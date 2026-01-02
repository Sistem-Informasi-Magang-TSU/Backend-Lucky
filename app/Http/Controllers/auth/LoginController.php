<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;



class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
{
    $key = Str::lower($request->email).'|'.$request->ip();

    // BATASI: 5 kali gagal dalam 1 menit
    if (RateLimiter::tooManyAttempts($key, 5)) {
        return back()->withErrors([
            'email' => 'Terlalu banyak percobaan login. Coba lagi dalam 1 menit.'
        ]);
    }

    $credentials = $request->validate([
        'email'    => ['required','email','regex:/^[a-zA-Z0-9._%+-]+@tsu\.ac\.id$/'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        RateLimiter::clear($key); // reset jika berhasil
        $request->session()->regenerate();
        return redirect()->route('dashboard');
    }

    // Tambah hit jika gagal
    RateLimiter::hit($key, 60);

    return back()->withErrors([
        'email' => 'Email atau password salah',
    ]);
}


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    
}
