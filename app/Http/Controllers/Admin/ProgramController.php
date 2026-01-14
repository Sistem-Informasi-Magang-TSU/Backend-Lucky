<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProgramMagang;
use App\Models\Mitra; 
use Illuminate\Database\QueryException;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all programs with their related Mitra (if needed)
        // Assuming there is a relation, though ProgramMagang model had `id_mitra`.
        // Let's check if we need to pass 'mitra' list for the create/edit modal dropdown.
        
        $programs = ProgramMagang::with('mitra')->latest()->get(); 
        $mitras = Mitra::all(); // We need this for the "Perusahaan" dropdown if it's a relation

        return view('admin.program.index', compact('programs', 'mitras'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
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

        try {
            ProgramMagang::create($request->all());
            return redirect()->back()->with('success', 'Program Magang berhasil ditambahkan');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan program: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $program = ProgramMagang::findOrFail($id);

        $request->validate([
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

        try {
            $program->update($request->all());
            return redirect()->back()->with('success', 'Program Magang berhasil diperbarui');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui program: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $program = ProgramMagang::findOrFail($id);
        
        try {
            $program->delete();
            return redirect()->back()->with('success', 'Program Magang berhasil dihapus');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Gagal menghapus program: ' . $e->getMessage());
        }
    }
}
