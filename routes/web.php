<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AuthController;

Route::get('/jadwal', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
Route::put('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
Route::delete('/mahasiswa/{mahasiswa}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');

use App\Http\Controllers\BanksoalController;

Route::get('/banksoal', [BanksoalController::class, 'index'])->name('banksoal.index');
Route::post('/banksoal', [BanksoalController::class, 'store'])->name('banksoal.store');
Route::put('/banksoal/{banksoal}', [BanksoalController::class, 'update'])->name('banksoal.update');
Route::delete('/banksoal/{banksoal}', [BanksoalController::class, 'destroy'])->name('banksoal.destroy');

use App\Http\Controllers\NilaiController;

Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai.index');
Route::post('/nilai', [NilaiController::class, 'store'])->name('nilai.store');
Route::put('/nilai/{nilai}', [NilaiController::class, 'update'])->name('nilai.update');
Route::delete('/nilai/{nilai}', [NilaiController::class, 'destroy'])->name('nilai.destroy');

Route::get('/', function () {
    return view('home');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'save'])->name('saveRegister');
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::post('/login', [AuthController::class, 'checkLogin'])->name('login.check');

