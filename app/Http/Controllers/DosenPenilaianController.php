<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Penilaian;

class DosenPenilaianController extends Controller
{
    public function index()
    {
        $nuptk = '1234567890'; // sementara (sesuai dosen login)

        $mahasiswa = Mahasiswa::with('penilaian')
            ->whereHas('pembimbing', fn($q) => $q->where('nuptk', $nuptk))
            ->get();

        return view('dosen.penilaian', compact('mahasiswa'));
    }

    public function store(Request $request, $nim)
    {
        $request->validate([
            'nilai' => 'required|integer|min:0|max:100',
            'catatan' => 'nullable|string'
        ]);

        Penilaian::updateOrCreate(
            ['nim' => $nim],
            [
                'nuptk' => '1234567890',
                'nilai' => $request->nilai,
                'catatan' => $request->catatan
            ]
        );

        return back()->with('success', 'Penilaian berhasil disimpan');
    }
}
