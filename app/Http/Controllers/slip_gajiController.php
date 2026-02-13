<?php

namespace App\Http\Controllers;

use App\Models\slip_gaji;
use App\Models\Gaji;
use Illuminate\Http\Request;

class slip_gajiController extends Controller
{
    // tampilkan daftar slip
    // public function index()
    // {
    //     $slip = slip_gaji::with('gaji.karyawan.jabatan')
    //         ->orderBy('tanggal_cetak','desc')
    //         ->get();

    //     return view('slip-gaji', compact('slip'));
    // }

    // generate slip dari gaji
    // public function store($id_gaji)
    // {
    //     slip_gaji::create([
    //         'id_gaji' => $id_gaji,
    //         'tanggal_cetak' => now(),
    //     ]);

    //     return redirect()->route('slip-gaji.index')
    //         ->with('success','Slip gaji berhasil dibuat');
    // }

    // tampilkan detail slip
    // public function show($id)
    // {
    //     $slip = slip_gaji::with('gaji.karyawan.jabatan')
    //         ->findOrFail($id);

    //     return view('slip-gaji-show', compact('slip'));
    // }

    /* ================= ADMIN ================= */

    public function indexAdmin()
    {
        $slip = slip_gaji::with('gaji.karyawan.jabatan')
            ->orderBy('tanggal_cetak','desc')
            ->get();

        return view('slip-gaji', compact('slip'));
    }

    public function store($id_gaji)
{
    if (slip_gaji::where('id_gaji', $id_gaji)->exists()) {
        return back()->with('error', 'Slip sudah dibuat');
    }

    slip_gaji::create([
        'id_gaji' => $id_gaji,
        'tanggal_cetak' => now(),
    ]);

    return back()->with('success','Slip gaji berhasil dibuat');
}


    public function showAdmin($id)
    {
        $slip = slip_gaji::with('gaji.karyawan.jabatan')
            ->findOrFail($id);

        return view('slip-gaji-show', compact('slip'));
    }

    /* ================= KARYAWAN ================= */

   public function indexKaryawan()
{
    $userId = auth()->id();

    $slip = slip_gaji::whereHas('gaji.karyawan', function ($q) use ($userId) {
            $q->where('id_user', $userId);
        })
        ->with('gaji.karyawan.jabatan')
        ->get();

    return view('slip-gaji', compact('slip'));
}



public function showKaryawan()
{
    $userId = auth()->id();

    $slip = slip_gaji::whereHas('gaji.karyawan', function ($q) use ($userId) {
        $q->where('id_user', $userId);
    })
    ->with('gaji.karyawan.jabatan')
    ->latest()
    ->first();

    if (!$slip) {
        return back()->with('error', 'Slip gaji belum tersedia');
    }

    return view('slip-gaji-show', compact('slip'));
}


}


