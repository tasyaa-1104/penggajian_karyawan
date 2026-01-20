<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\KaryawanController;

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

