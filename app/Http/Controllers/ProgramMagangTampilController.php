<?php

namespace App\Http\Controllers;

use App\Models\ProgramMagang;
use App\Models\Pendaftaran;
use App\Models\BerkasMahasiswa;
use App\Models\Mahasiswa;

class ProgramMagangTampilController extends Controller
{
    public function index()
    {
        $programs = ProgramMagang::with('mitra')->get();

        $jumlahPeserta = Mahasiswa::count();
        $pesertaAktif = Pendaftaran::where('status', 'diterima')->count();
        $pesertaLulus = Pendaftaran::where('status', 'lulus')->count();

        return view('mahasiswa.program.program', compact('programs', 'jumlahPeserta', 'pesertaAktif', 'pesertaLulus'));
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
