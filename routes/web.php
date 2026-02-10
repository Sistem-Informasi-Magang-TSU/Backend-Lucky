<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramMagangTampilController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\BerkasMahasiswaController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\DosenLogbookController;
use App\Http\Controllers\DosenPenilaianController;
use App\Http\Controllers\Admin\DataMahasiswaController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\PendaftaranController as AdminPendaftaranController;


use App\Models\Pengumuman;

Route::get('/whoami', function () {
    return response()->json([
        'authenticated' => auth()->check(),
        'id' => auth()->id(),
        'name' => auth()->user()?->name,
        'email' => auth()->user()?->email,
        'role' => auth()->user()?->role,
    ]);
})->middleware('auth');

// Landing page (PUBLIC)
Route::get('/', fn() => view('layouts.landing'))->name('landing');

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
    // tampilkan form reset
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    // proses reset password
    Route::post('/reset-password', [NewPasswordController::class, 'store'])
        ->name('password.reset.store');
});

// Semua halaman yang butuh login
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        $pengumumans = Pengumuman::where('status', 'aktif')->latest()->take(5)->get();
        $mahasiswa = auth()->user()->mahasiswa;
        $logbookCount = $mahasiswa ? $mahasiswa->logbook()->count() : 0;
        $pendaftaranCount = $mahasiswa ? $mahasiswa->pendaftaran()->count() : 0;

        return view('mahasiswa.dashboard.dashboard', compact('pengumumans', 'logbookCount', 'pendaftaranCount'));
    })->name('mahasiswa.dashboard');

    /*
    Route::get(
        '/dashboard/detail/{id}',
        fn($id) =>
        view('pages.dashboard.dashboard-detail', compact('id'))
    )->name('dashboard.detail');
    */

    Route::post('/password/update', [ProfileController::class, 'updatePassword'])
        ->name('profile.password.update');

    Route::get('/logbookview', [LogbookController::class, 'index'])->name('logbook');
    Route::get('/logbook', [LogbookController::class, 'index'])->name('logbook.index');
    Route::post('/logbook', [LogbookController::class, 'store'])->name('logbook.store');
    Route::get('/setting', fn() => view('layouts.setting'))->name('setting');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/program', [ProgramMagangTampilController::class, 'index'])
        ->name('program.index');

    Route::get('/program/{id_program}', [ProgramMagangTampilController::class, 'show'])
        ->name('program.show');

    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])
        ->name('pendaftaran.store');


    Route::get('/penilaian', fn() => view('mahasiswa.penilaian.penilaian'))->name('penilaian');
    Route::get('/pembimbing', fn() => view('mahasiswa.pembimbing.pembimbing'))->name('pembimbing');

    Route::put('/password', [App\Http\Controllers\Auth\PasswordController::class, 'update'])
        ->name('password.update');

    Route::post('/mahasiswa/{nim}/foto', [MahasiswaController::class, 'photomhs'])->name('mahasiswa.photomhs');
    Route::post('/dosen/{nuptk}/foto', [DosenController::class, 'photodsn'])->name('dosen.foto');
    Route::post('/dosen/{nuptk}/kontak', [DosenController::class, 'updateKontak'])->name('dosen.kontak.update');

    Route::post('/documents', [BerkasMahasiswaController::class, 'store'])->name('documents.store');





});

// ===================
// ROUTE DOSEN 
// ===================
Route::middleware(['auth', 'role:dosen'])->group(function () {


    Route::get('/dosen/setting', function () {
        return view('layouts.setting');
    })->name('dosen.setting');

    Route::get('/dosen/program', function () {
        $programs = \App\Models\ProgramMagang::with('mitra')->get();
        return view('dosen.programdosen', compact('programs'));
    })->name('dosen.view_program');


    Route::get('/dosen/dashboard', function () {
        $pengumumans = Pengumuman::where('status', 'aktif')->latest()->take(5)->get();
        // Dosen doesn't have logbook/pendaftaran in the same way, defaulting to 0 for view compatibility
        $logbookCount = 0;
        $pendaftaranCount = 0;
        return view('mahasiswa.dashboard.dashboard', compact('pengumumans', 'logbookCount', 'pendaftaranCount'));
    })->name('dosen.dashboard');

    Route::get(
        '/dosen/logbook',
        [DosenLogbookController::class, 'index']
    )->name('dosen.logbook');

    Route::post(
        '/dosen/logbook/{id}/validasi',
        [DosenLogbookController::class, 'validasi']
    )->name('dosen.logbook.validasi');

    Route::post(
        '/dosen/logbook/{id}/tolak',
        [DosenLogbookController::class, 'tolak']
    )->name('dosen.logbook.tolak');

    Route::get(
        '/dosen/logbook/{nim}/data',
        [DosenLogbookController::class, 'getLogbooks']
    )->name('dosen.logbook.data');

    Route::get(
        '/dosen/penilaian',
        [DosenPenilaianController::class, 'index']
    )
        ->name('dosen.penilaian');

    Route::post(
        '/dosen/penilaian/{nim}',
        [DosenPenilaianController::class, 'store']
    )
        ->name('dosen.penilaian.store');

    Route::post(
        '/dosen/penilaian/{nim}',
        [DosenPenilaianController::class, 'store']
    )
        ->name('dosen.penilaian.store');
});

Route::middleware(['auth', 'role:admin'])->group(function () {


    // ===================
    // ROUTE ADMIN
    // ===================
    Route::get('/admin/program', [ProgramController::class, 'index'])->name('admin.program.index');
    Route::post('/admin/program', [ProgramController::class, 'store'])->name('admin.program.store');
    Route::put('/admin/program/{id}', [ProgramController::class, 'update'])->name('admin.program.update');
    Route::delete('/admin/program/{id}', [ProgramController::class, 'destroy'])->name('admin.program.destroy');

    Route::get('/admin/pendaftaran', [AdminPendaftaranController::class, 'index'])->name('admin.pendaftaran.index');
    Route::put('/admin/pendaftaran/{id}', [AdminPendaftaranController::class, 'update'])->name('admin.pendaftaran.update');

    Route::get('/admin/mahasiswa', [DataMahasiswaController::class, 'index'])->name('admin.mahasiswa.index');

    // Pengumuman Routes
    Route::get('/admin/pengumuman', [PengumumanController::class, 'index'])->name('admin.pengumuman.index');
    Route::post('/admin/pengumuman', [PengumumanController::class, 'store'])->name('admin.pengumuman.store');
    Route::put('/admin/pengumuman/{id}', [PengumumanController::class, 'update'])->name('admin.pengumuman.update');
    Route::delete('/admin/pengumuman/{id}', [PengumumanController::class, 'destroy'])->name('admin.pengumuman.destroy');
});

// AUTH BREEZE
require __DIR__ . '/auth.php';
