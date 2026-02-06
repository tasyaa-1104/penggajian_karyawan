<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Karyawan;
use App\Models\Absensi;
use App\Models\Potongan;
use App\Models\rekap_absensi;
use App\Models\Tunjangan;
use Illuminate\Http\Request;

class GajiController extends Controller
{
     public function index()
    {
        $gaji = Gaji::with(['karyawan.jabatan', 'slipGaji'])
            ->orderBy('bulan', 'desc')
            ->get();

        return view('admin.gaji', compact('gaji'));
    }

    /* =========================
     * FORM HITUNG GAJI MASSAL
     * ========================= */
    public function create()
    {
        return view('admin.gaji-create', [
            'karyawan' => Karyawan::where('status_karyawan', 'aktif')->get()
        ]);
    }

    /* =========================
     * PROSES HITUNG GAJI MASSAL
     * ========================= */
    public function store(Request $request)
    {
        $request->validate([
            'bulan'        => 'required|date_format:Y-m',
            'id_karyawan'  => 'required|array'
        ]);

        $bulan = $request->bulan;
        $karyawanIds = $request->id_karyawan;

        $tarif = [
            'alpha' => 100000,
            'izin'  => 25000,
        ];

        $total_tunjangan = Tunjangan::sum('nominal');

        foreach ($karyawanIds as $id_karyawan) {

            $karyawan = Karyawan::findOrFail($id_karyawan);

            // ambil rekap
            $rekap = rekap_absensi::where('id_karyawan', $id_karyawan)
                ->where('bulan', $bulan)
                ->first();

            // skip kalau rekap belum ada
            if (!$rekap) continue;

            $total_potongan =
                ($rekap->jumlah_alpha * $tarif['alpha']) +
                ($rekap->jumlah_izin  * $tarif['izin']);

            $gaji_bersih =
                $karyawan->gaji_pokok +
                $total_tunjangan -
                $total_potongan;

            Gaji::updateOrCreate(
                [
                    'id_karyawan' => $id_karyawan,
                    'bulan'       => $bulan
                ],
                [
                    'total_tunjangan' => $total_tunjangan,
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
            ->with('success', 'Data gaji dihapus');
    }
}
