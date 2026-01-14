@extends('layouts.app')

@section('title', 'Validasi Logbook - Dosen')

@section('header_title', 'Validasi Logbook Mahasiswa')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="fade-up bg-white p-6 rounded-[2.5rem] border border-gray-100 shadow-sm flex items-center gap-5">
            <div class="bg-orange-50 text-orange-500 p-4 rounded-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-400">Total Perlu Validasi</p>
                <h4 id="count-pending" class="text-2xl font-black text-gray-800">{{ $countPending }}</h4>
            </div>
        </div>
        <div class="fade-up delay-100 bg-white p-6 rounded-[2.5rem] border border-gray-100 shadow-sm flex items-center gap-5">
            <div class="bg-green-50 text-green-500 p-4 rounded-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-400">Total Sudah Divalidasi</p>
                <h4 id="count-success" class="text-2xl font-black text-gray-800">{{ $countSuccess }}</h4>
            </div>
        </div>
    </div>

    <div class="fade-up delay-200 bg-white border border-gray-200 rounded-[2.5rem] overflow-hidden shadow-sm">
        <div class="p-8 border-b border-gray-50 flex justify-between items-center">
            <h3 class="text-xl font-black text-gray-800">Daftar Mahasiswa Bimbingan</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-400 text-xs uppercase tracking-widest font-black">
                        <th class="px-8 py-5">Mahasiswa</th>
                        <th class="px-8 py-5">Program</th>
                        <th class="px-8 py-5">Status Logbook</th>
                        <th class="px-8 py-5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                @forelse($mahasiswa as $mhs)
                <tr class="group hover:bg-gray-50 transition">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                        <img src="{{ $mhs->foto 
                        ? asset('storage/'.$mhs->foto) 
                        : 'https://ui-avatars.com/api/?name='.$mhs->user->name }}"
                        class="w-12 h-12 rounded-2xl shadow-sm">
                <div>
                <p class="font-bold text-gray-800">{{ $mhs->user->name }}</p>
                <p class="text-xs text-gray-400">{{ $mhs->nim }}</p>
                </div>
            </div>
        </td>

        <td class="px-8 py-6 text-sm font-medium text-gray-600">
            {{ $mhs->posisi ?? '-' }}
        </td>

        <td class="px-8 py-6">
            <span class="bg-orange-100 text-orange-600 px-4 py-1.5 rounded-full text-xs font-bold">
                {{ $mhs->logbook->count() }} Perlu Validasi
        </span>
        </td>

        <td class="px-8 py-6 text-center">
        <button
            onclick="showDetailLogbook('{{ $mhs->user->name }}', {{ $mhs->nim }})"
            class="bg-tsu-blue text-white px-6 py-2.5 rounded-xl font-bold text-sm">
            Periksa
        </button>
    </td>
</tr>
@empty
<tr>
    <td colspan="4" class="px-8 py-10 text-center text-gray-400 italic">
        Belum ada mahasiswa bimbingan.
    </td>
</tr>
@endforelse
</tbody>

            </table>
        </div>
    </div>
</div>

<div id="modalDetail" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[99] hidden flex items-center justify-center p-4">
    <div class="bg-white w-full max-w-4xl rounded-[3rem] shadow-2xl overflow-hidden animate-zoom-in">
        <div class="p-8 border-b flex justify-between items-center bg-gray-50">
            <div>
                <h3 class="text-2xl font-black text-gray-800" id="mhsName">Logbook Mahasiswa</h3>
                <p class="text-gray-500 text-sm italic">Hanya menampilkan logbook Mingguan & Bulanan.</p>
            </div>
            <button onclick="closeModal()" class="p-3 bg-white rounded-2xl shadow-sm hover:bg-red-50 hover:text-red-500 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>
        
        <div id="logbook-container" class="p-8 max-h-[60vh] overflow-y-auto space-y-6">
            <!-- Data Logbook akan dimuat di sini secara dinamis -->
            <div id="loading-spinner" class="hidden text-center py-10">
                <svg class="animate-spin h-8 w-8 text-tsu-teal mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <p class="text-gray-500 mt-2 text-sm">Memuat data logbook...</p>
            </div>
        </div>
    </div>
</div>

