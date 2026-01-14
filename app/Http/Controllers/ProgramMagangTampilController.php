<?php

namespace App\Http\Controllers;

use App\Models\ProgramMagang;
use App\Models\Pendaftaran;
use App\Models\BerkasMahasiswa;

class ProgramMagangTampilController extends Controller
{
    public function index()
    {
        $programs = ProgramMagang::with('mitra')->get();
        return view('mahasiswa.program.program', compact('programs'));
    }

    public function show($id_program)
    {
        $program = ProgramMagang::with('mitra')->findOrFail($id_program);
        $user = auth()->user();

        $hasDocuments = false;
        $isRegistered = false;

        if ($user) {
            $berkas = BerkasMahasiswa::where('user_id', $user->id)->first();

            $hasDocuments = $berkas && $berkas->isLengkap();

            $isRegistered = Pendaftaran::where('nim', $user->mahasiswa->nim)
                ->where('id_program', $program->id_program)
                ->exists();

        }
        return view('mahasiswa.program.program-detail', compact('program', 'hasDocuments', 'isRegistered'));
    }

}
