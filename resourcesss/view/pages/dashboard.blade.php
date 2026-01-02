<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Magang TSU</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'tsu-teal': '#086375', // Warna sidebar & button
                        'tsu-teal-dark': '#064e5c',
                        'tsu-green': '#074755', // Warna tombol aktif
                        'tsu-red': '#ef4444',
                        'tsu-blue': '#3b82f6',
                    },
                    fontFamily: {
                        'sans': ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1; 
        }
        ::-webkit-scrollbar-thumb {
            background: #c1c1c1; 
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8; 
        }
    </style>
</head>
<body class="bg-white font-sans text-gray-800 flex min-h-screen">

    <aside class="w-64 bg-tsu-teal flex-shrink-0 flex flex-col fixed h-full z-10 overflow-y-auto">
        <div class="p-8 flex items-center justify-center">
            <div class="flex items-center gap-3 text-white">
                <img src="/images/logo_tsu_white.svg" class="h-30 mb-4" alt="">
            </div>
        </div>

        <nav class="flex-1 px-4 space-y-4 mt-4">
            <a href="#" class="flex items-center gap-3 px-6 py-3 bg-[#074755] text-white rounded-full font-bold shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Program
            </a>

            <a href="#" class="flex items-center gap-3 px-6 py-3 bg-white text-black rounded-full font-bold hover:bg-gray-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Logbook
            </a>

            <a href="#" class="flex items-center gap-3 px-6 py-3 bg-white text-black rounded-full font-bold hover:bg-gray-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                Penilaian
            </a>

            <a href="#" class="flex items-center gap-3 px-6 py-3 bg-white text-black rounded-full font-bold hover:bg-gray-100 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                </svg>
                Pembimbing
            </a>
        </nav>
    </aside>

    <main class="flex-1 ml-64 p-8 bg-white">
        
        <header class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-extrabold text-black">Program Magang</h1>
            
            <div class="flex items-center gap-4">
                <button class="relative p-2 bg-yellow-50 rounded-full hover:bg-yellow-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="absolute top-2 right-2.5 block h-2 w-2 rounded-full ring-2 ring-white bg-red-500"></span>
                </button>

                <div class="flex items-center gap-3">
                    <img src="/images/foto_thomasgtg.png" alt="Thomas gtg" class="w-10 h-10 rounded-full object-cover border border-gray-200">
                    <div class="leading-none">
                        <p class="font-bold text-sm">Thomas gtg <span class="text-xs ml-1">▼</span></p>
                        <p class="text-xs text-gray-500">22430035</p>
                    </div>
                </div>
            </div>
        </header>

        <div class="bg-tsu-teal text-white rounded-xl p-6 mb-8 shadow-md">
            <h2 class="text-xl font-bold mb-2">Temukan Tempat Magang Favorite Kamu Disini!</h2>
            <p class="text-sm text-gray-200 font-light">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
        </div>

        <div class="border border-gray-300 rounded-xl p-6 mb-8">
            <h3 class="text-xl font-bold mb-6">Lowongan Terbaru - 2026</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                @php
                    $jobs = [
                        ['title' => 'Project Website Penjualan', 'company' => 'PT. Tiga Serangkai', 'role' => 'Frontend Developer'],
                        ['title' => 'Aplikasi Android OBYE', 'company' => 'Bangkit Academy', 'role' => 'Mobile Developer'],
                        ['title' => 'Pengelolaan Server API', 'company' => 'Jujura Academy', 'role' => 'Cloud Engineer'],
                        ['title' => 'Project Website Penjualan', 'company' => 'Puspa Holistic', 'role' => 'Backend Developer'],
                        ['title' => 'Kotlin Specialist', 'company' => 'Shopee Indonesia', 'role' => 'Mobile Development'],
                        ['title' => 'Senior Flutter Developer', 'company' => 'Singapore Airlines', 'role' => 'Frontend Development'],
                        ['title' => 'AI Machine Learning', 'company' => 'Bisa AI', 'role' => 'Backend Development'],
                        ['title' => 'Data Mining For Begineer', 'company' => 'Hotel Multazam', 'role' => 'Data Mining'],
                    ];
                @endphp

                @foreach($jobs as $job)
                <div class="border border-gray-400 rounded-xl p-4 flex flex-col justify-between hover:shadow-lg transition-shadow bg-white">
                    <div>
                        <h4 class="font-bold text-base mb-2">{{ $job['title'] }}</h4>
                        <div class="flex items-center gap-2 text-sm text-gray-700 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            {{ $job['company'] }}
                        </div>
                        <span class="inline-block bg-gray-200 text-tsu-teal font-medium text-xs px-3 py-1 rounded-md mb-4 border border-gray-300">
                            {{ $job['role'] }}
                        </span>
                    </div>
                    <button class="w-full bg-tsu-teal text-white text-sm font-semibold py-2 rounded-full hover:bg-tsu-teal-dark transition">
                        Lihat Detail
                    </button>
                </div>
                @endforeach

            </div>
        </div>

        <div class="border border-gray-300 rounded-xl p-6 mb-8 text-center">
            <h3 class="text-lg font-bold mb-6">Jumlah Peserta Yang Telah Bergabung</h3>
            
            <div class="grid grid-cols-3 divide-x divide-transparent">
                <div>
                    <div class="text-4xl font-bold text-red-500 mb-1">30</div>
                    <div class="text-sm font-medium text-black">Peserta Terdaftar</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-green-500 mb-1">10</div>
                    <div class="text-sm font-medium text-black">Peserta Aktif</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-blue-500 mb-1">50</div>
                    <div class="text-sm font-medium text-black">Peserta Lulus</div>
                </div>
            </div>
        </div>

        <div class="bg-tsu-teal text-white rounded-xl p-8 shadow-md">
            <h2 class="text-xl font-bold mb-2">Bangun Karir Lewat Magang Sesuai Skill Kamu!</h2>
            <p class="text-sm text-gray-200 font-light">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
        </div>

        <div class="h-8"></div>

    </main>
</body>
</html>