@extends('layouts.guest')

@section('styles')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        html {
            scroll-behavior: smooth;
        }

        .hero-gradient {
            background: radial-gradient(circle at 10% 20%, rgba(8, 99, 117, 0.05) 0%, rgba(255, 255, 255, 0) 100%);
        }

        .float-anim {
            animation: floating 4s ease-in-out infinite;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .nav-link {
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: #086375;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="w-full overflow-x-hidden hero-gradient">

        <nav class="w-full px-6 md:px-16 py-6 flex justify-between items-center max-w-7xl mx-auto flex-shrink-0">
            <div class="flex items-center gap-3">
                <img src="/images/logo_tsu.svg" class="h-12" alt="TSU Logo">
                <div class="text-left border-l-2 border-gray-200 pl-3">
                    <p class="font-semibold text-[10px] uppercase tracking-widest text-tsu-teal">Sistem Informasi Magang</p>
                    <p class="font-bold text-sm text-gray-800">UNIVERSITAS TIGA SERANGKAI</p>
                </div>
            </div>

            <div class="flex items-center gap-8 text-gray-700 font-semibold">
                <a href="#about" class="nav-link text-sm transition-all">About</a>
                <a href="#help" class="nav-link text-sm transition-all">Help</a>
            </div>
        </nav>

        <div class="min-h-[80vh] flex items-center justify-center">
            <div class="w-full px-6 md:px-16 max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                <div data-aos="fade-right" data-aos-duration="1000">
                    <p class="font-bold text-tsu-teal tracking-[0.2em] text-sm mb-4 uppercase">🚀 Lowongan 2026 Sudah
                        Dibuka, Daftar Sekarang!</p>
                    <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 leading-[1.1]">
                        Temukan Tempat <br>
                        <span class="text-tsu-teal">Magang Favorit</span> Kamu
                    </h1>
                    <p class="text-gray-600 mt-6 text-lg leading-relaxed max-w-md">
                        Platform cerdas untuk mencari, mengelola, dan melaporkan kegiatan Magang Anda dengan lebih efisien
                        dan transparan.
                    </p>

                    <div class="flex flex-wrap gap-4 mt-10">
                        <a href="{{ route('register') }}"
                            class="px-10 py-4 bg-tsu-teal text-white font-bold rounded-2xl shadow-xl shadow-tsu-teal/30 hover:bg-tsu-teal-dark hover:-translate-y-1 transition-all duration-300">
                            Daftar Sekarang
                        </a>
                        <a href="{{ route('login') }}"
                            class="px-10 py-4 bg-white border border-gray-200 text-gray-700 font-bold rounded-2xl shadow-lg hover:bg-gray-50 hover:-translate-y-1 transition-all duration-300">
                            Masuk
                        </a>
                    </div>
                </div>

                <div class="flex justify-center lg:justify-end" data-aos="zoom-in" data-aos-duration="1200">
                    <div class="relative">
                        <div class="absolute -top-10 -left-10 w-64 h-64 bg-tsu-teal/10 rounded-full blur-3xl"></div>
                        <img src="/images/ic_logreg.svg"
                            class="w-[350px] md:w-[500px] float-anim relative z-10 drop-shadow-2xl" alt="Hero Illustration">
                    </div>
                </div>
            </div>
        </div>

        <div id="about" class="py-24 w-full px-6 md:px-20 max-w-7xl mx-auto">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-sm font-black text-tsu-teal tracking-[0.3em] uppercase mb-2">Tentang Kami</h2>
                <div class="h-1.5 w-20 bg-tsu-teal mx-auto rounded-full"></div>
            </div>

            <div class="bg-white rounded-[40px] p-8 md:p-16 shadow-2xl shadow-gray-200/50 border border-gray-100 flex flex-col items-center text-center"
                data-aos="fade-up">
                <img src="/images/logo_tsu.svg" class="h-24 mb-8" alt="Logo TSU">
                <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6">Sistem Informasi Magang TSU</h3>
                <p class="text-gray-600 leading-relaxed max-w-4xl text-lg">
                    Sistem Informasi Magang TSU adalah platform resmi Universitas Tiga Serangkai yang menjembatani mahasiswa
                    dengan berbagai mitra industri terkemuka. Kami berkomitmen untuk memastikan setiap mahasiswa mendapatkan
                    pengalaman praktis yang berkualitas sesuai dengan kurikulum dan kebutuhan industri masa kini.
                </p>
            </div>
        </div>

        <div class="w-full pb-24 px-6 md:px-20 max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-10">

            <div class="bg-white rounded-3xl p-10 shadow-xl border border-gray-50 hover:shadow-2xl transition-all group"
                data-aos="fade-right">
                <div class="w-14 h-14 bg-tsu-teal/10 rounded-2xl flex items-center justify-center mb-6">
                    <img src="/images/ic_check.svg" class="h-8 transition-all" alt="Check Icon">
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Tujuan Program</h3>
                <ul class="space-y-3 text-gray-600">
                    <li class="flex items-start gap-2"><span class="text-tsu-teal font-bold">•</span> Akses mudah ke daftar
                        perusahaan mitra resmi.</li>
                    <li class="flex items-start gap-2"><span class="text-tsu-teal font-bold">•</span> Digitalisasi
                        pendaftaran dan pelaporan magang.</li>
                    <li class="flex items-start gap-2"><span class="text-tsu-teal font-bold">•</span> Monitoring progress
                        magang secara real-time.</li>
                    <li class="flex items-start gap-2"><span class="text-tsu-teal font-bold">•</span> Sinkronisasi antara
                        Mahasiswa, Dosen, dan Mitra.</li>
                </ul>
            </div>

            <div class="bg-white rounded-3xl p-10 shadow-xl border border-gray-50 hover:shadow-2xl transition-all group"
                data-aos="fade-left">
                <div class="w-14 h-14 bg-tsu-teal/10 rounded-2xl flex items-center justify-center mb-6">
                    <img src="/images/ic_groups.svg" class="h-8 transition-all" alt="Groups Icon">
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Manfaat Bagi Mahasiswa</h3>
                <ul class="space-y-3 text-gray-600">
                    <li class="flex items-start gap-2"><span class="text-tsu-teal font-bold">•</span> Tempat magang valid &
                        terverifikasi kampus.</li>
                    <li class="flex items-start gap-2"><span class="text-tsu-teal font-bold">•</span> Administrasi
                        surat-menyurat yang lebih cepat.</li>
                    <li class="flex items-start gap-2"><span class="text-tsu-teal font-bold">•</span> Logbook kegiatan
                        digital yang terorganisir.</li>
                    <li class="flex items-start gap-2"><span class="text-tsu-teal font-bold">•</span> Transparansi penilaian
                        dari pembimbing lapangan.</li>
                </ul>
            </div>

        </div>

        <footer id="help" class="w-full bg-tsu-teal-dark pt-20 pb-10">
            <div class="max-w-7xl mx-auto px-6 md:px-16 flex flex-col items-center text-center">

                <img src="/images/logo_tsu.svg" class="h-20 mb-6 brightness-0 invert" alt="Logo White">

                <div class="max-w-2xl mb-12">
                    <h4 class="text-white text-xl font-bold mb-4">Sistem Informasi Magang TSU</h4>
                    <p class="text-teal-50/70 leading-relaxed">
                        Mewujudkan generasi profesional melalui program magang yang terintegrasi dan berkualitas tinggi.
                        Hubungi kami untuk bantuan lebih lanjut terkait teknis dan kemitraan.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12 w-full max-w-4xl">
                    <div class="bg-white/5 p-6 rounded-2xl border border-white/10 flex flex-col items-center">
                        <h5 class="text-white font-semibold mb-4 uppercase tracking-widest text-xs opacity-60">Hubungi Kami
                        </h5>
                        <a href="https://wa.me/6285117407525" target="_blank"
                            class="flex items-center gap-3 text-white hover:text-tsu-teal transition-colors">
                            <img src="/images/ic_whatsapp.svg" class="h-6 brightness-0 invert">
                            <span class="font-medium">+62-851-1740-7525</span>
                        </a>
                    </div>
                    <div class="bg-white/5 p-6 rounded-2xl border border-white/10 flex flex-col items-center">
                        <h5 class="text-white font-semibold mb-4 uppercase tracking-widest text-xs opacity-60">Lokasi</h5>
                        <p class="text-white text-sm leading-relaxed">
                            Jl. K.H Samanhudi No.84-86, Purwosari, Kec. Laweyan,<br>Kota Surakarta, Jawa Tengah 57149,
                            Indonesia
                        </p>
                    </div>
                </div>

                <div class="flex gap-6 mb-16">
                    <a href="https://www.instagram.com/fteknik.tsu/" target="_blank"
                        class="w-14 h-14 bg-white/10 rounded-full flex items-center justify-center hover:bg-white hover:text-tsu-teal-dark transition-all duration-300 transform hover:-translate-y-1">
                        <svg class="w-7 h-7 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                    </a>
                </div>

                <div
                    class="w-full pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-xs text-white/40 tracking-widest uppercase">
                        &copy; {{ date('Y') }} Sistem Informasi Magang TSU. All rights reserved.
                    </p>
                    <div class="flex gap-6">
                        <a href="#" class="text-xs text-white/40 hover:text-white transition-colors">Privacy Policy</a>
                        <a href="#" class="text-xs text-white/40 hover:text-white transition-colors">Terms of Service</a>
                    </div>
                </div>
            </div>
        </footer>

    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            offset: 100,
            duration: 800
        });
    </script>
@endsection