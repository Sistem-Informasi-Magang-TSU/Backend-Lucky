<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class PendaftaranController extends Controller
{
    public function index()
    {
         
        $pendaftaran = Pendaftaran::all();

        if ($pendaftaran->isEmpty()) {
            return response()->json([
                'message' => 'Tidak ada data pendaftaran ditemukan.'
            ], 404);
        }
        return view('pages.register');
        
    }

    public function store(Request $request)
{
    $user = auth()->user();

    if ($user->role !== 'mahasiswa') {
        return response()->json([
            'success' => false,
            'message' => 'Akses ditolak'
        ], 403);
    }

    $mahasiswa = $user->mahasiswa;

    $request->validate([
        'program_id' => 'required|exists:program_magang,id_program',
    ]);

    $sudahDaftar = Pendaftaran::where('nim', $mahasiswa->nim)
        ->where('id_program', $request->program_id)
        ->exists();

    if ($sudahDaftar) {
        return response()->json([
            'success' => false,
            'message' => 'Anda sudah terdaftar pada program ini'
        ], 409);
    }

    if (! $berkas->cv_file || ! $berkas->transkrip_file || ! $berkas->krs_file) {
        return response()->json([
            'success' => false,
            'message' => 'Dokumen belum lengkap'
        ], 422);
    }

    $pendaftaran = Pendaftaran::create([
        'nim' => $mahasiswa->nim,
        'id_program' => $request->program_id,
        'status' => 'menunggu',
        'cv' => $mahasiswa->cv,
        'transkrip_nilai' => $mahasiswa->transkrip_nilai,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Pendaftaran berhasil',
        'data' => $pendaftaran
    ], 201);
}

    // public function store(Request $request)
    // {
    //     $user = auth()->user();

    //     // 🔒 Validasi basic
    //     $request->validate([
    //         'id_program' => 'required|exists:program_magang,id_program',
    //     ]);

    //     // ❌ Cegah daftar dua kali
    //     $sudahDaftar = Pendaftaran::where('nim', $user->nim)
    //         ->where('id_program', $request->id_program)
    //         ->exists();

    //     if ($sudahDaftar) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Anda sudah terdaftar pada program ini'
    //         ], 409);
    //     }

    //     // ❌ Cegah jika dokumen belum lengkap
    //     if (! $BerkasMahasiswa->cv || ! $BerkasMahasiswa->transkrip_nilai) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Dokumen belum lengkap'
    //         ], 422);
    //     }

    //     // ✅ Simpan pendaftaran
    //     $pendaftaran = Pendaftaran::create([
    //         'nim' => $user->nim,
    //         'id_program' => $request->id_program,
    //         'status' => 'menunggu',
    //         'cv' => $user->cv,
    //         'transkrip_nilai' => $user->transkrip_nilai,
    //     ]);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Pendaftaran berhasil ditambahkan',
    //         'data' => $pendaftaran
    //     ], 201);
    // }

    public function show($nim)
    {
        $pendaftaran = Pendaftaran::where('nim', $nim)->first();

        if (!$pendaftaran) {
            return response()->json([
                'message' => "Pendaftaran dengan NIM $nim tidak ditemukan."
            ], 404);
        }

        return response()->json($pendaftaran, 200);
    }

    public function update(Request $request, $nim)
    {
        $pendaftaran = Pendaftaran::where('nim', $nim)->first();

        if (!$pendaftaran) {
            return response()->json([
                'message' => "Pendaftaran dengan NIM $nim tidak ditemukan."
            ], 404);
        }

        try {
            $update = $pendaftaran->update($request->all());

            if ($update) {
                return response()->json([
                    'message' => 'Data pendaftaran berhasil diperbarui.',
                    'data' => $pendaftaran
                ], 200);
            }

            return response()->json([
                'message' => 'Gagal memperbarui data pendaftaran.'
            ], 500);

        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat update.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($nim)
    {
        $pendaftaran = Pendaftaran::where('nim', $nim)->first();

        if (!$pendaftaran) {
            return response()->json([
                'message' => "Pendaftaran dengan NIM $nim tidak ditemukan."
            ], 404);
        }

        try {
            if ($pendaftaran->delete()) {
                return response()->json([
                    'message' => "Pendaftaran dengan NIM $nim berhasil dihapus."
                ], 200);
            }

            return response()->json([
                'message' => 'Gagal menghapus pendaftaran.'
            ], 500);

        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
