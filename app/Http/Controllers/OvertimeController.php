<?php

namespace App\Http\Controllers;

use App\Models\Overtime;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OvertimeController extends Controller
{
    /**
     * Tampilkan halaman overtime
     */
    public function index()
    {
        $overtimes = Overtime::with('karyawan')->latest()->get();
        $karyawans = Karyawan::where('status_karyawan', 'aktif')->get();

        return view('admin.overtime-index', compact('overtimes', 'karyawans'));
    }

    /**
     * Simpan data overtime
     */
    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id'   => 'required|exists:karyawan,id_karyawan',
            'tanggal'       => 'required|date',
            'jam_mulai'     => 'required',
            'jam_selesai'   => 'required|after:jam_mulai',
            'tarif_per_jam' => 'required|numeric|min:0',
        ]);

        // parsing jam
        $jamMulai   = Carbon::createFromFormat('H:i', $request->jam_mulai);
        $jamSelesai = Carbon::createFromFormat('H:i', $request->jam_selesai);

        // hitung total jam (dibulatkan ke atas)
        $totalJam = $jamMulai->diffInMinutes($jamSelesai) / 60;
        $totalJam = ceil($totalJam); // biar ga pecahan

        // hitung upah
        $totalUpah = $totalJam * $request->tarif_per_jam;

        Overtime::create([
            'karyawan_id'   => $request->karyawan_id,
            'tanggal'       => $request->tanggal,
            'jam_mulai'     => $request->jam_mulai,
            'jam_selesai'   => $request->jam_selesai,
            'total_jam'     => $totalJam,
            'tarif_per_jam' => $request->tarif_per_jam,
            'total_upah'    => $totalUpah,
            'status'        => 'pending',
        ]);

        return redirect()->route('overtime.index')
            ->with('success', 'Overtime berhasil ditambahkan');
    }

    /**
     * Approve overtime
     */
    public function approve($id)
    {
        $overtime = Overtime::findOrFail($id);
        $overtime->update(['status' => 'approved']);

        return redirect()->route('overtime.index')
            ->with('success', 'Overtime berhasil di-approve');
    }
}
