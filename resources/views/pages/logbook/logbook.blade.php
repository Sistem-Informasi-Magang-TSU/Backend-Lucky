@extends('layouts.app')

@section('title', 'Logbook Kegiatan Magang')

@section('header_title', 'Logbook Kegiatan')

@section('content')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="fade-up bg-tsu-teal text-white rounded-xl p-6 mb-8 shadow-md">
        <h2 class="text-xl font-bold mb-2">Jangan lupa untuk Mengisi Logbook!</h2>
        <p class="text-sm text-gray-200 font-light">
            Catat semua kegiatan Anda di sini untuk dinilai oleh Pembimbing.
        </p>
    </div>

    <div class="fade-up delay-100 bg-white p-6 rounded-xl shadow-md border border-gray-200 relative">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
            <div class="flex flex-wrap items-center gap-2">
                <div class="flex items-center gap-2 bg-gray-50 border border-gray-300 rounded-lg px-3 py-1.5">
                    <label class="text-xs font-semibold text-gray-500 uppercase">Dari:</label>
                    <input type="date" id="filterStartDate" class="bg-transparent text-sm focus:outline-none">
                </div>
                <div class="flex items-center gap-2 bg-gray-50 border border-gray-300 rounded-lg px-3 py-1.5">
                    <label class="text-xs font-semibold text-gray-500 uppercase">Sampai:</label>
                    <input type="date" id="filterEndDate" class="bg-transparent text-sm focus:outline-none">
                </div>
                <button id="filterBtn"
                    class="bg-tsu-teal text-white text-sm font-semibold py-2 px-6 rounded-lg hover:bg-tsu-teal-dark transition shadow-sm">
                    Cari Logbook
                </button>
                <button id="resetFilter" class="text-gray-500 text-xs hover:underline ml-2">Semua</button>
            </div>

            <button id="openModal"
                class="bg-blue-600 text-white text-sm font-semibold py-2.5 px-5 rounded-full shadow-lg hover:bg-blue-700 transition flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Tambah Logbook
            </button>
        </div>

        <div class="relative">
            <div id="emptyState" class="fade-up delay-400 flex flex-col items-center justify-center py-20 px-4">
                <h3 class="text-lg font-bold text-gray-700 text-center">Kelihatannya Kamu Belum Mempunyai Logbook</h3>
                <p class="text-gray-500 text-sm text-center">
                    Klik
                    <span id="emptyStateAdd" class="text-blue-600 font-semibold uppercase cursor-pointer hover:underline">
                        Tambah Logbook
                    </span>
                    Untuk Mengisinya
                </p>
            </div>

            <div id="tableContainer" class="overflow-x-auto hidden">
                <table id="logbookTable"
                    class="min-w-full border-collapse rounded-lg overflow-hidden border border-gray-200">
                    <thead class="bg-tsu-teal text-white text-xs md:text-sm shadow-md">
                        <tr>
                            <th class="py-3 px-4 text-center font-semibold w-12 border-r border-white/10">No</th>
                            <th class="py-3 px-4 text-center font-semibold w-40 border-r border-white/20">Periode Tanggal
                            </th>
                            <th class="py-3 px-4 text-center font-semibold w-1/4 border-r border-white/20">Nama Kegiatan
                            </th>
                            <th class="py-3 px-4 text-center font-semibold border-r border-white/20">Uraian Kegiatan</th>
                            <th class="py-3 px-4 text-center font-semibold w-32 border-r border-white/20">Jenis</th>
                            <th class="py-3 px-4 text-center font-semibold w-40">Status</th>
                        </tr>
                    </thead>
                    <tbody id="logbookTableBody">
                        @forelse($logbooks as $i => $log)
                            <tr data-start="{{ $log->tanggal_mulai }}" data-end="{{ $log->tanggal_selesai }}">
                                <td>{{ $i + 1 }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($log->tanggal_mulai)->format('d/m/Y') }}
                                    -
                                    {{ \Carbon\Carbon::parse($log->tanggal_selesai)->format('d/m/Y') }}
                                </td>
                                <td>{{ $log->nama_kegiatan }}</td>
                                <td>{{ $log->uraian_kegiatan }}</td>
                                <td>{{ $log->jenis_logbook }}</td>
                                <td>
                                    <span class="badge">
                                        {{ $log->status_validasi == 'pending' ? 'Belum Divalidasi' : 'Disetujui' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div id="printActionContainer" class="hidden flex justify-end mt-6">
            <button onclick="exportToWord()"
                class="bg-green-600 text-white text-sm font-bold py-3.5 px-10 rounded-xl shadow-lg hover:bg-green-700 transition flex items-center gap-3 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                CETAK LOGBOOK (WORD)
            </button>
        </div>
    </div>

    <div id="logbookModal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-40 backdrop-blur-sm transition-opacity duration-300">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl p-0 overflow-hidden transform transition-all scale-95 duration-300"
            id="logbookModalContent">
            <div class="bg-tsu-teal p-4 text-white flex justify-between items-center">
                <h3 class="text-lg font-bold">Tambah Logbook Baru</h3>
                <button id="closeModal" class="text-white hover:text-gray-200"><svg xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg></button>
            </div>

            <form id="formLogbook" class="p-6 space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Mulai</label>
                        <input type="date" id="inputTanggalMulai" required
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-tsu-teal focus:border-tsu-teal outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Selesai</label>
                        <input type="date" id="inputTanggalSelesai" required
                            class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-tsu-teal focus:border-tsu-teal outline-none transition">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis Logbook</label>
                    <select id="inputJenis" required
                        class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-tsu-teal focus:border-tsu-teal outline-none transition">
                        <option value="individu">Individu</option>
                        <option value="kelompok">Kelompok</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Kegiatan</label>
                    <input type="text" id="inputNama" required
                        class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-tsu-teal focus:border-tsu-teal outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Uraian Kegiatan</label>
                    <textarea id="inputUraian" rows="4" required
                        class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-tsu-teal focus:border-tsu-teal outline-none transition"></textarea>
                </div>
                <div class="flex justify-end gap-3 mt-6 border-t pt-4">
                    <button type="button" id="cancelModal"
                        class="px-6 py-2 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition text-sm">Batal</button>
                    <button type="submit"
                        class="px-6 py-2 bg-tsu-teal text-white font-semibold rounded-lg hover:bg-tsu-teal-dark transition shadow-md text-sm">Simpan
                        Logbook</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('logbookModal');
        const openBtn = document.getElementById('openModal');
        const emptyStateAdd = document.getElementById('emptyStateAdd');
        const closeBtn = document.getElementById('closeModal');
        const cancelBtn = document.getElementById('cancelModal');
        const form = document.getElementById('formLogbook');
        const tableBody = document.getElementById('logbookTableBody');
        const emptyState = document.getElementById('emptyState');
        const tableContainer = document.getElementById('tableContainer');
        const printActionContainer = document.getElementById('printActionContainer');

        function checkEmptyState() {
            if (tableBody.rows.length > 0) {
                emptyState.classList.add('hidden');
                tableContainer.classList.remove('hidden');
                printActionContainer.classList.remove('hidden');
            } else {
                emptyState.classList.remove('hidden');
                tableContainer.classList.add('hidden');
                printActionContainer.classList.add('hidden');
            }
        }

        function toggleModal() {
            modal.classList.toggle('hidden');
            modal.classList.toggle('flex');
        }

        openBtn.addEventListener('click', toggleModal);
        emptyStateAdd.addEventListener('click', toggleModal);
        closeBtn.addEventListener('click', toggleModal);
        cancelBtn.addEventListener('click', toggleModal);

        function formatDateDisplay(dateStr) {
            const [y, m, d] = dateStr.split('-');
            return `${d}/${m}/${y}`;
        }

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const tglMulai = document.getElementById('inputTanggalMulai').value;
            const tglSelesai = document.getElementById('inputTanggalSelesai').value;

            if (new Date(tglMulai) > new Date(tglSelesai)) {
                Swal.fire('Oops!', 'Tanggal Selesai tidak boleh mendahului Tanggal Mulai.', 'error');
                return;
            }

            Swal.fire({
                title: 'Simpan Logbook?',
                text: "Logbook yang ditambahkan tidak dapat diedit maupun dihapus.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#086375',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    processSave();
                }
            });

            function processSave() {
                fetch("{{ route('logbook.store') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json",
                        "Accept": "application/json"
                    },
                    body: JSON.stringify({
                        tanggal_mulai: inputTanggalMulai.value,
                        tanggal_selesai: inputTanggalSelesai.value,
                        nama_kegiatan: inputNama.value,
                        uraian_kegiatan: inputUraian.value,
                        jenis_logbook: inputJenis.value
                    })
                })
                    .then(res => res.json())
                    .then(res => {
                        if (!res.success) {
                            Swal.fire('Gagal', res.message, 'error');
                            return;
                        }

                        Swal.fire('Berhasil', 'Logbook disimpan', 'success')
                            .then(() => location.reload());
                    });
            }

        });

        document.getElementById('filterBtn').addEventListener('click', function () {
            const startVal = document.getElementById('filterStartDate').value;
            const endVal = document.getElementById('filterEndDate').value;
            const rows = tableBody.getElementsByTagName('tr');

            if (!startVal || !endVal) {
                Swal.fire('Info', 'Silakan tentukan periode tanggal terlebih dahulu.', 'info');
                return;
            }

            const fStart = new Date(startVal);
            const fEnd = new Date(endVal);

            for (let row of rows) {
                const rStart = new Date(row.getAttribute('data-start'));
                const rEnd = new Date(row.getAttribute('data-end'));
                if (rStart >= fStart && rEnd <= fEnd) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            }
        });

        document.getElementById('resetFilter').addEventListener('click', () => {
            location.reload();
        });

        function exportToWord() {
            const table = document.getElementById('logbookTable').cloneNode(true);
            table.setAttribute('border', '1');
            table.style.borderCollapse = 'collapse';
            table.style.width = '100%';

            const header = `
                    <html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'>
                    <head><meta charset='utf-8'>
                    <style>
                        body { font-family: 'Arial'; }
                        table { border: 1px solid black; border-collapse: collapse; width: 100%; }
                        th { background-color: #086375; color: white; border: 1px solid black; padding: 5px; }
                        td { border: 1px solid black; padding: 5px; }
                        .title { text-align: center; font-size: 16pt; font-weight: bold; }
                    </style></head><body>
                    <div class="title">LOGBOOK KEGIATAN MAGANG TSU</div><br>
                `;
            const footer = "</body></html>";
            const blob = new Blob(['\ufeff', header + table.outerHTML + footer], { type: 'application/msword' });
            const url = URL.createObjectURL(blob);
            const link = document.createElement('a');
            link.href = url;
            link.download = 'Logbook_TSU.doc';
            link.click();
        }

        checkEmptyState();
    </script>

@endsection