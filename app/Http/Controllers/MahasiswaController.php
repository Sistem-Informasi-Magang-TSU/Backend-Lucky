<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::all();

        if ($mahasiswa->isEmpty()) {
            return response()->json([
                'message' => 'Tidak ada data mahasiswa ditemukan.'
            ], 404);
        }

        return response()->json($mahasiswa, 200);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
            'nim'            => 'required|unique:mahasiswa,nim|max:10',
            'prodi'          => 'required|max:50',
            'angkatan'       => 'required|digits:4',
            'status'         => 'required|in:aktif,nonaktif',
            'nomor_telepon'  => 'nullable|max:15',
            'posisi'         => 'nullable|max:50',
            'riwayat_magang' => 'nullable|max:1',
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

            $mahasiswa = Mahasiswa::create($validated);

            if ($mahasiswa) {
                return response()->json([
                    'message' => 'Mahasiswa berhasil ditambahkan',
                    'data' => $mahasiswa
                ], 201);
            }

            return response()->json([
                'message' => 'Gagal menambahkan mahasiswa.'
            ], 500);

        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan pada database.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($nim)
    {
        $mahasiswa = Mahasiswa::find($nim);

        if (!$mahasiswa) {
            return response()->json([
                'message' => "Mahasiswa dengan NIM $nim tidak ditemukan."
            ], 404);
        }

        return response()->json($mahasiswa, 200);
    }

    public function update(Request $request, $nim)
    {
        $mahasiswa = Mahasiswa::find($nim);

        if (!$mahasiswa) {
            return response()->json([
                'message' => "Mahasiswa dengan NIM $nim tidak ditemukan."
            ], 404);
        }

        try {
            $update = $mahasiswa->update($request->all());

            if ($update) {
                return response()->json([
                    'message' => 'Data mahasiswa berhasil diperbarui.',
                    'data' => $mahasiswa
                ], 200);
            }

            return response()->json([
                'message' => 'Gagal memperbarui data mahasiswa.'
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
        $mahasiswa = Mahasiswa::find($nim);

        if (!$mahasiswa) {
            return response()->json([
                'message' => "Mahasiswa dengan NIM $nim tidak ditemukan."
            ], 404);
        }

        try {
            if ($mahasiswa->delete()) {
                return response()->json([
                    'message' => "Mahasiswa dengan NIM $nim berhasil dihapus."
                ], 200);
            }

            return response()->json([
                'message' => 'Gagal menghapus mahasiswa.'
            ], 500);

        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function photomhs(Request $request, $nim)
{
    // 1️⃣ Ambil mahasiswa berdasarkan NIM
    $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();

    // 2️⃣ Validasi
    $request->validate([
        'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // 3️⃣ Hapus foto lama
    if ($mahasiswa->foto && Storage::disk('public')->exists($mahasiswa->foto)) {
        Storage::disk('public')->delete($mahasiswa->foto);
    }

    // 4️⃣ Simpan foto baru
    $file = $request->file('foto');
    $filename = $nim . '_' . time() . '.' . $file->getClientOriginalExtension();
    $path = $file->storeAs('mahasiswa', $filename, 'public');

    // 5️⃣ Update database
    $mahasiswa->update([
        'foto' => $path,
    ]);

    // 6️⃣ Redirect balik (WAJIB untuk form HTML)
    return back()->with('success', 'Foto profil berhasil diperbarui');
    dd(storage_path('app/public/' . $path));

}


}
