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
            'jenis_pengumuman' => 'required|in:info,warning,danger,success',
            'status' => 'nullable|in:aktif,nonaktif',
        ]);

        try {
            Pengumuman::create([
                'judul' => $request->judul,
                'isi' => $request->isi,
                'jenis_pengumuman' => $request->jenis_pengumuman,
                'status' => $request->status ?? 'aktif',
                'dibuat_oleh' => Auth::id(),
            ]);

            return redirect()->back()->with('success', 'Pengumuman berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan pengumuman: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'jenis_pengumuman' => 'required|in:info,warning,danger,success',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        try {
            $pengumuman->update($request->all());
            return redirect()->back()->with('success', 'Pengumuman berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui pengumuman: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            Pengumuman::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'Pengumuman berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus pengumuman: ' . $e->getMessage());
        }
    }
}
