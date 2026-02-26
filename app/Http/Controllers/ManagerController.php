<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cuti;

class ManagerController extends Controller
{
    public function dashboard()
    {
        $jumlah_karyawan = User::where('role', 'karyawan')->count();

        $cuti_pending = Cuti::where('status', 'pending')->count();

        $cuti_disetujui = Cuti::where('status', 'approved')->count();

        $cuti_ditolak = Cuti::where('status', 'rejected')->count();

        return view('manager.dashboard', compact(
            'jumlah_karyawan',
            'cuti_pending',
            'cuti_disetujui',
            'cuti_ditolak'
        ));
    }
}
