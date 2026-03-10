<?php

namespace App\Http\Controllers;

use App\Models\Cuti;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CutiController extends Controller
{
    /* =========================
     * HALAMAN KARYAWAN - CUTI
     * ========================= */
    public function indexKaryawan()
    {
        $karyawan = Karyawan::where('id_user', Auth::id())->firstOrFail();


        $cuti = Cuti::where('id_karyawan', $karyawan->id_karyawan)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('cuti', compact('cuti'));
    }

    /* =========================
     * SIMPAN CUTI KARYAWAN
     * ========================= */
   public function store(Request $request)
{
    $request->validate([
        'tanggal_mulai'   => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        'alasan'          => 'required'
    ]);

    $karyawan = Karyawan::where('id_user', Auth::id())->firstOrFail();

    // CEK apakah sudah mengajukan cuti bulan ini
    $sudahCuti = Cuti::where('id_karyawan', $karyawan->id_karyawan)
        ->whereMonth('tanggal_mulai', date('m'))
        ->whereYear('tanggal_mulai', date('Y'))
        ->exists();

    if ($sudahCuti) {
        return redirect()
            ->route('karyawan.cuti')
            ->with('error', 'Anda sudah mengajukan cuti bulan ini. Pengajuan berikutnya hanya bisa dilakukan bulan depan.');
    }

    Cuti::create([
        'id_karyawan'     => $karyawan->id_karyawan,
        'tanggal_mulai'   => $request->tanggal_mulai,
        'tanggal_selesai' => $request->tanggal_selesai,
        'alasan'          => $request->alasan,
        'status'          => 'pending'
    ]);

    return redirect()
        ->route('karyawan.cuti')
        ->with('success', 'Pengajuan cuti berhasil dikirim');
}

    /* =========================
     * HALAMAN ADMIN - DATA CUTI
     * ========================= */
    public function indexAdmin()
    {
        $cuti = Cuti::with('karyawan')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.cuti', compact('cuti'));
    }

    /* =========================
     * ADMIN ACC CUTI
     * ========================= */
    public function approve($id)
    {
        Cuti::where('id_cuti', $id)
            ->update(['status' => 'disetujui']);

        return back()->with('success', 'Cuti disetujui');
    }

    /* =========================
     * ADMIN TOLAK CUTI
     * ========================= */
    public function reject($id)
    {
        Cuti::where('id_cuti', $id)
            ->update(['status' => 'ditolak']);

        return back()->with('success', 'Cuti ditolak');
    }

    /* =========================
 * HRD - HANYA MELIHAT CUTI
 * ========================= */
public function indexHRD()
{
    $cuti = Cuti::with('karyawan')
        ->orderBy('created_at', 'desc')
        ->get();

    return view('admin.cuti', compact('cuti'));
}

/* =========================
 * MANAGER - APPROVE CUTI
 * ========================= */
public function indexManager()
{
    $cuti = Cuti::with('karyawan')
        ->where('status', 'pending') // hanya yang mengajukan
        ->orderBy('created_at', 'desc')
        ->get();

    return view('manager.cuti', compact('cuti'));
}

public function destroy($id)
{
    Cuti::where('id_cuti', $id)->delete();

    return back()->with('success','Data cuti berhasil dihapus');
}
}
