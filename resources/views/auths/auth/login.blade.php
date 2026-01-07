<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TSU</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'tsu-teal': '#086375',
                        'tsu-teal-dark': '#064e5c',
                        'tsu-blue-link': '#2563eb',
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
        
        <div class="hidden lg:flex w-[45%] flex-col justify-center items-center text-center p-8 relative">
            
            <h1 class="text-white text-3xl font-bold mb-8 z-10 drop-shadow-md leading-tight">
                Temukan Tempat<br>Magang Favorite Kamu
            </h1>

            <div class="w-3/4 max-w-sm z-10">
                <img src="/images/ic_logreg.svg" class="h-30 mb-4" alt="Ilustrasi Login">
            </div>
        </div>

        <div class="w-full lg:w-[55%] bg-white h-full rounded-l-[50px] lg:rounded-l-[60px] flex flex-col justify-center px-8 sm:px-12 md:px-20 lg:px-24 py-8 overflow-y-auto relative z-20 shadow-2xl">
            
            <div class="flex items-center gap-3 mb-6">
                <div class="w-25 h-20 flex-shrink-0">
                    <img src="/images/logo_tsu.svg" class="h-30 mb-4" alt="TSU Logo">
                </div>
                <div class="flex flex-col">
                    <span class="text-xs text-gray-800 leading-tight mt-1">Sistem Informasi Magang<br><span class="font-bold">UNIVERSITAS TIGA SERANGKAI</span></span>
                </div>
            </div>

            <h2 class="text-2xl font-bold text-black mb-2">Masuk dan Verifikasi</h2>
            <p class="text-sm text-gray-500 mb-8 leading-relaxed">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.
            </p>

            <form action="{{ route('login.process') }}" method="POST">
                    @csrf
                
                <div>
                    <label class="block text-black font-medium text-sm mb-2">Email</label>
                    <input type="email" name="email" placeholder="Masukkan Email WAJIB Berdomain @tsu.ac.id" 
                        class="w-full border border-gray-400 px-4 py-3 rounded text-sm placeholder-gray-400 italic placeholder:font-light focus:outline-none focus:border-tsu-teal focus:ring-1 focus:ring-tsu-teal transition">
                </div>

                <div>
                    <label class="block text-black font-medium text-sm mb-2">Password</label>
                    <input type="password" name="password" placeholder="Masukkan Password" 
                        class="w-full border border-gray-400 px-4 py-3 rounded text-sm placeholder-gray-400 italic placeholder:font-light focus:outline-none focus:border-tsu-teal focus:ring-1 focus:ring-tsu-teal transition">
                </div>

                <div class="text-right">
                    <a href="{{ route('password.request') }}" class="text-tsu-blue-link text-sm hover:underline font-medium decoration-tsu-blue-link">Lupa Kata Sandi?</a>
                </div>

                <button type="submit" class="w-full bg-tsu-teal text-white font-bold py-3 rounded-lg hover:bg-tsu-teal-dark transition shadow-lg mt-4 text-base">
                    Masuk
                </button>
            </form>
        </div>

    </div>
</body>
</html>