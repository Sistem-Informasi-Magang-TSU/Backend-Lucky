<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengumuman;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::latest()->take(5)->get();
        return view('admin.dashboard', compact('pengumuman'));
    }
}
