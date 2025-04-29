<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PendaftaranController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route publik (akses tanpa login)
Route::get('/pendaftaran', [PendaftaranController::class, 'create'])->name('pendaftaran.create');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

Route::get('/terdaftar/{pendaftaran}', [PendaftaranController::class, 'show'])->name('pendaftaran.show');
Route::get('/pendaftaran-berhasil', [PendaftaranController::class, 'success'])->name('pendaftaran.success');
Route::put('/terdaftar/check/{pendaftaran}', [PendaftaranController::class, 'check'])->name('pendaftaran.check');

// Route yang membutuhkan login
Route::middleware(['auth'])->group(function () {
    Route::get('/terdaftar', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::get('/pendaftaran/edit/{pendaftaran}', [PendaftaranController::class, 'edit'])->name('pendaftaran.edit');
    Route::put('/pendaftaran/edit/{pendaftaran}', [PendaftaranController::class, 'update'])->name('pendaftaran.update');
    Route::delete('/terdaftar/hapus/{pendaftaran}', [PendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');
});

require __DIR__.'/auth.php';
