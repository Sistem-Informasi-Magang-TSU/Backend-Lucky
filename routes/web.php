<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramMagangTampilController;


// Landing
Route::get('/', fn () => view('pages.landing'))->name('landing');

// Register
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Login
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.process');

// Logout (HARUS auth)
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
// cek user yang login
Route::get('/whoami', fn () => auth()->user())
    ->middleware('auth');

// Semua halaman yang butuh login
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', fn () => view('pages.dashboard.dashboard'))
->name('dashboard');

    Route::get('/dashboard/detail/{id}', function ($id) {
        return view('pages.dashboard.dashboard-detail', compact('id'));})->name('dashboard.detail');

    // password change
    Route::post('/password/update', [ProfileController::class, 'updatePassword'])->name('password.update');



    Route::get('/logbook', fn () => view('pages.logbook.logbook'))->name('logbook');
    Route::get('/setting', fn () => view('pages.setting'))->name('setting');
    Route::get('/program', [ProgramMagangTampilController::class, 'index'])->name('program.index');
    Route::get('/program/{id_program}', [ProgramMagangTampilController::class, 'show'])->name('program.show');
    Route::get('/penilaian', fn () => view('pages.penilaian.penilaian'))->name('penilaian');
    Route::get('/pembimbing', fn () => view('pages.pembimbing.pembimbing'))->name('pembimbing');
});
