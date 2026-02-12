<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard Magang TSU')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'tsu-teal': '#086375',
                        'tsu-teal-dark': '#064e5c',
                        'tsu-green': '#074755',
                        'tsu-red': '#ef4444',
                        'tsu-blue': '#3b82f6',
                        'tsu-orange': '#f59e0b',
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

        .fade-up {
            opacity: 0;
            animation: fadeUp 0.6s cubic-bezier(0.21, 1.02, 0.73, 1) forwards;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }

        .delay-400 {
            animation-delay: 0.4s;
        }

        .delay-500 {
            animation-delay: 0.5s;
        }

        .delay-600 {
            animation-delay: 0.6s;
        }

        .delay-700 {
            animation-delay: 0.7s;
        }

        .delay-800 {
            animation-delay: 0.8s;
        }

        .delay-900 {
            animation-delay: 0.9s;
        }
    </style>
</head>

<body class="bg-white font-sans text-gray-800 flex min-h-screen">

    <aside class="w-64 bg-tsu-teal flex-shrink-0 flex flex-col fixed h-full z-30 overflow-y-auto shadow-xl">
        <div class="p-8 flex items-center justify-center">
            <img src="{{ asset('images/logo_tsu_white.svg') }}" class="h-20 mb-4" alt="TSU Logo">
        </div>

        @php
            $user = auth()->user();
            $role = $user ? $user->role : null;

            $isMahasiswa = $role === 'mahasiswa';
            $isDosen = $role === 'dosen';
            $isAdmin = $role === 'admin';
<<<<<<< HEAD
=======
            $isAdminUniversitas = $role === 'admin_universitas';
            $isAdminProdi = $role === 'admin_prodi';
            $isAnyAdmin = $isAdmin || $isAdminUniversitas || $isAdminProdi;
>>>>>>> 4bd29f5 (Admin Univ & Admin Prodi donee)

            $activeClass = 'bg-[#074755] text-white shadow-md';
            $inactiveClass = 'bg-white text-black hover:bg-gray-100 transition shadow-sm';

            $settingLink = route('setting');

            // Foto profil logic
            if ($isMahasiswa && $user->mahasiswa?->foto) {
                $foto = asset('storage/' . $user->mahasiswa->foto);
            } elseif ($isDosen && $user->dosen?->foto) {
                $foto = asset('storage/' . $user->dosen->foto);
            } else {
                $foto = 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=0d9488&color=fff&size=128';
            }
        @endphp

        <nav class="flex-1 px-4 space-y-3 mt-2">
            @if($isMahasiswa)
                <a href="{{ route('mahasiswa.dashboard') }}"
                    class="flex items-center gap-3 px-6 py-3 rounded-full font-bold {{ request()->routeIs('dashboard.mahasiswa') ? $activeClass : $inactiveClass }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('program.index') }}"
                    class="flex items-center gap-3 px-6 py-3 rounded-full font-bold {{ request()->routeIs('program*') ? $activeClass : $inactiveClass }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    Program
                </a>
                <a href="{{ route('logbook') }}"
                    class="flex items-center gap-3 px-6 py-3 rounded-full font-bold {{ request()->routeIs('logbook*') ? $activeClass : $inactiveClass }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Logbook
                </a>
                <a href="{{ route('penilaian') }}"
                    class="flex items-center gap-3 px-6 py-3 rounded-full font-bold {{ request()->routeIs('penilaian*') ? $activeClass : $inactiveClass }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Penilaian
                </a>
                <a href="{{ route('pembimbing') }}"
                    class="flex items-center gap-3 px-6 py-3 rounded-full font-bold {{ request()->routeIs('pembimbing*') ? $activeClass : $inactiveClass }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Pembimbing
                </a>
            @endif

            @if($isDosen)
                <p class="text-[10px] text-teal-200 px-6 uppercase font-bold">Informasi Magang</p>

                <a href="{{ route('dosen.dashboard') }}"
                    class="flex items-center gap-3 px-6 py-3 rounded-full font-bold {{ request()->routeIs('dosen.dashboard') ? $activeClass : $inactiveClass }}">
                    Info Dashboard
                </a>
                <a href="{{ route('dosen.view_program') }}"
                    class="flex items-center gap-3 px-6 py-3 rounded-full font-bold {{ request()->routeIs('dosen.view_program') ? $activeClass : $inactiveClass }}">
                    Info Program
                </a>

                <p class="text-[10px] text-teal-200 px-6 uppercase font-bold">Monitor Mahasiswa</p>


                <a href="{{ route('dosen.logbook') }}"
                    class="flex items-center gap-3 px-6 py-3 rounded-full font-bold {{ request()->routeIs('dosen.logbook*') ? $activeClass : $inactiveClass }}">
                    Validasi Logbook
                </a>
                <a href="{{ route('dosen.penilaian') }}"
                    class="flex items-center gap-3 px-6 py-3 rounded-full font-bold {{ request()->routeIs('dosen.penilaian*') ? $activeClass : $inactiveClass }}">
                    Input Penilaian
                </a>
            @endif

