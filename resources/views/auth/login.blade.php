<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TSU</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.8s ease-out forwards',
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }

        input { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gradient-to-br from-[#4c9ca8] to-[#2c6e7a] font-sans min-h-screen flex items-center justify-center p-0 m-0 overflow-hidden">

    <div class="w-full h-screen flex flex-row">
        
        <div class="hidden lg:flex w-[45%] flex-col justify-center items-center text-center p-12 relative overflow-hidden">
            <div class="relative z-10 animate-fade-in-up">
                <h1 class="text-white text-4xl font-extrabold mb-6 drop-shadow-lg leading-tight">
                    Temukan Tempat<br>Magang Favorite Kamu
                </h1>
                <p class="text-teal-50 text-lg mb-10 opacity-90">Mulai langkah karirmu bersama <br> Universitas Tiga Serangkai</p>
                
                <div class="w-full flex justify-center animate-float">
                    <img src="/images/ic_logreg.svg" class="w-80 h-auto drop-shadow-2xl" alt="Ilustrasi Login">
                </div>
            </div>
            <div class="absolute top-20 left-20 w-32 h-32 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-20 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
        </div>

        <div class="w-full lg:w-[55%] bg-white h-full rounded-l-[40px] lg:rounded-l-[80px] flex flex-col justify-center px-8 sm:px-12 md:px-20 lg:px-24 py-8 overflow-y-auto shadow-2xl relative z-20 no-scrollbar">
            
            <div class="max-w-md w-full mx-auto">
                <div class="flex items-center gap-4 mb-10 animate-fade-in-up delay-100 opacity-0" style="animation-fill-mode: forwards;">
                    <img src="/images/logo_tsu.svg" class="h-16 w-auto" alt="TSU Logo">
                    <div class="h-12 w-[2px] bg-gray-200"></div>
                    <div class="flex flex-col">
                        <span class="text-[11px] text-gray-500 uppercase tracking-widest leading-none mb-1">SISTEM INFORMASI MAGANG</span>
                        <span class="text-sm font-bold text-gray-800 leading-tight">UNIVERSITAS TIGA SERANGKAI</span>
                    </div>
                </div>

                <div class="mb-10 animate-fade-in-up delay-200 opacity-0" style="animation-fill-mode: forwards;">
                    <h2 class="text-3xl font-bold text-gray-900 mb-3">Selamat Datang!</h2>
                    <p class="text-gray-500">Gunakan akun @tsu.ac.id untuk masuk ke sistem.</p>
                </div>

                <form x-data="{ show: false, password: '' }" action="{{ route('login') }}" method="POST" class="space-y-6 animate-fade-in-up delay-300 opacity-0" style="animation-fill-mode: forwards;">
                    @csrf
                    <div>
                        <label class="block text-gray-700 font-semibold text-sm mb-2">Alamat Email</label>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 group-focus-within:text-tsu-teal transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                                </svg>
                            </span>
                            <input type="email" id="email" name="email" placeholder="contoh: mhs@tsu.ac.id" required
                                class="w-full border border-gray-300 pl-12 pr-4 py-3.5 rounded-2xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-tsu-teal focus:ring-4 focus:ring-tsu-teal/10 bg-gray-50">
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold text-sm mb-2">Kata Sandi</label>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400 group-focus-within:text-tsu-teal transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </span>
                            <input :type="show ? 'text' : 'password'" id="password" name="password" x-model="password" placeholder="Masukkan password Anda" required
                                class="w-full border border-gray-300 pl-12 pr-12 py-3.5 rounded-2xl text-sm text-gray-800 placeholder-gray-400 focus:outline-none focus:border-tsu-teal focus:ring-4 focus:ring-tsu-teal/10 bg-gray-50">
                            
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 hover:text-tsu-teal transition-colors focus:outline-none">
                                <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg x-show="show" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" x-cloak>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                        <div class="mt-2 flex flex-wrap gap-x-4 gap-y-1">
                            <span class="text-[10px] flex items-center font-medium transition-colors duration-300" :class="/[A-Z]/.test(password) ? 'text-green-600' : 'text-gray-400'">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg> 1 Huruf Besar
                            </span>
                            <span class="text-[10px] flex items-center font-medium transition-colors duration-300" :class="/[0-9]/.test(password) ? 'text-green-600' : 'text-gray-400'">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg> 1 Angka
                            </span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-2">
                        <label class="flex items-center text-sm text-gray-600 cursor-pointer group">
                            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-tsu-teal focus:ring-tsu-teal mr-2 transition-transform group-active:scale-90">
                            Ingat saya
                        </label>
                        <a href="{{ route('password.request') }}" class="text-tsu-blue-link text-sm hover:underline font-semibold transition-all text-blue-700">Lupa Kata Sandi?</a>
                    </div>

                    <button type="submit" 
                        class="w-full bg-tsu-teal text-white font-bold py-4 rounded-2xl hover:bg-tsu-teal-dark hover:shadow-xl hover:-translate-y-1 active:scale-95 transition-all duration-300 mt-4 text-base shadow-lg shadow-tsu-teal/20">
                        Masuk Sekarang
                    </button>

                    <p class="text-center text-sm text-gray-500 mt-8 animate-fade-in-up delay-400 opacity-0" style="animation-fill-mode: forwards;">
                        Belum punya akun? <a href="{{ route('register') }}" class="text-tsu-teal font-bold hover:underline transition-all">Daftar Sekarang</a>
                    </p>
                </form>
            </div>

            <div class="absolute bottom-8 left-1/2 -translate-x-1/2 lg:left-24 lg:translate-x-0 opacity-40">
                <p class="text-xs text-gray-400 font-medium">© 2026 Universitas Tiga Serangkai. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>