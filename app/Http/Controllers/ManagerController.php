<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\Izin;
use App\Models\Sakit;
use App\Models\Karyawan;
use App\Models\Cuti;
use App\Models\Overtime;
use App\Models\Absensi;

class ManagerController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD MANAGER
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {
        $jumlah_karyawan = Karyawan::count();

        $cuti_pending = Cuti::where('status','pending')->count();
        $cuti_disetujui = Cuti::where('status','disetujui')->count();
        $cuti_ditolak = Cuti::where('status','ditolak')->count();

        $overtime_pending = Overtime::where('status','pending')->count();
        $overtime_approved = Overtime::where('status','approved')->count();
        $overtime_rejected = Overtime::where('status','rejected')->count();

        $izin_pending = Izin::where('status','pending')->count();
       $izin_disetujui = Izin::where('status','disetuji')->count();
        $izin_ditolak= Izin::where('status','ditolak')->count();

        $sakit_pending = Sakit::where('status','pending')->count();
        $sakit_disetujui = Sakit::where('status','disetujui')->count();
        $sakit_ditolak = Sakit::where('status','ditolak')->count();

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
            'izin_pending',
            'izin_disetujui',
            'izin_ditolak',

            'sakit_pending',
            'sakit_disetujui',
            'sakit_ditolak',
            'absensi_hari_ini'
        ), $notif));
    }


    /*
    |--------------------------------------------------------------------------
    | NOTIFIKASI SIDEBAR
    |--------------------------------------------------------------------------
    */

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


    /*
    |--------------------------------------------------------------------------
    | DATA KARYAWAN
    |--------------------------------------------------------------------------
    */

    public function karyawan()
    {
        $karyawan = Karyawan::orderBy('nama_karyawan','asc')->get();

        return view('manager.karyawan-index', compact('karyawan'));
    }


    /*
    |--------------------------------------------------------------------------
    | PERSETUJUAN LEMBUR
    |--------------------------------------------------------------------------
    */

    public function overtime(): View
    {
        $overtimes = Overtime::with('karyawan')
            ->orderBy('tanggal','desc')
            ->get();

        return view('manager.overtime-index', compact('overtimes'));
    }


    /*
    |--------------------------------------------------------------------------
    | DATA IZIN
    |--------------------------------------------------------------------------
    */
public function izin()
{
    $dataIzin = Izin::with('karyawan')->get()->map(function ($item) {
        $item->jenis_pengajuan = 'Izin';
        $item->isi = $item->alasan;
        $item->source = 'izin';
        return $item;
    });

    $dataSakit = Sakit::with('karyawan')->get()->map(function ($item) {
        $item->jenis_pengajuan = 'Sakit';
        $item->isi = $item->alasan;
        $item->source = 'sakit';
        return $item;
    });

    $data = $dataIzin->concat($dataSakit)->sortByDesc('tanggal')->values();

    return view('manager.izin', compact('data'));
}
//  public function izin()
// {
//     $data = Izin::where('status','pending')->get();

//     return view('manager.izin', compact('data'));
// }
// public function izin()
// {
//     $dataIzin = Izin::with('karyawan')->get()->map(function($item){
//       $item->jenis_pengajuan = 'Izin';
// $item->source = 'izin';
//     });

//     $dataSakit = Sakit::with('karyawan')->get()->map(function($item){
//        $item->jenis_pengajuan = 'Sakit';
// $item->source = 'sakit';
//     });

//     $data = $dataIzin->concat($dataSakit)->sortByDesc('tanggal');

//     return view('manager.izin', compact('data'));
// }
// public function izin()
// {
//    $dataIzin = Izin::with('karyawan')->get()->map(function($item){
//     $item->jenis = 'Izin';
//     return $item;
// });

// $dataSakit = Sakit::with('karyawan')->get()->map(function($item){
//     $item->jenis = 'Sakit';
//     return $item;
// });

// $data = $dataIzin->concat($dataSakit)->sortByDesc('tanggal');