<<<<<<< HEAD
            @if($isAdmin)
                <a href="{{ route('admin.pengumuman.index') }}"
                    class="flex items-center gap-3 px-6 py-3 rounded-full font-bold {{ request()->routeIs('admin.pengumuman.index') ? $activeClass : $inactiveClass }}">
=======
            @if($isAnyAdmin)
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-6 py-3 rounded-full font-bold {{ request()->routeIs('admin.dashboard') ? $activeClass : $inactiveClass }}">
>>>>>>> 4bd29f5 (Admin Univ & Admin Prodi donee)
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    Pengumuman
                </a>
                
                @if($isAdmin)
                <a href="{{ route('admin.program.index') }}"
                    class="flex items-center gap-3 px-6 py-3 rounded-full font-bold {{ request()->routeIs('admin.program*') ? $activeClass : $inactiveClass }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Kelola Program
                </a>
                <a href="{{ route('admin.pendaftaran.index') }}"
                    class="flex items-center gap-3 px-6 py-3 rounded-full font-bold {{ request()->routeIs('admin.pendaftaran*') ? $activeClass : $inactiveClass }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    ACC Pendaftaran
                </a>
                @endif

                <a href="{{ route('admin.mahasiswa.index', $isAdminUniversitas ? ['role' => 'universitas'] : []) }}"
                    class="flex items-center gap-3 px-6 py-3 rounded-full font-bold {{ request()->routeIs('admin.mahasiswa*') ? $activeClass : $inactiveClass }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Data Mahasiswa
                </a>
            @endif
        </nav>
    </aside>

    <main class="flex-1 ml-64 bg-gray-50 min-h-screen">

        <header
            class="sticky top-0 z-20 flex justify-between items-center px-8 py-6 bg-gray-50/80 backdrop-blur-md border-b border-gray-100">
            <div>
                <h1 class="text-3xl font-extrabold text-black">@yield('header_title')</h1>
                <p class="text-gray-500 text-sm">Sistem Informasi Magang TSU</p>
            </div>

            <div class="flex items-center gap-4">
                <div class="relative group">
                    <button
                        class="flex items-center gap-3 bg-white p-2 pr-4 rounded-full shadow-sm border border-gray-100 focus:outline-none transition hover:bg-gray-50">
                        <img src="{{ $foto }}" alt="User"
                            class="w-10 h-10 rounded-full object-cover border-2 border-tsu-teal">
                        <div class="leading-none text-left">
                            <p class="font-bold text-sm text-gray-800">
                                {{ $user->name }}
                                <span
                                    class="text-xs ml-1 transition-transform group-hover:rotate-180 inline-block">▼</span>
                            </p>
                            <p class="text-[10px] text-gray-400 uppercase tracking-wider font-bold">
                                @if($isDosen && $user->dosen)
                                    NUPTK. {{ $user->dosen->nuptk }}
                                @elseif($isMahasiswa && $user->mahasiswa)
                                    {{ $user->mahasiswa->nim }}
                                @else
                                    {{ $user->role }}
                                @endif
                            </p>
                        </div>
                    </button>

                    <div
                        class="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-xl py-2 border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top-right z-50">
                        <a href="{{ $settingLink }}"
                            class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-tsu-teal font-medium transition-colors">
                            <span class="mr-3 text-lg">⚙️</span> Pengaturan
                        </a>
                        <div class="my-1 border-t border-gray-100"></div>
                        <a href="#" id="logoutLink"
                            class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 font-medium transition-colors">
                            <span class="mr-3 text-lg">🚪</span> Keluar
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <div class="p-8">
            @yield('content')
        </div>
    </main>

    <div id="logoutModal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-40 backdrop-blur-sm transition-opacity duration-300">
        <div
            class="bg-white rounded-3xl shadow-2xl w-full max-w-sm p-8 transform transition-transform duration-300 scale-95">
            <div class="w-20 h-20 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2 text-center">Konfirmasi Keluar</h3>
            <p class="text-gray-500 mb-8 text-center leading-relaxed">Sesi Anda akan berakhir. Pastikan semua progres
                telah tersimpan.</p>

            <button id="cancelLogout"
                class="flex-1 px-4 py-3 bg-gray-100 text-gray-600 font-bold rounded-2xl hover:bg-gray-200 transition">Kembali</button>
            <form method="POST" action="{{ route('logout') }}" class="flex-1">
                @csrf
                <button type="submit"
                    class="w-full px-4 py-3 bg-tsu-red text-white font-bold rounded-2xl hover:bg-red-700 transition text-center">Keluar</button>
            </form>
        </div>
    </div>
    </div>

    <script>
        const logoutModal = document.getElementById('logoutModal');
        const logoutLink = document.getElementById('logoutLink');
        const cancelLogoutButton = document.getElementById('cancelLogout');

        logoutLink.addEventListener('click', (e) => {
            e.preventDefault();
            logoutModal.classList.remove('hidden');
            logoutModal.classList.add('flex');
        });

        cancelLogoutButton.addEventListener('click', () => {
            logoutModal.classList.add('hidden');
            logoutModal.classList.remove('flex');
        });
    </script>
</body>

</html>