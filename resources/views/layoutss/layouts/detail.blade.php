<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Menggunakan @yield untuk Judul Browser --}}
    <title>@yield('title', 'Detail Program TSU')</title> 
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'tsu-teal': '#086375',       
                        'tsu-teal-dark': '#064e5c',
                        'tsu-header-detail': '#09697E', 
                        'tsu-blue-light': '#E0F2FE', 
                        'tsu-blue-text': '#0284c7',  
                        'tsu-green-light': '#dcfce7', 
                        'tsu-green-text': '#16a34a',
                    },
                    fontFamily: {
                        'sans': ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#F8F9FA] font-sans text-gray-800 min-h-screen">

    <header class="bg-tsu-header-detail text-white shadow-md relative z-50">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center max-w-6xl">
            
            <div class="flex items-center gap-8">
                <a href="{{ url('/program') }}" class="transition hover:opacity-80">
                    <img src="/images/logo_tsu_white.svg" class="h-12" alt="Logo TSU">
                </a>
                <div class="h-8 w-[1.5px] bg-white/30 hidden md:block"></div>
                <h1 class="text-xl font-bold tracking-wide hidden md:block">@yield('header_title', 'Detail Magang')</h1>
            </div>

            <div class="relative">
                <button onclick="toggleDropdown()" class="flex items-center gap-3 hover:bg-white/10 p-2 rounded-xl transition">
                    <img src="/images/foto_thomasgtg.png" alt="Profile" class="w-10 h-10 rounded-full object-cover border-2 border-white/50 shadow-sm">
                    <div class="text-left hidden sm:block leading-tight">
                        <p class="font-bold text-sm flex items-center gap-1">Thomas gtg <span class="text-[10px] opacity-70">▼</span></p>
                        <p class="text-[11px] text-gray-200 font-light">22430035</p>
                    </div>
                </button>

                <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 z-[100]">
                    <a href="{{ url('/setting') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Pengaturan
                    </a>
                    <hr class="my-1 border-gray-100">
                    <a href="{{ url('/login') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Keluar
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-6 py-8 max-w-6xl">
        @yield('content')
    </main>

    <script>
    function toggleDropdown() {
        document.getElementById('dropdownMenu').classList.toggle('hidden');
    }

    window.onclick = function(event) {
        if (!event.target.closest('button')) {
            const dropdown = document.getElementById('dropdownMenu');
            if (!dropdown.classList.contains('hidden')) {
                dropdown.classList.add('hidden');
            }
        }
    }
</script>

</body>
</html>