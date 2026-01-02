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

        <form id="formReset" onsubmit="handleReset(event)" class="w-full max-w-md text-left space-y-5">
        @csrf  
            <div>
                <label class="block text-black font-semibold text-sm mb-2 ml-1">Kata Sandi Baru</label>
                <input type="password" placeholder="Masukkan Kata Sandi Baru" 
                    class="w-full border border-gray-400 px-4 py-3 rounded text-sm placeholder-gray-300 italic placeholder:font-light focus:outline-none focus:border-tsu-teal focus:ring-1 focus:ring-tsu-teal transition">
            </div>

            <div class="mb-8">
                <label class="block text-black font-semibold text-sm mb-2 ml-1">Konfirmasi Kata Sandi</label>
                <input type="password" placeholder="Masukkan Kembali Kata Sandi Baru" 
                    class="w-full border border-gray-400 px-4 py-3 rounded text-sm placeholder-gray-300 italic placeholder:font-light focus:outline-none focus:border-tsu-teal focus:ring-1 focus:ring-tsu-teal transition">
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-tsu-teal text-white font-bold py-3 rounded-lg hover:bg-tsu-teal-dark transition shadow-md text-base">
                    Ubah Sekarang
                </button>
            </div>
            
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