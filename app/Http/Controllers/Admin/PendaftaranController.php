<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Illuminate\Database\QueryException;

class PendaftaranController extends Controller
{
    public function index()
    {
        // Fetch pendaftaran with related mahasiswa and program
        $pendaftarans = Pendaftaran::with(['mahasiswa.user', 'programMagang.mitra'])
            ->latest()
            ->get();

        return view('admin.pendaftaran.index', compact('pendaftarans'));
    }

    public function update(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        $request->validate([
            'status' => 'required|in:diterima,ditolak',
            'alasan' => 'nullable|string' // In case we want to store rejection reason later (though schema didn't seem to have it, we can pass it to view/session if needed or just update status)
        ]);

        try {
            // Note: The schema for pendaftaran table has 'status' enum ['menunggu', 'diterima', 'ditolak']
            // It does NOT seem to have an 'alasan' column based on the migration review previously.
            // So we will just update the status.

            $pendaftaran->update([
                'status' => $request->status
            ]);

            $message = $request->status === 'diterima'
                ? 'Mahasiswa berhasil diloloskan.'
                : 'Pendaftaran mahasiswa ditolak.';

            return response()->json([
                'success' => true,
                'message' => $message
            ]);

        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui status: ' . $e->getMessage()
            ], 500);
        }
    }
}
