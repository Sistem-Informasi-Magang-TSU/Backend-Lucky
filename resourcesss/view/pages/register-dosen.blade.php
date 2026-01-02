<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Mahasiswa - TSU</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'tsu-teal': '#086375',       // Warna utama (Button & Active Tab)
                        'tsu-teal-dark': '#064e5c',
                        'tsu-bg-right': '#4EA7B2',   // Warna background kanan (estimasi)
                        'tsu-blue-link': '#2563eb',  // Warna link login
                    },
                    fontFamily: {
                        'sans': ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-[#4c9ca8] to-[#2c6e7a] font-sans min-h-screen flex items-center justify-center p-0 m-0 overflow-hidden">

    <div class="w-full h-screen flex flex-row">
        
        <div class="w-full lg:w-[55%] bg-white h-full rounded-r-[50px] lg:rounded-r-[60px] flex flex-col justify-center px-8 sm:px-12 md:px-20 lg:px-24 py-8 overflow-y-auto relative z-20 shadow-2xl">
            
            <div class="flex items-center gap-3 mb-8">
                <div class="w-25 h-20 flex-shrink-0">
                    <img src="/images/logo_tsu.svg" class="h-30 mb-4" alt="">
                </div>
                <div class="flex flex-col">
                    <span class="text-xs text-gray-800 leading-tight mt-1">Sistem Informasi Magang<br><span class="font-bold">UNIVERSITAS TIGA SERANGKAI</span></span>
                </div>
            </div>

            <div class="flex w-full mb-6 border border-black rounded-full p-[1px] max-w-md">
                <button class="w-1/2 py-2 rounded-l-full bg-white text-black font-semibold text-center text-sm sm:text-base">
                    Mahasiswa
                </button>
                <button class="w-1/2 py-2 rounded-r-full bg-tsu-teal text-white font-semibold text-center text-sm sm:text-base hover:bg-gray-50 transition">
                    Dosen Pembimbing
                </button>
            </div>

            <form action="#" method="POST" class="space-y-4 w-full max-w-md">
                
                <div>
                    <label class="block text-black font-medium text-sm mb-1">Nama Lengkap</label>
                    <input type="text" placeholder="Masukkan Nama Lengkap Mahasiswa" 
                        class="w-full border border-gray-400 px-4 py-2.5 rounded text-sm placeholder-gray-400 focus:outline-none focus:border-tsu-teal focus:ring-1 focus:ring-tsu-teal transition">
                </div>

                <div>
                    <label class="block text-black font-medium text-sm mb-1">NUPTK</label>
                    <input type="text" placeholder="Masukkan NUPTK" 
                        class="w-full border border-gray-400 px-4 py-2.5 rounded text-sm placeholder-gray-400 focus:outline-none focus:border-tsu-teal focus:ring-1 focus:ring-tsu-teal transition">
                </div>

                <div>
                    <label class="block text-black font-medium text-sm mb-1">Email</label>
                    <input type="email" placeholder="Masukkan Email WAJIB Berdomain @tsu.ac.id" 
                        class="w-full border border-gray-400 px-4 py-2.5 rounded text-sm placeholder-gray-400 italic placeholder:font-light focus:outline-none focus:border-tsu-teal focus:ring-1 focus:ring-tsu-teal transition">
                </div>

                <div>
                    <label class="block text-black font-medium text-sm mb-1">Password</label>
                    <input type="password" placeholder="Masukkan Password" 
                        class="w-full border border-gray-400 px-4 py-2.5 rounded text-sm placeholder-gray-400 italic placeholder:font-light focus:outline-none focus:border-tsu-teal focus:ring-1 focus:ring-tsu-teal transition">
                </div>

                <div>
                    <label class="block text-black font-medium text-sm mb-1">Konfirmasi Password</label>
                    <input type="password" placeholder="Masukkan Konfirmasi Password" 
                        class="w-full border border-gray-400 px-4 py-2.5 rounded text-sm placeholder-gray-400 italic placeholder:font-light focus:outline-none focus:border-tsu-teal focus:ring-1 focus:ring-tsu-teal transition">
                </div>

                <div class="text-right">
                    <a href="#" class="text-tsu-blue-link text-sm hover:underline font-medium">Sudah punya akun? Masuk</a>
                </div>

                <button type="submit" class="w-full bg-tsu-teal text-white font-bold py-3 rounded-lg hover:bg-tsu-teal-dark transition shadow-lg mt-2">
                    Daftar
                </button>
            </form>
        </div>

        <div class="hidden lg:flex w-[45%] flex-col justify-center items-center text-center p-8 relative">
            <h1 class="text-white text-3xl font-bold mb-8 z-10 drop-shadow-md">
                Temukan Tempat<br>Magang Favorite Kamu
            </h1>

            <div class="w-3/4 max-w-sm z-10">
                <img src="/images/ic_logreg.svg" class="h-30 mb-4" alt="">
            </div>
        </div>

    </div>
</body>
</html>