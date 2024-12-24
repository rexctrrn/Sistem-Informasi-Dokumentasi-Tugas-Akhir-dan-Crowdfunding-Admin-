<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\DosenController;
use App\Http\Controllers\TugasAkhirController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DonasiController;



Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');


    //dashboard Routing
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Dosen Routing
    Route::get('/dosen',[DosenController::class, 'index'])->name('dosen');
    Route::post('/dosen/store',[DosenController::class, 'store'])->name('dosen.store');
    Route::get('/dosen/{id}/edit',[DosenController::class, 'edit'])->name('dosen.edit');
    Route::post('/dosen/update',[DosenController::class, 'update'])->name('dosen.update');
    Route::post('/dosen/destroy',[DosenController::class, 'destroy'])->name('dosen.destroy');


    Route::get('/donasi',[DonasiController::class, 'index'])->name('donasi');
    Route::post('/donasi/destroy',[DonasiController::class, 'destroy'])->name('donasi.destroy');

    // Publikasi Routing
    Route::get('/publikasi',[TugasAkhirController::class, 'index'])->name('publikasi');
    Route::get('/publikasi/create',[TugasAkhirController::class, 'create'])->name('publikasi.create');
    Route::get('/publikasi/{id}/edit',[TugasAkhirController::class, 'edit'])->name('publikasi.edit');
    Route::get('/publikasi/{id}/view', [TugasAkhirController::class, 'view'])->name('publikasi.view');
    Route::post('/publikasi/store',[TugasAkhirController::class, 'store'])->name('publikasi.store');
    Route::post('/publikasi/update',[TugasAkhirController::class, 'update'])->name('publikasi.update');
    Route::post('/publikasi/destroy',[TugasAkhirController::class, 'destroy'])->name('publikasi.destroy');
    Route::get('/cetak-laporan', [TugasAkhirController::class, 'cetakLaporan'])->name('publikasi.cetakLaporan');


    
    Route::get('/admin',[AdminController::class, 'index'])->name('admin');
    Route::get('/admin/{id}/edit',[AdminController::class, 'edit'])->name('admin.edit');
    Route::post('/admin/store',[AdminController::class, 'store'])->name('admin.store');
    Route::post('/admin/destroy',[AdminController::class, 'destroy'])->name('admin.destroy');


});
