<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - TSU</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'tsu-teal': '#086375',       // Warna utama tombol & logo
                        'tsu-teal-dark': '#064e5c',
                    },
                    fontFamily: {
                        'sans': ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-[#4c9ca8] to-[#2c6e7a] font-sans min-h-screen flex items-center justify-center p-4">

    <div class="bg-white w-full max-w-[600px] rounded-[40px] shadow-2xl p-8 sm:p-12 flex flex-col items-center text-center">
        
        <div class="flex items-center gap-3 mb-8">
            <div class="w-25 h-30 flex-shrink-0">
                <img src="/images/logo_tsu.svg" alt="">
            </div>
            <div class="flex flex-col text-left">
                <span class="text-xs text-gray-800 leading-tight mt-1">Sistem Informasi Magang<br><span class="font-bold">UNIVERSITAS TIGA SERANGKAI</span></span>
            </div>
        </div>

        <h1 class="text-2xl font-bold text-black mb-4">Kode OTP</h1>
        
        <p class="text-black text-sm mb-8 leading-relaxed max-w-sm mx-auto">
            Kami telah mengirimkan kode verifikasi OTP ke alamat email Anda
        </p>

        <form action="{{ route('password.reset') }}" method="GET" class="w-full max-w-md text-left">
            
            <div class="mb-8">
                <label class="block text-black font-semibold text-sm mb-2 ml-1">Email</label>
                <input type="email" placeholder="Masukkan Email WAJIB Berdomain @tsu.ac.id" 
                    class="w-full border border-gray-400 px-4 py-3 rounded text-sm placeholder-gray-300 italic placeholder:font-light focus:outline-none focus:border-tsu-teal focus:ring-1 focus:ring-tsu-teal transition">
            </div>

            <button type="submit" class="w-full bg-tsu-teal text-white font-bold py-3 rounded-lg hover:bg-tsu-teal-dark transition shadow-md text-base">
                Kirimkan Kode
            </button>
            
        </form>
    </div>

</body>
</html>