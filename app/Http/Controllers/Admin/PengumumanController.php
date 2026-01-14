<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumumans = Pengumuman::latest()->get();
        return view('admin.pengumuman.index', compact('pengumumans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        Pengumuman::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'dibuat_oleh' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Pengumuman berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        $pengumuman->update($request->all());

        return redirect()->back()->with('success', 'Pengumuman berhasil diperbarui');
    }

    public function destroy($id)
    {
        Pengumuman::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Pengumuman berhasil dihapus');
    }
}
