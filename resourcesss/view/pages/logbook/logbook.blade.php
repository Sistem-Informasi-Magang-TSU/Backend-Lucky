@extends('layouts.app')

@section('title', 'Logbook Kegiatan Magang')

@section('header_title', 'Logbook Kegiatan')

@section('content')

    <div class="bg-tsu-teal text-white rounded-xl p-6 mb-8 shadow-md">
        <h2 class="text-xl font-bold mb-2">Jangan lupa untuk Mengisi Logbook!</h2>
        <p class="text-sm text-gray-200 font-light">
            Catat semua kegiatan Anda di sini untuk dinilai oleh Pembimbing.
        </p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200">
        
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center gap-4">
                <input type="date" class="border border-gray-300 rounded-md p-2 text-sm focus:ring-tsu-teal focus:border-tsu-teal">
                <button class="bg-tsu-teal text-white text-sm font-semibold py-2 px-4 rounded-md hover:bg-tsu-teal-dark transition">
                    Filter
                </button>
            </div>
            <button class="bg-tsu-blue text-white text-sm font-semibold py-2 px-4 rounded-full shadow-md hover:bg-blue-700 transition flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Logbook
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-tsu-teal text-white text-xs md:text-sm shadow-md">
                        <th class="py-3 px-4 text-left font-semibold w-12 rounded-tl-lg">No</th>
                        <th class="py-3 px-4 text-left font-semibold w-24">Waktu</th>
                        <th class="py-3 px-4 text-left font-semibold">Nama Kegiatan</th>
                        <th class="py-3 px-4 text-left font-semibold">Uraian Kegiatan</th>
                        <th class="py-3 px-4 text-left font-semibold w-32">Jenis Logbook</th>
                        <th class="py-3 px-4 text-center font-semibold w-24 rounded-tr-lg">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    
                    <tr class="bg-white hover:bg-gray-50 transition text-sm">
                        <td class="py-3 px-4 text-gray-700">1</td>
                        <td class="py-3 px-4 text-gray-700 font-medium">15/12/2025</td>
                        <td class="py-3 px-4 text-gray-800 font-medium">Setup Lingkungan Development</td>
                        <td class="py-3 px-4 text-gray-600">Menginstal NodeJS, Composer, dan mengkonfigurasi proyek Laravel baru untuk TSU.</td>
                        <td class="py-3 px-4 text-gray-700">Harian</td>
                        <td class="py-3 px-4 text-center">
                            <span class="inline-block px-3 py-1 text-xs font-semibold leading-none rounded-full text-green-700 bg-green-100">
                                Divalidasi
                            </span>
                        </td>
                    </tr>
                    
                    <tr class="bg-white hover:bg-gray-50 transition text-sm">
                        <td class="py-3 px-4 text-gray-700">2</td>
                        <td class="py-3 px-4 text-gray-700 font-medium">16/12/2025</td>
                        <td class="py-3 px-4 text-gray-800 font-medium">Implementasi Sidebar & Layout</td>
                        <td class="py-3 px-4 text-gray-600">Membuat file layout utama (`app.blade.php`) dan memisahkan navigasi serta header.</td>
                        <td class="py-3 px-4 text-gray-700">Harian</td>
                        <td class="py-3 px-4 text-center">
                            <span class="inline-block px-3 py-1 text-xs font-semibold leading-none rounded-full text-yellow-700 bg-yellow-100">
                                Belum Divalidasi
                            </span>
                        </td>
                    </tr>
                    
                    <tr class="bg-white hover:bg-gray-50 transition text-sm">
                        <td class="py-3 px-4 text-gray-700">3</td>
                        <td class="py-3 px-4 text-gray-700 font-medium">08/12/2025</td>
                        <td class="py-3 px-4 text-gray-800 font-medium">Riset UI/UX Dashboard</td>
                        <td class="py-3 px-4 text-gray-600">Mencari referensi desain dashboard untuk inspirasi tata letak.</td>
                        <td class="py-3 px-4 text-gray-700">Mingguan</td>
                        <td class="py-3 px-4 text-center">
                            <span class="inline-block px-3 py-1 text-xs font-semibold leading-none rounded-full text-yellow-700 bg-yellow-100">
                                Belum Divalidasi
                            </span>
                        </td>
                    </tr>

                    <tr class="bg-white hover:bg-gray-50 transition text-sm">
                        <td class="py-3 px-4 h-16 text-gray-400">4</td>
                        <td class="py-3 px-4 h-16 text-gray-400"></td>
                        <td class="py-3 px-4 h-16 text-gray-400"></td>
                        <td class="py-3 px-4 h-16 text-gray-400"></td>
                        <td class="py-3 px-4 h-16 text-gray-400"></td>
                        <td class="py-3 px-4 h-16 text-gray-400"></td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>
    
@endsection