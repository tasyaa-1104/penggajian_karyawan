<?php

namespace App\Http\Controllers;

use App\Models\rekap_absensi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KaryawanDashboardController extends Controller
{
    // public function index()
    // {
    //     $user = Auth::user();

    //     if (!$user || !$user->karyawan) {
    //         abort(403, 'Akun ini tidak terdaftar sebagai karyawan');
    //     }

    //     $bulan = now()->format('Y-m');

    //     $rekap = rekap_absensi::where('id_karyawan', $user->karyawan->id_karyawan)
    //         ->where('bulan', $bulan)
    //         ->first();

    //     return view('karyawan.dashboard', compact('rekap'));
    // }
}
