<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - TSU</title>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tailwind Custom Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'tsu-teal': '#086375',
                        'tsu-teal-dark': '#064e5c',
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

<body class="bg-gradient-to-br from-[#4c9ca8] to-[#2c6e7a] font-sans min-h-screen flex items-center justify-center">

<div class="w-full h-screen flex">

    <!-- LEFT SIDE -->
    <div class="w-full lg:w-[55%] bg-white h-full rounded-r-[60px] flex flex-col justify-center px-10 shadow-2xl">

        <!-- LOGO -->
        <div class="flex items-center gap-3 mb-8">
            <img src="/images/logo_tsu.svg" class="h-16" alt="">
            <span class="text-xs">
                Sistem Informasi Magang<br>
                <b>UNIVERSITAS TIGA SERANGKAI</b>
            </span>
        </div>

        <!-- TAB -->
        <div class="flex w-full mb-6 border border-tsu-border rounded-full max-w-md">
            <button type="button" id="tab-mahasiswa"
                class="w-1/2 py-2 rounded-l-full bg-tsu-teal text-white font-semibold">
                Mahasiswa
            </button>

            <button type="button" id="tab-dosen"
                class="w-1/2 py-2 rounded-r-full bg-white text-black font-semibold">
                Dosen Pembimbing
            </button>
        </div>

        <!-- FORM -->
        <form method="POST" action="{{ route('register.store') }}" class="space-y-4 max-w-md">
            @csrf

            <!-- ROLE -->
            <input type="hidden" name="role" id="role-input" value="mahasiswa">

            <!-- NAMA -->
            <div>
                <label class="text-sm font-medium">Nama Lengkap</label>
                <input id="input-nama" type="text" name="name" required
                    placeholder="Masukkan Nama Lengkap Mahasiswa"
                    class="w-full border px-4 py-2 rounded focus:ring-1 focus:ring-tsu-teal">
            </div>

            <!-- NIM -->
            <div id="field-nim">
                <label class="text-sm font-medium">NIM</label>
                <input type="text" name="nim"
                    class="w-full border px-4 py-2 rounded focus:ring-1 focus:ring-tsu-teal">
            </div>

            <div id="field-prodi">
                <label class="text-sm font-medium">PRODI</label>
                <input type="text" name="nim"
                    class="w-full border px-4 py-2 rounded focus:ring-1 focus:ring-tsu-teal">
            </div>

            <!-- NUPTK -->
            <div id="field-nuptk" class="hidden">
                <label class="text-sm font-medium">NUPTK</label>
                <input type="text" name="nuptk"
                    class="w-full border px-4 py-2 rounded focus:ring-1 focus:ring-tsu-teal">
            </div>

            <!-- EMAIL -->
            <div>
                <label class="text-sm font-medium">Email</label>
                <input type="email" name="email" required
                    placeholder="email@tsu.ac.id"
                    class="w-full border px-4 py-2 rounded focus:ring-1 focus:ring-tsu-teal">
            </div>

            <!-- PASSWORD -->
            <div>
                <label class="text-sm font-medium">Password</label>
                <input type="password" name="password" required
                    class="w-full border px-4 py-2 rounded focus:ring-1 focus:ring-tsu-teal">
            </div>

            <!-- PASSWORD CONFIRM -->
            <div>
                <label class="text-sm font-medium">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required
                    class="w-full border px-4 py-2 rounded focus:ring-1 focus:ring-tsu-teal">
            </div>

            <!-- SUBMIT -->
            <button type="submit"
                class="w-full bg-tsu-teal text-white py-3 rounded hover:bg-tsu-teal-dark">
                Daftar
            </button>

            <div class="text-right">
                <a href="/login" class="text-tsu-blue-link text-sm">
                    Sudah punya akun?
                </a>
            </div>
        </form>
    </div>

    <!-- RIGHT SIDE -->
    <div class="hidden lg:flex w-[45%] items-center justify-center text-white text-3xl font-bold">
        Temukan Tempat<br>Magang Favoritmu
    </div>

</div>

<!-- JAVASCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    const tabMahasiswa = document.getElementById('tab-mahasiswa');
    const tabDosen = document.getElementById('tab-dosen');
    const fieldNim = document.getElementById('field-nim');
    const fieldNim = document.getElementById('field-prodi');
    const fieldNuptk = document.getElementById('field-nuptk');
    const inputNama = document.getElementById('input-nama');
    const roleInput = document.getElementById('role-input');

    function setActiveTab(role) {

        roleInput.value = role;

        if (role === 'mahasiswa') {
            tabMahasiswa.classList.add('bg-tsu-teal','text-white');
            tabMahasiswa.classList.remove('bg-white','text-black');

            tabDosen.classList.add('bg-white','text-black');
            tabDosen.classList.remove('bg-tsu-teal','text-white');

            fieldNim.classList.remove('hidden');
            fieldNuptk.classList.add('hidden');

            inputNama.placeholder = "Masukkan Nama Lengkap Mahasiswa";
        }

        if (role === 'dosen') {
            tabDosen.classList.add('bg-tsu-teal','text-white');
            tabDosen.classList.remove('bg-white','text-black');

            tabMahasiswa.classList.add('bg-white','text-black');
            tabMahasiswa.classList.remove('bg-tsu-teal','text-white');

            fieldNuptk.classList.remove('hidden');
            fieldNim.classList.add('hidden');

            inputNama.placeholder = "Masukkan Nama Lengkap Dosen Pembimbing";
        }
    }

    tabMahasiswa.addEventListener('click', () => setActiveTab('mahasiswa'));
    tabDosen.addEventListener('click', () => setActiveTab('dosen'));

    setActiveTab('mahasiswa');
});
</script>

</body>
</html>
