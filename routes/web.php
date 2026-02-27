<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PotonganController;
use App\Http\Controllers\slip_gajiController;
use App\Http\Controllers\rekap_absensiController;
use App\Http\Controllers\TunjanganController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KaryawanDashboardController;



// Route::get('/', function () {
// //     return view('admin.template');
// // });
use App\Http\Controllers\HomeController;



Route::get('/', [HomeController::class, 'index']);


Route::middleware(['role:hrd'])->group(function () {



Route::get('/admin/dashboard', function () {return view('admin.dashboard');})->name('admin.dashboard');
Route::get('/admin/dashboard', [UserController::class, 'index']) ->name('admin.dashboard');
// Route::get('/login', function () {return view('login');})->name('login');
// Route::post('/login', function () {return redirect('/dashboard');})->name('login.proses');


    Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::get('/absensi/create', [AbsensiController::class, 'create'])->name('absensi.create');
    Route::post('/absensi', [AbsensiController::class, 'store'])->name('absensi.store');

// form edit
Route::get('/absensi/edit/{id}', [AbsensiController::class, 'edit'])->name('absensi.edit');

// update (POST)
Route::put('/absensi/update/{id}', [AbsensiController::class, 'update'])->name('absensi.update');

// hapus (POST)
Route::delete('/absensi/delete/{id}', [AbsensiController::class, 'destroy'])
    ->name('absensi.destroy');
// tampil rekap
Route::get('/rekap-absensi', [rekap_absensiController::class, 'index'])
    ->name('rekap-absensi.index');

// proses generate rekap (POST)
Route::post('/rekap-absensi', [rekap_absensiController::class, 'generate'])
    ->name('rekap-absensi.generate');
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
Route::delete(
    '/rekap-absensi/delete/{id}',
    [rekap_absensiController::class, 'destroy']
)->name('rekap-absensi.delete');

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





//potongan
Route::get('/potongan', [PotonganController::class, 'index'])->name('potongan.index');

Route::get('/potongan/create', [PotonganController::class, 'create'])->name('potongan.create');
Route::post('/potongan/store', [PotonganController::class, 'store'])->name('potongan.store');

Route::get('/potongan/edit/{id}', [PotonganController::class, 'edit'])->name('potongan.edit');
Route::put('/potongan/update/{id}', [PotonganController::class, 'update'])->name('potongan.update');

Route::delete('/potongan/delete/{id}', [PotonganController::class, 'destroy'])->name('potongan.destroy');


Route::get('/divisi', [DivisiController::class, 'index'])->name('divisi.index');
Route::get('/divisi/create', [DivisiController::class, 'create'])->name('divisi.create');
    Route::post('/divisi', [DivisiController::class, 'store'])->name('divisi.store');

    // Tambahkan ini:
    Route::get('/divisi/{id}/edit', [DivisiController::class, 'edit'])->name('divisi.edit');
    Route::put('/divisi/{id}', [DivisiController::class, 'update'])->name('divisi.update');

    Route::delete('/divisi/{id}', [DivisiController::class, 'destroy'])
        ->whereNumber('id')
        ->name('divisi.destroy');

        Route::get('/jabatan', [JabatanController::class, 'index'])->name('jabatan.index');
    Route::get('/jabatan/create', [JabatanController::class, 'create'])->name('jabatan.create');
    Route::post('/jabatan', [JabatanController::class, 'store'])->name('jabatan.store');
    Route::get('/jabatan/{id}/edit', [JabatanController::class, 'edit'])->name('jabatan.edit');
    Route::put('/jabatan/{id}', [JabatanController::class, 'update'])->name('jabatan.update');
    Route::delete('/jabatan/{id}', [JabatanController::class, 'destroy'])->name('jabatan.destroy');


    Route::get('/admin/cuti', [CutiController::class, 'indexAdmin'])->name('admin.cuti');
    Route::post('/admin/cuti/{id}/approve', [CutiController::class, 'approve'])->name('cuti.approve');
    Route::post('/admin/cuti/{id}/reject', [CutiController::class, 'reject'])->name('cuti.reject');






Route::get('/user', [UserController::class, 'list'])->name('user.list');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
}); // end middleware admin



Route::middleware(['role:karyawan'])->group(function () {

Route::get('/karyawan/cuti', [CutiController::class, 'indexKaryawan'])->name('karyawan.cuti');
Route::post('/karyawan/cuti', [CutiController::class, 'store'])->name('cuti.store');

// ================= SLIP GAJI (KARYAWAN) =================
Route::get('/karyawan/slip-gaji',
    [slip_gajiController::class, 'indexKaryawan']
)->name('karyawan.slip-gaji.index');

Route::get('/karyawan/slip-gaji/download',
    [slip_gajiController::class, 'downloadKaryawan'])
    ->name('karyawan.slip-gaji.download');




Route::get('/karyawan/dashboard',
    [KaryawanController::class, 'dashboardKaryawan']
)->name('karyawan.dashboard');


});