//     $data = $dataIzin->concat($dataSakit)->sortByDesc('tanggal');

//     return view('manager.izin', compact('data'));
// }

public function izinSakit()
{
    $izin = Izin::with('karyawan')->get()->map(function ($item) {
        $item->jenis = 'Izin';
        $item->isi = $item->alasan;
        return $item;
    });

    $sakit = Sakit::with('karyawan')->get()->map(function ($item) {
        $item->jenis = 'Sakit';
        $item->isi = $item->alasan;
        return $item;
    });

    $data = $izin->concat($sakit)->sortByDesc('tanggal');

    return view('manager.izin', compact('data'));
}
    /*
    |--------------------------------------------------------------------------
    | DATA SAKIT
    |--------------------------------------------------------------------------
    */
public function sakit()
{
    $data = Sakit::where('status','pending')->get();

    return view('manager.sakit', compact('data'));
}


    /*
    |--------------------------------------------------------------------------
    | APPROVE IZIN
    |--------------------------------------------------------------------------
    */

public function approveIzin($id)
{
    $izin = Izin::findOrFail($id);

    $izin->status = 'disetujui';
    $izin->save();

    // masuk ke absensi
    Absensi::create([
        'id_karyawan' => $izin->karyawan_id,
        'tanggal' => $izin->tanggal,
        'status_kehadiran' => 'Izin',
        'alasan' => $izin->alasan,
        'jam_masuk' => null,
        'jam_pulang' => null
    ]);

    return redirect()->back()->with('success','Izin berhasil di approve');
}


public function rejectIzin($id)
{
    $izin = Izin::findOrFail($id);
    $izin->status = 'ditolak';
    $izin->save();

    return redirect()->back()->with('success','Izin ditolak');
}

    /*
    |--------------------------------------------------------------------------
    | APPROVE SAKIT
    |--------------------------------------------------------------------------
    */

public function approveSakit($id)
{
    $sakit = Sakit::findOrFail($id);

    $sakit->status = 'disetujui';
    $sakit->save();

    // masuk ke absensi
    Absensi::create([
        'id_karyawan' => $sakit->karyawan_id,
        'tanggal' => $sakit->tanggal,
        'status_kehadiran' => 'Sakit',
        'alasan' => $sakit->alasan,
        'jam_masuk' => null,
        'jam_pulang' => null
    ]);

    return redirect()->back()->with('success','Sakit berhasil disetujui');
}


public function rejectSakit($id)
{
    $sakit = Sakit::findOrFail($id);
    $sakit->status = 'ditolak';
    $sakit->save();

    return redirect()->back()->with('success','Sakit berhasil ditolak');
}


    /*
    |--------------------------------------------------------------------------
    | LAPORAN MANAGER
    |--------------------------------------------------------------------------
    */

    public function laporan()
    {

        $laporan = Absensi::with('karyawan')
            ->orderBy('tanggal','desc')
            ->get();

        $cuti = Cuti::with('karyawan')
            ->orderBy('tanggal_mulai','desc')
            ->get();

        $lembur = Overtime::with('karyawan')
            ->orderBy('tanggal','desc')
            ->get();

        $izin = Izin::with('karyawan')
            ->orderBy('tanggal','desc')
            ->get();

        $sakit = Sakit::with('karyawan')
            ->orderBy('tanggal','desc')
            ->get();


        $rekap = Karyawan::select('nama_karyawan')
            ->withCount([
                'absensi as hadir' => function ($q) {
                    $q->where('status_kehadiran','Hadir');
                },
                'absensi as terlambat' => function ($q) {
                    $q->where('status_kehadiran','Terlambat');
                },
                'absensi as alpha' => function ($q) {
                    $q->where('status_kehadiran','Alpha');
                }
            ])
            ->get();


        return view('manager.laporan-index', compact(
            'laporan',
            'cuti',
            'lembur',
            'izin',
            'sakit',
            'rekap'
        ));
    }

}
