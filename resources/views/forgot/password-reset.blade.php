<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Kata Sandi - TSU</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'tsu-teal': '#086375',       
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

    <div class="bg-white w-full max-w-[600px] rounded-[40px] shadow-2xl p-8 sm:p-12 flex flex-col items-center">
        
        <div class="flex items-center gap-3 mb-10">
            <div class="w-25 h-25 flex-shrink-0">
                <img src="images/logo_tsu.svg" alt="">
            </div>
            <div class="flex flex-col text-left">
                <span class="text-xs text-gray-800 leading-tight mt-1">Sistem Informasi Magang<br><span class="font-bold">UNIVERSITAS TIGA SERANGKAI</span></span>
            </div>
        </div>

        <h1 class="text-2xl font-bold text-black mb-8">Ubah Kata Sandi</h1>

        <form method="POST" action="{{ route('password.store') }}" class="w-full max-w-md space-y-5">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div>
                <label class="block font-semibold">Kata Sandi Baru</label>
                <input type="password" name="password" required
                    class="w-full border px-4 py-3 rounded">
            </div>

            <div>
                <label class="block font-semibold">Konfirmasi Kata Sandi</label>
                <input type="password" name="password_confirmation" required
                    class="w-full border px-4 py-3 rounded">
            </div>

            <button type="submit"
                class="w-full bg-tsu-teal text-white font-bold py-3 rounded">
                Ubah Sekarang
            </button>
        </form>

    </div>

    <script>
    function handleReset(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Sandi Berhasil Diubah!',
            text: 'Silakan masuk kembali dengan kata sandi baru Anda.',
            icon: 'success',
            confirmButtonColor: '#086375',
            confirmButtonText: 'Ke Halaman Login'
        }).then((result) => {
            window.location.href = "{{ url('/login') }}";
        });
    }
    </script>
    
</body>
</html>