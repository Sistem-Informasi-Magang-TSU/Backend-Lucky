<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - TSU</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'tsu-teal': '#086375',
                        'tsu-teal-dark': '#064e5c',
                        'tsu-bg-right': '#4EA7B2',
                        'tsu-blue-link': '#2563eb',
                        'tsu-border': '#393939'
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

            <div class="flex w-full mb-6 border border-tsu-border rounded-full p-[1px] max-w-md">
                <button type="button" id="tab-mahasiswa" 
                    class="tab-btn w-1/2 py-2 rounded-l-full bg-tsu-teal text-white font-semibold text-center text-sm sm:text-base transition">
                    Mahasiswa
                </button>
                <button type="button" id="tab-dosen" 
                    class="tab-btn w-1/2 py-2 rounded-r-full bg-white text-black font-semibold text-center text-sm sm:text-base hover:bg-gray-50 transition">
                    Dosen Pembimbing
                </button>
            </div>

            @if ($errors->any())
    <div class="mb-4 p-3 rounded bg-red-100 border border-red-400 text-red-700 text-sm">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


            <form method="POST" action="{{ route('register.store') }}" class="space-y-4 max-w-md">
            @csrf

            <input type="hidden" name="role" id="role-input" value="mahasiswa">
                
                <div>
                    <label class="block text-black font-medium text-sm mb-1">Nama Lengkap</label>
                    <input type="text" name="name" id="input-nama" placeholder="Masukkan Nama Lengkap" 
                        class="w-full border border-gray-400 px-4 py-2.5 rounded text-sm placeholder-gray-400 focus:outline-none focus:border-tsu-teal focus:ring-1 focus:ring-tsu-teal transition">
                </div>

                 <div id="field-prodi" class="mt-4">
                <label for="prodi" class="block text-sm font-medium text-gray-700">
                    Program Studi
                </label>

                <select name="prodi" id="prodi" required class="w-full border border-gray-400 px-4 py-2.5 rounded text-sm placeholder-gray-400 focus:outline-none focus:border-tsu-teal focus:ring-1 focus:ring-tsu-teal transition"
                >
                    <option value="">-- Pilih Program Studi --</option>
                    <option value="informatika">Informatika</option>
                    <option value="sistem_informasi">Sistem Informasi</option>
                    <option value="teknik_komputer">Teknik Komputer</option>
                    <option value="rekayasa_perangkat_lunak">Rekayasa Perangkat Lunak</option>
                </select>
            </div>


                <div id="field-nim">
                    <label class="block text-black font-medium text-sm mb-1">NIM</label>
                    <input type="text" name="nim" placeholder="Masukkan NIM" 
                        class="w-full border border-gray-400 px-4 py-2.5 rounded text-sm placeholder-gray-400 focus:outline-none focus:border-tsu-teal focus:ring-1 focus:ring-tsu-teal transition">
                </div>

                <div id="field-nuptk" class="hidden">
                    <label class="block text-black font-medium text-sm mb-1">NUPTK</label>
                    <input type="text" name="nuptk" placeholder="Masukkan NUPTK" 
                        class="w-full border border-gray-400 px-4 py-2.5 rounded text-sm placeholder-gray-400 focus:outline-none focus:border-tsu-teal focus:ring-1 focus:ring-tsu-teal transition">
                </div>

                <div>
                    <label class="block text-black font-medium text-sm mb-1">Email</label>
                    <input type="email" name="email" placeholder="Masukkan Email WAJIB Berdomain @tsu.ac.id" 
                        class="w-full border border-gray-400 px-4 py-2.5 rounded text-sm placeholder-gray-400 italic placeholder:font-light focus:outline-none focus:border-tsu-teal focus:ring-1 focus:ring-tsu-teal transition">
                </div>

                <div>
                    <label class="block text-black font-medium text-sm mb-1">Password</label>
                    <input type="password" name="password" placeholder="Masukkan Password" 
                        class="w-full border border-gray-400 px-4 py-2.5 rounded text-sm placeholder-gray-400 italic placeholder:font-light focus:outline-none focus:border-tsu-teal focus:ring-1 focus:ring-tsu-teal transition">
                </div>

                <div id="password-rules" class="mt-2 space-y-1 text-xs">
                    <p id="rule-length" class="text-gray-400">• Minimal 10 karakter</p>
                    <p id="rule-upper" class="text-gray-400">• Mengandung huruf besar</p>
                    <p id="rule-lower" class="text-gray-400">• Mengandung huruf kecil</p>
                    <p id="rule-number" class="text-gray-400">• Mengandung angka</p>
                    <p id="rule-symbol" class="text-gray-400">• Mengandung simbol (!@#$)</p>
                </div>


                <div>
                    <label class="block text-black font-medium text-sm mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" placeholder="Masukkan Konfirmasi Password" 
                        class="w-full border border-gray-400 px-4 py-2.5 rounded text-sm placeholder-gray-400 italic placeholder:font-light focus:outline-none focus:border-tsu-teal focus:ring-1 focus:ring-tsu-teal transition">
                </div>

                <div class="text-right">
                    <a href="/login" class="text-tsu-blue-link text-sm hover:underline font-medium">Sudah punya akun? Masuk</a>
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
                <img src="/images/ic_logreg.svg" class="h-30 mb-4" alt="Ilustrasi">
            </div>
        </div>

    </div>

    <script>
document.addEventListener('DOMContentLoaded', function () {

    const tabMahasiswa = document.getElementById('tab-mahasiswa');
    const tabDosen = document.getElementById('tab-dosen');
    const fieldNim = document.getElementById('field-nim');
    const fieldProdi = document.getElementById('field-prodi');
    const fieldNuptk = document.getElementById('field-nuptk');
    const inputNama = document.getElementById('input-nama');
    const roleInput = document.getElementById('role-input');
    const inputNim   = document.querySelector('input[name="nim"]');
    const inputProdi = document.querySelector('select[name="prodi"]');
    const inputNuptk = document.querySelector('input[name="nuptk"]');

    const passwordInput = document.querySelector('input[name="password"]');
    const rules = {
        length: document.getElementById('rule-length'),
        upper: document.getElementById('rule-upper'),
        lower: document.getElementById('rule-lower'),
        number: document.getElementById('rule-number'),
        symbol: document.getElementById('rule-symbol'),
    };

    function setActiveTab(role) {

    roleInput.value = role;

    if (role === 'mahasiswa') {
        tabMahasiswa.classList.add('bg-tsu-teal','text-white');
        tabMahasiswa.classList.remove('bg-white','text-black','hover:bg-gray-50');

        tabDosen.classList.add('bg-white','text-black','hover:bg-gray-50');
        tabDosen.classList.remove('bg-tsu-teal','text-white');

        fieldNim.classList.remove('hidden');
        fieldNuptk.classList.add('hidden');
        fieldProdi.classList.remove('hidden');

        inputNim.required = true;     
        inputProdi.required = true;   

        inputNuptk.required = false;

        // Agar tidak ada bug inputan 
        inputNuptk.value = '';
    }

    if (role === 'dosen') {
        tabDosen.classList.add('bg-tsu-teal','text-white');
        tabDosen.classList.remove('bg-white','text-black','hover:bg-gray-50');

        tabMahasiswa.classList.add('bg-white','text-black','hover:bg-gray-50');
        tabMahasiswa.classList.remove('bg-tsu-teal','text-white');

        fieldNuptk.classList.remove('hidden');
        fieldNim.classList.add('hidden');
        fieldProdi.classList.add('hidden');

        inputNuptk.required = true;   

        // Mematikan Required Mahasiswa saat melakukan input dosen 
        inputNim.required = false;    
        inputProdi.required = false;

        // Jika ada inputan di dosen bisa kosong dan tidak terjadi bug
        inputNim.value = '';
        inputProdi.value = '';
    }
}

    function toggleRule(element, isValid) {
        if (isValid) {
            element.classList.remove('text-gray-400');
            element.classList.add('text-green-600');
        } else {
            element.classList.remove('text-green-600');
            element.classList.add('text-gray-400');
        }
    }

    tabMahasiswa.addEventListener('click', () => setActiveTab('mahasiswa'));
    tabDosen.addEventListener('click', () => setActiveTab('dosen'));
    passwordInput.addEventListener('input', function () {
    const value = passwordInput.value;

    toggleRule(rules.length, value.length >= 10);
    toggleRule(rules.upper, /[A-Z]/.test(value));
    toggleRule(rules.lower, /[a-z]/.test(value));
    toggleRule(rules.number, /\d/.test(value));
    toggleRule(rules.symbol, /[^A-Za-z0-9]/.test(value));
});
    setActiveTab('mahasiswa');
});
</script>
</body>
</html>