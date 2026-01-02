<?php

namespace App\Http\Controllers;

use App\Models\ProgramMagang;

class ProgramMagangTampilController extends Controller
{
    public function index()
    {
        $programs = ProgramMagang::with('mitra')->get();
        return view('pages.program.program', compact('programs'));
    }

    public function show($id_program)
    {
        $program = ProgramMagang::with('mitra')
                    ->findOrFail($id_program);

        return view('pages.program.program-detail', compact('program'));
    }
}
