<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate, max-age=0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <title>@yield('title', 'Dashboard Magang TSU')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
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
                    },
                    fontFamily: {
                        'sans': ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #c1c1c1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #a8a8a8; }
    </style>
</head>
<body class="bg-white font-sans text-gray-800 flex min-h-screen">

    <aside class="w-64 bg-tsu-teal flex-shrink-0 flex flex-col fixed h-full z-20 overflow-y-auto shadow-xl">
        <div class="p-8 flex items-center justify-center">
            <div class="flex items-center gap-3 text-white">
                <img src="{{ asset('images/logo_tsu_white.svg') }}" class="h-30 mb-4" alt="TSU Logo">
            </div>
        </div>

        @php
            // Rute '/' harusnya hanya landing, tapi jika dipakai di dashboard, masukkan di sini
            $currentPath = Request::path();
            $dashboardActive = str_starts_with($currentPath, 'dashboard') || $currentPath == '/'; 
            $logbookActive = str_starts_with($currentPath, 'logbook');
            $penilaianActive = str_starts_with($currentPath, 'penilaian');
            $pembimbingActive = str_starts_with($currentPath, 'pembimbing');
            
            $activeClass = 'bg-[#074755] text-white shadow-md';
            $inactiveClass = 'bg-white text-black hover:bg-gray-100 transition shadow-sm';
        @endphp

        <nav class="flex-1 px-4 space-y-4 mt-4">

            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-6 py-3 rounded-full font-bold {{ $dashboardActive ? $activeClass : $inactiveClass }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Program
            </a>

            <a href="{{ route('logbook') }}" class="flex items-center gap-3 px-6 py-3 rounded-full font-bold {{ $logbookActive ? $activeClass : $inactiveClass }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Logbook
            </a>

            <a href="{{ route('penilaian') }}" class="flex items-center gap-3 px-6 py-3 rounded-full font-bold {{ $penilaianActive ? $activeClass : $inactiveClass }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                Penilaian
            </a>

            <a href="{{ route('pembimbing') }}" class="flex items-center gap-3 px-6 py-3 rounded-full font-bold {{ $pembimbingActive ? $activeClass : $inactiveClass }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                </svg>
                Pembimbing
            </a>
        </nav>
    </aside>

    <main class="flex-1 ml-64 p-8 bg-white min-h-screen">
        
        <header class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-extrabold text-black">@yield('header_title', 'Program Magang')</h1>
            
            <div class="flex items-center gap-4">
        
                <div class="relative group z-30">
                    <button class="flex items-center gap-3 focus:outline-none">
                        <img src="{{ asset('images/foto_thomasgtg.png') }}" alt="User" class="w-10 h-10 rounded-full object-cover border border-gray-200">
                        <div class="leading-none text-left">
                            <p class="font-bold text-sm">Thomas gtg <span class="text-xs ml-1 transition-transform group-hover:rotate-180 inline-block">▼</span></p>
                            <p class="text-xs text-gray-500">22430035</p>
                        </div>
                    </button>
                    
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 transform origin-top-right">
                        <a href="{{ url('/setting') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-tsu-teal">
                            <i class="mr-2">⚙️</i> Setting
                        </a>
                        <div class="border-t border-gray-100"></div>
                        <a href="#" id="logoutLink" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700">
                            <i class="mr-2">🚪</i> Keluar
                        </a>
                    </div>
                </div>
            </div>
        </header>

        @yield('content')

        <div class="h-8"></div>
    </main>

    <div id="logoutModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-40 backdrop-blur-sm transition-opacity duration-300" aria-modal="true" role="dialog">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm p-8 transform transition-transform duration-300 scale-95" id="logoutModalContent">
            <h3 class="text-xl font-bold text-tsu-teal mb-4 text-center">Konfirmasi Keluar</h3>
            <p class="text-gray-600 mb-6 text-center">Apakah Anda yakin ingin keluar dari sesi magang Anda?</p>
            
            <div class="flex gap-4 justify-center">
                <button id="cancelLogout" class="flex-1 px-4 py-2 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition">
                    Kembali
                </button>
                <!-- 🔽 FORM LOGOUT (WAJIB POST) -->
                <form method="POST" action="{{ route('logout') }}" class="flex-1">
                    @csrf
                    <button type="submit"
                            class="w-full px-4 py-2 bg-tsu-red text-white font-semibold rounded-lg hover:bg-red-700 transition">
                        Keluar Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>

<script>
    const logoutModal = document.getElementById('logoutModal');
    const logoutLink = document.getElementById('logoutLink');
    const cancelLogoutButton = document.getElementById('cancelLogout');
    // const confirmLogoutButton = document.getElementById('confirmLogout');
    // const loginRoute = confirmLogoutButton.getAttribute('data-login-route');

    function showLogoutModal() {
        logoutModal.classList.remove('hidden');
        logoutModal.classList.add('flex');
    }

    function hideLogoutModal() {
        logoutModal.classList.add('hidden');
        logoutModal.classList.remove('flex');
    }

    if (logoutLink) {
        logoutLink.addEventListener('click', (e) => {
            e.preventDefault();
            showLogoutModal();
        });
    }

    cancelLogoutButton.addEventListener('click', hideLogoutModal);
    logoutModal.addEventListener('click', (e) => {
        if (e.target === logoutModal) {
            hideLogoutModal();
        }
    });

    // confirmLogoutButton.addEventListener('click', (e) => {
    //     e.preventDefault();
      
    //     window.location.replace(loginRoute); 
    // });
   
    const isDashboardPage = window.location.pathname.startsWith('{{ url('/dashboard') }}');
    
    if (isDashboardPage) {
        history.pushState(null, null, location.href); 
        
        window.addEventListener('popstate', (e) => {
            history.pushState(null, null, location.href);
            showLogoutModal();
        });
    }

</script>
</body>
</html>