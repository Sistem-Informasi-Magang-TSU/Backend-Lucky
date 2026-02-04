<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - TSU</title>
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
                        'tsu-light': '#f0f9fa',
                    },
                    fontFamily: { 'sans': ['Poppins', 'sans-serif'] },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.6s ease-out forwards',
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-15px)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .custom-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background: #e5e7eb;
            border-radius: 10px;
        }

        .custom-scroll::-webkit-scrollbar-thumb:hover {
            background: #086375;
        }

        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }

        [x-cloak] {
            display: none !important;
        }

        input {
            transition: all 0.3s ease;
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-[#4c9ca8] to-[#2c6e7a] font-sans min-h-screen flex items-center justify-center p-0 m-0 overflow-hidden">

    <div class="flex w-full h-screen bg-white shadow-2xl overflow-hidden">

        <div
            class="w-full lg:w-[55%] h-full flex flex-col px-8 sm:px-16 lg:px-24 py-10 overflow-y-auto custom-scroll bg-white rounded-r-[40px] lg:rounded-r-[80px] z-20 shadow-2xl">

            <div class="flex items-center gap-4 mb-10 animate-fade-in-up">
                <img src="/images/logo_tsu.svg" class="h-16 w-auto" alt="Logo TSU">
                <div class="h-10 w-[2px] bg-gray-200"></div>
                <span class="text-[11px] font-medium text-gray-500 uppercase tracking-wider leading-tight">
                    Sistem Informasi Magang<br>
                    <b class="text-gray-800 text-xs tracking-normal">Universitas Tiga Serangkai</b>
                </span>
            </div>

            <div class="animate-fade-in-up delay-100 opacity-0" style="animation-fill-mode: forwards;">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Buat Akun Baru</h2>
                <p class="text-gray-500 text-sm mb-8">Bergabunglah untuk mulai mengelola kegiatan magang Anda.</p>
            </div>

            @if ($errors->any())
                <div
                    class="mb-4 p-3 rounded bg-red-100 border border-red-400 text-red-700 text-sm animate-fade-in-up delay-100">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div x-data="{ role: '{{ old('role', 'mahasiswa') }}' }"
                class="w-full max-w-md animate-fade-in-up delay-200 opacity-0" style="animation-fill-mode: forwards;">
                <div class="inline-flex p-1.5 bg-gray-100 rounded-2xl mb-8 w-full">
                    <button @click="role = 'mahasiswa'"
                        :class="role === 'mahasiswa' ? 'bg-tsu-teal text-white shadow-md' : 'text-gray-500 hover:text-gray-700'"
                        class="flex-1 py-2.5 text-sm font-bold rounded-xl transition-all duration-300">
                        Mahasiswa
                    </button>
                    <button @click="role = 'dosen'"
                        :class="role === 'dosen' ? 'bg-tsu-teal text-white shadow-md' : 'text-gray-500 hover:text-gray-700'"
                        class="flex-1 py-2.5 text-sm font-bold rounded-xl transition-all duration-300">
                        Dosen Pembimbing
                    </button>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5 pb-10" x-data="{ 
                    password: '', 
                    confirm_password: '', 
                    showPass: false,
                    showConfirm: false,
                    prodi: '{{ old('prodi') }}',
                    dropdownOpen: false,
                    prodiLabel: ''
                }" x-init="
                    const prodiMap = {
                        'informatika': 'Informatika',
                        'sistem_informasi': 'Sistem Informasi',
                        'teknik_komputer': 'Teknik Komputer',
                        'rekayasa_perangkat_lunak': 'Rekayasa Perangkat Lunak'
                    };
                    prodiLabel = prodiMap[prodi] || '';
                ">
                    @csrf
                    <input type="hidden" name="role" :value="role">

                    <div class="space-y-1.5">
                        <label class="text-[11px] font-bold text-gray-500 uppercase tracking-widest ml-1">Nama
                            Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            :placeholder="role === 'mahasiswa' ? 'Contoh: Gibran Rakabuming' : 'Contoh: Prabowo Subianto'"
                            required
                            class="w-full bg-gray-50 border border-gray-200 px-4 py-3.5 rounded-2xl text-sm focus:bg-white focus:border-tsu-teal focus:ring-4 focus:ring-tsu-teal/10 outline-none">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="text-[11px] font-bold text-gray-500 uppercase tracking-widest ml-1"
                                x-text="role === 'mahasiswa' ? 'NIM' : 'NUPTK'"></label>

                            <input x-show="role === 'mahasiswa'" type="text" name="nim" value="{{ old('nim') }}"
                                placeholder="2243XXXX" :required="role === 'mahasiswa'"
                                class="w-full bg-gray-50 border border-gray-200 px-4 py-3.5 rounded-2xl text-sm focus:bg-white focus:border-tsu-teal focus:ring-4 focus:ring-tsu-teal/10 outline-none">

                            <input x-show="role === 'dosen'" type="text" name="nuptk" value="{{ old('nuptk') }}"
                                placeholder="0612XXXX" :required="role === 'dosen'"
                                class="w-full bg-gray-50 border border-gray-200 px-4 py-3.5 rounded-2xl text-sm focus:bg-white focus:border-tsu-teal focus:ring-4 focus:ring-tsu-teal/10 outline-none"
                                style="display: none;">
                        </div>

                        <div class="space-y-1.5 relative" x-show="role === 'mahasiswa'"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform -translate-y-2">
                            <label class="text-[11px] font-bold text-gray-500 uppercase tracking-widest ml-1">Program
                                Studi</label>
                            <input type="hidden" name="prodi" :value="prodi">
                            <button type="button" @click="dropdownOpen = !dropdownOpen"
                                class="w-full bg-gray-50 border border-gray-200 px-4 py-3.5 rounded-2xl text-sm flex justify-between items-center hover:border-tsu-teal transition-all">
                                <span x-text="prodiLabel || 'Pilih Prodi'"
                                    :class="prodi ? 'text-gray-800' : 'text-gray-400'"></span>
                                <svg class="h-5 w-5 text-gray-400 transition-transform"
                                    :class="dropdownOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-cloak
                                class="absolute z-50 w-full mt-2 bg-white border border-gray-200 rounded-2xl shadow-2xl overflow-hidden">
                                <ul class="py-2 text-sm text-gray-700 max-h-48 overflow-y-auto custom-scroll">
                                    <template x-for="item in [
                                        { val: 'informatika', label: 'Informatika' },
                                        { val: 'sistem_informasi', label: 'Sistem Informasi' },
                                        { val: 'teknik_komputer', label: 'Teknik Komputer' },
                                        { val: 'rekayasa_perangkat_lunak', label: 'Rekayasa Perangkat Lunak' }
                                    ]">
                                        <li @click="prodi = item.val; prodiLabel = item.label; dropdownOpen = false"
                                            class="px-4 py-3 hover:bg-tsu-light hover:text-tsu-teal cursor-pointer transition-colors"
                                            x-text="item.label"></li>
                                    </template>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="text-[11px] font-bold text-gray-500 uppercase tracking-widest ml-1">Email
                            Institusi</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="username@tsu.ac.id"
                            required
                            class="w-full bg-gray-50 border border-gray-200 px-4 py-3.5 rounded-2xl text-sm focus:bg-white focus:border-tsu-teal focus:ring-4 focus:ring-tsu-teal/10 outline-none">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label
                                class="text-[11px] font-bold text-gray-500 uppercase tracking-widest ml-1">Password</label>
                            <div class="relative">
                                <input :type="showPass ? 'text' : 'password'" name="password" x-model="password"
                                    placeholder="••••••••" required
                                    class="w-full bg-gray-50 border border-gray-200 px-4 py-3.5 rounded-2xl text-sm focus:bg-white focus:border-tsu-teal focus:ring-4 focus:ring-tsu-teal/10 outline-none">
                                <button type="button" @click="showPass = !showPass"
                                    class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-tsu-teal">
                                    <svg x-show="!showPass" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg x-show="showPass" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" x-cloak>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="space-y-1.5">
                            <label
                                class="text-[11px] font-bold text-gray-500 uppercase tracking-widest ml-1">Konfirmasi</label>
                            <div class="relative">
                                <input :type="showConfirm ? 'text' : 'password'" name="password_confirmation"
                                    x-model="confirm_password" placeholder="••••••••" required
                                    :class="confirm_password && password !== confirm_password ? 'border-red-400 ring-red-100' : ''"
                                    class="w-full bg-gray-50 border border-gray-200 px-4 py-3.5 rounded-2xl text-sm focus:bg-white focus:border-tsu-teal focus:ring-4 focus:ring-tsu-teal/10 outline-none">
                                <button type="button" @click="showConfirm = !showConfirm"
                                    class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-tsu-teal">
                                    <svg x-show="!showConfirm" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    <svg x-show="showConfirm" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" x-cloak>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div x-show="confirm_password && password !== confirm_password" x-cloak
                        class="flex items-center text-red-500 text-[10px] font-bold uppercase tracking-wider ml-1">
                        <svg class="h-3 w-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Password tidak cocok!
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-tsu-teal text-white font-bold py-4 rounded-2xl hover:bg-tsu-teal-dark shadow-xl shadow-tsu-teal/20 transition-all active:scale-[0.97] hover:-translate-y-1 duration-300">
                            Daftar Akun
                        </button>
                    </div>

                    <p class="text-center text-sm text-gray-500 mt-6">
                        Sudah punya akun? <a href="/login" class="text-tsu-teal font-bold hover:underline">Masuk</a>
                    </p>
                </form>
            </div>
        </div>

        <div
            class="hidden lg:flex w-[45%] bg-tsu-teal flex-col justify-center items-center relative p-12 overflow-hidden">
            <div
                class="absolute top-[-5%] right-[-5%] w-[350px] h-[350px] bg-tsu-teal-dark rounded-full blur-[90px] opacity-60">
            </div>
            <div
                class="absolute bottom-[-10%] left-[-10%] w-[300px] h-[300px] bg-[#4EA7B2] rounded-full blur-[80px] opacity-40">
            </div>

            <div class="relative z-10 text-center animate-fade-in-up">
                <div class="animate-float">
                    <img src="/images/ic_logreg.svg" class="w-full max-w-sm mx-auto mb-12 drop-shadow-2xl"
                        alt="Illustration">
                </div>
                <h2 class="text-white text-4xl font-extrabold mb-6 leading-tight">Gapai Karir<br>Impianmu Sekarang</h2>
                <p class="text-teal-50 text-base max-w-sm mx-auto leading-relaxed opacity-80">
                    Platform resmi Universitas Tiga Serangkai untuk manajemen magang mahasiswa yang lebih transparan dan
                    efisien.
                </p>
            </div>
        </div>

    </div>
</body>

</html>