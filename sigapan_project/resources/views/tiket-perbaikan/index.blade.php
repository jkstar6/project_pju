@extends('layouts.admin.master')

@section('title', 'Tiket Perbaikan')

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        #data-table td.text-center { vertical-align: middle; }
        .modal-overlay { display: none; }
        .modal-overlay.active { display: flex; }
    </style>
@endpush

@section('content')
    @php
        // ✅ Tiket Perbaikan: Admin & Teknisi bisa create/update. Survey read-only.
        $canManageTiket = auth()->check() && auth()->user()->hasAnyRole(['Admin','Teknisi']);
    @endphp

    <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
        <div class="trezo-card-header mb-[20px] md:mb-[25px] sm:flex sm:items-center sm:justify-between">
            <div class="trezo-card-title">
                <h5 class="mb-0">Daftar @yield('title')</h5>
            </div>

            {{-- ✅ CREATE hanya Admin & Teknisi --}}
            @if($canManageTiket)
                <div class="mt-3 sm:mt-0">
                    <button type="button" id="btnOpenCreate"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-primary-500 text-white hover:bg-primary-600 transition">
                        <i class="material-symbols-outlined !text-md">add</i>
                        Buat Tiket Baru
                    </button>
                </div>
            @endif
        </div>

        <div class="trezo-card-content" id="dataTable">
            <div class="table-responsive overflow-x-auto p-2">
                <table id="data-table" class="display stripe group" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-left">Info Aduan</th>
                            <th class="text-left">Tim Teknisi</th>
                            <th class="text-center">Jadwal</th>
                            <th class="text-center">Prioritas</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($tiketPerbaikan as $tiket)
                            @php
                                $statusClass = match($tiket->status_tindakan) {
                                    'Menunggu' => 'bg-yellow-100 text-yellow-700',
                                    'Proses' => 'bg-blue-100 text-blue-700',
                                    'Selesai' => 'bg-green-100 text-green-700',
                                    default => 'bg-gray-100 text-gray-600'
                                };
                            @endphp

                            <tr
                                data-id="{{ $tiket->id }}"
                                data-tgl_jadwal="{{ $tiket->tgl_jadwal }}"
                                data-prioritas="{{ $tiket->prioritas }}"
                                data-status_tindakan="{{ $tiket->status_tindakan }}"
                                data-perlu_surat_pln="{{ $tiket->perlu_surat_pln ? 1 : 0 }}"
                            >
                                <td class="text-center">
                                    <strong class="text-primary-500">#{{ $tiket->id }}</strong>
                                </td>

                                <td class="text-left">
                                    <div class="text-sm">
                                        <div class="font-bold text-gray-800 dark:text-gray-200">
                                            {{ optional($tiket->pengaduan)->tipe_aduan ?? '-' }}
                                        </div>
                                        <div class="text-xs text-primary-600 font-semibold">
                                            Tiang: {{ optional($tiket->aset_pju)->kode_tiang ?? 'Belum Ditautkan' }}
                                        </div>
                                        <div class="text-xs text-gray-500 italic truncate max-w-[200px]">
                                            {{ optional($tiket->pengaduan)->deskripsi_lokasi ?? '-' }}
                                        </div>
                                    </div>
                                </td>

                                <td class="text-left">
                                    <span class="font-medium">
                                        {{ optional($tiket->tim_lapangan)->nama_tim ?? 'Belum Ditugaskan' }}
                                    </span>
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
                                    <span class="px-[8px] py-[3px] rounded-sm font-medium text-xs {{ $statusClass }}">
                                        {{ $tiket->status_tindakan }}
                                    </span>
                                </td>

                                <td class="text-center">
                                    <div class="flex items-center gap-[5px] justify-center">
                                        <a href="{{ route('tiket-perbaikan.show', $tiket->id) }}"
                                           class="text-primary-500 hover:text-primary-700 transition custom-tooltip"
                                           data-text="Detail Tiket">
                                            <i class="material-symbols-outlined !text-md">visibility</i>
                                        </a>

                                        {{-- ✅ EDIT hanya Admin & Teknisi --}}
                                        @if($canManageTiket)
                                            <button type="button"
                                                class="btn-edit text-blue-600 hover:text-blue-800 transition custom-tooltip"
                                                data-text="Edit Tiket">
                                                <i class="material-symbols-outlined !text-md">edit</i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    {{-- ✅ MODAL CREATE hanya Admin & Teknisi --}}
    @if($canManageTiket)
        <div id="modalCreate" class="modal-overlay fixed inset-0 z-[999] items-center justify-center bg-black/50 p-4">
            <div class="w-full max-w-4xl rounded-md bg-white dark:bg-[#0c1427] p-5 shadow-lg relative max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between mb-4 border-b pb-2">
                    <h5 class="mb-0 font-semibold text-gray-800 dark:text-gray-100">Buat Tiket: Pilih Aduan, Tim, & Aset</h5>
                    <button type="button" class="btn-close-modal text-gray-500 hover:text-red-500">
                        <i class="material-symbols-outlined">close</i>
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-[#15203c] dark:text-gray-400">
                            <tr>
                                <th class="px-4 py-3">Pelapor / Tgl</th>
                                <th class="px-4 py-3">Penugasan & Aset</th>
                                <th class="px-4 py-3">Aduan</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="aduanListBody">
                            <tr><td colspan="4" class="text-center py-4">Memuat data...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ✅ MODAL EDIT hanya Admin & Teknisi --}}
        <div id="modalEdit" class="modal-overlay fixed inset-0 z-[999] items-center justify-center bg-black/50 p-4">
            <div class="w-full max-w-lg rounded-md bg-white dark:bg-[#0c1427] p-5 shadow-lg">
                <div class="flex items-center justify-between mb-4 border-b pb-2">
                    <h5 class="mb-0 font-semibold text-gray-800 dark:text-gray-100">Edit Tiket Perbaikan</h5>
                    <button type="button" class="btn-close-modal text-gray-500 hover:text-red-500">
                        <i class="material-symbols-outlined">close</i>
                    </button>
                </div>

                <form id="formEdit">
                    <input type="hidden" id="edit_id" name="id">

                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Jadwal Pengerjaan</label>
                            <input type="date" id="edit_tgl_jadwal" name="tgl_jadwal"
                                   class="w-full border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Prioritas</label>
                            <select id="edit_prioritas" name="prioritas"
                                    class="w-full border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]">
                                <option value="Biasa">Biasa</option>
                                <option value="Mendesak">Mendesak</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Status Tindakan</label>
                            <select id="edit_status" name="status_tindakan"
                                    class="w-full border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]">
                                <option value="Menunggu">Menunggu</option>
                                <option value="Proses">Proses</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1 text-gray-700 dark:text-gray-300">Butuh Surat PLN?</label>
                            <select id="edit_perlu_surat_pln" name="perlu_surat_pln"
                                    class="w-full border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]">
                                <option value="0">Tidak</option>
                                <option value="1">Perlu</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 mt-6">
                        <button type="button" class="btn-close-modal px-4 py-2 rounded-md bg-gray-100 text-gray-700">Batal</button>
                        <button type="submit" class="px-4 py-2 rounded-md bg-primary-500 text-white">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endsection

