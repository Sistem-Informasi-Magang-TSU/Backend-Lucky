@extends('layouts.app')

@section('title', 'Kelola Program Magang')
@section('header_title', 'Manajemen Program')

@section('content')
<div class="space-y-6">
    {{-- Alerts --}}
    @if(session('success'))
    <div class="bg-teal-50 border border-teal-200 text-teal-800 rounded-2xl p-4 flex items-center gap-3 fade-up">
        <svg class="w-6 h-6 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        <span class="font-bold">{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-50 border border-red-200 text-red-800 rounded-2xl p-4 flex items-center gap-3 fade-up">
        <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
        <span class="font-bold">{{ session('error') }}</span>
    </div>
    @endif

    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-800 rounded-2xl p-4 fade-up">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="flex justify-between items-center fade-up">
        <div>
            <h3 class="text-xl font-bold text-gray-800">Daftar Program Magang</h3>
            <p class="text-sm text-gray-500">Kelola kuota dan detail informasi program magang</p>
        </div>
        <button onclick="openProgramModal()" class="px-6 py-3 bg-tsu-teal text-white font-bold rounded-2xl hover:bg-tsu-teal-dark shadow-lg shadow-tsu-teal/30 transition flex items-center gap-2">
            <span class="text-lg">+</span> Tambah Program
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 fade-up delay-100">
        @forelse($programs as $program)
        <div class="bg-white rounded-[2.5rem] border border-gray-100 overflow-hidden shadow-sm hover:shadow-xl transition-all group relative">
            <div class="h-32 bg-gradient-to-br from-tsu-teal to-blue-500 p-6 relative">
                <div class="absolute top-4 right-4 bg-white/20 backdrop-blur-md px-3 py-1 rounded-full text-[10px] text-white font-bold uppercase">
                    {{ $program->kuota > 0 ? 'Aktif' : 'Penuh' }}
                </div>
                <h4 class="text-white font-bold text-lg mt-4 truncate" title="{{ $program->nama_program }}">{{ $program->nama_program }}</h4>
                <p class="text-teal-50/80 text-xs">{{ $program->mitra->nama_mitra ?? 'Mitra tidak ditemukan' }}</p>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex justify-between text-xs font-bold uppercase tracking-wider text-gray-400">
                    <span>Terisi</span>
                    <span>Kuota: {{ $program->kuota }}</span>
                </div>
                {{-- Progress Bar Simulasi (Karena belum ada data pendaftar real, kita hardcode 0 dulu atau nanti hitung count) --}}
                <div class="w-full h-3 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-tsu-teal rounded-full transition-all duration-1000" style="width: 0%"></div>
                </div>
                
                <div class="flex justify-between items-center text-sm font-bold text-gray-700">
                   <span>0 Pendaftar</span> <!-- Nanti diganti $program->pendaftaran_count -->
                </div>

                <hr class="border-gray-50">
                <div class="flex gap-2">
                    {{-- Edit Button --}}
                    <button onclick='editProgram(@json($program))' class="flex-1 py-2 bg-orange-50 text-orange-500 text-xs font-bold rounded-xl hover:bg-orange-100 transition flex items-center justify-center gap-2">
                        <span>✏️</span> Edit
                    </button>
                    {{-- Delete Button --}}
                    <form action="{{ route('admin.program.destroy', $program->id_program) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus program ini?');" class="contents">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-50 text-red-500 rounded-xl hover:bg-red-100 transition">🗑️</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12 text-gray-400">
            <p>Belum ada program magang.</p>
        </div>
        @endforelse
    </div>
</div>

