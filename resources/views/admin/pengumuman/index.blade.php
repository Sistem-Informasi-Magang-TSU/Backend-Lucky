@extends('layouts.app')

@section('title', 'Kelola Pengumuman')
@section('header_title', 'Manajemen Pengumuman')

@section('content')
    <div class="space-y-6">
        {{-- Alerts --}}
        @if(session('success'))
            <div class="bg-teal-50 border border-teal-200 text-teal-800 rounded-2xl p-4 flex items-center gap-3 fade-up">
                <svg class="w-6 h-6 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 rounded-2xl p-4 flex items-center gap-3 fade-up">
                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="font-bold">{{ session('error') }}</span>
            </div>
        @endif

        <div class="flex justify-between items-center fade-up">
            <div>
                <h3 class="text-xl font-bold text-gray-800">Daftar Pengumuman</h3>
                <p class="text-sm text-gray-500">Kelola pengumuman untuk mahasiswa dan dosen</p>
            </div>
            <button onclick="openPengumumanModal()"
                class="px-6 py-3 bg-tsu-teal text-white font-bold rounded-2xl hover:bg-tsu-teal-dark shadow-lg shadow-tsu-teal/30 transition flex items-center gap-2">
                <span class="text-lg">+</span> Tambah Pengumuman
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 fade-up delay-100">
            @forelse($pengumumans as $p)
                <div
                    class="bg-white rounded-[2.5rem] border border-gray-100 overflow-hidden shadow-sm hover:shadow-xl transition-all group relative">
                    <div class="h-32 bg-gradient-to-br from-indigo-500 to-purple-500 p-6 relative">
                        <div
                            class="absolute top-4 right-4 bg-white/20 backdrop-blur-md px-3 py-1 rounded-full text-[10px] text-white font-bold uppercase">
                            {{ $p->status ?? 'Aktif' }}
                        </div>
                        <div
                            class="absolute top-4 left-4 bg-white/20 backdrop-blur-md px-3 py-1 rounded-full text-[10px] text-white font-bold uppercase">
                            {{ $p->jenis_pengumuman ?? 'Info' }}
                        </div>
                        <h4 class="text-white font-bold text-lg mt-4 truncate" title="{{ $p->judul }}">{{ $p->judul }}</h4>
                        <p class="text-indigo-50/80 text-xs">{{ $p->created_at->format('d M Y') }}</p>
                    </div>
                    <div class="p-6 space-y-4">
                        <p class="text-gray-600 text-sm line-clamp-3">{{ $p->isi }}</p>

                        <hr class="border-gray-50">
                        <div class="flex gap-2">
                            {{-- Edit Button --}}
                            <button onclick='editPengumuman(@json($p))'
                                class="flex-1 py-2 bg-orange-50 text-orange-500 text-xs font-bold rounded-xl hover:bg-orange-100 transition flex items-center justify-center gap-2">
                                <span>✏️</span> Edit
                            </button>
                            {{-- Delete Button --}}
                            <form action="{{ route('admin.pengumuman.destroy', $p->id) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?');"
                                class="contents">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-4 py-2 bg-red-50 text-red-500 rounded-xl hover:bg-red-100 transition">🗑️</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 text-gray-400">
                    <p>Belum ada pengumuman.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Modal -->
    <div id="modalPengumuman"
        class="fixed inset-0 z-[60] hidden items-center justify-center bg-black/50 backdrop-blur-md p-4">
        <div
            class="bg-white w-full max-w-2xl rounded-[2.5rem] shadow-2xl overflow-hidden transform transition-all scale-95 duration-300 max-h-[90vh] overflow-y-auto">
            <div class="p-8 bg-tsu-teal text-white flex justify-between items-center sticky top-0 z-10">
                <h3 class="text-2xl font-bold" id="modalTitle">Tambah Pengumuman</h3>
                <button onclick="closePengumumanModal()"
                    class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition">✕</button>
            </div>
            <form id="pengumumanForm" action="{{ route('admin.pengumuman.store') }}" method="POST" class="p-8 space-y-4">
                @csrf
                <div id="methodField"></div>

                <div>
                    <label class="text-xs font-bold text-gray-400 uppercase ml-2">Judul</label>
                    <input type="text" name="judul" id="judul"
                        class="w-full bg-gray-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-tsu-teal transition mt-1"
                        required>
                </div>

                <div>
                    <label class="text-xs font-bold text-gray-400 uppercase ml-2">Jenis Pengumuman</label>
                    <select name="jenis_pengumuman" id="jenis_pengumuman"
                        class="w-full bg-gray-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-tsu-teal transition mt-1"
                        required>
                        <option value="info">Info</option>
                        <option value="warning">Warning</option>
                        <option value="danger">Danger</option>
                        <option value="success">Success</option>
                    </select>
                </div>

                <div>
                    <label class="text-xs font-bold text-gray-400 uppercase ml-2">Status</label>
                    <select name="status" id="status"
                        class="w-full bg-gray-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-tsu-teal transition mt-1"
                        required>
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                    </select>
                </div>

                <div>
                    <label class="text-xs font-bold text-gray-400 uppercase ml-2">Isi Pengumuman</label>
                    <textarea name="isi" id="isi" rows="4"
                        class="w-full bg-gray-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-tsu-teal transition mt-1"
                        required></textarea>
                </div>

                <div class="flex gap-4 pt-4 sticky bottom-0 bg-white pb-4">
                    <button type="button" onclick="closePengumumanModal()"
                        class="flex-1 py-4 bg-gray-100 text-gray-500 font-bold rounded-2xl hover:bg-gray-200 transition">Batal</button>
                    <button type="submit"
                        class="flex-[2] py-4 bg-tsu-teal text-white font-bold rounded-2xl hover:bg-tsu-teal-dark transition shadow-xl shadow-tsu-teal/30">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openPengumumanModal() {
            const modal = document.getElementById('modalPengumuman');
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            document.getElementById('pengumumanForm').action = "{{ route('admin.pengumuman.store') }}";
            document.getElementById('methodField').innerHTML = '';
            document.getElementById('modalTitle').innerText = 'Tambah Pengumuman';
            document.getElementById('pengumumanForm').reset();

            setTimeout(() => modal.querySelector('div').classList.replace('scale-95', 'scale-100'), 10);
        }

        function editPengumuman(p) {
            openPengumumanModal();

            let updateUrl = "{{ route('admin.pengumuman.update', ':id') }}";
            updateUrl = updateUrl.replace(':id', p.id);

            const form = document.getElementById('pengumumanForm');
            form.action = updateUrl;

            document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';
            document.getElementById('modalTitle').innerText = 'Edit Pengumuman';

            document.getElementById('judul').value = p.judul;
            document.getElementById('isi').value = p.isi;
            document.getElementById('jenis_pengumuman').value = p.jenis_pengumuman;
            document.getElementById('status').value = p.status;
        }

        function closePengumumanModal() {
            const modal = document.getElementById('modalPengumuman');
            modal.querySelector('div').classList.replace('scale-100', 'scale-95');
            setTimeout(() => modal.classList.replace('flex', 'hidden'), 200);
        }
    </script>
@endsection