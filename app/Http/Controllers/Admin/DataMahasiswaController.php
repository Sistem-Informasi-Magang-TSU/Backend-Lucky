<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DataMahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'mahasiswa')
            ->with(['mahasiswa.pendaftaran.programMagang.mitra']);

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhereHas('mahasiswa', function($q2) use ($search) {
                      $q2->where('nim', 'like', "%{$search}%");
                  });
            });
        }

        $mahasiswa = $query->get();

        return view('admin.mahasiswa.index', compact('mahasiswa'));
    }
}
