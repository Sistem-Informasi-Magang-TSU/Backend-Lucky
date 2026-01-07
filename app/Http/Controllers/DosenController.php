<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
use Illuminate\Database\QueryException;

class DosenController extends Controller
{
    public function index()
    {
        $data = Dosen::all();
        if ($data->isEmpty()) {
            return response()->json(['message' => 'Tidak ada data dosen ditemukan'], 404);
        }
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nuptk' => 'required|max:10|unique:dosen,nuptk',
                'nama' => 'required|max:100',
                'prodi' => 'required|max:50',
                'kontak' => 'nullable|max:20'
        ]);

            $data = Dosen::create($validated);
            return response()->json(['message' => 'Dosen berhasil ditambahkan', 'data' => $data], 201);

        } catch (QueryException $e) {
            return response()->json(['message' => 'Database error', 'error' => $e->getMessage()], 500);
        }//
    }

    public function show($nuptk)
    {
        $data = Dosen::find($nuptk);
        if (!$data) {
            return response()->json(['message' => "Dosen dengan NIDN $nuptk tidak ditemukan"], 404);
        }
        return response()->json($data, 200);
    }

    public function update(Request $request, $nuptk)
    {
        $data = Dosen::find($nuptk);
        if (!$data) {
            return response()->json(['message' => 'Dosen tidak ditemukan'], 404);
        }

        try {
            $data->update($request->all());
            return response()->json(['message' => 'Data dosen berhasil diperbarui', 'data' => $data], 200);

        } catch (QueryException $e) {
            return response()->json(['message' => 'Error update', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($nuptk)
    {
        $data = Dosen::find($nuptk);
        if (!$data) {
            return response()->json(['message' => 'Dosen tidak ditemukan'], 404);
        }

        try {
            $data->delete();
            return response()->json(['message' => 'Dosen berhasil dihapus'], 200);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error delete', 'error' => $e->getMessage()], 500);
        }
    }

    public function photodsn(Request $request, $nuptk)
    {
        // 1️⃣ Ambil dosen berdasarkan NUPTK
        $dosen = Dosen::where('nuptk', $nuptk)->firstOrFail();

        // 2️⃣ Validasi file
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 3️⃣ Hapus foto lama (jika ada)
        if ($dosen->foto && Storage::disk('public')->exists($dosen->foto)) {
            Storage::disk('public')->delete($dosen->foto);
        }

        // 4️⃣ Simpan foto baru ke folder dosen
        $file = $request->file('foto');
        $filename = $nuptk . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('dosen', $filename, 'public');

        // 5️⃣ Update database
        $dosen->update([
            'foto' => $path,
        ]);

        // 6️⃣ Kembali ke halaman sebelumnya
        return back()->with('success', 'Foto dosen berhasil diperbarui');
    }

}
