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