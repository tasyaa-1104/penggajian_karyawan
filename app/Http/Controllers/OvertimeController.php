<?php

namespace App\Http\Controllers;

use App\Models\Overtime;
use App\Models\Karyawan;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OvertimeController extends Controller
{
    /**
     * =========================
     * HALAMAN LIST OVERTIME
     * =========================
     */
    public function index()
    {
        return view('admin.overtime-index', [
            'overtimes' => Overtime::with('karyawan')
                ->orderBy('tanggal', 'desc')
                ->get(),

            'karyawans' => Karyawan::where('status_karyawan', 'aktif')->get(),
        ]);
    }

    /**
     * =========================
     * OVERTIME OTOMATIS PER KARYAWAN (KLIK)
     * sumber: absensi
     * =========================
     */
    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id'   => 'required|exists:karyawan,id_karyawan',
            'tanggal'       => 'required|date',
            'tarif_per_jam' => 'required|numeric|min:0'
        ]);

        // Ambil absensi hari itu
        $absensi = Absensi::where('id_karyawan', $request->karyawan_id)
            ->whereDate('tanggal', $request->tanggal)
            ->first();

        if (!$absensi || !$absensi->jam_pulang) {
            return back()->with('error', 'Absensi atau jam pulang tidak ditemukan');
        }

        $jamNormalPulang = Carbon::createFromTime(17, 0);
        $jamPulang       = Carbon::parse($absensi->jam_pulang);

        // Tidak lembur
        if ($jamPulang->lte($jamNormalPulang)) {
            return back()->with('error', 'Tidak ada lembur di tanggal tersebut');
        }

        // Cegah dobel overtime
        $exists = Overtime::where([
            'karyawan_id' => $request->karyawan_id,
            'tanggal'     => $request->tanggal,
            'sumber'      => 'absensi'
        ])->exists();

        if ($exists) {
            return back()->with('error', 'Overtime sudah pernah dibuat');
        }

        // Hitung lembur
        $totalJam   = $jamNormalPulang->diffInMinutes($jamPulang) / 60;
        $totalUpah = $totalJam * $request->tarif_per_jam;

        Overtime::create([
            'karyawan_id'   => $request->karyawan_id,
            'tanggal'       => $request->tanggal,
            'jam_mulai'     => '17:00:00',
            'jam_selesai'   => $jamPulang->format('H:i:s'),
            'total_jam'     => round($totalJam, 2),
            'tarif_per_jam' => $request->tarif_per_jam,
            'total_upah'    => round($totalUpah, 2),
            'sumber'        => 'absensi',
            'status'        => 'pending'
        ]);

        return back()->with('success', 'Overtime berhasil digenerate dari absensi');
    }

    /**
     * =========================
     * GENERATE SEMUA OVERTIME DARI ABSENSI
     * (TOMBOL "Generate dari Absensi")
     * =========================
     */
    /**
 * =========================
 * APPROVE OVERTIME
 * =========================
 */
public function approve($id)
{
    $overtime = Overtime::find($id);

    if (!$overtime) {
        return back()->with('error', 'Data overtime tidak ditemukan');
    }

    // Update status menjadi approved
    $overtime->status = 'approved';
    $overtime->save();

    return back()->with('success', 'Overtime berhasil di-approve');
}

public function generateFromAbsensi()
{
    $jamNormal = Carbon::createFromTime(17, 0);
    $tarif     = 20000;

    $testMode = true; // 🔥 UBAH false kalau sudah production
    $generated = 0;

    $absensis = Absensi::whereNotNull('jam_pulang')->get();

    foreach ($absensis as $absen) {

        $jamPulang = Carbon::parse($absen->jam_pulang);

        // ⛔ Skip kalau bukan lembur (kecuali test mode)
        if (!$testMode && $jamPulang->lte($jamNormal)) {
            continue;
        }

        // Cegah dobel
        $exists = Overtime::where([
            'karyawan_id' => $absen->id_karyawan,
            'tanggal'     => $absen->tanggal,
            'sumber'      => 'absensi'
        ])->exists();

        if ($exists) {
            continue;
        }

        // ⏱️ Hitung jam lembur
        $totalJam = max(
            0,
            $jamNormal->diffInMinutes($jamPulang) / 60
        );

        Overtime::create([
            'karyawan_id'   => $absen->id_karyawan,
            'tanggal'       => $absen->tanggal,
            'jam_mulai'     => '17:00:00',
            'jam_selesai'   => $jamPulang->format('H:i:s'),
            'total_jam'     => round($totalJam, 2),
            'tarif_per_jam' => $tarif,
            'total_upah'    => round($totalJam * $tarif, 2),
            'sumber'        => 'absensi',
            'status'        => 'pending'
        ]);

        $generated++;
    }

    // 📢 FEEDBACK YANG JUJUR
    if ($generated === 0) {
        return back()->with(
            'info',
            'Tidak ada absensi yang memenuhi syarat lembur (jam pulang > 17:00)'
        );
    }

    return back()->with(
        'success',
        "$generated data overtime berhasil digenerate"
    );

}
}