// ================= ABSENSI (KARYAWAN) =================
Route::get('/absensi', [AbsensiController::class, 'index'])
    ->name('absensi');

Route::get('/karyawan/absensi/create', [AbsensiController::class, 'createKaryawan'])
    ->name('karyawan.absensi.create');

Route::post('absensi/store', [AbsensiController::class, 'storeKaryawan'])
    ->name('karyawan.absensi.store');

Route::post('/karyawan/absen-masuk', [AbsensiController::class, 'absenMasuk'])
    ->name('karyawan.absen.masuk');

Route::post('/karyawan/absen-pulang', [AbsensiController::class, 'absenPulang'])
    ->name('karyawan.absen.pulang');

Route::get('/karyawan/absensi', [AbsensiController::class, 'halamanAbsensi'])
    ->name('karyawan.absensi');

Route::post('/karyawan/absen-izin', [AbsensiController::class, 'absenIzin'])
    ->name('karyawan.absen.izin');


Route::get('/login', function () {
    return view('login');
    })->name('login');

Route::post('/login', [UserController::class, 'login'])
->name('login.proses');

// Route::get('/karyawan/dashboard', [KaryawanDashboardController::class, 'index'])
//     ->name('karyawan.dashboard');



use App\Http\Controllers\OvertimeController;

Route::prefix('hrd')->middleware(['web','role:hrd'])->group(function () {

    Route::get('/overtime', [OvertimeController::class, 'index'])
        ->name('overtime.index');

    Route::post('/overtime/store', [OvertimeController::class, 'store'])
        ->name('overtime.store');

    Route::put('/overtime/{id}/approve', [OvertimeController::class, 'approve'])
        ->name('overtime.approve');

});
use Illuminate\Support\Facades\Auth;

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');


Route::get('/admin/overtime', [OvertimeController::class,'index'])->name('overtime.index');
Route::post('/admin/overtime', [OvertimeController::class,'store'])->name('overtime.store');
Route::put('/admin/overtime/approve/{id}', [OvertimeController::class,'approve'])->name('overtime.approve');






Route::post('/overtime/generate-absensi',
    [OvertimeController::class, 'generateFromAbsensi']
)->name('overtime.generate.absensi');

Route::post('/admin/overtime/generate',
    [OvertimeController::class, 'generateFromAbsensi']
)->name('overtime.generate');
Route::get('/admin/overtime/{id}/approve', [OvertimeController::class, 'approve'])
    ->name('overtime.approve')
    ->middleware('role:admin');



    Route::delete('/admin/overtime/{id}', [OvertimeController::class, 'destroy'])
    ->name('overtime.destroy');



  use App\Http\Controllers\ManagerController;

Route::middleware(['role:manager'])->group(function () {

    Route::get('/manager/dashboard',[ManagerController::class, 'dashboard']  )->name('manager.dashboard');

});

use App\Http\Controllers\FinanceController;

Route::middleware(['role:finance'])->group(function () {

    Route::get('/finance/dashboard', [FinanceController::class, 'dashboard'] )->name('finance.dashboard');
// ================= TUNJANGAN (FINANCE) =================
Route::get('/tunjangan', [TunjanganController::class, 'index'])->name('tunjangan.index');

Route::get('/tunjangan/create', [TunjanganController::class, 'create'])->name('tunjangan.create');
Route::post('/tunjangan/store', [TunjanganController::class, 'store'])->name('tunjangan.store');

Route::get('/tunjangan/edit/{id}', [TunjanganController::class, 'edit'])->name('tunjangan.edit');
Route::put('/tunjangan/update/{id}', [TunjanganController::class, 'update'])->name('tunjangan.update');

Route::delete('/tunjangan/delete/{id}', [TunjanganController::class, 'destroy'])->name('tunjangan.destroy');

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


// ================= SLIP GAJI (ADMIN) =================

// list semua slip
Route::get('/admin/slip-gaji',
    [slip_gajiController::class, 'indexAdmin']
)->name('admin.slip-gaji.index');

// generate slip
Route::post('/admin/slip-gaji/{id_gaji}',
    [slip_gajiController::class, 'store']
)->name('admin.slip-gaji.store');


// Admin / Finance download slip
Route::get('/admin/slip-gaji/{id}/download',
    [slip_gajiController::class, 'downloadAdmin'])
    ->name('admin.slip-gaji.download');
});
