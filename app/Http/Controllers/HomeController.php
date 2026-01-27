<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;

class HomeController extends Controller
{
    public function index()
    {
        $jumlahKaryawan = Karyawan::count();
        return view('landing', compact('jumlahKaryawan'));
    }
}
