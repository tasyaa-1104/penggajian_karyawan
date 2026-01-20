<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PotonganController;
use App\Http\Controllers\slip_gajiController;
use App\Http\Controllers\rekap_absensiController;
use App\Http\Controllers\TunjanganController;

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
// tampil rekap
Route::get('/rekap-absensi', [rekap_absensiController::class, 'index'])
    ->name('rekap-absensi.index');

// form generate
Route::get('/rekap-absensi/create', [rekap_absensiController::class, 'create'])
    ->name('rekap-absensi.create');

// simpan / generate
Route::post('/rekap-absensi/store', [rekap_absensiController::class, 'store'])->name('rekap-absensi.store');

// form edit
Route::get('/rekap-absensi/edit/{rekap_absensi}', [rekap_absensiController::class, 'edit'])->name('rekap-absensi.edit');

// update
Route::post('/rekap-absensi/update/{rekap_absensi}', [rekap_absensiController::class, 'update'])->name('rekap-absensi.update');

// hapus
Route::post('/rekap-absensi/delete/{rekap_absensi}', [rekap_absensiController::class, 'destroy'])->name('rekap-absensi.delete');
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

use App\Http\Controllers\GajiController;

// ================== GAJI ==================

// READ
Route::get('/gaji', [GajiController::class, 'index'])->name('gaji.index');

// CREATE
Route::get('/gaji/create', [GajiController::class, 'create'])->name('gaji.create');

Route::post('/gaji/store', [GajiController::class, 'store'])->name('gaji.store');

// UPDATE
Route::get('/gaji/edit/{id}', [GajiController::class, 'edit'])->name('gaji.edit');

Route::put('/gaji/update/{id}', [GajiController::class, 'update'])->name('gaji.update');

// DELETE
Route::delete('/gaji/delete/{id}', [GajiController::class, 'destroy'])->name('gaji.destroy');

Route::get('/', function () {return view('landing');});

