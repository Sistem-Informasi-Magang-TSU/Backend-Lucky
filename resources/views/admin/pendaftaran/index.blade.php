@extends('layouts.app')

@section('title', 'ACC Pendaftaran Mahasiswa')
@section('header_title', 'Verifikasi Pendaftaran')

@section('content')
@php
    $menunggu = $pendaftarans->where('status', 'menunggu');
    $diterima = $pendaftarans->where('status', 'diterima');
    $ditolak = $pendaftarans->where('status', 'ditolak');
@endphp

<div class="space-y-6">
    <div class="flex flex-wrap gap-4 fade-up">
        <button id="tab-menunggu-btn" onclick="switchTab('menunggu')" class="px-6 py-2 bg-tsu-teal text-white rounded-full text-xs font-bold shadow-lg shadow-tsu-teal/20 transition-all flex items-center gap-2">
            <span>Validasi Pendaftar</span>
            <span class="bg-white/20 px-2 py-0.5 rounded-full text-[10px]">{{ $menunggu->count() }}</span>
        </button>
        <button id="tab-diterima-btn" onclick="switchTab('diterima')" class="px-6 py-2 bg-white text-gray-500 rounded-full text-xs font-bold hover:bg-gray-50 transition border border-gray-100 transition-all flex items-center gap-2">
            <span>Pendaftar Lolos</span>
            <span class="bg-gray-100 px-2 py-0.5 rounded-full text-[10px]">{{ $diterima->count() }}</span>
        </button>
        <button id="tab-ditolak-btn" onclick="switchTab('ditolak')" class="px-6 py-2 bg-white text-gray-500 rounded-full text-xs font-bold hover:bg-gray-50 transition border border-gray-100 transition-all flex items-center gap-2">
            <span>Pendaftar Ditolak</span>
            <span class="bg-gray-100 px-2 py-0.5 rounded-full text-[10px]">{{ $ditolak->count() }}</span>
        </button>
    </div>

    {{-- SECTION: MENUNGGU --}}
    <div id="section-menunggu" class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden fade-up delay-100 tab-section">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-5 text-xs font-bold text-gray-400 uppercase">Mahasiswa</th>
                        <th class="px-6 py-5 text-xs font-bold text-gray-400 uppercase">Program Pilihan</th>
                        <th class="px-6 py-5 text-xs font-bold text-gray-400 uppercase">Berkas</th>
                        <th class="px-6 py-5 text-xs font-bold text-gray-400 uppercase text-center">Aksi Validasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($menunggu as $p)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center font-bold text-blue-600">
                                    {{ substr($p->mahasiswa->user->name ?? '?', 0, 2) }}
                                </div>
                                <div>
                                    <p class="font-bold text-sm text-gray-800">{{ $p->mahasiswa->user->name ?? 'Nama Tidak Ditemukan' }}</p>
                                    <p class="text-[10px] text-gray-400">{{ $p->nim }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <button onclick="viewProgramDetail('{{ $p->programMagang->nama_program ?? '-' }}', '{{ $p->programMagang->mitra->nama_mitra ?? '-' }}', '{{ $p->programMagang->jenis_bkp ?? '-' }}')" 
                                    class="text-xs font-bold text-tsu-teal bg-teal-50 px-3 py-1 rounded-lg hover:bg-teal-100 transition flex items-center gap-2">
                                <span>{{ Str::limit($p->programMagang->nama_program ?? '-', 20) }}</span>
                                <span class="text-[10px]">ℹ️</span>
                            </button>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                @if($p->cv)
                                <button onclick="previewDoc('CV - {{ $p->nim }}', 'CV')" class="p-2 bg-purple-50 text-purple-600 rounded-xl text-[10px] font-bold hover:bg-purple-100 transition">📄 CV</button>
                                @endif
                                @if($p->transkrip_nilai)
                                <button onclick="previewDoc('Transkrip - {{ $p->nim }}', 'Transkrip')" class="p-2 bg-green-50 text-green-600 rounded-xl text-[10px] font-bold hover:bg-green-100 transition">📄 TRNSK</button>
                                @endif
                                @if(!$p->cv && !$p->transkrip_nilai)
                                <span class="text-xs text-gray-300 italic">Tidak ada berkas</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center gap-2">
                                <button onclick="handleAcc('{{ $p->mahasiswa->user->name ?? 'Mahasiswa' }}', '{{ $p->id_daftar }}')" class="px-4 py-2 bg-tsu-teal text-white rounded-xl text-xs font-bold hover:bg-tsu-teal-dark shadow-md hover:shadow-lg transition">TERIMA</button>
                                <button onclick="handleReject('{{ $p->mahasiswa->user->name ?? 'Mahasiswa' }}', '{{ $p->id_daftar }}')" class="px-4 py-2 bg-red-50 text-red-500 rounded-xl text-xs font-bold hover:bg-red-100 transition">TOLAK</button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                            <span class="text-4xl block mb-2">✅</span>
                            <span class="text-sm font-bold">Semua pendaftaran telah divalidasi</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- SECTION: DITERIMA --}}
    <div id="section-diterima" class="hidden bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden fade-up delay-100 tab-section">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-5 text-xs font-bold text-gray-400 uppercase">Mahasiswa</th>
                        <th class="px-6 py-5 text-xs font-bold text-gray-400 uppercase">Program Magang</th>
                        <th class="px-6 py-5 text-xs font-bold text-gray-400 uppercase text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($diterima as $p)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center font-bold text-green-600">
                                    {{ substr($p->mahasiswa->user->name ?? '?', 0, 2) }}
                                </div>
                                <div>
                                    <p class="font-bold text-sm text-gray-800">{{ $p->mahasiswa->user->name ?? 'Nama Tidak Ditemukan' }}</p>
                                    <p class="text-[10px] text-gray-400">{{ $p->nim }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-gray-800">{{ $p->programMagang->nama_program ?? '-' }}</span>
                                <span class="text-[10px] text-tsu-teal">{{ $p->programMagang->mitra->nama_mitra ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-block px-4 py-1.5 bg-green-50 text-green-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-green-100">
                                ✅ LOLOS SELEKSI
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center text-gray-400">
                            <span class="text-4xl block mb-2">📂</span>
                            <span class="text-sm font-bold">Belum ada mahasiswa yang lolos</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- SECTION: DITOLAK --}}
    <div id="section-ditolak" class="hidden bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden fade-up delay-100 tab-section">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-5 text-xs font-bold text-gray-400 uppercase">Mahasiswa</th>
                        <th class="px-6 py-5 text-xs font-bold text-gray-400 uppercase">Program Magang</th>
                        <th class="px-6 py-5 text-xs font-bold text-gray-400 uppercase text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($ditolak as $p)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center font-bold text-red-600">
                                    {{ substr($p->mahasiswa->user->name ?? '?', 0, 2) }}
                                </div>
                                <div>
                                    <p class="font-bold text-sm text-gray-800">{{ $p->mahasiswa->user->name ?? 'Nama Tidak Ditemukan' }}</p>
                                    <p class="text-[10px] text-gray-400">{{ $p->nim }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-gray-800">{{ $p->programMagang->nama_program ?? '-' }}</span>
                                <span class="text-[10px] text-gray-500">{{ $p->programMagang->mitra->nama_mitra ?? '-' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="inline-block px-4 py-1.5 bg-red-50 text-red-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-red-100">
                                ❌ DITOLAK
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center text-gray-400">
                            <span class="text-4xl block mb-2">🙂</span>
                            <span class="text-sm font-bold">Tidak ada pendaftar yang ditolak</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODALS --}}
{{-- Modal Preview --}}
<div id="modalPreview" class="fixed inset-0 z-[70] hidden items-center justify-center bg-black/60 backdrop-blur-md p-4">
    <div class="bg-white w-full max-w-4xl h-[85vh] rounded-[2.5rem] shadow-2xl overflow-hidden flex flex-col">
        <div class="p-6 bg-white border-b flex justify-between items-center">
            <h3 class="font-bold text-gray-800" id="previewTitle">Preview Dokumen</h3>
            <button onclick="closePreview()" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center hover:bg-gray-200 transition">✕</button>
        </div>
        <div class="flex-1 bg-gray-100 flex flex-col items-center justify-center text-gray-400">
            <span class="text-5xl mb-2">📄</span>
            <p class="font-bold" id="docTypeDisplay">Memuat File...</p>
        </div>
        <div class="p-6 bg-gray-50 border-t flex justify-end">
            <button onclick="closePreview()" class="px-8 py-3 bg-gray-800 text-white font-bold rounded-2xl">Tutup Preview</button>
        </div>
    </div>
</div>

<script>
    function switchTab(status) {
        // Hide all sections
        document.querySelectorAll('.tab-section').forEach(el => el.classList.add('hidden'));
        
        // Show target section
        const target = document.getElementById('section-' + status);
        if(target) {
            target.classList.remove('hidden');
            // Re-trigger animation
            target.classList.remove('fade-up');
            void target.offsetWidth; // trigger reflow
            target.classList.add('fade-up');
        }

        // Update buttons state
        // Reset all
        document.getElementById('tab-menunggu-btn').className = "px-6 py-2 bg-white text-gray-500 rounded-full text-xs font-bold hover:bg-gray-50 border border-gray-100 transition-all flex items-center gap-2";
        document.getElementById('tab-diterima-btn').className = "px-6 py-2 bg-white text-gray-500 rounded-full text-xs font-bold hover:bg-gray-50 border border-gray-100 transition-all flex items-center gap-2";
        document.getElementById('tab-ditolak-btn').className = "px-6 py-2 bg-white text-gray-500 rounded-full text-xs font-bold hover:bg-gray-50 border border-gray-100 transition-all flex items-center gap-2";

        // Set active
        if(status === 'menunggu') {
            document.getElementById('tab-menunggu-btn').className = "px-6 py-2 bg-tsu-teal text-white rounded-full text-xs font-bold shadow-lg shadow-tsu-teal/20 transition-all flex items-center gap-2";
        } else if(status === 'diterima') {
            document.getElementById('tab-diterima-btn').className = "px-6 py-2 bg-tsu-teal text-white rounded-full text-xs font-bold shadow-lg shadow-tsu-teal/20 transition-all flex items-center gap-2";
        } else if(status === 'ditolak') {
            document.getElementById('tab-ditolak-btn').className = "px-6 py-2 bg-red-500 text-white rounded-full text-xs font-bold shadow-lg shadow-red-500/20 transition-all flex items-center gap-2";
        }
    }

    function viewProgramDetail(name, company, role) {
        Swal.fire({
            title: '<span class="text-lg font-bold">Detail Program Magang</span>',
            html: `
                <div class="text-left space-y-4 p-2">
                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Nama Program</p>
                        <p class="text-sm font-bold text-gray-800">${name}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Perusahaan</p>
                        <p class="text-sm font-bold text-tsu-teal">${company}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Jenis BKP</p>
                        <p class="text-sm font-bold text-gray-800">${role}</p>
                    </div>
                </div>
            `,
            confirmButtonColor: '#086375',
            confirmButtonText: 'Tutup'
        });
    }

    function handleAcc(name, id) {
        Swal.fire({
            title: 'ACC Mahasiswa?',
            text: `Apakah anda yakin meloloskan ${name}?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#086375',
            confirmButtonText: 'Ya, Loloskan!',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return fetch("{{ url('/admin/pendaftaran') }}/" + id, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        _method: 'PUT',
                        status: 'diterima'
                    })
                })
                .then(response => {
                    if (!response.ok) throw new Error(response.statusText)
                    return response.json()
                })
                .catch(error => Swal.showValidationMessage(`Request failed: ${error}`))
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Berhasil!', 
                    text: `${name} telah lolos.`, 
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => location.reload()); // Reload to move item to Accepted tab
            }
        })
    }

    function handleReject(name, id) {
        Swal.fire({
            title: 'Tolak Pendaftaran?',
            text: `Berikan alasan penolakan untuk ${name}`,
            input: 'textarea',
            inputPlaceholder: 'Tulis alasan penolakan...',
            showCancelButton: true,
            confirmButtonColor: '#EF4444',
            confirmButtonText: 'Tolak',
            showLoaderOnConfirm: true,
            preConfirm: (reason) => {
                return fetch("{{ url('/admin/pendaftaran') }}/" + id, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        _method: 'PUT',
                        status: 'ditolak',
                        alasan: reason
                    })
                })
                .then(response => {
                     if (!response.ok) throw new Error(response.statusText)
                    return response.json()
                })
                .catch(error => Swal.showValidationMessage(`Request failed: ${error}`))
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Ditolak', 
                    text: 'Mahasiswa dipindahkan ke daftar ditolak.', 
                    icon: 'error',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => location.reload()); // Reload to move item to Rejected tab
            }
        })
    }

    function previewDoc(title, type) {
        const modal = document.getElementById('modalPreview');
        document.getElementById('previewTitle').innerText = title;
        document.getElementById('docTypeDisplay').innerText = `Preview ${type} Mahasiswa`;
        modal.classList.replace('hidden', 'flex');
    }

    function closePreview() {
        document.getElementById('modalPreview').classList.replace('flex', 'hidden');
    }

    // Init with first tab
    window.onload = () => switchTab('menunggu');
</script>
@endsection