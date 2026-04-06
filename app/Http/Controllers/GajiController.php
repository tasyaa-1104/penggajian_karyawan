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
        'bulan' => 'required|date_format:Y-m',
        'id_karyawan' => 'required|array',
        'jenis_periode' => 'required'
    ]);

    $bulanInput = $request->bulan;
    $jenis = $request->jenis_periode;
    $karyawanIds = $request->id_karyawan;

    $bulan = Carbon::createFromFormat('Y-m', $bulanInput);

    // =========================
    // 🔥 HITUNG PERIODE
    // =========================
    if ($jenis == '25') {
        $start = $bulan->copy()->subMonth()->day(26);
        $end   = $bulan->copy()->day(25);
    } else {
        $start = $bulan->copy()->startOfMonth();
        $end   = $bulan->copy()->endOfMonth();
    }

    $tarif = [
        'alpha' => 100000,
        'izin'  => 25000,
    ];

    foreach ($karyawanIds as $id_karyawan) {

        $karyawan = Karyawan::with('tunjangan')->findOrFail($id_karyawan);

        // =========================
        // 🔥 FILTER TANGGAL MASUK
        // =========================
        $tanggalMasuk = Carbon::parse($karyawan->tanggal_masuk);

        $startHitung = $tanggalMasuk > $start ? $tanggalMasuk : $start;

        // =========================
        // 🔥 AMBIL REKAP SESUAI PERIODE
        // =========================
        $rekap = rekap_absensi::where('id_karyawan', $id_karyawan)
            ->where('bulan', $bulanInput)
            ->first();

        if (!$rekap) {
            continue;
        }

        // HITUNG MANUAL (biar fleksibel)
        $jumlah_alpha = $rekap->jumlah_alpha;
        $jumlah_izin  = $rekap->jumlah_izin;

        // =========================
        // TUNJANGAN
        // =========================
        $total_tunjangan = $karyawan->tunjangan->sum('nominal');

        // =========================
        // OVERTIME
        // =========================
        $total_overtime = Overtime::where('karyawan_id', $id_karyawan)
            ->whereBetween('tanggal', [$startHitung, $end])
            ->where('status', 'approved')
            ->sum('total_upah');

        // =========================
        // POTONGAN
        // =========================
        $total_potongan =
            ($jumlah_alpha * $tarif['alpha']) +
            ($jumlah_izin  * $tarif['izin']);

        // =========================
        // GAJI AKHIR
        // =========================
        $gaji_bersih =
            $karyawan->gaji_pokok +
            $total_tunjangan +
            $total_overtime -
            $total_potongan;

        // =========================
        // SIMPAN
        // =========================
        Gaji::updateOrCreate(
            [
                'id_karyawan' => $id_karyawan,
                'bulan' => $bulanInput
            ],
            [
                'periode_awal' => $start,
                'periode_akhir' => $end,
                'total_tunjangan' => $total_tunjangan,
                'total_overtime' => $total_overtime,
                'total_potongan' => $total_potongan,
                'gaji_bersih' => $gaji_bersih,
            ]
        );
    }

    return redirect()->route('gaji.index')
        ->with('success', 'Gaji berhasil dihitung sesuai periode!');
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
