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
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.rekap_absen.index', [
            'rekap' => rekap_absensi::with('karyawan')
                        ->orderBy('bulan', 'desc')
                        ->get(),
            'karyawan' => Karyawan::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * (dipakai generate)
     */
    public function create()
    {
        return view('admin.rekap_absen.create');
    }

    /**
     * Store a newly created resource in storage.
     * GENERATE REKAP
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
                    'jumlah_sakit' => $absensi->where('status_kehadiran', 'sakit')->count(),
                    'jumlah_alpa'  => $absensi->where('status_kehadiran', 'alpa')->count(),
                ]
            );
        }

        return redirect()->route('rekap-absensi.index')
                         ->with('success', 'Rekap absensi berhasil digenerate');
    }

    /**
     * Display the specified resource.
     */
    public function show(rekap_absensi $rekap_absensi)
    {
        return view('admin.rekap_absen.show', [
            'rekap' => $rekap_absensi->load('karyawan')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(rekap_absensi $rekap_absensi)
    {
        return view('admin.rekap_absen.edit', [
            'rekap' => $rekap_absensi,
            'karyawan' => Karyawan::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rekap_absensi $rekap_absensi)
    {
        $request->validate([
            'id_karyawan'  => 'required',
            'bulan'        => 'required',
            'jumlah_hadir' => 'required|integer',
            'jumlah_izin'  => 'required|integer',
            'jumlah_sakit' => 'required|integer',
            'jumlah_alpa'  => 'required|integer',
        ]);

        $rekap_absensi->update($request->all());

        return redirect()->route('rekap-absensi.index')
                         ->with('success', 'Rekap absensi berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rekap_absensi $rekap_absensi)
    {
        $rekap_absensi->delete();

        return redirect()->route('rekap-absensi.index')
                         ->with('success', 'Rekap absensi berhasil dihapus');
    }
}
