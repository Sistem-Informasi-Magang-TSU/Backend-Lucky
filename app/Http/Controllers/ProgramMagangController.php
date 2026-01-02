<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramMagang;
use Illuminate\Database\QueryException;


class ProgramMagangController extends Controller
{
    public function index()
    {
        $data = ProgramMagang::all();
        if ($data->isEmpty()) {
            return response()->json(['message' => 'Tidak ada data program ditemukan'], 404);
        }
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'id_program'        => 'required|string|max:8|unique:program_magang,id_program',
                'nama_program'      => 'required|string|max:100',
                'jenis_bkp'         => 'required|string|max:50',
                'lokasi_penempatan' => 'required|string|max:254',
                'id_mitra'          => 'required|string|exists:mitra,id_mitra',
                'periode'           => 'required|string|max:20',
                'kuota'             => 'required|integer|min:1',
                'syarat'            => 'nullable|string',
                'deskripsi_silabus' => 'nullable|string',
                'dampak_program'    => 'nullable|string'
            ]);
            $data = ProgramMagang::create($validated);
            return response()->json(['message' => 'Program Magang berhasil ditambahkan', 'data' => $data], 201);

        } catch (QueryException $e) {
            return response()->json(['message' => 'Database error', 'error' => $e->getMessage()], 500);
        }
    }

    public function show($id_program)
    {
        $data = ProgramMagang::find($id_program);
        if (!$data) {
            return response()->json(['message' => "Program Magang dengan id $id_program tidak ditemukan"], 404);
        }
        return response()->json($data, 200);
    }

    public function update(Request $request, $id_program)
    {
        $data = ProgramMagang::find($id_program);
        if (!$data) {
            return response()->json(['message' => 'Program Magang tidak ditemukan'], 404);
        }

        try {
            $data->update($request->all());
            return response()->json(['message' => 'Data program berhasil diperbarui', 'data' => $data], 200);

        } catch (QueryException $e) {
            return response()->json(['message' => 'Error update', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id_program)
    {
        $data = ProgramMagang::find($id_program);
        if (!$data) {
            return response()->json(['message' => 'Program Magang tidak ditemukan'], 404);
        }

        try {
            $data->delete();
            return response()->json(['message' => 'Program Magang berhasil dihapus'], 200);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error delete', 'error' => $e->getMessage()], 500);
        }
    }
}
