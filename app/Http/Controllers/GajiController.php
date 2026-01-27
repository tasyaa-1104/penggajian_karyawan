<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Karyawan;
use App\Models\Absensi;
use App\Models\Potongan;
use App\Models\Tunjangan;
use Illuminate\Http\Request;

class GajiController extends Controller
{
    public function index()
    {
        $gaji = Gaji::with('karyawan.jabatan')
            ->orderBy('bulan', 'desc')
            ->get();

        return view('admin.gaji', compact('gaji'));
    }

    public function create()
    {
        return view('admin.gaji-create', [
            'karyawan' => Karyawan::with('jabatan')->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_karyawan' => 'required|exists:karyawan,id_karyawan',
            'bulan' => 'required'
        ]);

        $karyawan = Karyawan::with('jabatan')->findOrFail($request->id_karyawan);

        /* =====================
         * GAJI POKOK
         * ===================== */
        $gaji_pokok = $karyawan->jabatan->gaji_pokok;

        /* =====================
         * AMBIL ABSENSI
         * ===================== */
        $absensi = Absensi::where('id_karyawan', $karyawan->id_karyawan)
            ->whereMonth('tanggal', date('m', strtotime($request->bulan)))
            ->whereYear('tanggal', date('Y', strtotime($request->bulan)))
            ->get();

        /* =====================
         * AMBIL ATURAN POTONGAN
         * ===================== */
        $aturan_potongan = Potongan::pluck('nominal', 'nama_potongan');
        // contoh: ['alfa'=>100000, 'izin'=>25000, 'sakit'=>10000]

        $total_potongan = 0;

        foreach ($absensi as $a) {
            if (isset($aturan_potongan[$a->status_kehadiran])) {
                $total_potongan += $aturan_potongan[$a->status_kehadiran];
            }
        }

        /* =====================
         * TUNJANGAN
         * ===================== */
        $total_tunjangan = Tunjangan::sum('nominal');

        /* =====================
         * GAJI BERSIH
         * ===================== */
        $gaji_bersih = $gaji_pokok + $total_tunjangan - $total_potongan;

        /* =====================
         * SIMPAN
         * ===================== */
        Gaji::create([
            'id_karyawan' => $karyawan->id_karyawan,
            'bulan' => $request->bulan,
            'total_tunjangan' => $total_tunjangan,
            'total_potongan' => $total_potongan,
            'gaji_bersih' => $gaji_bersih,
        ]);

        return redirect()->route('gaji.index')
            ->with('success', 'Gaji berhasil dihitung otomatis');
    }

    public function destroy($id)
    {
        Gaji::findOrFail($id)->delete();

        return redirect()->route('gaji.index')
            ->with('success', 'Data gaji dihapus');
    }
}
