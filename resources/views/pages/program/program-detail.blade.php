@extends('layouts.detail')

@section('title', 'Detail Project Website Penjualan')

@section('content')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
           <h2 class="text-3xl font-bold text-black mb-2">
                {{ $program->nama_program }}
            </h2>

                <span class="inline-block bg-blue-100 text-blue-600 font-semibold px-4 py-1 rounded-full text-sm mb-3">
                    {{ $program->mitra->nama_mitra ?? '-' }}
                </span>

        <div class="flex items-center gap-4 mt-1">
                <span class="bg-tsu-green-light text-tsu-green-text px-4 py-0.5 rounded-full text-sm font-bold">
                    {{ $program->jenis_bkp }}
                </span>
        <div class="text-black font-bold text-sm">
                Periode: {{ $program->periode }}
        </div>
</div>

        </div>

        <button id="btnDaftar" onclick="prosesPendaftaran()" class="bg-tsu-teal hover:bg-tsu-teal-dark text-white font-bold py-3 px-8 rounded-full flex items-center gap-2 shadow-lg transition"
    {{ $isRegistered ? 'disabled' : '' }}
>
    <svg id="iconDaftar" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ $isRegistered ? '' : 'rotate-45' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        @if($isRegistered)
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        @else
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
        @endif
    </svg>
    <span id="textDaftar">
        {{ $isRegistered ? 'Sudah Mendaftar' : 'Daftar Sekarang' }}
    </span>
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
                    {{ $program->lokasi_penempatan ?? '-' }}
                </p>

            </div>
        </div>

        <div class="lg:col-span-2 border border-gray-300 bg-white rounded-2xl p-5 flex flex-col items-center justify-center shadow-sm text-center">
            <h3 class="font-bold text-black text-lg mb-1">Kuota Pendaftar Tersedia</h3>
                <span class="text-4xl font-extrabold text-red-600">
                    {{ $program->kuota }}
                </span> 
        </div>
    </div>

    <div class="flex border border-gray-300 bg-white rounded-2xl p-6 mb-6 shadow-sm">
        <div class="items-center gap-3 mb-4 mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
        </div>
        <div classname="flex">
            <h3 class="font-bold text-black text-lg">Deskripsi Program</h3>
            <p class="text-sm text-black leading-relaxed">
                        {{ $program->deskripsi_silabus ?? 'Belum ada deskripsi.' }}
                    </p>
        </div>
    </div>

    <div class="border border-gray-300 bg-white rounded-2xl p-6 mb-6 shadow-sm">
        <div class="flex items-center gap-3 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
            </svg>
            <h3 class="font-bold text-black text-lg">Kriteria Pendaftar</h3>
        </div>
        <p class="text-sm text-black leading-relaxed whitespace-pre-line">
            {{ $program->syarat ?? 'Belum ada syarat khusus.' }}
        </p>
    </div>

    <div class="border border-gray-300 bg-white rounded-2xl p-6 mb-8 shadow-sm">
        <div class="flex items-center gap-3 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
            <h3 class="font-bold text-black text-lg">Capaian Pembelajaran</h3>
        </div>
        <p class="text-sm text-black leading-relaxed whitespace-pre-line">
            {{ $program->dampak_program ?? 'Belum ada capaian pembelajaran.' }}
        </p>
    </div>

    <script>
let hasDocuments = @json($hasDocuments);
let isRegistered = @json($isRegistered);

function prosesPendaftaran() {
    if (isRegistered) {
        Swal.fire('Info', 'Anda sudah terdaftar.', 'info');
        return;
    }

    if (!hasDocuments) {
        Swal.fire({
            title: 'Dokumen Belum Lengkap',
            text: 'Silakan lengkapi dokumen terlebih dahulu.',
            icon: 'warning',
            confirmButtonText: 'Ke Pengaturan'
        }).then(() => {
            window.location.href = "{{ url('/setting') }}";
        });
        return;
    }

    Swal.fire({
        title: 'Konfirmasi',
        text: 'Yakin ingin mendaftar program ini?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, Daftar'
    }).then(result => {
        if (!result.isConfirmed) return;

        fetch("{{ route('pendaftaran.store') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                program_id: {{ $program->program_id }}
            })
        })
        .then(res => res.json())
        .then(res => {
            if (!res.success) {
                Swal.fire('Gagal', res.message, 'error');
                return;
            }
            suksesDaftarUI();
        })
        .catch(() => {
            Swal.fire('Error', 'Server error', 'error');
        });
    });
}

function suksesDaftarUI() {
    isRegistered = true;

    Swal.fire('Berhasil', 'Pendaftaran berhasil!', 'success');

    const btn = document.getElementById('btnDaftar');
    btn.disabled = true;
    btn.classList.remove('bg-tsu-teal');
    btn.classList.add('bg-gray-400', 'cursor-not-allowed');

    document.getElementById('textDaftar').innerText = 'Sudah Mendaftar';
}
</script>


    {{-- <script>
        let hasDocuments = @json($hasDocuments);
        let isRegistered = @json($isRegistered);

        function prosesPendaftaran() {
            if(isRegistered) {
                Swal.fire({
                    icon: 'info',
                    title: 'Anda Sudah Terdaftar',
                    text: 'Anda tidak dapat mendaftar ulang pada program ini.',
                    confirmButtonColor: '#086375'
                });
                return;
            }

            if (!hasDocuments) {
                Swal.fire({
                    title: 'Dokumen Belum Lengkap!',
                    text: 'Silakan upload dokumen di menu Setting terlebih dahulu.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#086375',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ke Pengaturan Sekarang'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ url('/setting') }}";
                    }
                });
            } else {
                Swal.fire({
                    title: 'Konfirmasi Pendaftaran',
                    text: "Setelah mendaftar, Anda tidak dapat membatalkan pendaftaran ini. Yakin ingin melanjutkan?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#086375',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: 'Ya, Daftar Sekarang',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch("{{ route('pendaftaran.store') }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                program_id: {{ $program->program_id }}
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                suksesDaftarUI();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: data.message || 'Gagal mendaftar'
                                });
                            }
                        })
                        .catch(err => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: err.message || 'Terjadi kesalahan'
                            });
                        });

                    }
                });
            }
        }

        function suksesDaftarUI() {
            isRegistered = true;
            
            Swal.fire({
                title: 'Berhasil Terdaftar!',
                text: 'Lamaran Anda telah terkirim ke tim Program, Anda akan dihubungi lebih lanjut jika lolos.',
                icon: 'success',
                confirmButtonColor: '#086375'
            });

            const btn = document.getElementById('btnDaftar');
            const icon = document.getElementById('iconDaftar');
            const text = document.getElementById('textDaftar');

            btn.classList.remove('bg-tsu-teal', 'hover:bg-tsu-teal-dark');
            btn.classList.add('bg-gray-400', 'cursor-not-allowed');
            btn.disabled = true;
            
            icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />`;
            icon.classList.remove('rotate-45');
            
            text.innerText = 'Sudah Mendaftar';
        }
    </script> --}}
@endsection