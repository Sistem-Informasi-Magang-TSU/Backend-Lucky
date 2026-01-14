@extends('layouts.app')

@section('title', 'Data Mahasiswa')
@section('header_title', 'Database Mahasiswa')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 fade-up">
        <div>
            <h3 class="text-xl font-bold text-gray-800">Manajemen Data Mahasiswa</h3>
            <p class="text-sm text-gray-500">Total <span id="student-count" class="font-bold text-tsu-teal">0</span> mahasiswa terdaftar</p>
        </div>
        <div class="relative w-full md:w-72">
            <input type="text" id="searchInput" onkeyup="searchMahasiswa()" placeholder="Cari Nama atau NIM..." 
                   class="w-full bg-white border-none rounded-2xl py-3 px-11 shadow-sm focus:ring-2 focus:ring-tsu-teal transition">
            <span class="absolute left-4 top-3.5 text-gray-400">🔍</span>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden fade-up delay-100">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse" id="mahasiswaTable">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-5 text-xs font-bold text-gray-400 uppercase">Mahasiswa</th>
                        <th class="px-6 py-5 text-xs font-bold text-gray-400 uppercase">Kontak & Email</th>
                        <th class="px-6 py-5 text-xs font-bold text-gray-400 uppercase">Program Saat Ini</th>
                        <th class="px-6 py-5 text-xs font-bold text-gray-400 uppercase text-center">Berkas</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($mahasiswa as $mhs)
                        @php
                            $mhsData = $mhs->mahasiswa;
                            $registration = $mhsData ? $mhsData->pendaftaran->where('status', 'diterima')->first() : null;
                            $program = $registration ? $registration->programMagang : null;
                        @endphp
                    <tr class="hover:bg-gray-50/50 transition mhs-row">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-tsu-teal/10 flex items-center justify-center font-bold text-tsu-teal">
                                    {{ substr($mhs->name, 0, 2) }}
                                </div>
                                <div>
                                    <p class="font-bold text-sm text-gray-800 student-name">{{ $mhs->name }}</p>
                                    <p class="text-[10px] text-gray-400">NIM: {{ $mhsData ? $mhsData->nim : '-' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-xs font-bold text-gray-700">{{ $mhs->email }}</td>
                        <td class="px-6 py-4">
                            @if($program)
                                <span class="text-xs font-medium text-gray-600">{{ $program->posisi }} - {{ $program->mitra->nama_mitra }}</span>
                            @else
                                <span class="text-xs font-medium text-gray-400 italic">Belum Mengikuti Program</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2">
                                <button onclick="previewFile('CV', '{{ $mhs->name }}')" class="w-8 h-8 flex items-center justify-center bg-purple-50 text-purple-600 rounded-lg hover:bg-purple-100 transition">📄</button>
                                <button onclick="previewFile('KRS', '{{ $mhs->name }}')" class="w-8 h-8 flex items-center justify-center bg-orange-50 text-orange-600 rounded-lg hover:bg-orange-100 transition">📋</button>
                                <button onclick="previewFile('Transkrip', '{{ $mhs->name }}')" class="w-8 h-8 flex items-center justify-center bg-green-50 text-green-600 rounded-lg hover:bg-green-100 transition">📊</button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">Tidak ada data mahasiswa.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function updateStudentCount() {
        const rows = document.querySelectorAll('.mhs-row').length;
        document.getElementById('student-count').innerText = rows;
    }

    function searchMahasiswa() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        const rows = document.querySelectorAll('.mhs-row');
        
        rows.forEach(row => {
            const name = row.querySelector('.student-name').innerText.toLowerCase();
            const nim = row.innerText.toLowerCase();
            if (name.includes(input) || nim.includes(input)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    function viewFullDetail(name, prodi) {
        const modal = document.getElementById('modalDetailMhs');
        const content = modal.querySelector('div');
        
        document.getElementById('detailName').innerText = name;
        document.getElementById('detailProdi').innerText = prodi;
        document.getElementById('detailInitial').innerText = name.split(' ').map(n => n[0]).join('');
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => content.classList.replace('translate-x-full', 'translate-x-0'), 10);
    }

    function closeDetailMhs() {
        const modal = document.getElementById('modalDetailMhs');
        const content = modal.querySelector('div');
        content.classList.replace('translate-x-0', 'translate-x-full');
        setTimeout(() => modal.classList.replace('flex', 'hidden'), 300);
    }

    function previewFile(type, mhs) {
        Swal.fire({
            title: 'Membuka ' + type,
            text: 'Menghubungkan ke server untuk file ' + mhs + '...',
            icon: 'info',
            timer: 1000,
            showConfirmButton: false
        });
    }

    window.onload = updateStudentCount;
</script>
@endsection