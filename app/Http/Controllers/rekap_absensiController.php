<?php

namespace App\Http\Controllers;

use App\Models\rekap_absensi;
use App\Models\Absensi;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class rekap_absensiController extends Controller
{
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

    public function generate(Request $request)
    {
        $request->validate([
            'bulan' => 'required|date_format:Y-m'
        ]);

        $bulan = $request->bulan;
        $carbon = Carbon::createFromFormat('Y-m', $bulan);

        $bulanAngka = $carbon->month; // 2
        $tahunAngka = $carbon->year;  // 2026

        $hariIni = Carbon::today();

        // ❌ blok bulan depan
        if ($carbon->startOfMonth()->gt($hariIni->startOfMonth())) {
            return back()->withErrors([
                'bulan' => 'Bulan belum berjalan'
            ]);
        }

        // 🔥 batas hari untuk alpha
        $batasHari = $carbon->isSameMonth($hariIni)
            ? $hariIni->addDays(2)->day
            : $carbon->daysInMonth;
            
            $day = $carbon->isSameMonth($hariIni)
            ? 2
            : 0;



        // 🔥 hitung hari kerja yang sudah lewat
        $totalHariKerja = 0;
        for ($i = 1; $i <= $batasHari; $i++) {
            
            $tgl = Carbon::create($tahunAngka, $bulanAngka, $i)->addDays($day);
            if (!$tgl->isWeekend()) {
                $totalHariKerja++;
            }
        }

        $karyawan = Karyawan::all();

        foreach ($karyawan as $k) {

            // ✅ HADIR (FIX TOTAL)
            $hadir = Absensi::where('id_karyawan', $k->id_karyawan)
                ->whereMonth('tanggal', $bulanAngka)
                ->whereYear('tanggal', $tahunAngka)
                ->whereRaw('LOWER(status_kehadiran) = ?', ['hadir'])
                ->count();

            // ✅ IZIN
            $izin = Absensi::where('id_karyawan', $k->id_karyawan)
                ->whereMonth('tanggal', $bulanAngka)
                ->whereYear('tanggal', $tahunAngka)
                ->whereRaw('LOWER(status_kehadiran) = ?', ['izin'])
                ->count();

            // 🔥 ALPHA
            $alpha = $totalHariKerja - ($hadir + $izin);
            if ($alpha < 0) $alpha = 0;

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
            ->with('success', 'Rekap bulan '.$bulan.' berhasil digenerate');
    }

    public function destroy($id)
    {
        rekap_absensi::where('id_rekap', $id)->delete();

        return redirect()
            ->route('rekap-absensi.index')
            ->with('success', 'Rekap dihapus');
    }
}
