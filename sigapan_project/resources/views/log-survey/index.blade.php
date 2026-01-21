@extends('layouts.admin.master')

@section('title', 'Log Survey')

@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('log-survey') }} --}}
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">

    <style>
        #data-table td.text-center { vertical-align: middle; }
        #data-table td.text-center .select-sm { margin: 0 auto; display: inline-block; min-width: 130px; }

        /* modal */
        .modal-overlay { display: none; }
        .modal-overlay.active { display: flex; }

        /* FIX: clickable icon */
        #data-table td:last-child,
        #data-table td:last-child * { pointer-events: auto; }

        .btn-detail, .btn-edit, .btn-delete {
            position: relative;
            z-index: 10;
            cursor: pointer;
        }
    </style>
@endpush

@section('content')
    <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
        <div class="trezo-card-header mb-[20px] md:mb-[25px] sm:flex sm:items-center sm:justify-between">
            <div class="trezo-card-title">
                <h5 class="mb-0">
                    Data @yield('title') Harian
                </h5>
            </div>

            {{-- tombol tambah --}}
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
                            <th class="text-center">No.</th>
                            <th class="text-left">Kode Aset</th>
                            <th class="text-left">Lokasi</th>
                            <th class="text-left">Surveyor</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Kondisi</th>
                            <th class="text-center">Keberadaan</th>
                            <th class="text-left">Catatan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        {{-- @can('log-survey.read') --}}
                        @foreach ($logSurvey as $index => $log)
                            @php
                                $id = $log['id'];
                                $kode = $log['kode_aset'];
                                $lokasi = $log['lokasi_aset'];
                                $surveyor = $log['nama_surveyor'];
                                $tglRaw = $log['tgl_survey'];
                                $kondisi = $log['kondisi'];
                                $keberadaan = $log['keberadaan'];
                                $catatan = $log['catatan_kerusakan'] ?? '-';
                            @endphp

                            <tr
                                data-id="{{ $id }}"
                                data-is_db="1"
                                data-kode_aset="{{ $kode }}"
                                data-lokasi_aset="{{ $lokasi }}"
                                data-nama_surveyor="{{ $surveyor }}"
                                data-tgl_survey="{{ $tglRaw }}"
                                data-kondisi="{{ $kondisi }}"
                                data-keberadaan="{{ $keberadaan }}"
                                data-catatan_kerusakan="{{ $catatan }}"
                            >
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-left">{{ $kode }}</td>
                                <td class="text-left">{{ $lokasi }}</td>
                                <td class="text-left">{{ $surveyor }}</td>
                                <td class="text-center">{{ date('d M Y', strtotime($tglRaw)) }}</td>

                                <td class="text-center">
                                    <select
                                        class="select-sm kondisi-select border border-gray-200 dark:border-[#15203c] rounded-md px-2 py-1 text-sm bg-white dark:bg-[#0c1427]"
                                        data-id="{{ $id }}"
                                    >
                                        <option value="Nyala" {{ $kondisi=='Nyala'?'selected':'' }}>Nyala</option>
                                        <option value="Mati" {{ $kondisi=='Mati'?'selected':'' }}>Mati</option>
                                        <option value="Rusak Fisik" {{ $kondisi=='Rusak Fisik'?'selected':'' }}>Rusak Fisik</option>
                                    </select>
                                </td>

                                <td class="text-center">
                                    <select
                                        class="select-sm keberadaan-select border border-gray-200 dark:border-[#15203c] rounded-md px-2 py-1 text-sm bg-white dark:bg-[#0c1427]"
                                        data-id="{{ $id }}"
                                    >
                                        <option value="Ada" {{ $keberadaan=='Ada'?'selected':'' }}>Ada</option>
                                        <option value="Tidak Ada" {{ $keberadaan=='Tidak Ada'?'selected':'' }}>Tidak Ada</option>
                                    </select>
                                </td>

                                <td class="text-left">{{ $catatan }}</td>

                                <td class="text-center">
                                    <div class="flex items-center gap-[9px] justify-center">
                                        {{-- DETAIL (tanpa route, biar tidak error) --}}
                                        <a href="javascript:void(0)"
                                           class="btn-detail text-primary-500 leading-none custom-tooltip"
                                           data-id="{{ $id }}"
                                           data-text="Detail">
                                            <i class="material-symbols-outlined !text-md">visibility</i>
                                        </a>

                                        {{-- EDIT UI --}}
                                        <button type="button"
                                                class="btn-edit text-blue-600 leading-none custom-tooltip"
                                                data-text="Edit (UI)">
                                            <i class="material-symbols-outlined !text-md">edit</i>
                                        </button>

                                        {{-- DELETE DB (punya kamu) --}}
                                        <form action="{{ route('log-survey.destroy', $id) }}" method="post" class="d-inline js-delete-db">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"
                                                    onclick="confirmDelete(this);"
                                                    class="text-danger-500 leading-none custom-tooltip"
                                                    data-text="Delete">
                                                <i class="material-symbols-outlined !text-md">delete</i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        {{-- @endcan --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL CREATE --}}
    <div id="modalCreate" class="modal-overlay fixed inset-0 z-[999] items-center justify-center bg-black/50 p-4">
        <div class="w-full max-w-2xl rounded-md bg-white dark:bg-[#0c1427] p-5">
            <div class="flex items-center justify-between mb-4">
                <h5 class="mb-0 font-semibold text-gray-800 dark:text-gray-100">Tambah Log Survey</h5>
                <button type="button" class="btn-close-modal text-gray-500 hover:text-gray-800 dark:hover:text-gray-200">
                    <i class="material-symbols-outlined">close</i>
                </button>
            </div>

            <form id="formCreate" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Kode Aset</label>
                    <input name="kode_aset" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Surveyor</label>
                    <input name="nama_surveyor" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
                </div>

                <div class="md:col-span-2">
                    <label class="text-sm text-gray-600 dark:text-gray-300">Lokasi</label>
                    <input name="lokasi_aset" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Tanggal Survey</label>
                    <input type="date" name="tgl_survey" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Kondisi</label>
                    <select name="kondisi" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]">
                        <option value="Nyala">Nyala</option>
                        <option value="Mati">Mati</option>
                        <option value="Rusak Fisik">Rusak Fisik</option>
                    </select>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Keberadaan</label>
                    <select name="keberadaan" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]">
                        <option value="Ada">Ada</option>
                        <option value="Tidak Ada">Tidak Ada</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="text-sm text-gray-600 dark:text-gray-300">Catatan</label>
                    <textarea name="catatan_kerusakan" rows="3" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]"></textarea>
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

    {{-- MODAL EDIT --}}
    <div id="modalEdit" class="modal-overlay fixed inset-0 z-[999] items-center justify-center bg-black/50 p-4">
        <div class="w-full max-w-2xl rounded-md bg-white dark:bg-[#0c1427] p-5">
            <div class="flex items-center justify-between mb-4">
                <h5 class="mb-0 font-semibold text-gray-800 dark:text-gray-100">Edit Log Survey</h5>
                <button type="button" class="btn-close-modal text-gray-500 hover:text-gray-800 dark:hover:text-gray-200">
                    <i class="material-symbols-outlined">close</i>
                </button>
            </div>

            <form id="formEdit" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="hidden" name="id">

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Kode Aset</label>
                    <input name="kode_aset" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Surveyor</label>
                    <input name="nama_surveyor" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
                </div>

                <div class="md:col-span-2">
                    <label class="text-sm text-gray-600 dark:text-gray-300">Lokasi</label>
                    <input name="lokasi_aset" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Tanggal Survey</label>
                    <input type="date" name="tgl_survey" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Kondisi</label>
                    <select name="kondisi" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]">
                        <option value="Nyala">Nyala</option>
                        <option value="Mati">Mati</option>
                        <option value="Rusak Fisik">Rusak Fisik</option>
                    </select>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Keberadaan</label>
                    <select name="keberadaan" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]">
                        <option value="Ada">Ada</option>
                        <option value="Tidak Ada">Tidak Ada</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="text-sm text-gray-600 dark:text-gray-300">Catatan</label>
                    <textarea name="catatan_kerusakan" rows="3" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]"></textarea>
                </div>

                <div class="md:col-span-2 flex justify-end gap-2 mt-2">
                    <button type="button" class="btn-close-modal px-4 py-2 rounded-md bg-gray-100 dark:bg-[#15203c] text-gray-700 dark:text-gray-200">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-md bg-primary-500 text-white hover:bg-primary-600">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL DETAIL --}}
    <div id="modalDetail" class="modal-overlay fixed inset-0 z-[999] items-center justify-center bg-black/50 p-4">
        <div class="w-full max-w-xl rounded-md bg-white dark:bg-[#0c1427] p-5">
            <div class="flex items-center justify-between mb-4">
                <h5 class="mb-0 font-semibold text-gray-800 dark:text-gray-100">Detail Log Survey</h5>
                <button type="button" class="btn-close-modal text-gray-500 hover:text-gray-800 dark:hover:text-gray-200">
                    <i class="material-symbols-outlined">close</i>
                </button>
            </div>

            <div class="space-y-3 text-sm">
                <div class="flex justify-between gap-4"><span class="text-gray-500">Kode Aset</span><span id="dKode" class="font-medium">-</span></div>
                <div class="flex justify-between gap-4"><span class="text-gray-500">Lokasi</span><span id="dLokasi" class="font-medium">-</span></div>
                <div class="flex justify-between gap-4"><span class="text-gray-500">Surveyor</span><span id="dSurveyor" class="font-medium">-</span></div>
                <div class="flex justify-between gap-4"><span class="text-gray-500">Tanggal</span><span id="dTanggal" class="font-medium">-</span></div>
                <div class="flex justify-between gap-4"><span class="text-gray-500">Kondisi</span><span id="dKondisi" class="font-medium">-</span></div>
                <div class="flex justify-between gap-4"><span class="text-gray-500">Keberadaan</span><span id="dKeberadaan" class="font-medium">-</span></div>
                <div class="pt-2">
                    <div class="text-gray-500 mb-1">Catatan</div>
                    <div id="dCatatan" class="p-3 rounded-md bg-gray-50 dark:bg-[#15203c]">-</div>
                </div>
            </div>

            <div class="flex justify-end mt-4">
                <button type="button" class="btn-close-modal px-4 py-2 rounded-md bg-gray-100 dark:bg-[#15203c] text-gray-700 dark:text-gray-200">
                    Tutup
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.tailwindcss.js') }}"></script>

    <script>
        const dt = $('#data-table').DataTable({
            responsive: true,
            order: [[4, 'desc']],
            pageLength: 25,
            columnDefs: [
                { targets: [0,4,5,6,8], className: 'text-center' },
                { targets: [1,2,3,7], className: 'text-left' }
            ]
        });

        // dropdown styling
        function kondisiClass(val){
            if (val === 'Rusak Fisik') return ['bg-red-50','text-red-700','border-red-200'];
            if (val === 'Mati') return ['bg-orange-50','text-orange-700','border-orange-200'];
            return ['bg-blue-50','text-blue-700','border-blue-200'];
        }
        function keberadaanClass(val){
            if (val === 'Tidak Ada') return ['bg-red-50','text-red-700','border-red-200'];
            return ['bg-blue-50','text-blue-700','border-blue-200'];
        }
        function applySelectStyle(select, kind){
            const remove = [
                'bg-red-50','text-red-700','border-red-200',
                'bg-orange-50','text-orange-700','border-orange-200',
                'bg-blue-50','text-blue-700','border-blue-200'
            ];
            select.classList.remove(...remove);
            const add = (kind === 'kondisi') ? kondisiClass(select.value) : keberadaanClass(select.value);
            select.classList.add(...add);
        }

        document.querySelectorAll('.kondisi-select').forEach(el => applySelectStyle(el,'kondisi'));
        document.querySelectorAll('.keberadaan-select').forEach(el => applySelectStyle(el,'keberadaan'));

        document.addEventListener('change', function(e){
            if (e.target.classList.contains('kondisi-select')) applySelectStyle(e.target,'kondisi');
            if (e.target.classList.contains('keberadaan-select')) applySelectStyle(e.target,'keberadaan');
        });

        // modal helpers
        const modalCreate = document.getElementById('modalCreate');
        const modalEdit = document.getElementById('modalEdit');
        const modalDetail = document.getElementById('modalDetail');
        function openModal(m){ m.classList.add('active'); }
        function closeModal(m){ m.classList.remove('active'); }

        document.getElementById('btnOpenCreate').addEventListener('click', () => {
            document.getElementById('formCreate').reset();
            openModal(modalCreate);
        });

        document.addEventListener('click', function(e){
            if (e.target.closest('.btn-close-modal')) {
                closeModal(modalCreate); closeModal(modalEdit); closeModal(modalDetail);
            }
            if (e.target === modalCreate) closeModal(modalCreate);
            if (e.target === modalEdit) closeModal(modalEdit);
            if (e.target === modalDetail) closeModal(modalDetail);
        });

        function formatDateToDMY(dateStr){
            if (!dateStr) return '-';
            const d = new Date(dateStr);
            if (isNaN(d.getTime())) return '-';
            return d.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
        }

        // DETAIL -> open modal
        document.addEventListener('click', function(e){
            const btn = e.target.closest('.btn-detail');
            if (!btn) return;

            e.preventDefault();
            const tr = btn.closest('tr');
            if (!tr) return;

            document.getElementById('dKode').innerText = tr.dataset.kode_aset || tr.children[1]?.innerText?.trim() || '-';
            document.getElementById('dLokasi').innerText = tr.dataset.lokasi_aset || tr.children[2]?.innerText?.trim() || '-';
            document.getElementById('dSurveyor').innerText = tr.dataset.nama_surveyor || tr.children[3]?.innerText?.trim() || '-';

            const raw = tr.dataset.tgl_survey || '';
            document.getElementById('dTanggal').innerText = raw ? formatDateToDMY(raw) : (tr.children[4]?.innerText?.trim() || '-');

            document.getElementById('dKondisi').innerText = tr.querySelector('.kondisi-select')?.value || tr.dataset.kondisi || '-';
            document.getElementById('dKeberadaan').innerText = tr.querySelector('.keberadaan-select')?.value || tr.dataset.keberadaan || '-';

            const cat = tr.dataset.catatan_kerusakan || tr.children[7]?.innerText?.trim() || '-';
            document.getElementById('dCatatan').innerText = cat;

            openModal(modalDetail);
        });

        // CREATE (frontend-only) => row baru pakai delete UI icon
        document.getElementById('formCreate').addEventListener('submit', function(e){
            e.preventDefault();
            const fd = new FormData(this);
            const p = Object.fromEntries(fd.entries());

            const id = Date.now();
            const no = dt.rows().count() + 1;

            const kode = p.kode_aset || '-';
            const lokasi = p.lokasi_aset || '-';
            const surveyor = p.nama_surveyor || '-';
            const tglRaw = p.tgl_survey || '';
            const tglLabel = tglRaw ? formatDateToDMY(tglRaw) : '-';
            const kondisi = p.kondisi || 'Nyala';
            const keberadaan = p.keberadaan || 'Ada';
            const catatan = (p.catatan_kerusakan && p.catatan_kerusakan.trim()) ? p.catatan_kerusakan : '-';

            const kondisiHtml = `
                <select class="select-sm kondisi-select border border-gray-200 dark:border-[#15203c] rounded-md px-2 py-1 text-sm bg-white dark:bg-[#0c1427]" data-id="${id}">
                    <option value="Nyala" ${kondisi==='Nyala'?'selected':''}>Nyala</option>
                    <option value="Mati" ${kondisi==='Mati'?'selected':''}>Mati</option>
                    <option value="Rusak Fisik" ${kondisi==='Rusak Fisik'?'selected':''}>Rusak Fisik</option>
                </select>
            `;
            const keberadaanHtml = `
                <select class="select-sm keberadaan-select border border-gray-200 dark:border-[#15203c] rounded-md px-2 py-1 text-sm bg-white dark:bg-[#0c1427]" data-id="${id}">
                    <option value="Ada" ${keberadaan==='Ada'?'selected':''}>Ada</option>
                    <option value="Tidak Ada" ${keberadaan==='Tidak Ada'?'selected':''}>Tidak Ada</option>
                </select>
            `;

            const aksiHtml = `
                <div class="flex items-center gap-[9px] justify-center">
                    <a href="javascript:void(0)" class="btn-detail text-primary-500 leading-none custom-tooltip" data-id="${id}" data-text="Detail">
                        <i class="material-symbols-outlined !text-md">visibility</i>
                    </a>
                    <button type="button" class="btn-edit text-blue-600 leading-none custom-tooltip" data-text="Edit (UI)">
                        <i class="material-symbols-outlined !text-md">edit</i>
                    </button>
                    <button type="button" class="btn-delete text-danger-500 leading-none custom-tooltip" data-text="Delete (UI)">
                        <i class="material-symbols-outlined !text-md">delete</i>
                    </button>
                </div>
            `;

            const node = dt.row.add([
                `${no}`,
                `${kode}`,
                `${lokasi}`,
                `${surveyor}`,
                `${tglLabel}`,
                kondisiHtml,
                keberadaanHtml,
                `${catatan}`,
                aksiHtml
            ]).draw(false).node();

            node.dataset.id = id;
            node.dataset.is_db = "0";
            node.dataset.kode_aset = kode;
            node.dataset.lokasi_aset = lokasi;
            node.dataset.nama_surveyor = surveyor;
            node.dataset.tgl_survey = tglRaw;
            node.dataset.kondisi = kondisi;
            node.dataset.keberadaan = keberadaan;
            node.dataset.catatan_kerusakan = catatan;

            node.querySelectorAll('.kondisi-select').forEach(el => applySelectStyle(el,'kondisi'));
            node.querySelectorAll('.keberadaan-select').forEach(el => applySelectStyle(el,'keberadaan'));

            closeModal(modalCreate);
        });

        // OPEN EDIT
        document.addEventListener('click', function(e){
            const btn = e.target.closest('.btn-edit');
            if (!btn) return;

            const tr = btn.closest('tr');
            const form = document.getElementById('formEdit');

            form.id.value = tr.dataset.id || '';
            form.kode_aset.value = tr.dataset.kode_aset || tr.children[1]?.innerText?.trim() || '';
            form.lokasi_aset.value = tr.dataset.lokasi_aset || tr.children[2]?.innerText?.trim() || '';
            form.nama_surveyor.value = tr.dataset.nama_surveyor || tr.children[3]?.innerText?.trim() || '';
            form.tgl_survey.value = tr.dataset.tgl_survey || '';
            form.kondisi.value = tr.querySelector('.kondisi-select')?.value || tr.dataset.kondisi || 'Nyala';
            form.keberadaan.value = tr.querySelector('.keberadaan-select')?.value || tr.dataset.keberadaan || 'Ada';
            form.catatan_kerusakan.value = tr.dataset.catatan_kerusakan || tr.children[7]?.innerText?.trim() || '';

            openModal(modalEdit);
        });

        // EDIT SUBMIT
        document.getElementById('formEdit').addEventListener('submit', function(e){
            e.preventDefault();

            const fd = new FormData(this);
            const p = Object.fromEntries(fd.entries());
            const id = p.id;

            const tr = document.querySelector(`#data-table tbody tr[data-id="${CSS.escape(id)}"]`);
            if (!tr) { alert('Data tidak ditemukan'); return; }

            const kode = p.kode_aset || '-';
            const lokasi = p.lokasi_aset || '-';
            const surveyor = p.nama_surveyor || '-';
            const tglRaw = p.tgl_survey || '';
            const tglLabel = tglRaw ? formatDateToDMY(tglRaw) : '-';
            const kondisi = p.kondisi || 'Nyala';
            const keberadaan = p.keberadaan || 'Ada';
            const catatan = (p.catatan_kerusakan && p.catatan_kerusakan.trim()) ? p.catatan_kerusakan : '-';

            tr.dataset.kode_aset = kode;
            tr.dataset.lokasi_aset = lokasi;
            tr.dataset.nama_surveyor = surveyor;
            tr.dataset.tgl_survey = tglRaw;
            tr.dataset.kondisi = kondisi;
            tr.dataset.keberadaan = keberadaan;
            tr.dataset.catatan_kerusakan = catatan;

            const row = dt.row(tr);
            const data = row.data();

            data[1] = `${kode}`;
            data[2] = `${lokasi}`;
            data[3] = `${surveyor}`;
            data[4] = `${tglLabel}`;

            data[5] = `
                <select class="select-sm kondisi-select border border-gray-200 dark:border-[#15203c] rounded-md px-2 py-1 text-sm bg-white dark:bg-[#0c1427]" data-id="${id}">
                    <option value="Nyala" ${kondisi==='Nyala'?'selected':''}>Nyala</option>
                    <option value="Mati" ${kondisi==='Mati'?'selected':''}>Mati</option>
                    <option value="Rusak Fisik" ${kondisi==='Rusak Fisik'?'selected':''}>Rusak Fisik</option>
                </select>
            `;
            data[6] = `
                <select class="select-sm keberadaan-select border border-gray-200 dark:border-[#15203c] rounded-md px-2 py-1 text-sm bg-white dark:bg-[#0c1427]" data-id="${id}">
                    <option value="Ada" ${keberadaan==='Ada'?'selected':''}>Ada</option>
                    <option value="Tidak Ada" ${keberadaan==='Tidak Ada'?'selected':''}>Tidak Ada</option>
                </select>
            `;
            data[7] = `${catatan}`;

            row.data(data).draw(false);

            tr.querySelectorAll('.kondisi-select').forEach(el => applySelectStyle(el,'kondisi'));
            tr.querySelectorAll('.keberadaan-select').forEach(el => applySelectStyle(el,'keberadaan'));

            closeModal(modalEdit);
        });

        // DELETE UI (frontend-only) untuk row baru
        document.addEventListener('click', function(e){
            const btn = e.target.closest('.btn-delete');
            if (!btn) return;

            const tr = btn.closest('tr');
            const isDb = tr?.dataset?.is_db === "1";
            if (isDb) return; // row DB hapus pakai form backend

            if (confirm('Hapus data ini? (UI)')) {
                dt.row(tr).remove().draw(false);
            }
        });
    </script>
@endpush
