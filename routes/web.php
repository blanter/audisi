<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\JuriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AssessmentConfigController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Route Default
Route::get('/', function () {
    return view('welcome');
});

// Route Dashboard with Verified
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Route PENDAFTARAN Publik (NO LOGIN)
Route::get('/pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
Route::get('/pendaftaran-berhasil', [PendaftaranController::class, 'success'])->name('pendaftaran.success');

Route::middleware(['auth'])->group(function () {
    // Route Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route PENDAFTARAN (LOGIN)
    Route::get('/peserta', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::get('/peserta/{pendaftaran}', [PendaftaranController::class, 'show'])->name('pendaftaran.show');
    Route::put('/peserta/check/{pendaftaran}', [PendaftaranController::class, 'check'])->name('pendaftaran.check');
    Route::get('/pendaftaran/edit/{pendaftaran}', [PendaftaranController::class, 'edit'])->name('pendaftaran.edit');
    Route::put('/pendaftaran/edit/{pendaftaran}', [PendaftaranController::class, 'update'])->name('pendaftaran.update');
    Route::delete('/peserta/hapus/{pendaftaran}', [PendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');

    // Route PENJURIAN
    Route::get('/penjurian', [JuriController::class, 'index'])->name('penjurian.index');
    Route::get('/peserta/nilai/{pendaftaran}', [JuriController::class, 'show'])->name('penjurian.show');
    Route::post('/penilaian/store/{pendaftaran}', [JuriController::class, 'penilaian'])->name('penjurian.penilaian');
    Route::delete('/penilaian/hapus/{penilaian}', [JuriController::class, 'destroy'])->name('penjurian.destroy');

    // New Route Assesment
    Route::resource('standar-nilai', AssessmentConfigController::class);

    // Route QRCode (LOGIN)
    Route::get('/qr-tamu', [QRCodeController::class, 'qrindex'])->name('qrindex');
    Route::get('/qr-scan', [QRCodeController::class, 'qrscan'])->name('qrscan');
    Route::post('/submit-player', [QRCodeController::class, 'submit_player'])->name('submit.player');
    Route::get('/data-tamu', [QRCodeController::class, 'datatamu'])->name('datatamu');

    // Route Tasks
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks/store', [TaskController::class, 'store'])->name('tasks.store');
    Route::post('/tasks/{task}/deskripsi/{index}/status', [TaskController::class, 'updateDeskripsiStatus'])->name('tasks.updateDeskripsiStatus');
    Route::get('/tasks/edit/{task}', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/edit/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/delete/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    // Route Admin Mode
    Route::get('/adminuser', [ProfileController::class, 'adminindex'])->name('adminuser');
    Route::post('/adminuser/{user}/editrole', [ProfileController::class, 'admineditRole'])->name('editmodeadmin');
    Route::delete('/adminuser/{user}', [ProfileController::class, 'admindestroy'])->name('destroyuser');
});

// Route QRCode (NO LOGIN)
Route::get('/qr-form', [QRCodeController::class, 'qrform'])->name('qrform');
Route::post('/generate-qr', [QRCodeController::class, 'generate'])->name('generate.qr');

require __DIR__.'/auth.php';
