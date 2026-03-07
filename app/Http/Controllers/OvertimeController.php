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
     * HRD / ADMIN - LIST OVERTIME
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
     * MANAGER - LIST PENDING OVERTIME
     * =========================
     */
    public function indexManager()
    {
        $overtimes = Overtime::with('karyawan')
            ->where('status', 'pending')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('manager.overtime-index', compact('overtimes'));
    }


    /**
     * =========================
     * GENERATE OVERTIME PER KARYAWAN
     * =========================
     */
    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id'   => 'required|exists:karyawan,id_karyawan',
            'tanggal'       => 'required|date',
            'tarif_per_jam' => 'required|numeric|min:0'
        ]);

        $absensi = Absensi::where('id_karyawan', $request->karyawan_id)
            ->whereDate('tanggal', $request->tanggal)
            ->first();

        if (!$absensi || !$absensi->jam_pulang) {
            return back()->with('error', 'Absensi atau jam pulang tidak ditemukan');
        }

        $jamNormalPulang = Carbon::createFromTime(17, 0);
        $jamPulang = Carbon::parse($absensi->jam_pulang);

        if ($jamPulang->lte($jamNormalPulang)) {
            return back()->with('error', 'Tidak ada lembur di tanggal tersebut');
        }

        $exists = Overtime::where([
            'karyawan_id' => $request->karyawan_id,
            'tanggal' => $request->tanggal,
            'sumber' => 'absensi'
        ])->exists();

        if ($exists) {
            return back()->with('error', 'Overtime sudah pernah dibuat');
        }

        $totalJam = $jamNormalPulang->diffInMinutes($jamPulang) / 60;
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
     * =========================
     */
    public function generateFromAbsensi()
{
    $jamNormal = Carbon::createFromTime(17, 0);
    $tarif = 50000;

    $generated = 0;

    $absensis = Absensi::whereNotNull('jam_pulang')->get();

    foreach ($absensis as $absen) {

        $jamPulang = Carbon::parse($absen->jam_pulang);

        // cek apakah overtime sudah ada
        $exists = Overtime::where([
            'karyawan_id' => $absen->id_karyawan,
            'tanggal' => $absen->tanggal,
            'sumber' => 'absensi'
        ])->exists();

        if ($exists) {
            continue;
        }

        // hitung jam lembur
        if ($jamPulang->lte($jamNormal)) {

            $totalJam = 0;
            $totalUpah = 0;

        } else {

            $totalJam = $jamNormal->diffInMinutes($jamPulang) / 60;
            $totalUpah = $totalJam * $tarif;

        }

        Overtime::create([
            'karyawan_id'   => $absen->id_karyawan,
            'tanggal'       => $absen->tanggal,
            'jam_mulai'     => '17:00:00',
            'jam_selesai'   => $jamPulang->format('H:i:s'),
            'total_jam'     => round($totalJam, 2),
            'tarif_per_jam' => $tarif,
            'total_upah'    => round($totalUpah, 2),
            'sumber'        => 'absensi',
            'status'        => 'pending'
        ]);

        $generated++;
    }

    return back()->with(
        'success',
        "$generated data overtime berhasil digenerate"
    );
}


    /**
     * =========================
     * APPROVE OVERTIME (MANAGER)
     * =========================
     */
    public function approve($id)
    {
        $overtime = Overtime::find($id);

        if (!$overtime) {
            return back()->with('error', 'Data overtime tidak ditemukan');
        }

        $overtime->status = 'approved';
        $overtime->save();

        return back()->with('success', 'Lembur berhasil disetujui');
    }


    /**
     * =========================
     * REJECT OVERTIME (MANAGER)
     * =========================
     */
    public function reject($id)
    {
        $overtime = Overtime::find($id);

        if (!$overtime) {
            return back()->with('error', 'Data overtime tidak ditemukan');
        }

        $overtime->status = 'rejected';
        $overtime->save();

        return back()->with('success', 'Lembur ditolak');
    }


    /**
     * =========================
     * DELETE OVERTIME (HRD)
     * =========================
     */
    public function destroy($id)
    {
        $overtime = Overtime::find($id);

        if (!$overtime) {
            return back()->with('error', 'Data overtime tidak ditemukan');
        }

        $overtime->delete();

        return back()->with('success', 'Data overtime berhasil dihapus');
    }

}
