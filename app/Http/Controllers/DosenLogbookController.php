<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\LogBook;
use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenLogbookController extends Controller
{
    public function index()
    {
        $nuptk = auth()->user()->dosen->nuptk;

        // ambil mahasiswa bimbingan 
        $mahasiswa = Mahasiswa::with([
            'logbook' => function ($q) {
                $q->where('status_validasi', 'belum divalidasi');
            }
        ])
            ->whereHas('pembimbing', function ($q) use ($nuptk) {
                $q->where('nuptk', $nuptk);
            })
            ->get();

        // Hitung total pending dan success dari mahasiswa bimbingan
        $countPending = 0;
        $countSuccess = 0;

        foreach ($mahasiswa as $mhs) {
            $countPending += $mhs->logbook->where('status_validasi', 'pending')->count();
            $countSuccess += $mhs->logbook->where('status_validasi', 'disetujui')->count();
        }

        return view('dosen.logbook', compact('mahasiswa', 'countPending', 'countSuccess'));
    }

    public function validasi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak',
            'catatan' => 'nullable|string'
        ]);

        $logbook = LogBook::findOrFail($id);

        $logbook->update([
            'status_validasi' => $request->status,
        ]);

        return back()->with('success', 'Logbook berhasil divalidasi');
    }

    public function tolak(Request $request, $id)
    {
        $request->validate([
            'respo_revisi' => 'required|string'
        ]);

        $logbook = LogBook::findOrFail($id);

        $logbook->update([
            'status_validasi' => 'revisi',
            'respo_revisi' => $request->respo_revisi
        ]);

        return back()->with('success', 'Logbook dikembalikan untuk revisi');
    }

    public function getLogbooks($nim)
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();

        $logbooks = $mahasiswa->logbook()
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($logbooks);
    }
}
