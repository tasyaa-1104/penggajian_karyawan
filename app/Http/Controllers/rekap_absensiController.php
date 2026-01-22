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
            $rekap = rekap_absensi::with('karyawan')->get();

    return view('admin.rekap-absensi', compact('rekap'));

    }

    public function generate(Request $request)
    {
        $bulan = $request->bulan; // format: 2026-01

        // sementara test dulu
        return redirect()
            ->route('rekap-absensi.index')
            ->with('success', 'Rekap bulan '.$bulan.' berhasil digenerate');
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
        'id_karyawan' => 'required',
        'bulan' => 'required', // format: 2026-01
    ]);

    $bulan = $request->bulan;

    $hadir = Absensi::where('id_karyawan', $request->id_karyawan)
        ->whereMonth('tanggal', date('m', strtotime($bulan)))
        ->whereYear('tanggal', date('Y', strtotime($bulan)))
        ->where('status_kehadiran', 'Hadir')
        ->count();

    $izin = Absensi::where('id_karyawan', $request->id_karyawan)
        ->whereMonth('tanggal', date('m', strtotime($bulan)))
        ->whereYear('tanggal', date('Y', strtotime($bulan)))
        ->where('status_kehadiran', 'Izin')
        ->count();

    $alpha = Absensi::where('id_karyawan', $request->id_karyawan)
        ->whereMonth('tanggal', date('m', strtotime($bulan)))
        ->whereYear('tanggal', date('Y', strtotime($bulan)))
        ->where('status_kehadiran', 'Alpha')
        ->count();

    rekap_absensi::create([
        'id_karyawan' => $request->id_karyawan,
        'bulan' => $bulan,
        'jumlah_hadir' => $hadir,
        'jumlah_izin' => $izin,
        'jumlah_alpha' => $alpha,
    ]);

    return redirect()->route('rekap-absensi')
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
