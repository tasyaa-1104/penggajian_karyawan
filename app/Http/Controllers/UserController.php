<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Gaji;
use Carbon\Carbon;

class UserController extends Controller
{
  public function index()
{
    $jumlah_karyawan = Karyawan::count();
    $jumlah_gaji = Gaji::count();

    // SEMENTARA: supaya tidak error
    $total_gaji_bulan = 0;

    return view('admin.dashboard', compact(
        'jumlah_karyawan',
        'jumlah_gaji',
        'total_gaji_bulan'
    ));
}

}
