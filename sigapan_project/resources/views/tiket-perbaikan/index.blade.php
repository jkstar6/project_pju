@extends('layouts.admin.master')

@section('title', 'Tiket Perbaikan')

@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('tiket-perbaikan') }} --}}
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">

    <style>
        #data-table td.text-center { vertical-align: middle; }
        #data-table td.text-center .status-select { margin: 0 auto; display: inline-block; min-width: 120px; }

        /* simple modal */
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

            {{-- ✅ BUTTON CREATE --}}
            <div class="mt-3 sm:mt-0">
                <button
                    type="button"
                    id="btnOpenCreate"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-primary-500 text-white hover:bg-primary-600 transition"
                >
                    <i class="material-symbols-outlined !text-md">add</i>
                    Tambah
                </button>
            </div>
        </div>

        <div class="trezo-card-content" id="dataTable">
            <div class="table-responsive overflow-x-auto p-2">
                <table id="data-table" class="display stripe group" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">No. Tiket</th>
                            <th class="text-left">Lokasi</th>
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
                            <tr data-id="{{ $tiket['id'] }}">
                                <td class="text-center">
                                    <strong class="text-primary-500">{{ $tiket['no_tiket'] }}</strong>
                                </td>

                                <td class="text-left">
                                    <div>
                                        <strong>{{ $tiket['kode_aset'] }}</strong><br>
                                        <small class="text-gray-500">{{ $tiket['lokasi_aset'] }}</small>
                                    </div>
                                </td>

                                <td class="text-left">{{ $tiket['nama_pelapor'] }}</td>
                                <td class="text-left">{{ $tiket['nama_tim'] ?? '-' }}</td>

                                <td class="text-center">
                                    {{ $tiket['tgl_jadwal'] ? date('d M Y', strtotime($tiket['tgl_jadwal'])) : '-' }}
                                </td>

                                <td class="text-center">
                                    <span class="px-[8px] py-[3px] inline-block rounded-sm font-medium text-xs
                                        {{ $tiket['prioritas'] == 'Mendesak'
                                            ? 'bg-red-100 dark:bg-[#15203c] text-red-600'
                                            : 'bg-gray-100 dark:bg-[#15203c] text-gray-600' }}">
                                        {{ $tiket['prioritas'] }}
                                    </span>
                                </td>

                                {{-- ✅ STATUS: dropdown 1 aja --}}
                                <td class="text-center">
                                    <select class="status-select border border-gray-200 dark:border-[#15203c] rounded-md px-2 py-1 text-sm bg-white dark:bg-[#0c1427]"
                                            data-id="{{ $tiket['id'] }}">
                                        <option value="Menunggu" {{ $tiket['status_tindakan']=='Menunggu'?'selected':'' }}>Menunggu</option>
                                        <option value="Proses" {{ $tiket['status_tindakan']=='Proses'?'selected':'' }}>Proses</option>
                                        <option value="Selesai" {{ $tiket['status_tindakan']=='Selesai'?'selected':'' }}>Selesai</option>
                                    </select>
                                </td>

                                <td class="text-center">
                                    @if ($tiket['perlu_surat_pln'])
                                        <span class="px-[8px] py-[3px] inline-block bg-orange-100 dark:bg-[#15203c] text-orange-600 rounded-sm font-medium text-xs">
                                            Perlu
                                        </span>
                                    @else
                                        <span class="px-[8px] py-[3px] inline-block bg-gray-100 dark:bg-[#15203c] text-gray-600 rounded-sm font-medium text-xs">
                                            Tidak
                                        </span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <div class="flex items-center gap-[9px] justify-center">
                                        <a href="{{ route('tiket-perbaikan.show', $tiket['id']) }}"
                                           class="text-primary-500 leading-none custom-tooltip"
                                           data-text="Detail">
                                            <i class="material-symbols-outlined !text-md">visibility</i>
                                        </a>

                                        {{-- frontend-only edit --}}
                                        <button type="button"
                                                class="btn-edit text-blue-600 leading-none custom-tooltip"
                                                data-text="Edit (UI)">
                                            <i class="material-symbols-outlined !text-md">edit</i>
                                        </button>

                                        {{-- frontend-only delete --}}
                                        <button type="button"
                                                class="btn-delete text-red-600 leading-none custom-tooltip"
                                                data-text="Hapus (UI)">
                                            <i class="material-symbols-outlined !text-md">delete</i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    {{-- ✅ MODAL CREATE (FRONTEND ONLY) --}}
    <div id="modalCreate" class="modal-overlay fixed inset-0 z-[999] items-center justify-center bg-black/50 p-4">
        <div class="w-full max-w-xl rounded-md bg-white dark:bg-[#0c1427] p-5">
            <div class="flex items-center justify-between mb-4">
                <h5 class="mb-0 font-semibold text-gray-800 dark:text-gray-100">Tambah Tiket</h5>
                <button type="button" class="btn-close-modal text-gray-500 hover:text-gray-800 dark:hover:text-gray-200">
                    <i class="material-symbols-outlined">close</i>
                </button>
            </div>

            <form id="formCreate" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">No. Tiket</label>
                    <input name="no_tiket" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Kode Aset</label>
                    <input name="kode_aset" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
                </div>

                <div class="md:col-span-2">
                    <label class="text-sm text-gray-600 dark:text-gray-300">Lokasi Aset</label>
                    <input name="lokasi_aset" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Pelapor</label>
                    <input name="nama_pelapor" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Tim Teknisi</label>
                    <input name="nama_tim" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" placeholder="Opsional">
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Jadwal</label>
                    <input type="date" name="tgl_jadwal" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]">
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Prioritas</label>
                    <select name="prioritas" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]">
                        <option value="Biasa">Biasa</option>
                        <option value="Mendesak">Mendesak</option>
                    </select>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Status</label>
                    <select name="status_tindakan" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]">
                        <option value="Menunggu">Menunggu</option>
                        <option value="Proses">Proses</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Surat PLN</label>
                    <select name="perlu_surat_pln" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]">
                        <option value="0">Tidak</option>
                        <option value="1">Perlu</option>
                    </select>
                </div>

                <div class="md:col-span-2 flex justify-end gap-2 mt-2">
                    <button type="button" class="btn-close-modal px-4 py-2 rounded-md bg-gray-100 dark:bg-[#15203c] text-gray-700 dark:text-gray-200">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-md bg-primary-500 text-white hover:bg-primary-600">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.tailwindcss.js') }}"></script>

    <script>
        // ===== DataTables init (biar alignment konsisten) =====
        const dt = $('#data-table').DataTable({
            responsive: true,
            pageLength: 25,
            columnDefs: [
                { targets: [0,4,5,6,7,8], className: 'text-center' },
                { targets: [1,2,3], className: 'text-left' }
            ]
        });

        // ===== Dropdown status style =====
        function statusClass(status) {
            if (status === 'Menunggu') return ['bg-orange-50','text-orange-700','border-orange-200'];
            if (status === 'Proses') return ['bg-blue-50','text-blue-700','border-blue-200'];
            return ['bg-green-50','text-green-700','border-green-200']; // Selesai
        }
        function applyStatusStyle(select) {
            const remove = [
                'bg-orange-50','text-orange-700','border-orange-200',
                'bg-blue-50','text-blue-700','border-blue-200',
                'bg-green-50','text-green-700','border-green-200'
            ];
            select.classList.remove(...remove);
            select.classList.add(...statusClass(select.value));
        }
        document.querySelectorAll('.status-select').forEach(applyStatusStyle);

        // delegation (aman utk DataTables redraw)
        document.addEventListener('change', function(e){
            if (!e.target.classList.contains('status-select')) return;
            applyStatusStyle(e.target);
        });

        // ===== Modal open/close =====
        function openModal() { document.getElementById('modalCreate').classList.add('active'); }
        function closeModal() { document.getElementById('modalCreate').classList.remove('active'); }

        document.getElementById('btnOpenCreate').addEventListener('click', () => {
            document.getElementById('formCreate').reset();
            openModal();
        });

        document.addEventListener('click', function(e) {
            if (e.target.closest('.btn-close-modal')) closeModal();
            if (e.target.id === 'modalCreate') closeModal();
        });

        // ===== Helper HTML create row =====
        function prioritasBadgeHtml(p) {
            const cls = (p === 'Mendesak')
                ? 'bg-red-100 dark:bg-[#15203c] text-red-600'
                : 'bg-gray-100 dark:bg-[#15203c] text-gray-600';
            return `<span class="px-[8px] py-[3px] inline-block rounded-sm font-medium text-xs ${cls}">${p}</span>`;
        }

        function suratBadgeHtml(perlu) {
            if (String(perlu) === '1') {
                return `<span class="px-[8px] py-[3px] inline-block bg-orange-100 dark:bg-[#15203c] text-orange-600 rounded-sm font-medium text-xs">Perlu</span>`;
            }
            return `<span class="px-[8px] py-[3px] inline-block bg-gray-100 dark:bg-[#15203c] text-gray-600 rounded-sm font-medium text-xs">Tidak</span>`;
        }

        function formatDateToDMY(dateStr) {
            if (!dateStr) return '-';
            const d = new Date(dateStr);
            if (isNaN(d.getTime())) return '-';
            return d.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
        }

        // ===== Create submit (frontend only) =====
        document.getElementById('formCreate').addEventListener('submit', function(e) {
            e.preventDefault();

            const fd = new FormData(this);
            const payload = Object.fromEntries(fd.entries());

            const id = Date.now();
            const no_tiket = payload.no_tiket || '-';
            const kode_aset = payload.kode_aset || '-';
            const lokasi_aset = payload.lokasi_aset || '-';
            const nama_pelapor = payload.nama_pelapor || '-';
            const nama_tim = payload.nama_tim ? payload.nama_tim : '-';
            const tgl_raw = payload.tgl_jadwal || '';
            const tgl_label = tgl_raw ? formatDateToDMY(tgl_raw) : '-';
            const prioritas = payload.prioritas || 'Biasa';
            const status = payload.status_tindakan || 'Menunggu';
            const perlu = payload.perlu_surat_pln || '0';

            const statusSelectHtml = `
                <select class="status-select border border-gray-200 dark:border-[#15203c] rounded-md px-2 py-1 text-sm bg-white dark:bg-[#0c1427]"
                        data-id="${id}">
                    <option value="Menunggu" ${status==='Menunggu'?'selected':''}>Menunggu</option>
                    <option value="Proses" ${status==='Proses'?'selected':''}>Proses</option>
                    <option value="Selesai" ${status==='Selesai'?'selected':''}>Selesai</option>
                </select>
            `;

            const aksiHtml = `
                <div class="flex items-center gap-[9px] justify-center">
                    <a href="javascript:void(0)" class="text-primary-500 leading-none custom-tooltip" data-text="Detail">
                        <i class="material-symbols-outlined !text-md">visibility</i>
                    </a>
                    <button type="button" class="btn-edit text-blue-600 leading-none custom-tooltip" data-text="Edit (UI)">
                        <i class="material-symbols-outlined !text-md">edit</i>
                    </button>
                    <button type="button" class="btn-delete text-red-600 leading-none custom-tooltip" data-text="Hapus (UI)">
                        <i class="material-symbols-outlined !text-md">delete</i>
                    </button>
                </div>
            `;

            const node = dt.row.add([
                `<strong class="text-primary-500">${no_tiket}</strong>`,
                `<div><strong>${kode_aset}</strong><br><small class="text-gray-500">${lokasi_aset}</small></div>`,
                `${nama_pelapor}`,
                `${nama_tim}`,
                `${tgl_label}`,
                prioritasBadgeHtml(prioritas),
                statusSelectHtml,
                suratBadgeHtml(perlu),
                aksiHtml
            ]).draw(false).node();

            // store id for delete etc
            node.dataset.id = id;

            // apply warna dropdown di row baru
            node.querySelectorAll('.status-select').forEach(applyStatusStyle);

            closeModal();
        });

        // ===== delete row (frontend only) =====
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.btn-delete');
            if (!btn) return;

            const tr = btn.closest('tr');
            if (confirm('Hapus tiket ini? (frontend-only)')) {
                dt.row(tr).remove().draw(false);
            }
        });
    </script>
@endpush