@push('scripts')
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.tailwindcss.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Init DataTable Utama
        $('#data-table').DataTable({ responsive: true });

        const CAN_MANAGE_TIKET = @json($canManageTiket);
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        // Master Data dari Controller
        const listTim = @json($tims);
        const listAset = @json($asets);

        function openModal(modalId){ document.getElementById(modalId)?.classList.add('active'); }
        function closeModal(modalId){ document.getElementById(modalId)?.classList.remove('active'); }

        // ====== READ-ONLY: Survey stop di sini ======
        if (!CAN_MANAGE_TIKET) {
            // Survey hanya lihat list + detail.
        } else {

            // ====== Close modal buttons ======
            document.addEventListener('click', function(e){
                if (e.target.closest('.btn-close-modal')) {
                    closeModal('modalCreate');
                    closeModal('modalEdit');
                }
                const modalCreate = document.getElementById('modalCreate');
                const modalEdit = document.getElementById('modalEdit');
                if (e.target === modalCreate) closeModal('modalCreate');
                if (e.target === modalEdit) closeModal('modalEdit');
            });

            // ====== OPEN CREATE ======
            document.getElementById('btnOpenCreate')?.addEventListener('click', function() {
                openModal('modalCreate');
                fetchVerifiedAduan();
            });

            // ====== FETCH ADUAN ======
            function fetchVerifiedAduan() {
                const tbody = document.getElementById('aduanListBody');
                tbody.innerHTML = '<tr><td colspan="4" class="text-center py-4 text-gray-400 italic">Memuat data...</td></tr>';

                fetch("{{ route('tiket-perbaikan.get-verified-aduan') }}")
                    .then(res => res.json())
                    .then(data => {
                        tbody.innerHTML = '';
                        if (!data || data.length === 0) {
                            tbody.innerHTML = '<tr><td colspan="4" class="text-center py-4">Tidak ada aduan baru.</td></tr>';
                            return;
                        }

                        const timTeknisi = (listTim || []).filter(t => t.kategori === 'Teknisi');

                        data.forEach(item => {
                            let timOptions = `<option value="">-- Pilih Tim Teknisi --</option>`;
                            timTeknisi.forEach(t => timOptions += `<option value="${t.id}">${t.nama_tim}</option>`);

                            let asetOptions = `<option value="">-- Pilih Kode Tiang --</option>`;
                            (listAset || []).forEach(a => {
                                const lok = a.desa ? ` (${a.desa})` : '';
                                asetOptions += `<option value="${a.id}">${a.kode_tiang}${lok}</option>`;
                            });

                            const row = `
                                <tr class="bg-white border-b dark:bg-[#0c1427] dark:border-gray-700 hover:bg-gray-50/50">
                                    <td class="px-4 py-3 text-xs">
                                        <strong>${item.nama_pelapor ?? '-'}</strong><br>
                                        <span class="text-gray-400">${item.created_at ? new Date(item.created_at).toLocaleDateString('id-ID') : '-'}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex flex-col gap-2 min-w-[200px]">
                                            <select id="sel_tim_${item.id}" class="text-xs border rounded px-2 py-1 dark:bg-[#0c1427] dark:border-gray-600 dark:text-white">
                                                ${timOptions}
                                            </select>
                                            <select id="sel_aset_${item.id}" class="text-xs border rounded px-2 py-1 dark:bg-[#0c1427] dark:border-gray-600 dark:text-white">
                                                ${asetOptions}
                                            </select>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-xs">
                                        <span class="font-semibold text-blue-600">${item.tipe_aduan ?? '-'}</span><br>
                                        <span class="text-gray-400 italic">${(item.deskripsi_lokasi ?? '').substring(0, 30)}...</span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <button data-aduan-id="${item.id}" class="btn-buat-tiket px-3 py-2 text-xs font-medium text-white bg-green-600 rounded hover:bg-green-700 shadow-sm">
                                            Buat Tiket
                                        </button>
                                    </td>
                                </tr>
                            `;
                            tbody.insertAdjacentHTML('beforeend', row);
                        });
                    })
                    .catch(() => {
                        tbody.innerHTML = '<tr><td colspan="4" class="text-center text-red-500">Error fetch data.</td></tr>';
                    });
            }

            // ====== CREATE TIKET (delegation) ======
            document.addEventListener('click', function(e){
                const btn = e.target.closest('.btn-buat-tiket');
                if (!btn) return;

                const aduanId = btn.getAttribute('data-aduan-id');
                const tId = document.getElementById(`sel_tim_${aduanId}`)?.value;
                const aId = document.getElementById(`sel_aset_${aduanId}`)?.value;

                if (!tId || !aId) {
                    Swal.fire('Opps!', 'Pilih Tim Teknisi dan Kode Tiang dulu.', 'warning');
                    return;
                }

                fetch("{{ route('tiket-perbaikan.store') }}", {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                    body: JSON.stringify({ pengaduan_id: aduanId, tim_lapangan_id: tId, aset_pju_id: aId })
                })
                .then(res => res.json())
                .then(data => {
                    if (data?.success) {
                        Swal.fire('Berhasil', data.message, 'success').then(() => location.reload());
                    } else {
                        Swal.fire('Gagal', data?.message ?? 'Tidak dapat membuat tiket.', 'error');
                    }
                })
                .catch(() => Swal.fire('Error', 'Kesalahan sistem.', 'error'));
            });

            // ====== OPEN EDIT (ambil dari dataset tr) ======
            document.addEventListener('click', function(e){
                const btnEdit = e.target.closest('.btn-edit');
                if (!btnEdit) return;

                const tr = btnEdit.closest('tr');
                const id = tr.dataset.id;

                openModal('modalEdit');

                document.getElementById('edit_id').value = id;
                document.getElementById('edit_tgl_jadwal').value = tr.dataset.tgl_jadwal || '';
                document.getElementById('edit_prioritas').value = tr.dataset.prioritas || 'Biasa';
                document.getElementById('edit_status').value = tr.dataset.status_tindakan || 'Menunggu';
                document.getElementById('edit_perlu_surat_pln').value = (tr.dataset.perlu_surat_pln == "1") ? "1" : "0";
            });

            // ====== SUBMIT EDIT ======
            document.getElementById('formEdit')?.addEventListener('submit', function(e) {
                e.preventDefault();
                const id = document.getElementById('edit_id').value;

                const payload = Object.fromEntries(new FormData(this).entries());
                payload.perlu_surat_pln = payload.perlu_surat_pln === "1" ? 1 : 0;

                fetch(`/tiket-perbaikan/${id}`, {
                    method: 'PUT',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                    body: JSON.stringify(payload)
                })
                .then(res => res.json())
                .then(data => {
                    if (data?.success) {
                        Swal.fire('Berhasil', data.message, 'success').then(() => location.reload());
                    } else {
                        Swal.fire('Gagal', data?.message ?? 'Tidak dapat update tiket.', 'error');
                    }
                })
                .catch(() => Swal.fire('Error', 'Kesalahan sistem.', 'error'));
            });
        }
    </script>
@endpush
