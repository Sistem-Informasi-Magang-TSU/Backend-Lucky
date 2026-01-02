@extends('layouts.app')

@section('title', 'Pengaturan Akun')

@section('header_title', 'Pengaturan')

@section('content')

<div class="max-w-6xl mx-auto pb-10">
    
    <div class="flex flex-wrap items-center gap-2 mb-8 bg-white p-2 rounded-3xl border border-gray-100 shadow-sm">
        <button onclick="switchTab('profile')" id="btn-profile" class="tab-btn active flex-1 flex items-center justify-center gap-3 px-6 py-4 rounded-2xl font-bold transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            Profil
        </button>
        <button onclick="switchTab('security')" id="btn-security" class="tab-btn flex-1 flex items-center justify-center gap-3 px-6 py-4 rounded-2xl font-bold transition-all text-gray-500 hover:bg-gray-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
            Keamanan
        </button>
        <button onclick="switchTab('documents')" id="btn-documents" class="tab-btn flex-1 flex items-center justify-center gap-3 px-6 py-4 rounded-2xl font-bold transition-all text-gray-500 hover:bg-gray-50 relative">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Dokumen
            <span id="docPing" class="absolute top-3 right-1/4 w-2.5 h-2.5 bg-red-500 rounded-full animate-ping"></span>
        </button>
    </div>

    <div class="bg-white border border-gray-200 rounded-[2.5rem] p-8 md:p-12 shadow-sm min-h-[500px]">
        
        <div id="tab-profile" class="tab-content">
            <h3 class="text-2xl font-black text-gray-800 mb-8">Informasi Profil</h3>
            <form action="#" class="space-y-8">
                <div class="flex flex-col md:flex-row items-center gap-8 pb-8 border-b border-gray-100">
                    <div class="relative">
                        <div class="w-36 h-36 rounded-full border-4 border-gray-50 overflow-hidden shadow-inner">
                            <img id="previewFoto" src="https://ui-avatars.com/api/?name=Thomas+gtg&background=0d9488&color=fff&size=128" class="w-full h-full object-cover">
                        </div>
                        <label for="foto" class="absolute bottom-1 right-1 bg-tsu-blue text-white p-2.5 rounded-full cursor-pointer hover:scale-110 transition shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </label>
                        <input type="file" id="foto" class="hidden" accept="image/*" onchange="previewImageProfile(this)">
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-700 text-lg">Foto Profil</h4>
                        <p class="text-sm text-gray-400 mt-1 max-w-xs">Gunakan foto formal dengan format JPG atau PNG (Maks. 2MB).</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-gray-600 ml-1">Nama Lengkap</label>
                        <input type="text" value="{{ auth()->user()->name }}" disabled class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50 text-gray-400 cursor-not-allowed">
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-gray-600 ml-1">NIM</label>
                        <input type="text" value={{auth()->user()->mahasiswa->nim}} disabled class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50 text-gray-400 cursor-not-allowed">
                    </div>
                </div>
                <button type="submit" class="bg-tsu-teal text-white px-12 py-4 rounded-2xl font-bold hover:bg-teal-700 transition shadow-lg shadow-teal-100">Simpan Profil</button>
            </form>
        </div>

        <div id="tab-security" class="tab-content hidden">
            <h3 class="text-2xl font-black text-gray-800 mb-8">Ubah Kata Sandi</h3>
            @if($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded-xl mb-4">
                    {{ $errors->first() }}
                </div>
            @endif
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-4">
                    {{ session('success') }}
                </div>
            @endif


            <form action="{{ route('password.update') }}" method="POST" class="w-full max-w-md text-left space-y-5">
                @csrf

                <div class="space-y-2 relative">
                    <label class="text-sm font-bold text-gray-600">Kata Sandi Lama</label>
                    <div class="relative">
                        <input type="password" id="pass_lama" name="current_password" class="w-full px-5 py-4 rounded-2xl border border-gray-200" placeholder="••••••••">
                        <button type="button" onclick="togglePass('pass_lama')" class="absolute right-4 top-4 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        </button>
                    </div>
                </div>

                <div class="space-y-2 relative">
                    <label class="text-sm font-bold text-gray-600">Kata Sandi Baru</label>
                    <div class="relative">
                        <input type="password" id="pass_baru" name="password" class="w-full px-5 py-4 rounded-2xl border border-gray-200" placeholder="Masukkan minimal 8 karakter">
                        <button type="button" onclick="togglePass('pass_baru')" class="absolute right-4 top-4 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        </button>
                    </div>
                </div>

                <div class="space-y-2 relative">
                    <label class="text-sm font-bold text-gray-600">Konfirmasi Kata Sandi Baru</label>
                    <div class="relative">
                        <input type="password" id="pass_konfirmasi" name="password_confirmation" class="w-full px-5 py-4 rounded-2xl border border-gray-200" placeholder="Masukkan ulang kata sandi baru">
                        <button type="button" onclick="togglePass('pass_konfirmasi')" class="absolute right-4 top-4 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        </button>
                    </div>
                </div>
                <button type="submit" class="bg-tsu-blue text-white px-10 py-4 rounded-2xl font-bold hover:bg-opacity-90 transition">Perbarui Kata Sandi</button>
            </form>
        </div>

        <div id="tab-documents" class="tab-content hidden">
            <h3 class="text-2xl font-black text-gray-800 mb-2">Dokumen Pendukung</h3>
            <p class="text-gray-500 mb-10 italic">Lengkapi dokumen di bawah ini agar tombol "Daftar Magang" dapat diakses.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="p-6 border-2 border-dashed border-gray-200 rounded-[2rem] hover:border-tsu-teal transition group flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-4 mb-6">
                            <div class="bg-red-50 text-red-500 p-4 rounded-2xl group-hover:bg-red-500 group-hover:text-white transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">File CV</h4>
                                <p id="cv-status" class="text-xs text-red-500 font-bold">Belum Ada File</p>
                            </div>
                        </div>
                        <div id="preview-container-cv" class="hidden mb-3">
                            <button type="button" onclick="previewPDF('cv_file')" class="text-xs text-tsu-teal underline font-bold">👁 Pratinjau CV</button>
                        </div>
                    </div>
                    <div>
                        <label for="cv_file" class="block w-full text-center bg-gray-100 text-gray-600 py-3 rounded-xl font-bold cursor-pointer hover:bg-gray-200">Pilih PDF</label>
                        <input type="file" id="cv_file" class="hidden" accept=".pdf" onchange="updateFileStatus('cv-status', this)">
                    </div>
                </div>

                <div class="p-6 border-2 border-dashed border-gray-200 rounded-[2rem] hover:border-tsu-teal transition group flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-4 mb-6">
                            <div class="bg-blue-50 text-blue-500 p-4 rounded-2xl group-hover:bg-blue-500 group-hover:text-white transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">Transkrip Nilai</h4>
                                <p id="transkrip-status" class="text-xs text-red-500 font-bold">Belum Ada File</p>
                            </div>
                        </div>
                        <div id="preview-container-transkrip" class="hidden mb-3">
                            <button type="button" onclick="previewPDF('transkrip_file')" class="text-xs text-tsu-teal underline font-bold">👁 Pratinjau Transkrip</button>
                        </div>
                    </div>
                    <div>
                        <label for="transkrip_file" class="block w-full text-center bg-gray-100 text-gray-600 py-3 rounded-xl font-bold cursor-pointer hover:bg-gray-200">Pilih PDF</label>
                        <input type="file" id="transkrip_file" class="hidden" accept=".pdf" onchange="updateFileStatus('transkrip-status', this)">
                    </div>
                </div>

                <div class="p-6 border-2 border-dashed border-gray-200 rounded-[2rem] hover:border-tsu-teal transition group flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-4 mb-6">
                            <div class="bg-orange-50 text-orange-500 p-4 rounded-2xl group-hover:bg-orange-500 group-hover:text-white transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" /></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">KRS Terbaru</h4>
                                <p id="krs-status" class="text-xs text-red-500 font-bold">Belum Ada File</p>
                            </div>
                        </div>
                        <div id="preview-container-krs" class="hidden mb-3">
                            <button type="button" onclick="previewPDF('krs_file')" class="text-xs text-tsu-teal underline font-bold">👁 Pratinjau KRS</button>
                        </div>
                    </div>
                    <div>
                        <label for="krs_file" class="block w-full text-center bg-gray-100 text-gray-600 py-3 rounded-xl font-bold cursor-pointer hover:bg-gray-200 transition">Pilih PDF</label>
                        <input type="file" id="krs_file" class="hidden" accept=".pdf" onchange="updateFileStatus('krs-status', this)">
                    </div>
                </div>
            </div>

            <button onclick="saveDocs()" class="w-full mt-10 bg-tsu-teal text-white py-5 rounded-2xl font-black text-lg hover:bg-teal-700 transition shadow-xl shadow-teal-100">
                Simpan Semua Dokumen
            </button>
        </div>

    </div>
</div>

<style>
    .tab-btn.active {
        background-color: #0d9488 !important;
        color: white !important;
        box-shadow: 0 10px 15px -3px rgba(13, 148, 136, 0.2);
    }
</style>

<script>
    function switchTab(tabName) {
        document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('hidden'));
        document.getElementById('tab-' + tabName).classList.remove('hidden');

        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.remove('active', 'text-white');
            btn.classList.add('text-gray-500', 'hover:bg-gray-50');
        });

        const activeBtn = document.getElementById('btn-' + tabName);
        activeBtn.classList.add('active');
        activeBtn.classList.remove('text-gray-500', 'hover:bg-gray-50');
    }

    function togglePass(id) {
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
    }

    function updateFileStatus(id, input) {
        if (input.files.length > 0) {
            const el = document.getElementById(id);
            const fileName = input.files[0].name;
            el.innerText = fileName.length > 15 ? fileName.substring(0, 15) + "..." : fileName;
            el.classList.remove('text-red-500');
            el.classList.add('text-tsu-teal');

            const prefix = id.split('-')[0];
            const containerId = 'preview-container-' + prefix;
            const container = document.getElementById(containerId);
            if(container) container.classList.remove('hidden');
        }
    }

    function previewPDF(inputId) {
        const fileInput = document.getElementById(inputId);
        if (fileInput && fileInput.files[0]) {
            const fileURL = URL.createObjectURL(fileInput.files[0]);
            window.open(fileURL, '_blank');
        } else {
            alert('Pilih file terlebih dahulu');
        }
    }

    function previewImageProfile(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = (e) => document.getElementById('previewFoto').src = e.target.result;
            reader.readAsDataURL(input.files[0]);
        }
    }

    function saveDocs() {
        const btn = event.target;
        btn.innerText = 'Menyimpan...';
        btn.disabled = true;

        setTimeout(() => {
            const pingIndicator = document.getElementById('docPing');
            if (pingIndicator) pingIndicator.classList.add('hidden');
            
            btn.innerText = 'Dokumen Tersimpan!';
            btn.classList.replace('bg-tsu-teal', 'bg-green-500');
            
            Swal.fire('Berhasil', 'Dokumen disimpan. Anda sekarang bisa mendaftar magang!', 'success');
        }, 1500);
    }
</script>
@endsection