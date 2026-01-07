<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'email',
                'regex:/@tsu\.ac\.id$/',
                'unique:users,email'
            ],

            'password' => [
                'required',
                'confirmed',
                Password::min(10)
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],

            'role' => ['required', 'in:mahasiswa,dosen'],

            'nim'   => ['required_if:role,mahasiswa', 'nullable', 'unique:mahasiswa,nim'],
            'prodi' => ['required_if:role,mahasiswa'],

            'nuptk' => ['required_if:role,dosen', 'nullable', 'unique:dosen,nuptk'],
        ]);

        DB::transaction(function () use ($request) {

            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => $request->role,
            ]);

            event(new Registered($user));

            if ($request->role === 'mahasiswa') {
                Mahasiswa::create([
                    'user_id' => $user->id,
                    'nim'     => $request->nim,
                    'prodi'   => $request->prodi,
                ]);
            }

            if ($request->role === 'dosen') {
                Dosen::create([
                    'user_id' => $user->id,
                    'nuptk'   => $request->nuptk,
                ]);
            }
        });

        return redirect('/login')
            ->with('success', 'Registrasi berhasil. Silakan cek email untuk verifikasi.');
    }
}
