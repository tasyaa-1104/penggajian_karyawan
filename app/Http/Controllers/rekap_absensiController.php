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
     * TAMPIL DATA REKAP
     */
    public function index()
    {
        $rekap = rekap_absensi::with('karyawan')->orderBy('bulan', 'desc')->get();
        return view('admin.rekap-absensi', compact('rekap'));
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

        $alpha = Absensi::where('id_karyawan', $k->id_karyawan)
            ->whereBetween('tanggal', [$awalBulan, $akhirBulan])
            ->where('status_kehadiran', 'Alpha')
            ->count();

        rekap_absensi::updateOrCreate(
            [
                'id_karyawan' => $k->id_karyawan,
                'bulan' => $bulan
            ],
            [
                'jumlah_hadir' => $hadir,
                'jumlah_izin' => $izin,
                'jumlah_alpha' => $alpha
            ]
        );
    }

    return redirect()
        ->route('rekap-absensi.index')
        ->with('success', 'Rekap absensi bulan '.$bulan.' berhasil digenerate');
}
    /**
     * EDIT MANUAL (OPSIONAL)
     */
    public function edit(rekap_absensi $rekapAbsensi)
    {
        return view('admin.rekap-absensi-edit', [
            'rekap' => $rekapAbsensi,
            'karyawan' => Karyawan::all()
        ]);
    }

    /**
     * UPDATE MANUAL
     */
    public function update(Request $request, rekap_absensi $rekapAbsensi)
    {
        $request->validate([
            'jumlah_hadir' => 'required|integer',
            'jumlah_izin' => 'required|integer',
            'jumlah_alpha' => 'required|integer',
        ]);

        $rekapAbsensi->update($request->all());

        return redirect()->route('rekap-absensi.index')
            ->with('success', 'Rekap absensi berhasil diupdate');
    }

    /**
     * HAPUS REKAP
     */
    public function destroy(rekap_absensi $rekapAbsensi)
    {
        $rekapAbsensi->delete();

        return redirect()->route('rekap-absensi.index')
            ->with('success', 'Rekap absensi berhasil dihapus');
    }

}
