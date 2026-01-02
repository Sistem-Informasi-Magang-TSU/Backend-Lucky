@extends('layouts.app')

@section('title', 'Logbook Kegiatan Magang')

@section('header_title', 'Logbook Kegiatan')

@section('content')

    <div class=" fade-up bg-tsu-teal text-white rounded-xl p-6 mb-8 shadow-md">
        <h2 class="text-xl font-bold mb-2">Jangan lupa untuk Mengisi Logbook!</h2>
        <p class="text-sm text-gray-200 font-light">
            Catat semua kegiatan Anda di sini untuk dinilai oleh Pembimbing.
        </p>
    </div>

    <div class="fade-up delay-100 bg-white p-6 rounded-xl shadow-md border border-gray-200">
        
        <div class="flex justify-between items-center mb-6">
            <div class="fade-up delay-100 flex items-center gap-4">
                <input type="date" id="filterDate" class="border border-gray-300 rounded-md p-2 text-sm focus:ring-tsu-teal focus:border-tsu-teal">
                <button id="filterBtn" class="bg-tsu-teal text-white text-sm font-semibold py-2 px-4 rounded-md hover:bg-tsu-teal-dark transition">
                    Cari
                </button>
            </div>

            <button id="openModal" class="fade-up delay-300 bg-tsu-blue text-white text-sm font-semibold py-2 px-4 rounded-full shadow-md hover:bg-blue-700 transition flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Logbook
            </button>
        </div>

        <div class="relative">
            
            <div id="emptyState" class="fade-up delay-400 flex flex-col items-center justify-center py-20 px-4">
                <h3 class="text-lg font-bold text-gray-700 text-center">Kelihatannya Kamu Belum Mempunyai Logbook</h3>
                <p class="text-gray-500 text-sm text-center">
                    Klik 
                    <span id="emptyStateAdd" class="text-tsu-blue font-semibold uppercase cursor-pointer hover:underline">
                        Tambah Logbook
                    </span> 
                    Untuk Mengisinya
                </p>
            </div>

            <div id="tableContainer" class="overflow-x-auto hidden">
                <table class="min-w-full border-collapse rounded-lg overflow-hidden">
                    <thead class="bg-tsu-teal text-white text-xs md:text-sm shadow-md">
                        <tr>
                            <th class="py-3 px-4 text-center font-semibold w-12 rounded-tl-lg border-r border-white/20">No</th>
                            <th class="py-3 px-4 text-center font-semibold w-28 border-r border-white/20">Tanggal</th>
                            <th class="py-3 px-4 text-center font-semibold w-1/4 border-r border-white/20">Nama Kegiatan</th>
                            <th class="py-3 px-4 text-center font-semibold border-r border-white/20">Uraian Kegiatan</th>
                            <th class="py-3 px-4 text-center font-semibold w-32 whitespace-nowrap border-r border-white/20">Jenis Logbook</th>
                            <th class="py-3 px-4 text-center font-semibold w-32 rounded-tr-lg">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        </tbody>
                </table>
            </div>
        </div>

        <div class="fade-up delay-00 bg-yellow-50 border-l-4 border-yellow-400 p-3 mt-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="fade-up delay-500 ml-3">
                    <p class="text-xs text-yellow-700">
                        Peringatan: Logbook yang telah ditambahkan <strong>tidak dapat diubah atau dihapus</strong> kembali.
                    </p>
                </div>
            </div>
        </div>

    <div id="logbookModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-40 backdrop-blur-sm transition-opacity duration-300">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl p-0 overflow-hidden transform transition-all scale-95 duration-300" id="logbookModalContent">
            
            <div class="bg-tsu-teal p-4 text-white flex justify-between items-center">
                <h3 class="text-lg font-bold">Tambah Logbook Baru</h3>
                <button id="closeModal" class="text-white hover:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

    <form id="formLogbook" class="p-6 space-y-4">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal</label>
                <input type="date" id="inputTanggal" required class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-tsu-teal focus:border-tsu-teal outline-none transition">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis Logbook</label>
                <select id="inputJenis" required class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-tsu-teal focus:border-tsu-teal outline-none transition">
                    <option value="Mingguan">Mingguan</option>
                    <option value="Bulanan">Bulanan</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Kegiatan</label>
            <input type="text" id="inputNama" placeholder="Contoh: Implementasi UI Login" required class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-tsu-teal focus:border-tsu-teal outline-none transition">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Uraian Kegiatan</label>
            <textarea id="inputUraian" rows="4" placeholder="Jelaskan secara detail apa yang Anda kerjakan..." required class="w-full border border-gray-300 rounded-lg p-2.5 text-sm focus:ring-tsu-teal focus:border-tsu-teal outline-none transition"></textarea>
        </div>

        <div class="flex justify-end gap-3 mt-6 border-t pt-4">
            <button type="button" id="cancelModal" class="px-6 py-2 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition text-sm">
                Batal
            </button>
            <button type="submit" class="px-6 py-2 bg-tsu-teal text-white font-semibold rounded-lg hover:bg-tsu-teal-dark transition shadow-md text-sm">
                Simpan Logbook
            </button>
        </div>
    </form>

    <script>
        const modal = document.getElementById('logbookModal');
        const openBtn = document.getElementById('openModal');
        const emptyStateAdd = document.getElementById('emptyStateAdd');
        const closeBtn = document.getElementById('closeModal');
        const cancelBtn = document.getElementById('cancelModal');
        const form = document.getElementById('formLogbook');
        const tableBody = document.querySelector('tbody');
        const emptyState = document.getElementById('emptyState');
        const tableContainer = document.getElementById('tableContainer');

        const filterDateInput = document.getElementById('filterDate');
        const filterBtn = document.getElementById('filterBtn');

        function checkEmptyState() {
            if (tableBody.rows.length > 0) {
                emptyState.classList.add('hidden');
                tableContainer.classList.remove('hidden');
            } else {
                emptyState.classList.remove('hidden');
                tableContainer.classList.add('hidden');
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

        filterBtn.addEventListener('click', function() {
            const filterValue = filterDateInput.value;
            const rows = tableBody.getElementsByTagName('tr');

            if (!filterValue) {
                for (let row of rows) row.style.display = "";
                return;
            }

            const [year, month, day] = filterValue.split('-');
            const formattedFilter = `${day}/${month}/${year}`;

            for (let row of rows) {
                const dateCell = row.cells[1].textContent;
                if (dateCell === formattedFilter) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            }
        });

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const konfirmasi = confirm("Apakah Anda yakin? Logbook yang ditambahkan tidak bisa dihapus atau diubah lagi.");
            if (!konfirmasi) return;

            const tanggal = document.getElementById('inputTanggal').value;
            const jenis = document.getElementById('inputJenis').value;
            const nama = document.getElementById('inputNama').value;
            const uraian = document.getElementById('inputUraian').value;

            const submitBtn = form.querySelector('button[type="submit"]');
            submitBtn.innerHTML = 'Memproses...';
            submitBtn.disabled = true;

            setTimeout(() => {
                const nextNumber = tableBody.rows.length + 1;
                const newRow = document.createElement('tr');
                newRow.className = "bg-white hover:bg-gray-50 transition text-sm";
                
                const dateParts = tanggal.split('-');
                const formattedDate = `${dateParts[2]}/${dateParts[1]}/${dateParts[0]}`;

                newRow.innerHTML = `
                    <td class="py-3 px-4 text-center text-gray-700 font-bold text-tsu-teal border-r border-gray-100">${nextNumber}</td>
                    <td class="py-3 px-4 text-center text-gray-700 font-medium border-r border-gray-100">${formattedDate}</td>
                    <td class="py-3 px-4 text-left text-gray-800 font-medium border-r border-gray-100">${nama}</td>
                    <td class="py-3 px-4 text-left text-gray-600 leading-relaxed border-r border-gray-100">${uraian}</td>
                    <td class="py-3 px-4 text-center text-gray-700 whitespace-nowrap font-medium border-r border-gray-100">${jenis}</td>
                    <td class="py-3 px-4 text-center">
                        <span class="inline-block px-3 py-1 text-xs font-semibold leading-none rounded-full text-yellow-700 bg-yellow-100 whitespace-nowrap">
                            Belum Divalidasi
                        </span>
                    </td>
                `;

                tableBody.appendChild(newRow);
                checkEmptyState();
                toggleModal();
                
                submitBtn.innerHTML = 'Simpan Logbook';
                submitBtn.disabled = false;
                form.reset();
            }, 800);
        });

        window.addEventListener('click', (e) => {
            if (e.target === modal) toggleModal();
        });

        checkEmptyState();
    </script>

@endsection