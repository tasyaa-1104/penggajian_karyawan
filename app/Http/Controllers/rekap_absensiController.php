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
     * TAMPIL DATA REKAP ABSENSI
     */
    public function index()
    {
        return view('admin.rekap-absensi', [
            'rekap' => rekap_absensi::with('karyawan')
                        ->orderBy('bulan', 'desc')
                        ->get(),
            'karyawan' => Karyawan::all()
        ]);
    }

    /**
     * FORM GENERATE REKAP
     */
    public function create()
    {
        return view('admin.rekap-absensi-create');
    }

    /**
     * PROSES GENERATE REKAP ABSENSI
     */
    public function store(Request $request)
    {
        $request->validate([
            'bulan' => 'required'
        ]);

        $bulan = $request->bulan;

        foreach (Karyawan::all() as $karyawan) {

            $absensi = Absensi::where('id_karyawan', $karyawan->id_karyawan)
                ->whereMonth('tanggal', Carbon::parse($bulan)->month)
                ->whereYear('tanggal', Carbon::parse($bulan)->year)
                ->get();

            rekap_absensi::updateOrCreate(
                [
                    'id_karyawan' => $karyawan->id_karyawan,
                    'bulan' => $bulan
                ],
                [
                    'jumlah_hadir' => $absensi->where('status_kehadiran', 'hadir')->count(),
                    'jumlah_izin'  => $absensi->where('status_kehadiran', 'izin')->count(),
                    'jumlah_alpha' => $absensi->where('status_kehadiran', 'alpa')->count(),
                ]
            );
        }

        return redirect()->route('rekap-absensi.index')
            ->with('success', 'Rekap absensi berhasil digenerate');
    }

    /**
     * FORM EDIT REKAP
     */
    public function edit(rekap_absensi $rekap_absensi)
    {
        return view('admin.rekap-absen.edit', [
            'rekap' => $rekap_absensi,
            'karyawan' => Karyawan::all()
        ]);
    }

    /**
     * UPDATE DATA REKAP
     */
    public function update(Request $request, rekap_absensi $rekap_absensi)
    {
        $request->validate([
            'id_karyawan'  => 'required',
            'bulan'        => 'required',
            'jumlah_hadir' => 'required|integer',
            'jumlah_izin'  => 'required|integer',
            'jumlah_alpha' => 'required|integer',
        ]);

        $rekap_absensi->update([
            'id_karyawan'  => $request->id_karyawan,
            'bulan'        => $request->bulan,
            'jumlah_hadir' => $request->jumlah_hadir,
            'jumlah_izin'  => $request->jumlah_izin,
            'jumlah_alpha' => $request->jumlah_alpha,
        ]);

        return redirect()->route('rekap-absensi.index')
            ->with('success', 'Rekap absensi berhasil diupdate');
    }

    /**
     * HAPUS DATA REKAP
     */
    public function destroy(rekap_absensi $rekap_absensi)
    {
        $rekap_absensi->delete();

        return redirect()->route('rekap-absensi.index')
            ->with('success', 'Rekap absensi berhasil dihapus');
    }
}