<!-- Modal Tambah/Edit Program -->
<div id="modalProgram" class="fixed inset-0 z-[60] hidden items-center justify-center bg-black/50 backdrop-blur-md p-4">
    <div class="bg-white w-full max-w-2xl rounded-[2.5rem] shadow-2xl overflow-hidden transform transition-all scale-95 duration-300 max-h-[90vh] overflow-y-auto">
        <div class="p-8 bg-tsu-teal text-white flex justify-between items-center sticky top-0 z-10">
            <h3 class="text-2xl font-bold" id="modalTitle">Tambah Program Magang</h3>
            <button onclick="closeProgramModal()" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-white/20 transition">✕</button>
        </div>
        <form id="programForm" action="{{ route('admin.program.store') }}" method="POST" class="p-8 space-y-4">
            @csrf
            <div id="methodField"></div>
            
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="text-xs font-bold text-gray-400 uppercase ml-2">ID Program (Unik)</label>
                    <input type="text" name="id_program" id="id_program" class="w-full bg-gray-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-tsu-teal transition mt-1" placeholder="Contoh: PROG001" required>
                </div>

                <div class="col-span-2">
                    <label class="text-xs font-bold text-gray-400 uppercase ml-2">Nama Program</label>
                    <input type="text" name="nama_program" id="nama_program" class="w-full bg-gray-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-tsu-teal transition mt-1" placeholder="Contoh: Android Developer" required>
                </div>

                <div class="col-span-2">
                    <label class="text-xs font-bold text-gray-400 uppercase ml-2">Mitra / Perusahaan</label>
                    <select name="id_mitra" id="id_mitra" class="w-full bg-gray-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-tsu-teal transition mt-1" required>
                        <option value="">Pilih Mitra</option>
                        @foreach($mitras as $mitra)
                            <option value="{{ $mitra->id_mitra }}">{{ $mitra->nama_mitra }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label class="text-xs font-bold text-gray-400 uppercase ml-2">Jenis BKP</label>
                    <input type="text" name="jenis_bkp" id="jenis_bkp" class="w-full bg-gray-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-tsu-teal transition mt-1" placeholder="Magang / Studi Independen" required>
                </div>

                <div>
                    <label class="text-xs font-bold text-gray-400 uppercase ml-2">Periode</label>
                    <input type="text" name="periode" id="periode" class="w-full bg-gray-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-tsu-teal transition mt-1" placeholder="Genap 2023/2024" required>
                </div>

                <div class="col-span-2">
                    <label class="text-xs font-bold text-gray-400 uppercase ml-2">Lokasi Penempatan</label>
                    <input type="text" name="lokasi_penempatan" id="lokasi_penempatan" class="w-full bg-gray-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-tsu-teal transition mt-1" placeholder="Alamat lengkap..." required>
                </div>

                <div>
                    <label class="text-xs font-bold text-gray-400 uppercase ml-2">Kuota</label>
                    <input type="number" name="kuota" id="kuota" class="w-full bg-gray-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-tsu-teal transition mt-1" placeholder="0" min="1" required>
                </div>

                <div class="col-span-2">
                    <label class="text-xs font-bold text-gray-400 uppercase ml-2">Syarat</label>
                    <textarea name="syarat" id="syarat" rows="2" class="w-full bg-gray-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-tsu-teal transition mt-1" placeholder="Syarat pendaftaran..."></textarea>
                </div>
                
                <div class="col-span-2">
                    <label class="text-xs font-bold text-gray-400 uppercase ml-2">Deskripsi Silabus</label>
                    <textarea name="deskripsi_silabus" id="deskripsi_silabus" rows="2" class="w-full bg-gray-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-tsu-teal transition mt-1" placeholder="Deskripsi..."></textarea>
                </div>
                
                <div class="col-span-2">
                    <label class="text-xs font-bold text-gray-400 uppercase ml-2">Dampak Program</label>
                    <textarea name="dampak_program" id="dampak_program" rows="2" class="w-full bg-gray-50 border-none rounded-2xl py-4 px-6 focus:ring-2 focus:ring-tsu-teal transition mt-1" placeholder="Dampak yang diharapkan..."></textarea>
                </div>
            </div>
            
            <div class="flex gap-4 pt-4 sticky bottom-0 bg-white pb-4">
                <button type="button" onclick="closeProgramModal()" class="flex-1 py-4 bg-gray-100 text-gray-500 font-bold rounded-2xl hover:bg-gray-200 transition">Batal</button>
                <button type="submit" class="flex-[2] py-4 bg-tsu-teal text-white font-bold rounded-2xl hover:bg-tsu-teal-dark transition shadow-xl shadow-tsu-teal/30">Simpan Program</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openProgramModal() {
        const modal = document.getElementById('modalProgram');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        // Reset form for create
        document.getElementById('programForm').action = "{{ route('admin.program.store') }}";
        document.getElementById('methodField').innerHTML = '';
        document.getElementById('modalTitle').innerText = 'Tambah Program Magang';
        
        // Clear inputs
        document.getElementById('programForm').reset();
        document.getElementById('id_program').readOnly = false; // Boleh edit ID saat create
        document.getElementById('id_program').classList.remove('bg-gray-200');

        setTimeout(() => modal.querySelector('div').classList.replace('scale-95', 'scale-100'), 10);
    }

    function editProgram(program) {
        openProgramModal();
        
        // Set update route
        const form = document.getElementById('programForm');
        // Construct the update URL correctly.  We need the ID.
        // The default resource route for update is PUT /program/{program}
        // Since we are using string IDs, we need to be careful with URL generation.
        // It's safer to use a placeholder and replace it.
        let updateUrl = "{{ route('admin.program.update', ':id') }}";
        updateUrl = updateUrl.replace(':id', program.id_program);
        
        form.action = updateUrl;
        
        // Add PUT method spoofing
        document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';
        document.getElementById('modalTitle').innerText = 'Edit Program Magang';
        
        // Fill inputs
        document.getElementById('id_program').value = program.id_program;
        document.getElementById('id_program').readOnly = true; // Jangan edit ID saat update
        document.getElementById('id_program').classList.add('bg-gray-200');
        
        document.getElementById('nama_program').value = program.nama_program;
        document.getElementById('id_mitra').value = program.id_mitra;
        document.getElementById('jenis_bkp').value = program.jenis_bkp;
        document.getElementById('periode').value = program.periode;
        document.getElementById('lokasi_penempatan').value = program.lokasi_penempatan;
        document.getElementById('kuota').value = program.kuota;
        document.getElementById('syarat').value = program.syarat;
        document.getElementById('deskripsi_silabus').value = program.deskripsi_silabus;
        document.getElementById('dampak_program').value = program.dampak_program;
    }

    function closeProgramModal() {
        const modal = document.getElementById('modalProgram');
        modal.querySelector('div').classList.replace('scale-100', 'scale-95');
        setTimeout(() => modal.classList.replace('flex', 'hidden'), 200);
    }
</script>
@endsection