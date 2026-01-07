<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramMagangTampilController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\BerkasMahasiswaController;


Route::get('/whoami', function () {
    return response()->json([
        'authenticated' => auth()->check(),
        'id'            => auth()->id(),
        'name'          => auth()->user()?->name,
        'email'         => auth()->user()?->email,
        'role'          => auth()->user()?->role,
    ]);
})->middleware('auth');

// Landing page (PUBLIC)
Route::get('/', fn () => view('pages.landing'))->name('landing');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->name('register.store');

    // FORGOT PASSWORD
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');
});

// Semua halaman yang butuh login
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', fn () => view('pages.dashboard.dashboard'))
        ->name('dashboard');

    Route::get('/dashboard/detail/{id}', fn ($id) =>
        view('pages.dashboard.dashboard-detail', compact('id'))
    )->name('dashboard.detail');

    Route::post('/password/update', [ProfileController::class, 'updatePassword'])
        ->name('password.update');

    Route::get('/logbook', fn () => view('pages.logbook.logbook'))->name('logbook');
    Route::get('/setting', fn () => view('pages.setting'))->name('setting');

    Route::get('/program', [ProgramMagangTampilController::class, 'index'])
        ->name('program.index');

    Route::get('/program/{id_program}', [ProgramMagangTampilController::class, 'show'])
        ->name('program.show');

    Route::get('/penilaian', fn () => view('pages.penilaian.penilaian'))->name('penilaian');
    Route::get('/pembimbing', fn () => view('pages.pembimbing.pembimbing'))->name('pembimbing');

     Route::put('/password', [PasswordController::class, 'update'])
        ->name('password.update');

    Route::post('/mahasiswa/{nim}/foto',[MahasiswaController::class, 'photomhs'])->name('mahasiswa.photomhs');
    Route::post('/dosen/{nuptk}/foto', [DosenController::class, 'photodsn'])->name('dosen.foto');

    Route::post('/documents', [BerkasMahasiswaController::class, 'store'])->name('documents.store');





});

// AUTH BREEZE
require __DIR__.'/auth.php';
