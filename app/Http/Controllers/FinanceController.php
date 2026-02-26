<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cuti;

class FinanceController extends Controller
{
    public function dashboard()
    {
        $jumlah_karyawan = User::where('role', 'karyawan')->count();

        $cuti_disetujui = Cuti::where('status', 'approved')->count();

        // contoh data dummy gaji
        $total_gaji = 50000000;

        $penggajian_pending = 3;

        return view('finance.dashboard', compact(
            'jumlah_karyawan',
            'cuti_disetujui',
            'total_gaji',
            'penggajian_pending'
        ));
    }
}
