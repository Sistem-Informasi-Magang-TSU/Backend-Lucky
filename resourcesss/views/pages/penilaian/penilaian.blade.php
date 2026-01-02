@extends('layouts.app')

@section('title', 'Penilaian Magang')

@section('header_title', 'Penilaian')

@section('content')
<style>
    /* CSS UNTUK TAMPILAN CETAK PERSIS WEB */
    @media print {
        /* 1. Paksa Browser menampilkan warna background dan gambar */
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            color-adjust: exact !important;
        }

        /* 2. Pastikan Sidebar dan Topbar TIDAK tersembunyi */
        aside, nav, header {
            display: block !important;
        }

        /* 3. Atur ukuran kertas agar tidak terpotong */
        @page {
            size: auto;
            margin: 0mm; /* Menghilangkan header/footer bawaan browser (tanggal/url) */
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #F3F4F6 !important; /* Warna abu-abu background web */
        }

        /* 4. Sesuaikan layout agar sidebar tetap di samping */
        .flex {
            display: flex !important;
        }

        /* Sembunyikan tombol cetak saja saat sedang mencetak agar tidak mengganggu */
        .no-print-button {
            display: none !important;
        }
    }

    /* Animasi fade-in tetap ada untuk di web */
    .fade-up {
        animation: fadeUp 0.5s ease-out forwards;
    }
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="w-full pb-10">
    <div class="max-w-5xl mx-auto fade-up">
        
        <div class="bg-white border border-gray-200 rounded-3xl p-8 mb-6 shadow-sm">
            <h2 class="text-3xl font-bold text-gray-800">Program Website Penjualan</h2>
            <p class="text-xl text-gray-500 mt-2">PT. Tiga Serangkai</p>
            <div class="mt-5">
                <span class="bg-teal-50 text-teal-700 px-6 py-2 rounded-full text-sm font-semibold border border-teal-100 uppercase tracking-wide">
                    Frontend Developer
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white border border-gray-200 rounded-3xl p-10 shadow-sm flex flex-col items-center justify-center">
                <h3 class="text-gray-600 font-semibold text-lg mb-2">Nilai Program</h3>
                <span class="text-[100px] font-black text-tsu-blue leading-none tracking-tighter">87</span>
                <p class="text-gray-400 mt-4 font-medium text-sm">Teguh Susyanto, S.Kom.</p>
            </div>

            <div class="bg-white border border-gray-200 rounded-3xl p-10 shadow-sm flex flex-col items-center justify-center">
                <h3 class="text-gray-600 font-semibold text-lg mb-2">Nilai Dosen Pembimbing</h3>
                <span class="text-[100px] font-black text-tsu-teal leading-none tracking-tighter">85</span>
                <p class="text-gray-400 mt-4 font-medium text-sm">Wawan Laksito, S.Kom.</p>
            </div>
        </div>

        <div class="mb-10">
            <h3 class="text-xl font-bold text-gray-800 mb-4 px-2">Komentar Pembimbing</h3>
            <div class="bg-gray-50 border border-gray-100 rounded-3xl p-8 relative shadow-inner">
                <p class="text-gray-600 leading-relaxed italic text-lg">
                    "Website magang penjualan ini sudah memenuhi seluruh kriteria penilaian yang telah ditetapkan. 
                    Layout website bagus, responsif, dan fitur-fitur seperti cart, checkout, dan manajemen produk 
                    sudah berfungsi dengan baik."
                </p>
                <div class="mt-6 text-right border-t border-gray-200 pt-4">
                    <p class="text-tsu-teal font-black text-lg">Wawan Laksito, S.Kom.</p>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 no-print-button">
            <button onclick="window.print()" class="group flex items-center justify-center gap-3 bg-tsu-teal text-white px-8 py-4 rounded-2xl font-bold hover:bg-teal-700 transition-all shadow-lg active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Cetak Laporan Nilai
            </button>
            
            <button class="flex items-center justify-center gap-3 border-2 border-tsu-teal text-tsu-teal px-8 py-4 rounded-2xl font-bold hover:bg-teal-50 transition-all active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                </svg>
                Unduh Sertifikat Magang
            </button>
        </div>
    </div>
</div>
@endsection