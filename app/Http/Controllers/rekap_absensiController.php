<?php

namespace App\Http\Controllers;

use App\Models\rekap_absensi;
use App\Models\Absensi;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class rekap_absensiController extends Controller
{
    /**
     * TAMPIL DATA REKAP + SEARCH
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $rekap = rekap_absensi::with('karyawan')
            ->when($search, function ($query, $search) {
                $query->where('bulan', 'like', "%{$search}%")
                      ->orWhereHas('karyawan', function ($q) use ($search) {
                          $q->where('nama_karyawan', 'like', "%{$search}%");
                      });
            })
            ->orderBy('bulan', 'desc')
            ->get();

        return view('admin.rekap-absensi', compact('rekap', 'search'));
    }

    /**
     * FORM GENERATE
     */
    public function create()
    {
        return view('admin.rekap-absensi-create');
    }

    /**
     * PROSES GENERATE REKAP BULANAN
     */
    public function generate(Request $request)
{
    $request->validate([
        'bulan' => 'required'
    ]);

    $bulan = $request->bulan; // contoh: 2026-01

    $awalBulan  = Carbon::createFromFormat('Y-m', $bulan)->startOfMonth();
    $akhirBulan = Carbon::createFromFormat('Y-m', $bulan)->endOfMonth();

    // 🔥 HITUNG TOTAL HARI KERJA DALAM BULAN
    $totalHariKerja = 0;
    $tanggal = $awalBulan->copy();

    while ($tanggal <= $akhirBulan) {
        if (!$tanggal->isWeekend()) {
            $totalHariKerja++;
        }
        $tanggal->addDay();
    }

    $karyawan = Karyawan::all();

    foreach ($karyawan as $k) {

        $hadir = Absensi::where('id_karyawan', $k->id_karyawan)
            ->whereBetween('tanggal', [$awalBulan, $akhirBulan])
            ->where('status_kehadiran', 'Hadir')
            ->count();

        $izin = Absensi::where('id_karyawan', $k->id_karyawan)
            ->whereBetween('tanggal', [$awalBulan, $akhirBulan])
            ->where('status_kehadiran', 'Izin')
            ->count();

        // 🔥 ALPHA OTOMATIS PER BULAN
        $alpha = $totalHariKerja - ($hadir + $izin);

        if ($alpha < 0) {
            $alpha = 0;
        }

        rekap_absensi::updateOrCreate(
            [
                'id_karyawan' => $k->id_karyawan,
                'bulan' => $bulan
            ],
            [
                'jumlah_hadir' => $hadir,
                'jumlah_izin'  => $izin,
                'jumlah_alpha' => $alpha
            ]
        );
    }

    return redirect()
        ->route('rekap-absensi.index')
        ->with('success', 'Rekap absensi bulan '.$bulan.' berhasil digenerate');
}



    /**
     * HAPUS REKAP
     */
    public function destroy($id)
    {
        rekap_absensi::where('id_rekap', $id)->delete();

        return redirect()->route('rekap-absensi.index')
            ->with('success', 'Rekap absensi berhasil dihapus');
    }
}
