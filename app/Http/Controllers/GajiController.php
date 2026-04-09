<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Karyawan;
use App\Models\rekap_absensi;
use App\Models\Overtime;
use App\Models\Tunjangan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GajiController extends Controller
{
   public function index()
    {
       $gaji = Gaji::with([
        'karyawan.jabatan',
        'slipGaji',
        'rekap'
    ])->orderBy('bulan','desc')->get();

        $tunjangan = Tunjangan::all();

        return view('finance.gaji', compact('gaji','tunjangan'));
    }

    /* =========================
     * FORM HITUNG GAJI MASSAL
     * ========================= */
    public function create()
    {
        return view('finance.gaji-create', [
            'karyawan' => Karyawan::where('status_karyawan', 'aktif')->get()
        ]);
    }

    /* =========================
     * PROSES HITUNG GAJI MASSAL
     * ========================= */
   

public function store(Request $request)
{
    $request->validate([
        'bulan'       => 'required|date_format:Y-m',
        'id_karyawan' => 'required|array'
    ]);

    $bulanInput = $request->bulan;
    $karyawanIds = $request->id_karyawan;

    $bulan = Carbon::createFromFormat('Y-m', $bulanInput);

    $tarif = [
        'alpha' => 100000,
        'izin'  => 25000,
    ];

    foreach ($karyawanIds as $id_karyawan) {

        $karyawan = Karyawan::findOrFail($id_karyawan);

        $total_tunjangan = $karyawan->tunjangan->sum('nominal');

        $rekap = rekap_absensi::where('id_karyawan', $id_karyawan)
            ->where('bulan', $bulanInput)
            ->first();

        if (!$rekap) {
            continue;
        }

        /* =========================
           HITUNG TOTAL HARI KERJA VALID
        ========================= */
        $tanggalMasuk = Carbon::parse($karyawan->created_at);

        $start = $bulan->copy()->startOfMonth();
        $end   = $bulan->copy()->endOfMonth();

        // kalau masuk di bulan ini
        if ($tanggalMasuk->isSameMonth($bulan)) {
            $start = $tanggalMasuk->copy();
        }

        $totalHariKerja = 0;

        for ($date = $start->copy(); $date <= $end; $date->addDay()) {
            if (!$date->isWeekend()) {
                $totalHariKerja++;
            }
        }

        if ($totalHariKerja == 0) {
            continue;
        }

        /* =========================
           GAJI PER HARI
        ========================= */
        $gajiPerHari = $karyawan->gaji_pokok / $totalHariKerja;

        /* =========================
           GAJI BERDASARKAN HADIR
        ========================= */
        $gajiDariHadir = $gajiPerHari * $rekap->jumlah_hadir;

        /* =========================
           OVERTIME
        ========================= */
        $total_overtime = Overtime::where('karyawan_id', $id_karyawan)
            ->whereMonth('tanggal', $bulan->month)
            ->whereYear('tanggal', $bulan->year)
            ->where('status', 'approved')
            ->sum('total_upah');

        /* =========================
           POTONGAN
        ========================= */
        $total_potongan =
            ($rekap->jumlah_alpha * $tarif['alpha']) +
            ($rekap->jumlah_izin  * $tarif['izin']);

        /* =========================
           FINAL GAJI
        ========================= */
        $gaji_bersih =
            $gajiDariHadir +
            $total_tunjangan +
            $total_overtime -
            $total_potongan;

        Gaji::updateOrCreate(
            [
                'id_karyawan' => $id_karyawan,
                'bulan'       => $bulanInput
            ],
            [
                'total_tunjangan' => $total_tunjangan,
                'total_overtime'  => $total_overtime,
                'total_potongan'  => $total_potongan,
                'gaji_bersih'     => $gaji_bersih,
            ]
        );
    }

    return redirect()
        ->route('gaji.index')
        ->with('success', 'Gaji massal berhasil dihitung');
}

    public function destroy($id)
    {
        Gaji::where('id_gaji', $id)->delete();

        return redirect()
            ->route('gaji.index')
            ->with('success', 'Data gaji berhasil dihapus');
    }

    public function exportPdf()
    {
        $gaji = Gaji::with('karyawan.jabatan')->get();

        $pdf = Pdf::loadView('finance.gaji_pdf', compact('gaji'))
                ->setPaper('A4', 'landscape');

        return $pdf->download('Rekap_Data_Gaji.pdf');
    }
}
