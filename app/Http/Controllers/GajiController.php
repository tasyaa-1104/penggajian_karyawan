<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Karyawan;
use App\Models\rekap_absensi;
use App\Models\Overtime;
use App\Models\Tunjangan;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
            'bulan'       => 'required|date_format:Y-m',
            'id_karyawan' => 'required|array'
        ]);

        $bulanInput = $request->bulan;
        $karyawanIds = $request->id_karyawan;

        // parsing bulan
        $bulan = Carbon::createFromFormat('Y-m', $bulanInput);

        // tarif potongan
        $tarif = [
            'alpha' => 100000,
            'izin'  => 25000,
        ];

        // total tunjangan global
        $total_tunjangan = Tunjangan::sum('nominal');

        foreach ($karyawanIds as $id_karyawan) {

            $karyawan = Karyawan::findOrFail($id_karyawan);

            // ambil rekap absensi bulanan
            $rekap = rekap_absensi::where('id_karyawan', $id_karyawan)
                ->where('bulan', $bulanInput)
                ->first();

            // kalau tidak ada rekap, skip
            if (!$rekap) {
                continue;
            }

            // =====================
            // HITUNG OVERTIME
            // =====================
            $total_overtime = Overtime::where('karyawan_id', $id_karyawan)
                ->whereMonth('tanggal', $bulan->month)
                ->whereYear('tanggal', $bulan->year)
                ->where('status', 'approved')
                ->sum('total_upah');

            // =====================
            // HITUNG POTONGAN
            // =====================
            $total_potongan =
                ($rekap->jumlah_alpha * $tarif['alpha']) +
                ($rekap->jumlah_izin  * $tarif['izin']);

            // =====================
            // HITUNG GAJI BERSIH
            // =====================
            $gaji_bersih =
                $karyawan->gaji_pokok +
                $total_tunjangan +
                $total_overtime -
                $total_potongan;

            // simpan / update gaji
            Gaji::updateOrCreate(
                [
                    'id_karyawan' => $id_karyawan,
                    'bulan'       => $bulanInput
                ],
                [
                    'total_tunjangan' => $total_tunjangan,
                    'total_overtime'  => $total_overtime,
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
            ->with('success', 'Data gaji berhasil dihapus');
    }
}
