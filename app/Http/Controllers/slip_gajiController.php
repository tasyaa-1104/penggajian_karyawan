<?php

namespace App\Http\Controllers;

use App\Models\slip_gaji;
use App\Models\Gaji;
use App\Models\Tunjangan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

public function downloadKaryawan()
{
    $user = Auth::user();

    $gaji = Gaji::where('id_karyawan', $user->karyawan->id_karyawan)
                ->latest()
                ->first();

    if (!$gaji) {
        return back()->with('error', 'Gaji belum tersedia');
    }

    $slip = slip_gaji::where('id_gaji', $gaji->id_gaji)
                    ->latest()
                    ->first();

    if (!$slip) {
        return back()->with('error', 'Slip gaji belum tersedia');
    }

    // ✅ TAMBAHKAN INI
  $tunjangan = Tunjangan::whereHas('karyawan', function ($q) use ($gaji) {
    $q->where('karyawan.id_karyawan', $gaji->id_karyawan);
})->get();

    $pdf = Pdf::loadView('slip-gaji', compact('slip', 'tunjangan'));

    return $pdf->download('slip-gaji-'.$slip->gaji->karyawan->nama_karyawan.'.pdf');
}

public function downloadAdmin($id)
{
    $slip = slip_gaji::with(['gaji.karyawan.jabatan'])->findOrFail($id);

    $tunjangan = $slip->gaji->tunjangan;

    $pdf = Pdf::loadView('finance.slip-gaji', compact('slip','tunjangan'));

    $nama = $slip->gaji->karyawan->nama_karyawan ?? 'karyawan';

    return $pdf->download('slip-gaji-'.$nama.'.pdf');


}
}


