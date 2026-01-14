@extends('layouts.app')

@section('title', 'Dashboard - Program Magang')
@section('header_title', 'Program Magang')

@section('content')

<style>
    html { scroll-behavior: smooth; }
</style>

<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div x-data="{ tab: 'mandiri' }">

    {{-- HERO --}}
    <div class="fade-up bg-tsu-teal text-white rounded-2xl p-8 mb-8 shadow-lg">
        <h2 class="text-2xl font-extrabold mb-2">Pilih Jalur Masa Depanmu!</h2>
        <p class="text-sm text-teal-50/80 max-w-lg">
            Klik kategori di bawah untuk melihat lowongan Magang Mandiri atau Studi Independen.
        </p>
    </div>

    {{-- TAB --}}
    <div id="about" class="fade-up border bg-white rounded-2xl p-8 mb-8">
        <div class="flex justify-between items-center mb-8">
            <h3 class="text-xl font-black">Lowongan Tersedia - 2026</h3>

            <div class="flex bg-gray-100 p-1 rounded-xl">
                <button @click="tab = 'mandiri'"
                        :class="tab === 'mandiri' ? 'bg-white text-tsu-teal shadow' : 'text-gray-500'"
                        class="px-8 py-2 rounded-lg text-sm font-bold">
                    Magang Mandiri
                </button>
                <button @click="tab = 'studi'"
                        :class="tab === 'studi' ? 'bg-white text-tsu-teal shadow' : 'text-gray-500'"
                        class="px-8 py-2 rounded-lg text-sm font-bold">
                    Studi Independen
                </button>
            </div>
        </div>

        {{-- LIST PROGRAM --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($programs as $program)

                {{-- MAGANG MANDIRI --}}
                @if ($program->jenis_bkp === 'Magang Mandiri')
                <div x-show="tab === 'mandiri'" class="fade-up border rounded-2xl p-5 flex flex-col justify-between bg-white hover:shadow-lg">

                    <div>
                        <span class="text-[9px] font-black px-2 py-1 rounded bg-gray-100 text-gray-500 uppercase">
                            {{ $program->jenis_bkp }}
                        </span>

                        <h4 class="font-bold text-lg mt-2 text-gray-800">
                            {{ $program->nama_program }}
                        </h4>

                        <div class="text-sm text-gray-500 mb-3">
                            {{ $program->mitra->nama_mitra ?? '-' }}
                        </div>

                        <span class="inline-block bg-teal-50 text-tsu-teal text-[10px] px-3 py-1 rounded-lg">
                            Periode {{ $program->periode }}
                        </span>
                    </div>

                    <a href="{{ route('program.show', $program->id_program) }}"
                       class="mt-4 bg-tsu-teal text-white py-3 rounded-xl font-bold text-center">
                        Lihat Detail Program
                    </a>
                </div>
                @endif

                {{-- STUDI INDEPENDEN --}}
                @if ($program->jenis_bkp === 'Studi Independen')
                <div x-show="tab === 'studi'" class="fade-up border rounded-2xl p-5 flex flex-col justify-between bg-white hover:shadow-lg">

                    <div>
                        <span class="text-[9px] font-black px-2 py-1 rounded bg-gray-100 text-gray-500 uppercase">
                            {{ $program->jenis_bkp }}
                        </span>

                        <h4 class="font-bold text-lg mt-2 text-gray-800">
                            {{ $program->nama_program }}
                        </h4>

                        <div class="text-sm text-gray-500 mb-3">
                            {{ $program->mitra->nama_mitra ?? '-' }}
                        </div>

                        <span class="inline-block bg-blue-50 text-tsu-blue text-[10px] px-3 py-1 rounded-lg">
                            Periode {{ $program->periode }}
                        </span>
                    </div>

                    <a href="{{ route('program.show', $program->id_program) }}"
                       class="mt-4 bg-tsu-teal text-white py-3 rounded-xl font-bold text-center">
                        Lihat Detail Program
                    </a>
                </div>
                @endif

            @endforeach
        </div>
    </div>

</div>
@endsection
