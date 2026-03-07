<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Carbon\Carbon;

use App\Models\Karyawan;
use App\Models\Cuti;
use App\Models\Overtime;
use App\Models\Absensi;

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
        $overtime_rejected = Overtime::where('status','rejected')->count(); // tambah ini

        $absensi_hari_ini = Absensi::whereDate('tanggal', Carbon::today())->count();

        return view('manager.dashboard', compact(
            'jumlah_karyawan',
            'cuti_pending',
            'cuti_disetujui',
            'cuti_ditolak',
            'overtime_pending',
            'overtime_approved',
            'overtime_rejected',
            'absensi_hari_ini'
        ));
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

}