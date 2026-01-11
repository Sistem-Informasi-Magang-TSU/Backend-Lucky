<?php
namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user();

        if (!$user || $user->role !== 'mahasiswa') {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak'
            ], 403);
        }

        if (!$user->mahasiswa) {
            return response()->json([
                'success' => false,
                'message' => 'Data mahasiswa tidak ditemukan'
            ], 422);
        }

        $request->validate([
            'program_id' => 'required|exists:program_magang,id_program',
        ]);

        $nim = $user->mahasiswa->nim;

        $sudahDaftar = Pendaftaran::where('nim', $nim)
            ->where('id_program', $request->program_id)
            ->exists();

        if ($sudahDaftar) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah terdaftar'
            ], 409);
        }

        $berkas = $user->mahasiswa->berkas ?? null;

        if (
            !$berkas ||
            !$berkas->cv_file ||
            !$berkas->transkrip_file ||
            !$berkas->krs_file
        ) {
            return response()->json([
                'success' => false,
                'message' => 'Dokumen belum lengkap'
            ], 422);
        }

        $pendaftaran = Pendaftaran::create([
            'nim' => $nim,
            'id_program' => $request->program_id,
            'status' => 'menunggu',
        ]);

        return response()->json([
            'success' => true,
            'data' => $pendaftaran
        ]);
    }
}
