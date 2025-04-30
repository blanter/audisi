<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\JuriController;
use Illuminate\Support\Facades\Route;

// Route Default
Route::get('/', function () {
    return view('welcome');
});

// Route Dashboard with Verified
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route PENDAFTARAN publik (akses tanpa login)
Route::get('/pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
Route::get('/pendaftaran-berhasil', [PendaftaranController::class, 'success'])->name('pendaftaran.success');

// Route PENDAFTARAN yang membutuhkan login
Route::middleware(['auth'])->group(function () {
    Route::get('/peserta', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::get('/peserta/{pendaftaran}', [PendaftaranController::class, 'show'])->name('pendaftaran.show');
    Route::put('/peserta/check/{pendaftaran}', [PendaftaranController::class, 'check'])->name('pendaftaran.check');
    Route::get('/pendaftaran/edit/{pendaftaran}', [PendaftaranController::class, 'edit'])->name('pendaftaran.edit');
    Route::put('/pendaftaran/edit/{pendaftaran}', [PendaftaranController::class, 'update'])->name('pendaftaran.update');
    Route::delete('/peserta/hapus/{pendaftaran}', [PendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');
});

// Route PENJURIAN
Route::middleware('auth')->group(function () {
    Route::get('/penjurian', [JuriController::class, 'index'])->name('penjurian.index');
    Route::get('/peserta/nilai/{pendaftaran}', [JuriController::class, 'show'])->name('penjurian.show');
    Route::post('/showcases/store', [JuriController::class, 'showcase'])->name('penjurian.showcase');
});

require __DIR__.'/auth.php';
