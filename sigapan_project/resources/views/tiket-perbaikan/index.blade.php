@extends('layouts.admin.master')

@section('title', 'Tiket Perbaikan')

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        #data-table td.text-center { vertical-align: middle; }
        
        /* Modal Styles */
        .modal-overlay { display: none; }
        .modal-overlay.active { display: flex; }
    </style>
@endpush

@section('content')
    <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
        <div class="trezo-card-header mb-[20px] md:mb-[25px] sm:flex sm:items-center sm:justify-between">
            <div class="trezo-card-title">
                <h5 class="mb-0">Daftar @yield('title')</h5>
            </div>

            <div class="mt-3 sm:mt-0">
                <button type="button" id="btnOpenCreate"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-primary-500 text-white hover:bg-primary-600 transition">
                    <i class="material-symbols-outlined !text-md">add</i>
                    Buat Tiket Baru
                </button>
            </div>
        </div>

        <div class="trezo-card-content" id="dataTable">
            <div class="table-responsive overflow-x-auto p-2">
                <table id="data-table" class="display stripe group" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-left">Info Aduan</th>
                            <th class="text-left">Pelapor</th>
                            <th class="text-left">Tim Teknisi</th>
                            <th class="text-center">Jadwal</th>
                            <th class="text-center">Prioritas</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Surat PLN</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tiketPerbaikan as $tiket)
                            <tr>
                                <td class="text-center">
                                    <strong class="text-primary-500">#{{ $tiket->id }}</strong>
                                </td>

                                <td class="text-left">
                                    <div class="text-sm">
                                        <div class="font-bold text-gray-800 dark:text-gray-200">
                                            {{ optional($tiket->pengaduan)->tipe_aduan ?? '-' }}
                                        </div>
                                        <div class="text-xs text-gray-500 italic truncate max-w-[200px]">
                                            {{ optional($tiket->pengaduan)->deskripsi_lokasi ?? '-' }}
                                        </div>
                                    </div>
                                </td>

                                <td class="text-left">
                                    {{ optional($tiket->pengaduan)->nama_pelapor ?? '-' }}<br>
                                    <span class="text-xs text-gray-400">{{ optional($tiket->pengaduan)->no_hp ?? '' }}</span>
                                </td>

                                <td class="text-left">
                                    {{ optional($tiket->tim_lapangan)->nama_tim ?? 'Tim Teknisi 1' }}
                                </td>

                                <td class="text-center">
                                    {{ $tiket->tgl_jadwal ? \Carbon\Carbon::parse($tiket->tgl_jadwal)->format('d M Y') : '-' }}
                                </td>

                                <td class="text-center">
                                    <span class="px-[8px] py-[3px] inline-block rounded-sm font-medium text-xs
                                        {{ $tiket->prioritas == 'Mendesak' ? 'bg-red-100 text-red-600' : 'bg-blue-100 text-blue-600' }}">
                                        {{ $tiket->prioritas }}
                                    </span>
                                </td>

                                <td class="text-center">
                                    @php
                                        $statusClass = match($tiket->status_tindakan) {
                                            'Menunggu' => 'bg-yellow-100 text-yellow-700',
                                            'Proses' => 'bg-blue-100 text-blue-700',
                                            'Selesai' => 'bg-green-100 text-green-700',
                                            default => 'bg-gray-100 text-gray-600'
                                        };
                                    @endphp
                                    <span class="px-[8px] py-[3px] rounded-sm font-medium text-xs {{ $statusClass }}">
                                        {{ $tiket->status_tindakan }}
                                    </span>
                                </td>

                                <td class="text-center">
                                    @if ($tiket->perlu_surat_pln)
                                        <span class="px-[8px] py-[3px] inline-block bg-orange-100 text-orange-600 rounded-sm font-medium text-xs border border-orange-200">
                                            Perlu
                                        </span>
                                    @else
                                        <span class="px-[8px] py-[3px] inline-block bg-gray-100 text-gray-600 rounded-sm font-medium text-xs border border-gray-200">
                                            Tidak
                                        </span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <div class="flex items-center gap-[5px] justify-center">
                                        
                                        {{-- BUTTON DETAIL (MATA) --}}
                                        <a href="{{ route('tiket-perbaikan.show', $tiket->id) }}" 
                                           class="text-primary-500 hover:text-primary-700 transition custom-tooltip" 
                                           data-text="Detail Tiket">
                                            <i class="material-symbols-outlined !text-md">visibility</i>
                                        </a>

                                        {{-- BUTTON EDIT --}}
                                        <button type="button" 
                                            onclick="openEditModal({{ json_encode($tiket) }})"
                                            class="text-blue-600 hover:text-blue-800 transition custom-tooltip" 
                                            data-text="Edit Tiket">
                                            <i class="material-symbols-outlined !text-md">edit</i>
                                        </button>

                                        {{-- BUTTON HAPUS --}}
                                        
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL CREATE (PILIH ADUAN) --}}
    <div id="modalCreate" class="modal-overlay fixed inset-0 z-[999] items-center justify-center bg-black/50 p-4">
        <div class="w-full max-w-3xl rounded-md bg-white dark:bg-[#0c1427] p-5 shadow-lg relative max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between mb-4 border-b pb-2">
                <h5 class="mb-0 font-semibold text-gray-800 dark:text-gray-100">Pilih Aduan Terverifikasi</h5>
                <button type="button" onclick="closeModal('modalCreate')" class="text-gray-500 hover:text-red-500">
                    <i class="material-symbols-outlined">close</i>
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-[#15203c] dark:text-gray-400">
                        <tr>
                            <th class="px-4 py-3">Tgl Aduan</th>
                            <th class="px-4 py-3">Pelapor</th>
                            <th class="px-4 py-3">Tipe & Lokasi</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="aduanListBody">
                        <tr>
                            <td colspan="4" class="text-center py-4">Memuat data...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT (UPDATE TIKET) --}}
    <div id="modalEdit" class="modal-overlay fixed inset-0 z-[999] items-center justify-center bg-black/50 p-4">
        <div class="w-full max-w-lg rounded-md bg-white dark:bg-[#0c1427] p-5 shadow-lg">
            <div class="flex items-center justify-between mb-4 border-b pb-2">
                <h5 class="mb-0 font-semibold text-gray-800 dark:text-gray-100">Edit Tiket Perbaikan</h5>
                <button type="button" onclick="closeModal('modalEdit')" class="text-gray-500 hover:text-red-500">
                    <i class="material-symbols-outlined">close</i>
                </button>
            </div>

            <form id="formEdit">
                <input type="hidden" id="edit_id" name="id">
                
                <div class="grid grid-cols-1 gap-4">
                    {{-- Jadwal --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jadwal Pengerjaan</label>
                        <input type="date" id="edit_tgl_jadwal" name="tgl_jadwal" 
                            class="w-full border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c] focus:ring-primary-500 focus:border-primary-500">
                    </div>

                    {{-- Prioritas --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Prioritas</label>
                        <select id="edit_prioritas" name="prioritas" class="w-full border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]">
                            <option value="Biasa">Biasa</option>
                            <option value="Mendesak">Mendesak</option>
                        </select>
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status Tindakan</label>
                        <select id="edit_status" name="status_tindakan" class="w-full border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]">
                            <option value="Menunggu">Menunggu</option>
                            <option value="Proses">Proses</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>

                    {{-- Surat PLN --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Butuh Surat PLN?</label>
                        <select id="edit_perlu_surat_pln" name="perlu_surat_pln" class="w-full border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]">
                            <option value="0">Tidak</option>
                            <option value="1">Perlu</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" onclick="closeModal('modalEdit')" class="px-4 py-2 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-md bg-primary-500 text-white hover:bg-primary-600">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.tailwindcss.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Init DataTable
        $('#data-table').DataTable({
            responsive: true,
            pageLength: 10,
            columnDefs: [
                { targets: [0,4,5,6,7,8], className: 'text-center' },
            ]
        });

        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        // ===== MODAL LOGIC =====
        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }

        // 1. OPEN CREATE MODAL (LOAD ADUAN)
        document.getElementById('btnOpenCreate').addEventListener('click', function() {
            document.getElementById('modalCreate').classList.add('active');
            fetchVerifiedAduan();
        });

        // Fetch Data Aduan Verified via AJAX
        function fetchVerifiedAduan() {
            const tbody = document.getElementById('aduanListBody');
            tbody.innerHTML = '<tr><td colspan="4" class="text-center py-4">Memuat data...</td></tr>';

            fetch("{{ route('tiket-perbaikan.get-verified-aduan') }}")
                .then(res => res.json())
                .then(data => {
                    tbody.innerHTML = '';
                    if(data.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="4" class="text-center py-4 text-gray-500">Tidak ada aduan verified yang belum ditiketkan.</td></tr>';
                        return;
                    }

                    data.forEach(item => {
                        const dateFormatted = new Date(item.created_at).toLocaleDateString('id-ID');
                        const row = `
                            <tr class="bg-white border-b dark:bg-[#0c1427] dark:border-gray-700 hover:bg-gray-50">
                                <td class="px-4 py-3">${dateFormatted}</td>
                                <td class="px-4 py-3 font-medium text-gray-900">${item.nama_pelapor}</td>
                                <td class="px-4 py-3">
                                    <span class="font-semibold text-blue-600">${item.tipe_aduan}</span><br>
                                    <span class="text-xs text-gray-500">${item.deskripsi_lokasi.substring(0, 50)}...</span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <button onclick="createTiket(${item.id})" 
                                        class="px-3 py-1 text-xs font-medium text-white bg-green-600 rounded hover:bg-green-700">
                                        Buat Tiket
                                    </button>
                                </td>
                            </tr>
                        `;
                        tbody.innerHTML += row;
                    });
                })
                .catch(err => {
                    tbody.innerHTML = '<tr><td colspan="4" class="text-center text-red-500">Gagal memuat data.</td></tr>';
                });
        }

        // 2. CREATE TIKET ACTION
        function createTiket(aduanId) {
            Swal.fire({
                title: 'Buat Tiket?',
                text: "Tiket akan dibuat dengan data default.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Buat',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch("{{ route('tiket-perbaikan.store') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: JSON.stringify({ pengaduan_id: aduanId })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if(data.success) {
                            Swal.fire('Berhasil', data.message, 'success').then(() => location.reload());
                        }
                    })
                    .catch(err => Swal.fire('Error', 'Terjadi kesalahan sistem', 'error'));
                }
            });
        }

        // 3. OPEN EDIT MODAL
        function openEditModal(tiket) {
            document.getElementById('modalEdit').classList.add('active');
            
            // Isi form dengan data yang ada
            document.getElementById('edit_id').value = tiket.id;
            document.getElementById('edit_tgl_jadwal').value = tiket.tgl_jadwal;
            document.getElementById('edit_prioritas').value = tiket.prioritas;
            document.getElementById('edit_status').value = tiket.status_tindakan;
            document.getElementById('edit_perlu_surat_pln').value = tiket.perlu_surat_pln ? "1" : "0";
        }

        // 4. SUBMIT EDIT
        document.getElementById('formEdit').addEventListener('submit', function(e) {
            e.preventDefault();
            const id = document.getElementById('edit_id').value;
            const formData = new FormData(this);
            const data = Object.fromEntries(formData.entries());

            // Convert "1"/"0" string to boolean logic
            data.perlu_surat_pln = data.perlu_surat_pln === "1" ? 1 : 0;

            fetch(`/tiket-perbaikan/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(data)
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    closeModal('modalEdit');
                    Swal.fire('Berhasil', data.message, 'success').then(() => location.reload());
                }
            })
            .catch(err => Swal.fire('Error', 'Gagal update data', 'error'));
        });

       
    </script>
@endpush