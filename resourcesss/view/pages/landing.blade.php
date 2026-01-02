@extends('layouts.guest')

@section('styles')
<style>
    html { scroll-behavior: smooth; }
</style>
@endsection


@section('content')
<div class="w-full">

    <div class="min-h-screen pt-4 pb-24 shadow-inner flex flex-col">

        <div class="w-full px-6 md:px-16 py-3 flex justify-between items-center max-w-7xl mx-auto flex-shrink-0">
            <div class="flex items-center gap-3">
                <img src="/images/logo_tsu.svg" class="h-10" alt="TSU Logo"> 
                <div class="text-left text-[#004d5a]">
                    <p class="font-semibold text-sm">Sistem Informasi Magang</p>
                    <p class="font-bold text-sm">UNIVERSITAS TIGA SERANGKAI</p>
                </div>
            </div>

            <div class="flex items-center gap-10 text-black font-medium">
                <a href="#about" class="hover:text-gray-700">About</a> 
                <a href="#help" class="hover:text-gray-700">Help</a>
            </div>
        </div>

        <div class="flex-grow flex items-center justify-center">
             <div class="w-full px-6 md:px-16 max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 items-center">
                
                <div>
                    <p class="font-semibold text-black">Halo, Selamat Datang</p>
                    <h1 class="text-4xl md:text-5xl font-extrabold mt-2 text-black leading-snug">
                        Temukan Tempat <br>
                        Magang Favorite Kamu
                    </h1>
                    <p class="text-gray-700 mt-4 text-base md:text-lg leading-relaxed">
                        Sistem yang memudahkanmu mencari, mengelola, dan <br>
                        melaporkan kegiatan Magang.
                    </p>

                    <div class="flex gap-4 mt-8">
                        <a href="{{ route('register') }}" class="px-8 py-3 bg-[#0d6775] text-white font-semibold rounded-xl shadow-lg hover:opacity-90 transition">
                            Daftar
                        </a>
                        <a href="{{ route('login') }}" class="px-8 py-3 bg-white border border-gray-300 rounded-xl shadow-lg hover:bg-gray-100 font-semibold transition">
                            Masuk
                        </a>
                    </div>
                </div>

                <div class="flex justify-center mt-10 md:mt-0">
                    <img src="/images/rocket.png" class="w-[320px] md:w-[420px]" alt="Rocket"> 
                </div>
            </div>
        </div>
    </div>
    
    <div id="about" class="mt-16 md:mt-24 w-full px-6 md:px-20 max-w-7xl mx-auto">
        <h2 class="text-center text-xl font-extrabold text-[#005f6f] tracking-wider mb-8">
            ABOUT
        </h2>

        <div class="bg-white border border-gray-300 rounded-2xl px-8 py-10 shadow-xl max-w-4xl mx-auto">
            <div class="flex flex-col items-center">
                <img src="/images/logo_tsu.svg" class="h-20 mb-4" alt="Logo TSU">
                <h3 class="text-xl md:text-2xl font-bold text-[#006a79]">
                    Sistem Informasi Magang
                </h3>
                <p class="mt-4 text-center text-gray-700 leading-relaxed max-w-3xl">
                    Sistem Informasi Magang TSU adalah platform resmi Universitas Tiga Serangkai yang memudahkan mahasiswa dalam mencari, memilih, dan mengelola kegiatan magang. Website ini menyediakan informasi tempat magang mitra kampus, sehingga mahasiswa dapat menemukan peluang yang sesuai dengan minat dan program studi.
                </p>
            </div>
        </div>
    </div>

    <div class="w-full mt-16 px-6 md:px-20 max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">

        <div class="bg-white border border-gray-300 rounded-2xl px-8 py-10 shadow-xl">
            <div class="flex items-center gap-3 mb-4">
                <img src="/images/ic_check.svg" class="h-9"> 
                <h3 class="text-lg font-bold text-[#0A7784]">Tujuan Program</h3>
            </div>
            
            <ul class="list-disc ml-6 text-gray-700 leading-relaxed space-y-2">
                <li>Memberikan akses mudah ke daftar perusahaan mitra.</li>
                <li>Menyederhanakan proses pendaftaran dan pengajuan magang.</li>
                <li>Menyediakan fitur monitoring dan pelaporan kegiatan magang.</li>
                <li>Menghubungkan mahasiswa, dosen pembimbing, dan koordinator magang dalam satu sistem.</li>
            </ul>
        </div>

        <div class="bg-white border border-gray-300 rounded-2xl px-8 py-10 shadow-xl">
            <div class="flex items-center gap-3 mb-4">
                <img src="/images/ic_groups.svg" class="h-9">
                <h3 class="text-lg font-bold text-[#0A7784]">Manfaat Bagi Mahasiswa</h3>
            </div>

            <ul class="list-disc ml-6 text-gray-700 leading-relaxed space-y-2">
                <li>Informasi tempat magang yang valid dan terverifikasi kampus.</li>
                <li>Proses administrasi lebih cepat dan efisien.</li>
                <li>Panduan lengkap mulai dari pendaftaran hingga penilaian akhir.</li>
                <li>Transparansi progress magang secara real-time.</li>
            </ul>
        </div>

    </div>

    <div id="help" class="w-full mt-24 bg-[#0e6a79] py-12">
        <h2 class="text-center text-white text-xl font-extrabold tracking-wider mb-6">
            HELP
        </h2>

        <div class="flex justify-center gap-10 mt-6 text-white flex-wrap">

            <div class="flex items-center gap-3 font-medium">
                <img src="/images/ic_call.svg" class="h-6"> 
                <span>+62 123 456 789 (Call Center)</span>
            </div>

            <div class="flex items-center gap-3 font-medium">
                <img src="/images/ic_whatsapp.svg" class="h-6">
                <span>+62 123 456 789 (WhatsApp)</span>
            </div>

        </div>
        
        <p class="text-center text-xs text-white/70 mt-10">
            &copy; {{ date('Y') }} Sistem Informasi Magang TSU. All rights reserved.
        </p>

    </div>

</div>
@endsection