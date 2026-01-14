@extends('layouts.app')

@section('title', 'Pengaturan Akun')
@section('header_title', 'Pengaturan')

@section('content')

@php
    $user = auth()->user();

    $isMahasiswa = $user->role === 'mahasiswa';
    $isDosen     = $user->role === 'dosen';
    $isAdmin     = $user->role === 'admin';

    // Route upload foto
    $photoRoute = '#'; // Default
    if ($isMahasiswa && $user->mahasiswa) {
        $photoRoute = route('mahasiswa.photomhs', $user->mahasiswa->nim);
    } elseif ($isDosen && $user->dosen) {
        $photoRoute = route('dosen.foto', $user->dosen->nuptk);
    }

    // Foto profil
    if ($isMahasiswa && $user->mahasiswa?->foto) {
        $foto = asset('storage/' . $user->mahasiswa->foto);
    } elseif ($isDosen && $user->dosen?->foto) {
        $foto = asset('storage/' . $user->dosen->foto);
    } else {
        $foto = 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=0d9488&color=fff&size=128';
    }
@endphp

<div class="max-w-6xl mx-auto pb-10">

    {{-- TAB HEADER --}}
    <div class="flex flex-wrap items-center gap-2 mb-8 bg-white p-2 rounded-3xl border border-gray-100 shadow-sm">
        <button onclick="switchTab('profile')" id="btn-profile"
            class="tab-btn active flex-1 flex items-center justify-center gap-3 px-6 py-4 rounded-2xl font-bold">
            Profil
        </button>

        <button onclick="switchTab('security')" id="btn-security"
            class="tab-btn flex-1 flex items-center justify-center gap-3 px-6 py-4 rounded-2xl font-bold text-gray-500 hover:bg-gray-50">
            Keamanan
        </button>

        @if(!$isAdmin)
        <button onclick="switchTab('extra')" id="btn-extra"
            class="tab-btn flex-1 flex items-center justify-center gap-3 px-6 py-4 rounded-2xl font-bold text-gray-500 hover:bg-gray-50 relative">
            {{ $isDosen ? 'WhatsApp' : 'Dokumen' }}
            @if($isMahasiswa)
                <span id="docPing" class="absolute top-3 right-1/4 w-2.5 h-2.5 bg-red-500 rounded-full animate-ping"></span>
            @endif
        </button>
        @endif
    </div>

    {{-- CONTENT --}}
    <div class="bg-white border border-gray-200 rounded-[2.5rem] p-8 md:p-12 shadow-sm min-h-[500px]">

        {{-- ================= PROFIL ================= --}}
        <div id="tab-profile" class="tab-content">
            <h3 class="text-2xl font-black mb-8">Informasi Profil</h3>

            @if($photoRoute)
            <form action="{{ $photoRoute }}" method="POST" enctype="multipart/form-data">
                @csrf
            @endif

                <div class="flex flex-col md:flex-row items-center gap-8 pb-8 border-b">
                    <div class="relative">
                        <div class="w-36 h-36 rounded-full overflow-hidden border-4">
                            <img id="previewFoto" src="{{ $foto }}" class="w-full h-full object-cover">
                        </div>
                        @if($photoRoute)
                        <label for="foto" class="absolute bottom-1 right-1 bg-tsu-blue text-white p-2 rounded-full cursor-pointer">
                            ✎
                        </label>
                        <input type="file" id="foto" name="foto" class="hidden" accept="image/*" onchange="previewImageProfile(this)">
                        @error('foto')
                            <p class="text-red-500 text-xs mt-1 bg-white p-1 rounded absolute -bottom-8 whitespace-nowrap shadow">{{ $message }}</p>
                        @enderror
                        @endif
                    </div>

                    <div>
                        <h4 class="font-bold">Foto Profil</h4>
                        <p class="text-sm text-gray-400">JPG / PNG maks 2MB</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
                    <div>
                        <label class="text-sm font-bold">Nama Lengkap</label>
                        <input type="text" value="{{ $user->name }}" disabled class="w-full px-5 py-4 rounded-2xl bg-gray-100">
                    </div>
                    <div>
                        <label class="text-sm font-bold">
                            {{ $isMahasiswa ? 'NIM' : ($isDosen ? 'NUPTK' : 'ROLE') }}
                        </label>
                        <input type="text"
                            value="{{ $isMahasiswa ? $user->mahasiswa?->nim : ($isDosen ? $user->dosen?->nuptk : 'ADMIN') }}"
                            disabled class="w-full px-5 py-4 rounded-2xl bg-gray-100">
                    </div>
                </div>

                @if($photoRoute)
                <button class="mt-8 bg-tsu-teal text-white px-12 py-4 rounded-2xl font-bold">
                    Simpan Profil
                </button>
            </form>
            @endif
        </div>

        {{-- ================= KEAMANAN ================= --}}
        <div id="tab-security" class="tab-content hidden">
            <h3 class="text-2xl font-black mb-8">Ubah Kata Sandi</h3>

            <form action="{{ route('password.update') }}" method="POST" class="max-w-md space-y-5">
                @csrf
                @method('PUT')

                <input type="password" name="current_password" placeholder="Kata sandi lama"
                    class="w-full px-5 py-4 rounded-2xl border">

                <input type="password" name="password" placeholder="Kata sandi baru"
                    class="w-full px-5 py-4 rounded-2xl border">

                <input type="password" name="password_confirmation" placeholder="Konfirmasi kata sandi"
                    class="w-full px-5 py-4 rounded-2xl border">

                <button class="bg-tsu-blue text-white px-10 py-4 rounded-2xl font-bold">
                    Perbarui Kata Sandi
                </button>
            </form>
        </div>

        {{-- ================= EXTRA ================= --}}
        @if(!$isAdmin)
        <div id="tab-extra" class="tab-content hidden">

            {{-- DOSEN --}}
            @if($isDosen)
                <h3 class="text-2xl font-black mb-4">Nomor WhatsApp</h3>
                <form action="{{ route('dosen.kontak.update', $user->dosen->nuptk) }}" method="POST">
                    @csrf
                    <input type="text" name="kontak" value="{{ $user->dosen->kontak }}" placeholder="08xxxxxxxxxx"
                        class="w-full max-w-md px-5 py-4 rounded-2xl border">
                    <button type="submit"
                        class="mt-4 bg-tsu-teal text-white px-10 py-4 rounded-2xl font-bold">
                        Simpan
                    </button>
                </form>

            {{-- MAHASISWA --}}
            @else
                <h3 class="text-2xl font-black mb-4">Dokumen Pendukung</h3>

                <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach(['cv_file'=>'CV','transkrip_file'=>'Transkrip','krs_file'=>'KRS'] as $field=>$label)
                        <div class="p-6 border-2 border-dashed rounded-2xl">
                            <h4 class="font-bold mb-2">{{ $label }}</h4>

                            @if($user->berkas?->$field)
                                <a href="{{ asset('storage/'.$user->berkas->$field) }}" target="_blank"
                                   class="text-sm text-blue-600 underline">Lihat File</a>
                            @else
                                <p class="text-sm text-red-500">Belum diupload</p>
                            @endif

                            <label class="block mt-4 bg-gray-100 py-3 rounded-xl text-center cursor-pointer">
                                Pilih PDF
                                <input type="file" name="{{ $field }}" class="hidden" accept=".pdf">
                            </label>
                        </div>
                        @endforeach
                    </div>

                    <button class="w-full mt-8 bg-tsu-teal text-white py-5 rounded-2xl font-black text-lg">
                        Simpan Semua Dokumen
                    </button>
                </form>
            @endif
        </div>
        @endif

    </div>
</div>

<style>
.tab-btn.active {
    background:#0d9488;
    color:white;
}
</style>

<script>
function switchTab(tab) {
    document.querySelectorAll('.tab-content').forEach(t => t.classList.add('hidden'));
    document.getElementById('tab-' + tab).classList.remove('hidden');

    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('btn-' + tab).classList.add('active');
}

function previewImageProfile(input) {
    if (input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => document.getElementById('previewFoto').src = e.target.result;
        reader.readAsDataURL(input.files[0]);
    }
}

function saveWA() {
    alert('Nomor WhatsApp berhasil disimpan');
}
</script>

@endsection
