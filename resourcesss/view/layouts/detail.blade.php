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
                        // Warna header khusus untuk halaman detail
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

    <header class="bg-tsu-header-detail text-white shadow-md">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center max-w-6xl">
            
            <div class="flex items-center gap-8">
                <a href="{{ url('/program') }}">
                    <img src="/images/logo_tsu_white.svg" class="h-8" alt="Logo TSU">
                </a>

                <h1 class="text-2xl font-bold tracking-wide">@yield('header_title', 'Detail Magang')</h1>
            </div>

            <div class="flex items-center gap-4">
                <button class="relative p-2 bg-yellow-100 rounded-full hover:bg-yellow-200 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="absolute top-2 right-2.5 block h-2 w-2 rounded-full ring-2 ring-white bg-red-500"></span>
                </button>

                <div class="flex items-center gap-3">
                    <img src="/images/foto_thomasgtg.png" alt="Thomas gtg" class="w-10 h-10 rounded-full object-cover border-2 border-white/50">
                    <div class="leading-none text-white">
                        <p class="font-bold text-sm flex items-center gap-1">Thomas gtg <span class="text-[10px]">▼</span></p>
                        <p class="text-xs text-gray-200 font-light">22430035</p>
                    </div>
                </div>
            </div>
            
        </div>
    </header>

    <main class="container mx-auto px-6 py-8 max-w-6xl">
        @yield('content')
    </main>

</body>
</html>