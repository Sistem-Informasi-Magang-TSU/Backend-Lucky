@extends('layouts.app')

@section('title', 'Admin Dashboard')
@section('header_title', 'Dashboard Admin')

@section('content')
<div class="space-y-6">
    @if(auth()->user()->role === 'admin')
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8 fade-up">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-xl font-bold text-gray-800">Buat Pengumuman Baru</h3>
                <p class="text-xs text-gray-400">Terbitkan informasi penting untuk seluruh pengguna</p>
            </div>
            <span class="text-3xl">📢</span>
        </div>
        
        <form id="formPengumuman" class="space-y-5" onsubmit="handleConfirm(event)">
            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase ml-2 tracking-widest">Judul Pengumuman</label>
                    <input type="text" id="judul" name="judul" required placeholder="Contoh: Batas Akhir Upload Laporan" 
                           class="w-full bg-gray-50 border-2 border-transparent rounded-2xl py-4 px-6 focus:bg-white focus:border-tsu-teal focus:ring-0 transition">
                </div>
                <div>
                    <label class="text-[10px] font-black text-gray-400 uppercase ml-2 tracking-widest">Isi Pesan</label>
                    <textarea id="isi" name="isi" rows="4" required placeholder="Tuliskan detail informasi di sini..." 
                              class="w-full bg-gray-50 border-2 border-transparent rounded-2xl py-4 px-6 focus:bg-white focus:border-tsu-teal focus:ring-0 transition"></textarea>
                </div>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-10 py-4 bg-tsu-teal text-white font-bold rounded-2xl hover:bg-tsu-teal-dark shadow-xl shadow-tsu-teal/30 transition-all hover:-translate-y-1">
                    Terbitkan Pengumuman
                </button>
            </div>
        </form>
    </div>
    @endif

    <div class="bg-white rounded-[2.5rem] p-8 border border-gray-100 shadow-sm fade-up delay-100">
        <div class="flex items-center gap-3 mb-6">
            <h3 class="font-bold text-gray-800 text-lg">Riwayat Pengumuman Terakhir</h3>
            <span class="px-3 py-1 bg-gray-100 text-gray-500 text-[10px] font-bold rounded-full uppercase" id="announce-count">{{ $pengumuman->count() }} Post</span>
        </div>
        
        <div id="listPengumuman" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @forelse($pengumuman as $p)
            <div class="bg-gray-50 p-5 rounded-3xl border-l-4 border-{{ $loop->first ? 'tsu-teal' : 'tsu-orange' }} relative group transition-all hover:bg-white hover:shadow-md">
                <div class="flex justify-between items-start mb-1">
                    <p class="font-bold text-gray-800">{{ $p->judul }}</p>
                    @if(auth()->user()->role === 'admin')
                    <form action="/admin/pengumuman/{{ $p->id }}" method="POST" onsubmit="return confirm('Hapus pengumuman ini?');" class="opacity-0 group-hover:opacity-100 transition-opacity">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700 text-xs">Hapus</button>
                    </form>
                    @endif
                </div>
                <p class="text-xs text-gray-500 line-clamp-2 mb-2">{{ $p->isi }}</p>
                <p class="text-[10px] text-gray-400 font-medium">🕒 {{ $p->created_at->diffForHumans() }}</p>
            </div>
            @empty
            <div class="col-span-2 text-center py-10">
                <p class="text-gray-400 text-sm">Belum ada pengumuman yang diterbitkan.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<script>
    function handleConfirm(e) {
        e.preventDefault();
        
        const judul = document.getElementById('judul').value;
        const isi = document.getElementById('isi').value;

        Swal.fire({
            title: 'Terbitkan Pengumuman?',
            text: "Apakah isi pengumuman sudah benar?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#086375',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Terbitkan!',
            cancelButtonText: 'Cek Kembali',
            border: 'none',
            borderRadius: '2rem'
        }).then((result) => {
            if (result.isConfirmed) {
                // Send via AJAX
                fetch('/admin/pengumuman', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        judul: judul,
                        isi: isi
                    })
                })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Pengumuman telah dipublish ke dashboard user.',
                        icon: 'success',
                        confirmButtonColor: '#086375'
                    }).then(() => {
                        // Reload page to show new announcement or prepend JS
                        location.reload(); 
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat menyimpan pengumuman.',
                        icon: 'error',
                        confirmButtonColor: '#d33'
                    });
                });
            }
        });
    }

    function updateAnnounceList(judul, pesan) {
        const list = document.getElementById('listPengumuman');
        const newAnnounce = document.createElement('div');
        
        newAnnounce.className = "bg-white p-5 rounded-3xl border-l-4 border-blue-500 shadow-md animate-fade-in-down transition-all";
        newAnnounce.innerHTML = `
            <p class="font-bold text-gray-800 mb-1">${judul}</p>
            <p class="text-xs text-gray-500 line-clamp-1 mb-2">${pesan}</p>
            <p class="text-[10px] text-blue-500 font-bold uppercase tracking-tighter">✨ Baru Saja Diterbitkan</p>
        `;
        
        list.insertBefore(newAnnounce, list.firstChild);
        
        const countSpan = document.getElementById('announce-count');
        const currentCount = document.querySelectorAll('#listPengumuman > div').length;
        countSpan.innerText = `${currentCount} Post`;
    }
</script>

<style>
    @keyframes fade-in-down {
        0% { opacity: 0; transform: translateY(-10px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-down {
        animation: fade-in-down 0.4s ease-out;
    }
</style>
@endsection