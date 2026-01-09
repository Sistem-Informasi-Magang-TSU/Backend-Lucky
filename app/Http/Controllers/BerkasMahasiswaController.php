<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BerkasMahasiswa;

class BerkasMahasiswaController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'cv_file' => 'nullable|mimes:pdf|max:2048',
        'transkrip_file' => 'nullable|mimes:pdf|max:2048',
        'krs_file' => 'nullable|mimes:pdf|max:2048',
    ]);

    $user = auth()->user();

    $berkas = BerkasMahasiswa::firstOrCreate([
        'user_id' => $user->id,
    ]);

    if ($request->hasFile('cv_file')) {
        $berkas->cv_file = $request->file('cv_file')
            ->store('documents/cv', 'public');
    }

    if ($request->hasFile('transkrip_file')) {
        $berkas->transkrip_file = $request->file('transkrip_file')
            ->store('documents/transkrip', 'public');
    }

    if ($request->hasFile('krs_file')) {
        $berkas->krs_file = $request->file('krs_file')
            ->store('documents/krs', 'public');
    }

    $berkas->save();

    return back()->with('success', 'Dokumen berhasil disimpan');
}
    
public function index()
{
    $berkas = BerkasMahasiswa::where('user_id', auth()->id())->first();

    $berkasLengkap = $berkas && $berkas->isLengkap();

    return view('pages.setting', compact('berkas', 'berkasLengkap'));
}
}