<script>
    let pendingCount = {{ $countPending }};
    let successCount = {{ $countSuccess }};

    function updateStats() {
        // Implementasi update count jika diperlukan real-time atau reload page
    }

    function showDetailLogbook(nama, nim) {
        document.getElementById('mhsName').innerText = "Logbook: " + nama;
        
        const container = document.getElementById('logbook-container');
        const spinner = document.getElementById('loading-spinner');
        
        // Clear previous content but keep spinner
        container.innerHTML = '';
        container.appendChild(spinner);
        
        spinner.classList.remove('hidden');
        document.getElementById('modalDetail').classList.remove('hidden');

        fetch(`/dosen/logbook/${nim}/data`)
            .then(res => res.json())
            .then(data => {
                spinner.classList.add('hidden');
                
                if (data.length === 0) {
                    container.innerHTML += '<p class="text-center text-gray-500 italic">Belum ada logbook yang diunggah.</p>';
                    return;
                }

                data.forEach(log => {
                    const card = createLogbookCard(log);
                    container.innerHTML += card;
                });
            })
            .catch(err => {
                spinner.classList.add('hidden');
                container.innerHTML += '<p class="text-center text-red-500">Gagal memuat data.</p>';
                console.error(err);
            });
    }

    function createLogbookCard(log) {
        // Formatting Status Badge
        let statusBadge = '';
        if (log.status_validasi === 'pending') {
            statusBadge = '<span class="bg-orange-100 text-orange-600 px-3 py-1 rounded-lg text-[10px] font-black uppercase">Perlu Validasi</span>';
        } else if (log.status_validasi === 'disetujui') {
            statusBadge = '<span class="bg-green-100 text-green-600 px-3 py-1 rounded-lg text-[10px] font-black uppercase">Disetujui</span>';
        } else if (log.status_validasi === 'revisi') {
            statusBadge = '<span class="bg-red-100 text-red-600 px-3 py-1 rounded-lg text-[10px] font-black uppercase">Revisi</span>';
        }

        // Action Buttons Logic
        let actionButtons = '';
        if (log.status_validasi === 'pending') {
            actionButtons = `
                <div class="flex gap-2 shrink-0 action-area">
                    <form method="POST" action="/dosen/logbook/${log.id_logbook}/validasi">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="status" value="disetujui">
                        <button class="bg-tsu-teal text-white px-5 py-2 rounded-xl text-xs font-bold hover:bg-tsu-teal-dark transition">
                            Validasi
                        </button>
                    </form>
                    
                    <button onclick="rejectAction(this, ${log.id_logbook})" 
                        class="bg-white border border-red-200 text-red-500 px-5 py-2.5 rounded-xl text-xs font-bold hover:bg-red-50 transition">
                        Tolak
                    </button>
                </div>
            `;
        }

        return `
            <div class="logbook-card p-6 border border-gray-100 rounded-[2rem] bg-gray-50/50 flex flex-col md:flex-row justify-between items-start gap-4 transition-all mb-4">
                <div class="space-y-3 w-full">
                    <div class="flex gap-2 items-center">
                        <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-lg text-[10px] font-black uppercase">
                            ${log.tipe_logbook || 'Logbook'}
                        </span>
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">
                            ${new Date(log.created_at).toLocaleDateString('id-ID')}
                        </span>
                        ${statusBadge}
                    </div>
                    <h5 class="font-bold text-gray-800 text-lg">${log.judul || 'Tanpa Judul'}</h5>
                    <p class="text-gray-600 text-sm leading-relaxed">${log.deskripsi || '-'}</p>
                    
                    ${log.respo_revisi ? `<div class="bg-red-50 p-3 rounded-xl border border-red-100 text-xs text-red-600 mt-2"><strong>Catatan Revisi:</strong> ${log.respo_revisi}</div>` : ''}
                </div>
                ${actionButtons}
            </div>
        `;
    }

    function closeModal() {
        document.getElementById('modalDetail').classList.add('hidden');
    }

    function rejectAction(btn, id) {
        Swal.fire({
            title: 'Tolak Logbook?',
            input: 'textarea',
            inputPlaceholder: 'Berikan alasan penolakan/revisi...',
            inputAttributes: {
                'aria-label': 'Berikan alasan penolakan/revisi'
            },
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            confirmButtonText: 'Kirim Revisi',
            showLoaderOnConfirm: true,
            preConfirm: (reason) => {
                if (!reason) {
                    Swal.showValidationMessage('Alasan harus diisi!');
                    return false;
                }
                
                return fetch(`/dosen/logbook/${id}/tolak`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ respo_revisi: reason })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText);
                    }
                    return response; // No json response expected effectively based on controller back()
                })
                .catch(error => {
                    Swal.showValidationMessage(
                        `Request failed: ${error}`
                    );
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                const actionArea = btn.closest('.action-area');
                actionArea.innerHTML = '<span class="text-red-500 font-bold flex items-center gap-1 text-sm">❌ Menunggu Revisi</span>';
                
                Swal.fire({
                    title: 'Terkirim!',
                    text: 'Mahasiswa akan segera merevisi.',
                    icon: 'success'
                }).then(() => {
                     // Optional: Reload data or update UI further
                     // For now, we just leave it as marked
                });
            }
        });
    }

    window.onclick = function(event) {
        let modal = document.getElementById('modalDetail');
        if (event.target == modal) closeModal();
    }
</script>
@endsection