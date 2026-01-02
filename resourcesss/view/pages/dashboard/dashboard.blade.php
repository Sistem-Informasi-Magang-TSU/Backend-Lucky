@extends('layouts.app')

@section('title', 'Dashboard - Program Magang')

@section('header_title', 'Program Magang')

@section('content')

    <div class="bg-tsu-teal text-white rounded-xl p-6 mb-8 shadow-md">
        <h2 class="text-xl font-bold mb-2">Temukan Tempat Magang Favorite Kamu Disini!</h2>
        <p class="text-sm text-gray-200 font-light">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
    </div>

    <div class="border border-gray-300 rounded-xl p-6 mb-8">
        <h3 class="text-xl font-bold mb-6">Lowongan Terbaru - 2026</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"> 
            {{-- Tips: Pindahkan data ini ke Controller nanti jika sempat --}}
            @php
                $jobs = [
                    ['title' => 'Project Website Penjualan', 'company' => 'PT. Tiga Serangkai', 'role' => 'Frontend Developer', 'id' => 1],
                    ['title' => 'Aplikasi Android OBYE', 'company' => 'Bangkit Academy', 'role' => 'Mobile Developer', 'id' => 2], // Tambahkan ID
                    ['title' => 'Pengelolaan Server API', 'company' => 'Jujura Academy', 'role' => 'Cloud Engineer', 'id' => 3], // Tambahkan ID
                    ['title' => 'Project Website Penjualan', 'company' => 'Puspa Holistic', 'role' => 'Backend Developer', 'id' => 4], // Tambahkan ID
                    ['title' => 'Kotlin Specialist', 'company' => 'Shopee Indonesia', 'role' => 'Mobile Development', 'id' => 5], // Tambahkan ID
                    ['title' => 'Senior Flutter Developer', 'company' => 'Singapore Airlines', 'role' => 'Frontend Development', 'id' => 6], // Tambahkan ID
                    // ... Pastikan data lain juga memiliki ID ...
                ];
            @endphp

            @foreach($jobs as $job)
            <div class="border border-gray-400 rounded-xl p-4 flex flex-col justify-between hover:shadow-lg transition-shadow bg-white hover:border-tsu-teal">
                <div>
                    <h4 class="font-bold text-base mb-2 line-clamp-1" title="{{ $job['title'] }}">{{ $job['title'] }}</h4>
                    <div class="flex items-center gap-2 text-sm text-gray-700 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        {{ $job['company'] }}
                    </div>
                    <span class="inline-block bg-gray-100 text-tsu-teal font-medium text-xs px-3 py-1 rounded-md mb-4 border border-gray-200">
                        {{ $job['role'] }}
                    </span>
                </div>
                
                <a href="{{ route('dashboard.detail', ['id' => $job['id']]) }}" class="text-center w-full bg-tsu-teal text-white text-sm font-semibold py-2 rounded-full hover:bg-tsu-teal-dark transition">
                    Lihat Detail
                </a>

            </div>
            @endforeach

        </div>
    </div>

    <div class="border border-gray-300 rounded-xl p-6 mb-8 text-center">
        <h3 class="text-lg font-bold mb-6">Jumlah Peserta Yang Telah Bergabung</h3>
        
        <div class="grid grid-cols-3 divide-x divide-gray-200">
            <div>
                <div class="text-4xl font-bold text-tsu-red mb-1">30</div>
                <div class="text-sm font-medium text-gray-600">Peserta Terdaftar</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-green-500 mb-1">10</div>
                <div class="text-sm font-medium text-gray-600">Peserta Aktif</div>
            </div>
            <div>
                <div class="text-4xl font-bold text-tsu-blue mb-1">50</div>
                <div class="text-sm font-medium text-gray-600">Peserta Lulus</div>
            </div>
        </div>
    </div>

    <div class="bg-tsu-teal text-white rounded-xl p-8 shadow-md flex justify-between items-center">
        <div>
            <h2 class="text-xl font-bold mb-2">Bangun Karir Lewat Magang Sesuai Skill Kamu!</h2>
            <p class="text-sm text-gray-200 font-light">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
        </div>
    </div>

@endsection