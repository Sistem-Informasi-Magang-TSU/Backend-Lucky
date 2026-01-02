<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // VALIDASI
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'regex:/^[a-zA-Z0-9._%+-]+@tsu\.ac\.id$/',
                'unique:users,email'
            ],
            'password' => 'required|confirmed|min:8',
            'role' => 'required|in:mahasiswa,dosen',

            // Khusus mahasiswa
            'nim'   => 'required_if:role,mahasiswa',
            'prodi' => 'required_if:role,mahasiswa',

            // Khusus dosen
            'nuptk' => 'required_if:role,dosen',
        ]);

        DB::transaction(function () use ($request) {

            // INSERT KE USERS
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'role'     => $request->role,
            ]);

            // JIKA MAHASISWA
            if ($request->role === 'mahasiswa') {
                Mahasiswa::create([
                    'user_id' => $user->id,
                    'nim'     => $request->nim,
                    'prodi'   => $request->prodi,
                ]);
            }

            // (OPSIONAL) JIKA DOSEN → 
            if ($request->role === 'dosen') {
                Dosen::create([
                    'user_id' => $user->id,
                    'nuptk'   => $request->nuptk,
                ]);
            }
            
        });

        return redirect('/login')->with('success', 'Registrasi berhasil');
    }
}
