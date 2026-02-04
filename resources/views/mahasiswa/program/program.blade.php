@extends('layouts.app')

@section('title', 'Dashboard - Program Magang')

@section('header_title', 'Program Mahasiswa Berdampak')

@section('content')

    @php
        // Map backend data to the format expected by AlpineJS
        $jobs = $programs->map(function ($program) {
            // Map jenis_bkp to the tab IDs used in the new layout
            $type = 'magang'; // Default
            if ($program->jenis_bkp === 'Studi Independen') {
                $type = 'studi';
            } elseif ($program->jenis_bkp === 'Magang Mandiri') {
                $type = 'magang';
            }

            return [
                'id' => $program->id_program,
                'type' => $type,
                'role' => $program->jenis_bkp,
                'company' => $program->mitra->nama_mitra ?? '-',
                'title' => $program->nama_program,
                'url' => route('program.show', $program->id_program)
            ];
        });

        // Helper for generating route prefix if needed elsewhere, though links are pre-generated above
        $rolePrefix = 'mahasiswa';
        if (request()->is('dosen*')) {
            $rolePrefix = 'dosen';
        } elseif (request()->is('admin*')) {
            $rolePrefix = 'admin';
        }
    @endphp

    <style>
        html {
            scroll-behavior: smooth;
        }

        .category-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .category-card:hover {
            transform: translateY(-5px);
        }

        .fade-up-item {
            animation: fadeUp 0.5s ease-out forwards;
            opacity: 0;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <div x-data="{ 
            tab: 'magang', 
            page: 1, 
            perPage: 6,
            categories: [
                { id: 'magang', name: 'Magang', icon: '💼' },
                { id: 'studi', name: 'Studi Independen', icon: '📚' },
                { id: 'kewirausahaan', name: 'Kewirausahaan', icon: '🚀' },
                { id: 'kampus-mengajar', name: 'Kampus Mengajar', icon: '👨‍🏫' },
                { id: 'kkn-tematik', name: 'KKN Tematik', icon: '🏘️' },
                { id: 'riset', name: 'Riset', icon: '🔬' },
                { id: 'proyek-independen', name: 'Studi/Proyek Independent', icon: '🛠️' },
                { id: 'kemanusiaan', name: 'Program Kemanusiaan', icon: '🤝' },
                { id: 'pertukaran', name: 'Pertukaran Mahasiswa', icon: '🌏' }
            ],
            jobs: {{ Js::from($jobs) }},
            get filteredJobs() {
                let filtered = this.jobs.filter(j => j.type === this.tab);
                return filtered.slice((this.page - 1) * this.perPage, this.page * this.perPage);
            },
            get totalPages() {
                let count = this.jobs.filter(j => j.type === this.tab).length;
                return count > 0 ? Math.ceil(count / this.perPage) : 1;
            }
        }">

        <div class="fade-up bg-tsu-teal text-white rounded-2xl p-8 mb-8 shadow-lg relative overflow-hidden">
            <div class="relative z-10">
                <h2 class="text-2xl font-extrabold mb-2">Eksplorasi Program Mahasiswa</h2>
                <p class="text-sm text-teal-50/80 font-light max-w-lg">
                    Pilih kategori program di bawah ini untuk melihat peluang yang tersedia untukmu.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-9 gap-3 mb-10">
            <template x-for="(cat, index) in categories" :key="cat.id">
                <button @click="tab = cat.id; page = 1"
                    class="category-card fade-up p-4 rounded-2xl border flex flex-col items-center justify-center text-center transition-all group shadow-sm"
                    :style="'animation-delay: ' + (index * 80) + 'ms'"
                    :class="tab === cat.id ? 'bg-tsu-teal border-tsu-teal text-white shadow-teal-100' : 'bg-white border-gray-100 text-gray-600 hover:border-tsu-teal hover:bg-teal-50'">
                    <span class="text-2xl mb-2 group-hover:scale-110 transition-transform" x-text="cat.icon"></span>
                    <span class="text-[10px] md:text-[11px] font-bold leading-tight" x-text="cat.name"></span>
                </button>
            </template>
        </div>

        <div id="lowongan-section"
            class="fade-up border border-gray-200 bg-white rounded-2xl p-6 md:p-8 mb-8 shadow-sm min-h-[500px]">

            <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8 border-b border-gray-100 pb-6">
                <div>
                    <h3 class="text-xl font-black text-gray-800">
                        Daftar Lowongan: <span class="text-tsu-teal"
                            x-text="categories.find(c => c.id === tab).name"></span>
                    </h3>
                    <p class="text-xs text-gray-400 mt-1">Menampilkan lowongan terbaru tahun 2026</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" x-show="filteredJobs.length > 0">
                <template x-for="(job, index) in filteredJobs" :key="tab + job.id">
                    <div class="fade-up-item border border-gray-100 rounded-2xl p-5 flex flex-col justify-between hover:shadow-xl hover:-translate-y-1 transition-all bg-white group"
                        :style="'animation-delay: ' + (index * 150) + 'ms'">
                        <div>
                            <div class="flex justify-between items-start mb-4">
                                <div class="p-3 bg-gray-50 rounded-xl group-hover:bg-teal-50 transition-colors text-xl">
                                    <span x-text="categories.find(c => c.id === tab).icon"></span>
                                </div>
                                <span class="text-[9px] font-black px-2 py-1 rounded bg-gray-100 text-gray-500 uppercase"
                                    x-text="categories.find(c => c.id === tab).name"></span>
                            </div>
                            <h4 class="font-bold text-lg mb-1 text-gray-800 group-hover:text-tsu-teal transition-colors leading-tight"
                                x-text="job.title"></h4>
                            <div class="text-sm text-gray-500 mb-4 font-medium" x-text="job.company"></div>
                            <span
                                class="inline-block bg-teal-50 text-tsu-teal font-bold text-[10px] uppercase px-3 py-1.5 rounded-lg mb-6 border border-teal-100"
                                x-text="job.role"></span>
                        </div>

                        <a :href="job.url"
                            class="flex items-center justify-center gap-2 w-full bg-tsu-teal text-white text-sm font-bold py-3 rounded-xl hover:bg-tsu-teal-dark transition-all active:scale-95 shadow-md">
                            Lihat Detail Program
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </template>
            </div>

            <div x-show="filteredJobs.length === 0"
                class="fade-up flex flex-col items-center justify-center py-20 text-center">
                <div class="bg-gray-50 p-8 rounded-full mb-6">
                    <span class="text-6xl">🔍</span>
                </div>
                <h4 class="text-xl font-bold text-gray-800 mb-2">Mohon Maaf...</h4>
                <p class="text-gray-500 text-sm max-w-sm font-light">
                    Saat ini lowongan untuk program <span class="font-bold text-tsu-teal"
                        x-text="categories.find(c => c.id === tab).name"></span> belum tersedia.
                </p>
                <button @click="tab = 'magang'" class="mt-6 text-tsu-teal font-bold text-sm hover:underline">Lihat program
                    lainnya</button>
            </div>

            <div class="flex items-center justify-center gap-2 mt-12" x-show="filteredJobs.length > 0">
                <button @click="page = Math.max(1, page - 1)" :disabled="page === 1"
                    class="p-2 rounded-lg border border-gray-200 hover:bg-gray-50 disabled:opacity-30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
                <template x-for="p in totalPages">
                    <button @click="page = p"
                        :class="page === p ? 'bg-tsu-teal text-white' : 'border border-gray-200 text-gray-600'"
                        class="w-10 h-10 rounded-lg font-bold text-sm transition-all" x-text="p"></button>
                </template>
                <button @click="page = Math.min(totalPages, page + 1)" :disabled="page === totalPages"
                    class="p-2 rounded-lg border border-gray-200 hover:bg-gray-50 disabled:opacity-30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="fade-up delay-[500ms] border border-gray-300 rounded-xl p-6 mb-8 text-center bg-white shadow-sm">
            <h3 class="text-lg font-bold mb-6">Jumlah Peserta Yang Telah Bergabung</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="text-center p-6 rounded-2xl bg-red-50/50 border border-red-80">
                    <div class="text-4xl font-bold text-tsu-red mb-1">30</div>
                    <div class="text-sm font-medium text-gray-600">Peserta Terdaftar</div>
                </div>
                <div class="text-center p-6 rounded-2xl bg-green-50/50 border border-green-80">
                    <div class="text-4xl font-bold text-green-500 mb-1">10</div>
                    <div class="text-sm font-medium text-gray-600">Peserta Aktif</div>
                </div>
                <div class="text-center p-6 rounded-2xl bg-blue-50/50 border border-blue-80">
                    <div class="text-4xl font-bold text-tsu-blue mb-1">50</div>
                    <div class="text-sm font-medium text-gray-600">Peserta Lulus</div>
                </div>
            </div>
        </div>

        <div
            class="fade-up delay-[700ms] bg-tsu-teal text-white rounded-2xl p-10 shadow-lg flex flex-col md:flex-row justify-between items-center gap-6">
            <div>
                <h2 class="text-2xl font-black mb-2">Bangun Karir Lewat Program Sesuai Skill Kamu!</h2>
                <p class="text-sm text-teal-50/80 font-light max-w-xl">Dapatkan pengalaman nyata dan sertifikasi
                    internasional melalui berbagai program unggulan kami.</p>
            </div>
            <a href="#about"
                class="bg-white text-tsu-teal px-8 py-4 rounded-xl font-bold hover:bg-gray-100 transition shadow-xl active:scale-95 whitespace-nowrap">
                Daftar Sekarang
            </a>
        </div>

@endsection