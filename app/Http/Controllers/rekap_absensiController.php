<?php

namespace App\Http\Controllers;


use App\Exports\RekapAbsensiExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\rekap_absensi;
use App\Models\Absensi;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class rekap_absensiController extends Controller
{
    /* ===============================
       HALAMAN INDEX
    =============================== */
    public function index(Request $request)
    {
        $search = $request->search;

        $rekap = rekap_absensi::with('karyawan')
            ->when($search, function ($q) use ($search) {
                $q->where('bulan', 'like', "%{$search}%")
                  ->orWhereHas('karyawan', function ($k) use ($search) {
                      $k->where('nama_karyawan', 'like', "%{$search}%");
                  });
            })
            ->orderBy('bulan', 'desc')
            ->get();

        return view('admin.rekap-absensi', compact('rekap', 'search'));
    }

    public function create()
    {
        return view('admin.rekap-absensi-create');
    }

    /* ===============================
       WEB GENERATE
    =============================== */
    public function generate(Request $request)
    {
        $request->validate([
            'bulan' => 'required|date_format:Y-m'
        ]);

        $this->generateRekap($request->bulan);

        return redirect()
            ->route('rekap-absensi.index')
            ->with('success', 'Rekap bulan '.$request->bulan.' berhasil digenerate');
    }

    /* ===============================
       LOGIKA INTI (WEB + SCHEDULER)
    =============================== */
public function generateRekap(string $bulan)
{
    $carbon = Carbon::createFromFormat('Y-m', $bulan);

    $bulanAngka = $carbon->month;
    $tahunAngka = $carbon->year;

    $hariIni = Carbon::today();

    // ❌ Blok bulan depan
    if ($carbon->copy()->startOfMonth()->gt($hariIni->copy()->startOfMonth())) {
        return;
    }

    // 🔥 Range hari dari config (REKOMENDASI = 0)
    $rangeHari = config('absensi.range_hari', 0);

    // 🔥 Tentukan batas hari
    if ($carbon->isSameMonth($hariIni)) {
        $batasHari = $hariIni->copy()->addDays($rangeHari)->day;
    } else {
        $batasHari = $carbon->daysInMonth;
    }

    /* ===============================
       HITUNG HARI KERJA
    =============================== */
    $totalHariKerja = 0;

    for ($i = 1; $i <= $batasHari; $i++) {

        $tgl = Carbon::create($tahunAngka, $bulanAngka, $i);

        if (!$tgl->isWeekend()) {
            $totalHariKerja++;
        }
    }

    /* ===============================
       HITUNG PER KARYAWAN
    =============================== */
    $karyawan = Karyawan::all();

    foreach ($karyawan as $k) {

    // 🔥 Tentukan tanggal mulai kerja dihitung
    $tanggalMasuk = Carbon::parse($k->created_at);

    // 🔥 Kalau karyawan dibuat setelah bulan yang direkap → SKIP
if ($tanggalMasuk->gt($carbon->copy()->endOfMonth())) {
    continue;
}

    $tanggalAwalHitung = $carbon->copy()->startOfMonth();

    // Jika karyawan dibuat di bulan yang sama
    if ($tanggalMasuk->isSameMonth($carbon)) {
        $tanggalAwalHitung = $tanggalMasuk->copy();
    }

    $totalHariKerja = 0;

    for ($i = $tanggalAwalHitung->day; $i <= $batasHari; $i++) {

        $tgl = Carbon::create($tahunAngka, $bulanAngka, $i);

        if (!$tgl->isWeekend()) {
            $totalHariKerja++;
        }
    }

    $hadir = Absensi::where('id_karyawan', $k->id_karyawan)
        ->whereMonth('tanggal', $bulanAngka)
        ->whereYear('tanggal', $tahunAngka)
        ->whereRaw('LOWER(status_kehadiran) = ?', ['hadir'])
        ->count();

    $izin = Absensi::where('id_karyawan', $k->id_karyawan)
        ->whereMonth('tanggal', $bulanAngka)
        ->whereYear('tanggal', $tahunAngka)
        ->whereRaw('LOWER(status_kehadiran) = ?', ['izin'])
        ->count();

    $sakit = Absensi::where('id_karyawan', $k->id_karyawan)
        ->whereMonth('tanggal', $bulanAngka)
        ->whereYear('tanggal', $tahunAngka)
        ->whereRaw('LOWER(status_kehadiran) = ?', ['sakit'])
        ->count();

    $alpha = $totalHariKerja - ($hadir + $izin + $sakit);
    if ($alpha < 0) $alpha = 0;

    rekap_absensi::updateOrCreate(
        [
            'id_karyawan' => $k->id_karyawan,
            'bulan'       => $bulan
        ],
        [
            'jumlah_hadir' => $hadir,
            'jumlah_izin'  => $izin,
            'jumlah_sakit' => $sakit,
            'jumlah_alpha' => $alpha
        ]
    );
    }
}
    public function destroy($id)
    {
        rekap_absensi::where('id_rekap', $id)->delete();

        return redirect()
            ->route('rekap-absensi.index')
            ->with('success', 'Rekap dihapus');
    }

    public function exportExcel()
{
    return Excel::download(new RekapAbsensiExport, 'rekap-absensi.xlsx');
}
  
public function exportPDF()
{
    $rekap = rekap_absensi::with('karyawan')->get();

    $pdf = Pdf::loadView('admin.rekap-absensi-pdf', compact('rekap'));

    return $pdf->download('rekap-absensi.pdf');
}
}
