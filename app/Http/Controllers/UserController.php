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

    // FORMAT BULAN SESUAI DATABASE (YYYY-MM)
    $bulan = now()->format('Y-m');

    // TOTAL GAJI BULAN INI
    $total_gaji_bulan = Gaji::where('bulan', $bulan)
        ->sum('gaji_bersih');

    // STATUS GAJI KARYAWAN OTOMATIS
    $status_karyawan = Karyawan::leftJoin('gaji', function ($join) use ($bulan) {
            $join->on('karyawan.id_karyawan', '=', 'gaji.id_karyawan')
                 ->where('gaji.bulan', $bulan);
        })
        ->select('karyawan.nama_karyawan', 'gaji.id_gaji')
        ->orderBy('karyawan.nama_karyawan')
        ->get()
        ->map(function ($row) {
            return [
                'nama'   => $row->nama_karyawan,
                'status'=> $row->id_gaji ? 'Dibayar' : 'Belum'
            ];
        });

    $komposisi_gaji = [70,20,10];

    return view('admin.dashboard', compact(
        'jumlah_karyawan',
        'jumlah_gaji',
        'total_gaji_bulan',
        'status_karyawan',
        'komposisi_gaji'
    ));
}


}
