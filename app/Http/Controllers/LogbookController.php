<?php

namespace App\Http\Controllers;

use App\Models\logbook;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class LogbookController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $logbooks = LogBook::where('nim', $user->mahasiswa->nim)
            ->orderBy('tanggal_mulai', 'desc')
            ->get();

        return view('mahasiswa.logbook.logbook', compact('logbooks'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'nama_kegiatan' => 'required|string',
            'uraian_kegiatan' => 'required|string',
            'jenis_logbook' => 'required|in:individu,kelompok',
        ]);

        $pendaftaran = Pendaftaran::where('nim', $user->mahasiswa->nim)
            ->where('status', 'diterima')
            ->first();

        if (!$pendaftaran) {
            return response()->json([
                'success' => false,
                'message' => 'Anda belum terdaftar di program magang manapun atau status belum diterima.'
            ], 422);
        }

        LogBook::create([
            'nim' => $user->mahasiswa->nim,
            'id_program' => $pendaftaran->id_program,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'nama_kegiatan' => $request->nama_kegiatan,
            'uraian_kegiatan' => $request->uraian_kegiatan,
            'jenis_logbook' => $request->jenis_logbook,
            'status_validasi' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Logbook berhasil disimpan'
        ]);
    }

    public function show($nim)
    {
        $logbook = LogBook::where('nim', $nim)->first();

        if (!$logbook) {
            return response()->json([
                'message' => "LogBook dengan NIDN $nim tidak ditemukan."
            ], 404);
        }

        return response()->json($logbook, 200);
    }

    public function update(Request $request, $nim)
    {
        $logbook = LogBook::where('nim', $nim)->first();

        if (!$logbook) {
            return response()->json([
                'message' => "LogBook dengan NIDN $nim tidak ditemukan."
            ], 404);
        }

        try {
            $update = $logbook->update($request->all());

            if ($update) {
                return response()->json([
                    'message' => 'Data logbook berhasil diperbarui.',
                    'data' => $logbook
                ], 200);
            }

            return response()->json([
                'message' => 'Gagal memperbarui data logbook.'
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
        $logbook = LogBook::where('nim', $nim)->first();

        if (!$logbook) {
            return response()->json([
                'message' => "LogBook dengan NIDN $nim tidak ditemukan."
            ], 404);
        }

        try {
            if ($logbook->delete()) {
                return response()->json([
                    'message' => "LogBook dengan NIDN $nim berhasil dihapus."
                ], 200);
            }

            return response()->json([
                'message' => 'Gagal menghapus logbook.'
            ], 500);

        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
