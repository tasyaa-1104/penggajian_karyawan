<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PotonganController;
use App\Http\Controllers\slip_gajiController;
use App\Http\Controllers\TunjanganController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\JabatanController;

Route::get('/', function () {
    return view('admin.template');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi');
// FORM TAMBAH ABSENSI
Route::get('/absensi/create', [AbsensiController::class, 'create'])->name('absensi.create');

// simpan absensi
Route::post('/absensi/store', [AbsensiController::class, 'store'])->name('absensi.store');
// form edit
Route::get('/absensi/edit/{id}', [AbsensiController::class, 'edit'])->name('absensi.edit');

// update (POST)
Route::post('/absensi/update/{id}', [AbsensiController::class, 'update'])->name('absensi.update');

// hapus (POST)
Route::post('/absensi/delete/{id}', [AbsensiController::class, 'destroy'])->name('absensi.delete');

/* READ */
Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan');

/* CREATE */
Route::get('/karyawan/create', [KaryawanController::class, 'create'])->name('karyawan-create');
Route::post('/karyawan/store', [KaryawanController::class, 'store'])->name('karyawan-store');

/* UPDATE */
Route::get('/karyawan/edit/{id}', [KaryawanController::class, 'edit'])->name('karyawan-edit');
Route::put('/karyawan/update/{id}', [KaryawanController::class, 'update'])->name('karyawan-update');

/* DELETE */
Route::delete('/karyawan/delete/{id}', [KaryawanController::class, 'destroy'])->name('karyawan-destroy');


//tunjangan
Route::get('/tunjangan', [TunjanganController::class, 'index'])->name('tunjangan.index');

Route::get('/tunjangan/create', [TunjanganController::class, 'create'])->name('tunjangan.create');
Route::post('/tunjangan/store', [TunjanganController::class, 'store'])->name('tunjangan.store');

Route::get('/tunjangan/edit/{id}', [TunjanganController::class, 'edit'])->name('tunjangan.edit');
Route::put('/tunjangan/update/{id}', [TunjanganController::class, 'update'])->name('tunjangan.update');

Route::delete('/tunjangan/delete/{id}', [TunjanganController::class, 'destroy'])->name('tunjangan.destroy');


//potongan
Route::get('/potongan', [PotonganController::class, 'index'])->name('potongan.index');

Route::get('/potongan/create', [PotonganController::class, 'create'])->name('potongan.create');
Route::post('/potongan/store', [PotonganController::class, 'store'])->name('potongan.store');

Route::get('/potongan/edit/{id}', [PotonganController::class, 'edit'])->name('potongan.edit');
Route::put('/potongan/update/{id}', [PotonganController::class, 'update'])->name('potongan.update');

Route::delete('/potongan/delete/{id}', [PotonganController::class, 'destroy'])->name('potongan.destroy');


//slip gaji
Route::get('/slip-gaji', [slip_gajiController::class, 'index'])->name('slipgaji.index');

Route::get('/slip-gaji/create', [slip_gajiController::class, 'create'])->name('slipgaji.create');
Route::post('/slip-gaji/store', [slip_gajiController::class, 'store'])->name('slipgaji.store');

Route::get('/slip-gaji/edit/{id}', [slip_gajiController::class, 'edit'])->name('slipgaji.edit');
Route::put('/slip-gaji/update/{id}', [slip_gajiController::class, 'update'])->name('slipgaji.update');

Route::delete('/slip-gaji/delete/{id}', [slip_gajiController::class, 'destroy'])->name('slipgaji.destroy');






Route::prefix('admin')->group(function () {
    Route::get('/divisi', [DivisiController::class, 'index'])->name('divisi.index');
    Route::get('/divisi/create', [DivisiController::class, 'create'])->name('divisi.create');
    Route::post('/divisi', [DivisiController::class, 'store'])->name('divisi.store');

    // Tambahkan ini:
    Route::get('/divisi/{id}/edit', [DivisiController::class, 'edit'])->name('divisi.edit');
    Route::put('/divisi/{id}', [DivisiController::class, 'update'])->name('divisi.update');

    Route::delete('/divisi/{id}', [DivisiController::class, 'destroy'])
        ->whereNumber('id')
        ->name('divisi.destroy');
});

Route::prefix('admin')->group(function () {
    Route::get('/jabatan', [JabatanController::class, 'index'])->name('jabatan.index');
    Route::get('/jabatan/create', [JabatanController::class, 'create'])->name('jabatan.create');
    Route::post('/jabatan', [JabatanController::class, 'store'])->name('jabatan.store');
    Route::get('/jabatan/{id}/edit', [JabatanController::class, 'edit'])->name('jabatan.edit');
    Route::put('/jabatan/{id}', [JabatanController::class, 'update'])->name('jabatan.update');
    Route::delete('/jabatan/{id}', [JabatanController::class, 'destroy'])->name('jabatan.destroy');
});
