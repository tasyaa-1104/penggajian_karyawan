<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Carbon\Carbon;

use App\Models\Izin;
use App\Models\Sakit;
use App\Models\Karyawan;
use App\Models\Cuti;
use App\Models\Overtime;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{

    /**
     * Dashboard Manager
     */
   public function dashboard()
{
    $jumlah_karyawan = Karyawan::count();

    $cuti_pending = Cuti::where('status','pending')->count();
    $cuti_disetujui = Cuti::where('status','approved')->count();
    $cuti_ditolak = Cuti::where('status','rejected')->count();

    $overtime_pending = Overtime::where('status','pending')->count();
    $overtime_approved = Overtime::where('status','approved')->count();
    $overtime_rejected = Overtime::where('status','rejected')->count();

    $absensi_hari_ini = Absensi::whereDate('tanggal', Carbon::today())->count();

    $notif = $this->notif();

    return view('manager.dashboard', array_merge(compact(
        'jumlah_karyawan',
        'cuti_pending',
        'cuti_disetujui',
        'cuti_ditolak',
        'overtime_pending',
        'overtime_approved',
        'overtime_rejected',
        'absensi_hari_ini'
    ), $notif));
}

    private function notif()
{
    $izin_pending = Izin::where('status','pending')->count();
    $sakit_pending = Sakit::where('status','pending')->count();

    return [
        'izin_pending' => $izin_pending,
        'sakit_pending' => $sakit_pending,
        'total_notif' => $izin_pending + $sakit_pending
    ];
}
    /**
     * Halaman Persetujuan Overtime Manager
     */
    public function indexManager(): View
    {
        $overtimes = Overtime::with('karyawan')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('manager.overtime-index', compact('overtimes'));
    }

    /**
     * Laporan Manager
     */
    public function laporan()
    {
        $laporan = Absensi::with(['karyawan','overtime'])
            ->orderBy('tanggal','desc')
            ->get();

        return view('manager.laporan-index', compact('laporan'));
    }

    /**
     * Data Karyawan
     */
    public function karyawan()
    {
        $karyawan = Karyawan::orderBy('nama_karyawan','asc')->get();

        return view('manager.karyawan-index', compact('karyawan'));
    }

//     public function absenIzin(Request $request)
// {
//     $request->validate([
//         'status_kehadiran' => 'required|in:Izin,Sakit',
//         'keterangan' => 'required|min:5'
//     ]);

//     $karyawan = Karyawan::where('id_user', Auth::user()->id)->first();

//     if (!$karyawan) {
//         return back()->with('error','Akun belum terhubung dengan data karyawan');
//     }

//     $tanggal = Carbon::now('Asia/Jakarta')->toDateString();

//     if($request->status_kehadiran == 'Izin')
//     {
//         Izin::create([
//             'karyawan_id' => $karyawan->id_karyawan,
//             'tanggal' => $tanggal,
//             'alasan' => $request->keterangan,
//             'status' => 'pending'
//         ]);
//     }

//     if($request->status_kehadiran == 'Sakit')
//     {
//         Sakit::create([
//             'karyawan_id' => $karyawan->id_karyawan,
//             'tanggal' => $tanggal,
//             'keterangan' => $request->keterangan,
//             'status' => 'pending'
//         ]);
//     }

//     return back()->with('success','Pengajuan berhasil dikirim, menunggu approval manager');
// }

  /**
     * Halaman data izin
     */
    public function izin()
    {
        $data = Izin::with('karyawan')
            ->orderBy('tanggal','desc')
            ->get();

        return view('manager.izin', compact('data'));
    }


    /**
     * Halaman data sakit
     */
    public function sakit()
    {
        $data = Sakit::with('karyawan')
            ->orderBy('tanggal','desc')
            ->get();

        return view('manager.sakit', compact('data'));
    }


public function approveIzin($id)
{
    $izin = Izin::findOrFail($id);

    $izin->status = 'disetujui';
    $izin->save();

    Absensi::create([
        'id_karyawan' => $izin->karyawan_id,
        'tanggal' => $izin->tanggal,
        'status_kehadiran' => 'Izin',
        'keterangan' => $izin->alasan
    ]);

    return back()->with('success','Izin disetujui');
}

public function approveSakit($id)
{
    $sakit = Sakit::findOrFail($id);

    $sakit->status = 'disetujui';
    $sakit->save();

    Absensi::create([
        'id_karyawan' => $sakit->karyawan_id,
        'tanggal' => $sakit->tanggal,
        'status_kehadiran' => 'Sakit',
        'keterangan' => $sakit->keterangan
    ]);

    return back()->with('success','Sakit disetujui');
}

}
