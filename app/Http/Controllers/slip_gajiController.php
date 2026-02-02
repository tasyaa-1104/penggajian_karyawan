<?php

namespace App\Http\Controllers;

use App\Models\slip_gaji;
use App\Models\Gaji;
use Illuminate\Http\Request;

class slip_gajiController extends Controller
{
    // tampilkan daftar slip
    public function index()
    {
        $slip = slip_gaji::with('gaji.karyawan.jabatan')
            ->orderBy('tanggal_cetak','desc')
            ->get();

        return view('slip-gaji', compact('slip'));
    }

    // generate slip dari gaji
    public function store($id_gaji)
    {
        slip_gaji::create([
            'id_gaji' => $id_gaji,
            'tanggal_cetak' => now(),
        ]);

        return redirect()->route('slip-gaji.index')
            ->with('success','Slip gaji berhasil dibuat');
    }

    // tampilkan detail slip
    public function show($id)
    {
        $slip = slip_gaji::with('gaji.karyawan.jabatan')
            ->findOrFail($id);

        return view('slip-gaji-show', compact('slip'));
    }
}
