@extends('layouts.app')

@section('title', 'Dashboard - Pengumuman')

@section('header_title', 'Dashboard Utama')

@section('content')
<div class="max-w-6xl mx-auto space-y-8">

    <div class="fade-up relative overflow-hidden bg-tsu-teal rounded-[2.5rem] p-10 text-white shadow-2xl shadow-teal-100">
        <div class="relative z-10">
            <h2 class="text-3xl font-black mb-2">Halo, {{ auth()->user()->name }}! 👋</h2>
            <p class="text-teal-50/80 max-w-xl leading-relaxed">
                Selamat datang di portal magang TSU. Pastikan Anda selalu memantau pengumuman terbaru di bawah ini untuk informasi periode magang dan administrasi.
            </p>
            <div class="flex gap-4 mt-8">
                <div class="bg-white/10 backdrop-blur-md px-6 py-3 rounded-2xl border border-white/20">
                    <p class="text-[10px] uppercase font-bold text-teal-200">Periode Saat Ini</p>
                    <p class="font-bold">Semester Ganjil 2025/2026</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md px-6 py-3 rounded-2xl border border-white/20">
                    @php
                        $berkas = auth()->user()->berkas;

                        $terverifikasi = $berkas
                            && $berkas->cv_file
                            && $berkas->transkrip_file
                            && $berkas->krs_file;
                    @endphp

                    <p class="text-[10px] uppercase font-bold text-teal-200">Status Akun</p>

                    @if($terverifikasi)
                        <p class="font-bold flex items-center gap-2 text-green-300">
                            <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                            Terverifikasi
                        </p>
                    @else
                        <p class="font-bold flex items-center gap-2 text-red-300">
                            <span class="w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
                            Belum Terverifikasi
                        </p>
                    @endif
                </div>

            </div>
        </div>
        <div class="absolute right-[-5%] top-[-20%] w-96 h-96 bg-white/5 rounded-full blur-3xl"></div>
        <div class="absolute right-[5%] bottom-[-10%] w-64 h-64 bg-teal-400/10 rounded-full blur-2xl"></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 space-y-6">
            <div class="fade-up delay-100 flex items-center justify-between mb-2">
                <h3 class="text-xl font-black text-gray-800 flex items-center gap-3">
                    <span class="bg-tsu-teal text-white p-2 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </span>
                    Pengumuman Global
                </h3>
                <span class="text-sm font-bold text-tsu-teal bg-teal-50 px-4 py-1 rounded-full">3 Baru</span>
            </div>

            <div class="fade-up delay-200 bg-white border-l-8 border-tsu-red rounded-3xl p-6 shadow-sm hover:shadow-md transition">
                <div class="flex justify-between items-start mb-4">
                    <span class="bg-red-50 text-red-600 text-[10px] font-black uppercase px-3 py-1 rounded-lg">Penting</span>
                    <p class="text-gray-400 text-xs">27 Des 2024 - 10:00</p>
                </div>
                <h4 class="text-lg font-bold text-gray-800 mb-2">Batas Akhir Unggah Laporan Bulanan Desember</h4>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    Diberitahukan kepada seluruh mahasiswa magang bahwa pengunggahan logbook dan laporan bulanan periode Desember paling lambat tanggal 30 Desember 2024 pukul 23.59 WIB.
                </p>
                <div class="flex items-center gap-2 text-tsu-teal font-bold text-xs cursor-pointer hover:underline">
                    Baca Selengkapnya 
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                </div>
            </div>

            <div class="fade-up delay-300 bg-white border-l-8 border-tsu-blue rounded-3xl p-6 shadow-sm hover:shadow-md transition">
                <div class="flex justify-between items-start mb-4">
                    <span class="bg-blue-50 text-blue-600 text-[10px] font-black uppercase px-3 py-1 rounded-lg">Informasi</span>
                    <p class="text-gray-400 text-xs">25 Des 2024 - 08:30</p>
                </div>
                <h4 class="text-lg font-bold text-gray-800 mb-2">Pembukaan Batch Magang Mandiri Januari 2026</h4>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    Pendaftaran untuk Program Magang Mandiri batch Januari 2025 kini telah dibuka. Mahasiswa diharapkan segera melengkapi dokumen persyaratan di menu Setting.
                </p>
                <a href="{{ route('program.index') }}" class="inline-block bg-gray-100 text-gray-700 px-4 py-2 rounded-xl text-xs font-bold hover:bg-tsu-blue hover:text-white transition">Lihat Daftar Program</a>
            </div>

            <div class="fade-up delay-400 bg-white border-l-8 border-tsu-orange rounded-3xl p-6 shadow-sm hover:shadow-md transition">
                <div class="flex justify-between items-start mb-4">
                    <span class="bg-orange-50 text-orange-600 text-[10px] font-black uppercase px-3 py-1 rounded-lg">Update</span>
                    <p class="text-gray-400 text-xs">20 Des 2024 - 14:20</p>
                </div>
                <h4 class="text-lg font-bold text-gray-800 mb-2">Pembaruan Format Penilaian Pembimbing Lapangan</h4>
                <p class="text-gray-600 text-sm leading-relaxed">
                    Terdapat pembaruan pada form penilaian di menu Penilaian. Mohon konfirmasi kepada pembimbing masing-masing untuk menggunakan format terbaru versi 2.1.
                </p>
            </div>
        </div>

        <div class="space-y-8">
            <div class="fade-up delay-300 bg-white rounded-[2rem] p-8 border border-gray-100 shadow-sm">
                <h4 class="font-black text-gray-800 mb-6 uppercase text-xs tracking-widest">Aktivitas Saya</h4>
                <div class="space-y-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-teal-50 text-tsu-teal rounded-2xl flex items-center justify-center font-bold">12</div>
                        <div>
                            <p class="text-sm font-bold">Logbook Diisi</p>
                            <p class="text-[10px] text-gray-400">Total bulan ini</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-blue-50 text-tsu-blue rounded-2xl flex items-center justify-center font-bold">02</div>
                        <div>
                            <p class="text-sm font-bold">Program Dilamar</p>
                            <p class="text-[10px] text-gray-400">Menunggu verifikasi</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="fade-up delay-500 bg-white rounded-[2rem] p-8 border border-gray-100 shadow-sm">
                <h4 class="font-black text-gray-800 mb-6 uppercase text-xs tracking-widest">Agenda Mendatang</h4>
                <div class="relative border-l-2 border-dashed border-gray-100 ml-2 space-y-8">
                    <div class="relative pl-8">
                        <div class="absolute left-[-9px] top-0 w-4 h-4 bg-tsu-teal rounded-full ring-4 ring-teal-50"></div>
                        <p class="text-[10px] font-bold text-tsu-teal uppercase">30 Des 2024</p>
                        <p class="text-sm font-bold">Deadline Laporan Akhir</p>
                    </div>
                    <div class="relative pl-8">
                        <div class="absolute left-[-9px] top-0 w-4 h-4 bg-gray-200 rounded-full ring-4 ring-gray-50"></div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase">05 Jan 2025</p>
                        <p class="text-sm font-bold text-gray-400">Presentasi Hasil Magang</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection