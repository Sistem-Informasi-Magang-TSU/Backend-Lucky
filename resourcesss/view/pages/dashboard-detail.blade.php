<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Magang - TSU</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'tsu-teal': '#086375',       
                        'tsu-teal-dark': '#064e5c',
                        'tsu-blue-light': '#E0F2FE', // Untuk background pill perusahaan
                        'tsu-blue-text': '#0284c7',  // Untuk text perusahaan
                        'tsu-green-light': '#dcfce7', // Pill Aktif
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

    <header class="bg-tsu-teal text-white shadow-md">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            
            <div class="flex items-center gap-8">
                <div class="flex items-center gap-3">
                    <svg class="w-10 h-10" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 10 H25 V40" stroke="white" stroke-width="8" stroke-linecap="round"/>
                        <path d="M25 10 H40" stroke="white" stroke-width="8" stroke-linecap="round"/>
                        <path d="M30 20 C35 20 40 25 40 30" stroke="white" stroke-width="4" fill="none"/>
                    </svg>
                    <div class="flex flex-col leading-tight">
                        <span class="text-2xl font-bold tracking-wider">TSU</span>
                        <span class="text-[0.5rem] uppercase tracking-widest text-gray-200">Tiga Serangkai<br>University</span>
                    </div>
                </div>

                <h1 class="text-2xl font-bold tracking-wide">Detail Magang</h1>
            </div>

            <div class="flex items-center gap-4">
                <button class="relative p-2 bg-yellow-100 rounded-full hover:bg-yellow-200 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    <span class="absolute top-2 right-2.5 block h-2 w-2 rounded-full ring-2 ring-white bg-red-500"></span>
                </button>

                <div class="flex items-center gap-3">
                    <img src="https://i.pravatar.cc/150?img=11" alt="Thomas gtg" class="w-10 h-10 rounded-full object-cover border-2 border-white/50">
                    <div class="leading-none text-white">
                        <p class="font-bold text-sm flex items-center gap-1">Thomas gtg <span class="text-[10px]">▼</span></p>
                        <p class="text-xs text-gray-200 font-light">22430035</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-6 py-8 max-w-6xl">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-black mb-2">Project Website Penjualan</h2>
                
                <span class="inline-block bg-blue-100 text-blue-600 font-semibold px-4 py-1 rounded-full text-sm mb-3">
                    PT. Tiga Serangkai University
                </span>

                <div class="flex items-center gap-4 mt-1">
                    <span class="bg-green-100 text-green-600 px-4 py-0.5 rounded-full text-sm font-bold">Aktif</span>
                    <div class="flex items-center gap-1 text-black font-bold text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Durasi: 3 Bulan
                    </div>
                </div>
            </div>

            <button class="bg-tsu-teal hover:bg-tsu-teal-dark text-white font-bold py-3 px-8 rounded-full flex items-center gap-2 shadow-lg transition transform hover:-translate-y-0.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                </svg>
                Daftar Sekarang
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 mb-6">
            
            <div class="lg:col-span-3 border border-gray-300 bg-white rounded-2xl p-5 flex items-start gap-4 shadow-sm">
                <div class="mt-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-black text-lg">Lokasi Penempatan</h3>
                    <p class="text-sm text-gray-800 font-medium leading-relaxed mt-1">
                        Jl. K.H Samanhudi No.84-86, Purwosari,<br>
                        Kec. Laweyan, Kota Surakarta, Jawa Tengah 57149
                    </p>
                </div>
            </div>

            <div class="lg:col-span-2 border border-gray-300 bg-white rounded-2xl p-5 flex flex-col items-center justify-center shadow-sm text-center">
                <h3 class="font-bold text-black text-lg mb-1">Kuota Pendaftar Tersedia</h3>
                <span class="text-4xl font-extrabold text-red-600">69</span>
            </div>
        </div>

        <div class="border border-gray-300 bg-white rounded-2xl p-6 mb-6 shadow-sm">
            <div class="flex items-center gap-3 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <h3 class="font-bold text-black text-lg">Deskripsi Jobdesk</h3>
            </div>
            
            <div class="text-sm text-black space-y-2 leading-relaxed pl-1">
                <p class="mb-2">Magang Project Website Penjualan akan berperan dalam proses pembuatan dan pengembangan sistem penjualan berbasis website. Peserta magang akan terlibat dalam:</p>
                <ul class="list-disc ml-5 space-y-1 marker:text-black">
                    <li>Membuat tampilan antarmuka (UI) menggunakan design guideline yang telah disediakan.</li>
                    <li>Melakukan integrasi API antara frontend dan backend.</li>
                    <li>Mengembangkan fitur utama seperti manajemen produk, transaksi penjualan, laporan, dan user management.</li>
                    <li>Menguji fungsionalitas sistem dan memastikan alur kerja berjalan baik.</li>
                    <li>Mendokumentasikan proses pengembangan dan melakukan perbaikan berdasarkan feedback tim.</li>
                </ul>
            </div>
        </div>

        <div class="border border-gray-300 bg-white rounded-2xl p-6 mb-6 shadow-sm">
            <div class="flex items-center gap-3 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                </svg>
                <h3 class="font-bold text-black text-lg">Kriteria Pendaftar</h3>
            </div>
            
            <div class="text-sm text-black space-y-2 leading-relaxed pl-1">
                <ul class="list-disc ml-5 space-y-1 marker:text-black">
                    <li>Mahasiswa aktif S1/D3 jurusan Informatika, Sistem Informasi, Ilmu Komputer, atau bidang terkait.</li>
                    <li>Memiliki kemampuan dasar HTML, CSS, dan JavaScript.</li>
                    <li>Memahami salah satu framework: Laravel / NodeJS / React / Vue (nilai tambah).</li>
                    <li>Mampu bekerja secara mandiri maupun tim.</li>
                    <li>Teliti, komunikatif, dan memiliki minat tinggi dalam pengembangan web.</li>
                    <li>Bersedia mengikuti arahan mentor dan menyelesaikan tugas sesuai timeline.</li>
                </ul>
            </div>
        </div>

        <div class="border border-gray-300 bg-white rounded-2xl p-6 mb-8 shadow-sm">
            <div class="flex items-center gap-3 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                <h3 class="font-bold text-black text-lg">Capaian Pembelajaran</h3>
            </div>
            
            <div class="text-sm text-black space-y-2 leading-relaxed pl-1">
                <ul class="list-disc ml-5 space-y-1 marker:text-black">
                    <li>Setelah mengikuti program magang ini, mahasiswa mampu menerapkan konsep pengembangan web dalam pembuatan aplikasi penjualan, menguasai proses pembuatan fitur CRUD serta integrasi frontend-backend menggunakan REST API, memahami penerapan standar UI/UX pada halaman operasional, menggunakan Git sebagai alat kolaborasi dan manajemen versi, melakukan pengujian aplikasi untuk memastikan kualitas fungsionalitas, serta berkomunikasi efektif dalam tim pengembang untuk menyelesaikan project sesuai kebutuhan.</li>
                </ul>
            </div>
        </div>

    </main>
</body>
</html>