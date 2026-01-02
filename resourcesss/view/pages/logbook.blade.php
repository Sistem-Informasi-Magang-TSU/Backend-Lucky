<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logbook - TSU</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'tsu-teal': '#086375', 
                        'tsu-teal-dark': '#064e5c',
                        'tsu-active': '#115e6e', // Warna gelap untuk menu aktif di logbook
                    },
                    fontFamily: {
                        'sans': ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-white font-sans text-gray-800 flex min-h-screen">

    <aside class="w-64 bg-tsu-teal flex-shrink-0 flex flex-col fixed h-full z-10">
        <div class="p-8 flex items-center justify-center">
            <div class="flex items-center gap-3 text-white">
                <img src="/images/logo_tsu_white.svg" class="h-30 mb-4" alt="">
            </div>
        </div>

        <nav class="flex-1 px-4 space-y-4 mt-4">
            
            <a href="#" class="flex items-center gap-3 px-6 py-3 bg-white text-black rounded-full font-bold hover:bg-gray-100 transition shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Program
            </a>

            <a href="#" class="flex items-center gap-3 px-6 py-3 bg-tsu-teal-dark border border-teal-800 text-white rounded-full font-bold shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Logbook
            </a>

            <a href="#" class="flex items-center gap-3 px-6 py-3 bg-white text-black rounded-full font-bold hover:bg-gray-100 transition shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                Penilaian
            </a>

            <a href="#" class="flex items-center gap-3 px-6 py-3 bg-white text-black rounded-full font-bold hover:bg-gray-100 transition shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                </svg>
                Pembimbing
            </a>
        </nav>
    </aside>

    <main class="flex-1 ml-64 p-8 bg-white h-screen overflow-hidden">
        
        <header class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-extrabold text-black">Logbook</h1>
            
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
            <h2 class="text-xl font-bold mb-2">Jangan lupa untuk Mengisi Logbook!</h2>
            <p class="text-sm text-gray-200 font-light">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
        </div>

        <div class="w-full">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-tsu-teal text-white text-sm">
                        <th class="py-3 px-4 text-left font-semibold border-r border-teal-600 w-16 rounded-tl-lg">No</th>
                        <th class="py-3 px-4 text-left font-semibold border-r border-teal-600 w-32">Waktu</th>
                        <th class="py-3 px-4 text-left font-semibold border-r border-teal-600">Nama Kegiatan</th>
                        <th class="py-3 px-4 text-left font-semibold border-r border-teal-600">Uraian Kegiatan</th>
                        <th class="py-3 px-4 text-left font-semibold border-r border-teal-600">Jenis Logbook</th>
                        <th class="py-3 px-4 text-left font-semibold rounded-tr-lg">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border border-black/50">
                        <td class="h-16 border-r border-black/50"></td>
                        <td class="h-16 border-r border-black/50"></td>
                        <td class="h-16 border-r border-black/50"></td>
                        <td class="h-16 border-r border-black/50"></td>
                        <td class="h-16 border-r border-black/50"></td>
                        <td class="h-16"></td>
                    </tr>
                    </tbody>
            </table>
        </div>

    </main>
</body>
</html>