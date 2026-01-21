@extends('layouts.admin.master')

@section('title', 'Progres Pengerjaan')

@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('progres-pengerjaan') }} --}}
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">

    <style>
        #data-table td.text-center { vertical-align: middle; }
        #data-table td:last-child, #data-table td:last-child * { pointer-events: auto; }

        .tahapan-select{ min-width: 240px; }
        .btn-icon{ cursor:pointer; position:relative; z-index:10; }
        .material-symbols-outlined{ font-size:18px !important; }

        /* modal */
        .modal-overlay{ display:none; }
        .modal-overlay.active{ display:flex; }
    </style>
@endpush

@section('content')
    <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
        <div class="trezo-card-header mb-[20px] md:mb-[25px] sm:flex sm:items-center sm:justify-between">
            <div class="trezo-card-title">
                <h5 class="mb-0">Data @yield('title') PJU Baru</h5>
            </div>

            {{-- CREATE --}}
            <div class="mt-3 sm:mt-0">
                <button type="button" id="btnOpenCreate"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-primary-500 text-white hover:bg-primary-600 transition">
                    <i class="material-symbols-outlined">add</i>
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
                            <th class="text-left">Petugas</th>
                            <th class="text-center">Tahapan Terakhir</th>
                            <th class="text-center">Update Terakhir</th>
                            <th class="text-center">Progress</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        {{-- @can('progres-pengerjaan.read') --}}
                        @php
                            $groupedProgres = collect($progresPengerjaan)->groupBy('aset_pju_id');

                            // ENUM DB kamu
                            $tahapanEnum = [
                                'Galian',
                                'Pengecoran',
                                'Pemasangan Tiang dan Armatur',
                                'Pemasangan Jaringan',
                                'Selesai'
                            ];

                            // mapping persentase default (kalau persentase kosong)
                            $autoMap = [
                                'Galian' => 20,
                                'Pengecoran' => 40,
                                'Pemasangan Tiang dan Armatur' => 60,
                                'Pemasangan Jaringan' => 80,
                                'Selesai' => 100,
                            ];
                        @endphp

                        @foreach ($groupedProgres as $asetId => $progresses)
                            @php
                                $latestProgres = $progresses->sortByDesc('tgl_update')->first();
                                $tahapan = $latestProgres['tahapan'] ?? 'Galian';
                                $persen = (int)($latestProgres['persentase'] ?? ($autoMap[$tahapan] ?? 0));
                                $tglRaw = $latestProgres['tgl_update'] ?? null;
                                $tglLabel = $tglRaw ? date('d M Y H:i', strtotime($tglRaw)) : '-';
                            @endphp

                            <tr
                                data-aset="{{ $latestProgres['aset_pju_id'] }}"
                                data-is_db="1"
                                data-kode_aset="{{ $latestProgres['kode_aset'] }}"
                                data-lokasi="{{ $latestProgres['lokasi_proyek'] }}"
                                data-petugas="{{ $latestProgres['nama_petugas'] }}"
                                data-tahapan="{{ $tahapan }}"
                                data-persen="{{ $persen }}"
                            >
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-left"><strong class="text-primary-500">{{ $latestProgres['kode_aset'] }}</strong></td>
                                <td class="text-left">{{ $latestProgres['lokasi_proyek'] }}</td>
                                <td class="text-left">{{ $latestProgres['nama_petugas'] }}</td>

                                {{-- ✅ dropdown hanya 1x --}}
                                <td class="text-center">
                                    <select class="tahapan-select border border-gray-200 dark:border-[#15203c] rounded-md px-3 py-2 text-sm bg-white dark:bg-[#0c1427]">
                                        @foreach($tahapanEnum as $opt)
                                            <option value="{{ $opt }}" {{ $tahapan===$opt?'selected':'' }}>{{ $opt }}</option>
                                        @endforeach
                                    </select>
                                </td>

                                {{-- last update (akan berubah saat edit / change dropdown) --}}
                                <td class="text-center">
                                    <span class="last-update">{{ $tglLabel }}</span>
                                </td>

                                {{-- ✅ Progress: BAR + TEXT SAJA (TIDAK ADA INPUT) --}}
                                <td class="text-center">
                                    <div class="w-full max-w-[220px] mx-auto">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700 overflow-hidden">
                                            <div class="progress-bar bg-primary-500 h-2.5 rounded-full" style="width: {{ $persen }}%"></div>
                                        </div>
                                        <span class="progress-text text-xs text-gray-600 dark:text-gray-400">{{ $persen }}%</span>
                                    </div>
                                </td>

                                {{-- ✅ Aksi: Edit + Hapus + Riwayat (ICON HISTORY SAJA, TANPA (UI)) --}}
                                <td class="text-center">
                                    <div class="flex items-center gap-[12px] justify-center">
                                        <button type="button" class="btn-icon btn-edit text-blue-600 custom-tooltip" data-text="Edit">
                                            <i class="material-symbols-outlined">edit</i>
                                        </button>

                                        <button type="button" class="btn-icon btn-delete text-danger-500 custom-tooltip" data-text="Hapus">
                                            <i class="material-symbols-outlined">delete</i>
                                        </button>

                                        <a href="{{ route('progres-pengerjaan.show', $latestProgres['aset_pju_id']) }}"
                                           class="btn-icon text-primary-500 custom-tooltip" data-text="Riwayat">
                                            <i class="material-symbols-outlined">history</i>
                                        </a>
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

    {{-- =========================
        MODAL CREATE (frontend-only)
    ========================== --}}
    <div id="modalCreate" class="modal-overlay fixed inset-0 z-[999] items-center justify-center bg-black/50 p-4">
        <div class="w-full max-w-2xl rounded-md bg-white dark:bg-[#0c1427] p-5">
            <div class="flex items-center justify-between mb-4">
                <h5 class="mb-0 font-semibold text-gray-800 dark:text-gray-100">Tambah Progres Pengerjaan</h5>
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
                    <label class="text-sm text-gray-600 dark:text-gray-300">Petugas</label>
                    <input name="petugas" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
                </div>

                <div class="md:col-span-2">
                    <label class="text-sm text-gray-600 dark:text-gray-300">Lokasi</label>
                    <input name="lokasi" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Tahapan</label>
                    <select name="tahapan" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]">
                        <option value="Galian">Galian</option>
                        <option value="Pengecoran">Pengecoran</option>
                        <option value="Pemasangan Tiang dan Armatur">Pemasangan Tiang dan Armatur</option>
                        <option value="Pemasangan Jaringan">Pemasangan Jaringan</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>

                {{-- ✅ progress hanya bisa diubah dari modal edit, jadi create kita pakai auto by tahapan --}}
                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Progress (Auto)</label>
                    <input type="text" value="Akan mengikuti tahapan" disabled
                           class="w-full mt-1 border rounded-md px-3 py-2 bg-gray-50 dark:bg-[#15203c] dark:border-[#15203c] text-sm">
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

    {{-- =========================
        MODAL EDIT (frontend-only) => progress hanya bisa diubah di sini
    ========================== --}}
    <div id="modalEdit" class="modal-overlay fixed inset-0 z-[999] items-center justify-center bg-black/50 p-4">
        <div class="w-full max-w-2xl rounded-md bg-white dark:bg-[#0c1427] p-5">
            <div class="flex items-center justify-between mb-4">
                <h5 class="mb-0 font-semibold text-gray-800 dark:text-gray-100">Edit Progres Pengerjaan</h5>
                <button type="button" class="btn-close-modal text-gray-500 hover:text-gray-800 dark:hover:text-gray-200">
                    <i class="material-symbols-outlined">close</i>
                </button>
            </div>

            <form id="formEdit" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="hidden" name="aset_pju_id">

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Kode Aset</label>
                    <input name="kode_aset" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Petugas</label>
                    <input name="petugas" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
                </div>

                <div class="md:col-span-2">
                    <label class="text-sm text-gray-600 dark:text-gray-300">Lokasi</label>
                    <input name="lokasi" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Tahapan</label>
                    <select name="tahapan" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]">
                        <option value="Galian">Galian</option>
                        <option value="Pengecoran">Pengecoran</option>
                        <option value="Pemasangan Tiang dan Armatur">Pemasangan Tiang dan Armatur</option>
                        <option value="Pemasangan Jaringan">Pemasangan Jaringan</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                    <p class="text-xs text-gray-500 mt-1">* Persen otomatis mengikuti tahapan jika kamu kosongkan.</p>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Persentase (0-100)</label>
                    <input type="number" name="persen" min="0" max="100"
                           class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]">
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
@endsection

@push('scripts')
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.tailwindcss.js') }}"></script>

    <script>
        const tahapanToPercent = {
            "Galian": 20,
            "Pengecoran": 40,
            "Pemasangan Tiang dan Armatur": 60,
            "Pemasangan Jaringan": 80,
            "Selesai": 100
        };

        function nowLabel() {
            const d = new Date();
            return d.toLocaleString('id-ID', {
                day:'2-digit', month:'short', year:'numeric',
                hour:'2-digit', minute:'2-digit'
            }).replace('.', '');
        }

        function clampPercent(p){
            p = parseInt(p || 0, 10);
            if (isNaN(p)) p = 0;
            return Math.max(0, Math.min(100, p));
        }

        function setRowProgress(tr, percent) {
            percent = clampPercent(percent);
            tr.dataset.persen = percent;

            const bar = tr.querySelector('.progress-bar');
            const txt = tr.querySelector('.progress-text');

            if (bar) bar.style.width = percent + '%';
            if (txt) txt.innerText = percent + '%';
        }

        function setLastUpdate(tr) {
            const el = tr.querySelector('.last-update');
            if (el) el.innerText = nowLabel();
        }

        const dt = $('#data-table').DataTable({
            responsive: true,
            order: [[5, 'desc']],
            pageLength: 25,
            columnDefs: [
                { targets: [0,4,5,6,7], className: 'text-center' },
                { targets: [1,2,3], className: 'text-left' }
            ]
        });

        // ===== modal helpers =====
        const modalCreate = document.getElementById('modalCreate');
        const modalEdit = document.getElementById('modalEdit');
        function openModal(m){ m.classList.add('active'); }
        function closeModal(m){ m.classList.remove('active'); }

        document.getElementById('btnOpenCreate').addEventListener('click', () => {
            document.getElementById('formCreate').reset();
            openModal(modalCreate);
        });

        document.addEventListener('click', function(e){
            if (e.target.closest('.btn-close-modal')) { closeModal(modalCreate); closeModal(modalEdit); }
            if (e.target === modalCreate) closeModal(modalCreate);
            if (e.target === modalEdit) closeModal(modalEdit);
        });

        // ===== dropdown tahapan di table: boleh diganti, tapi progress auto (tanpa input manual) =====
        document.addEventListener('change', function(e){
            if (!e.target.classList.contains('tahapan-select')) return;

            const tr = e.target.closest('tr');
            const tahapan = e.target.value;

            tr.dataset.tahapan = tahapan;

            // auto percent sesuai tahapan
            const auto = tahapanToPercent[tahapan] ?? 0;
            setRowProgress(tr, auto);

            // update last update
            setLastUpdate(tr);
        });

        // ===== CREATE (UI): progress auto ikut tahapan =====
        document.getElementById('formCreate').addEventListener('submit', function(e){
            e.preventDefault();
            const fd = new FormData(this);
            const p = Object.fromEntries(fd.entries());

            const asetId = Date.now();
            const no = dt.rows().count() + 1;

            const tahapan = p.tahapan || 'Galian';
            const persen = tahapanToPercent[tahapan] ?? 0;

            const tahapanHtml = `
                <select class="tahapan-select border border-gray-200 dark:border-[#15203c] rounded-md px-3 py-2 text-sm bg-white dark:bg-[#0c1427]">
                    <option value="Galian" ${tahapan==='Galian'?'selected':''}>Galian</option>
                    <option value="Pengecoran" ${tahapan==='Pengecoran'?'selected':''}>Pengecoran</option>
                    <option value="Pemasangan Tiang dan Armatur" ${tahapan==='Pemasangan Tiang dan Armatur'?'selected':''}>Pemasangan Tiang dan Armatur</option>
                    <option value="Pemasangan Jaringan" ${tahapan==='Pemasangan Jaringan'?'selected':''}>Pemasangan Jaringan</option>
                    <option value="Selesai" ${tahapan==='Selesai'?'selected':''}>Selesai</option>
                </select>
            `;

            const progressHtml = `
                <div class="w-full max-w-[220px] mx-auto">
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700 overflow-hidden">
                        <div class="progress-bar bg-primary-500 h-2.5 rounded-full" style="width:${persen}%"></div>
                    </div>
                    <span class="progress-text text-xs text-gray-600 dark:text-gray-400">${persen}%</span>
                </div>
            `;

            // UI icon "riwayat" juga (bukan tulisan (UI))
            const aksiHtml = `
                <div class="flex items-center gap-[12px] justify-center">
                    <button type="button" class="btn-icon btn-edit text-blue-600 custom-tooltip" data-text="Edit">
                        <i class="material-symbols-outlined">edit</i>
                    </button>
                    <button type="button" class="btn-icon btn-delete text-danger-500 custom-tooltip" data-text="Hapus">
                        <i class="material-symbols-outlined">delete</i>
                    </button>
                    <a href="javascript:void(0)" class="btn-icon text-primary-500 custom-tooltip" data-text="Riwayat (UI)">
                        <i class="material-symbols-outlined">history</i>
                    </a>
                </div>
            `;

            const node = dt.row.add([
                `${no}`,
                `<strong class="text-primary-500">${(p.kode_aset || '-')}</strong>`,
                `${(p.lokasi || '-')}`,
                `${(p.petugas || '-')}`,
                tahapanHtml,
                `<span class="last-update">${nowLabel()}</span>`,
                progressHtml,
                aksiHtml
            ]).draw(false).node();

            node.dataset.aset = asetId;
            node.dataset.is_db = "0";
            node.dataset.kode_aset = p.kode_aset || '-';
            node.dataset.lokasi = p.lokasi || '-';
            node.dataset.petugas = p.petugas || '-';
            node.dataset.tahapan = tahapan;
            node.dataset.persen = persen;

            closeModal(modalCreate);
        });

        // ===== OPEN EDIT MODAL =====
        document.addEventListener('click', function(e){
            const btn = e.target.closest('.btn-edit');
            if (!btn) return;

            const tr = btn.closest('tr');
            const form = document.getElementById('formEdit');

            form.aset_pju_id.value = tr.dataset.aset || '';
            form.kode_aset.value = tr.dataset.kode_aset || tr.children[1]?.innerText?.trim() || '';
            form.lokasi.value = tr.dataset.lokasi || tr.children[2]?.innerText?.trim() || '';
            form.petugas.value = tr.dataset.petugas || tr.children[3]?.innerText?.trim() || '';
            form.tahapan.value = tr.querySelector('.tahapan-select')?.value || tr.dataset.tahapan || 'Galian';
            form.persen.value = tr.dataset.persen || 0;

            openModal(modalEdit);
        });

        // ===== SUBMIT EDIT MODAL => update row + last update berubah =====
        document.getElementById('formEdit').addEventListener('submit', function(e){
            e.preventDefault();
            const fd = new FormData(this);
            const p = Object.fromEntries(fd.entries());

            const tr = document.querySelector(`#data-table tbody tr[data-aset="${CSS.escape(p.aset_pju_id)}"]`);
            if (!tr) { alert('Data tidak ditemukan'); return; }

            const tahapan = p.tahapan || 'Galian';
            const persen = (p.persen === '' || p.persen === null || typeof p.persen === 'undefined')
                ? (tahapanToPercent[tahapan] ?? 0)
                : clampPercent(p.persen);

            // update dataset
            tr.dataset.kode_aset = p.kode_aset || '-';
            tr.dataset.lokasi = p.lokasi || '-';
            tr.dataset.petugas = p.petugas || '-';
            tr.dataset.tahapan = tahapan;
            tr.dataset.persen = persen;

            // update via datatable
            const row = dt.row(tr);
            const data = row.data();

            data[1] = `<strong class="text-primary-500">${(p.kode_aset || '-')}</strong>`;
            data[2] = `${(p.lokasi || '-')}`;
            data[3] = `${(p.petugas || '-')}`;

            data[4] = `
                <select class="tahapan-select border border-gray-200 dark:border-[#15203c] rounded-md px-3 py-2 text-sm bg-white dark:bg-[#0c1427]">
                    <option value="Galian" ${tahapan==='Galian'?'selected':''}>Galian</option>
                    <option value="Pengecoran" ${tahapan==='Pengecoran'?'selected':''}>Pengecoran</option>
                    <option value="Pemasangan Tiang dan Armatur" ${tahapan==='Pemasangan Tiang dan Armatur'?'selected':''}>Pemasangan Tiang dan Armatur</option>
                    <option value="Pemasangan Jaringan" ${tahapan==='Pemasangan Jaringan'?'selected':''}>Pemasangan Jaringan</option>
                    <option value="Selesai" ${tahapan==='Selesai'?'selected':''}>Selesai</option>
                </select>
            `;

            data[5] = `<span class="last-update">${nowLabel()}</span>`;

            data[6] = `
                <div class="w-full max-w-[220px] mx-auto">
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700 overflow-hidden">
                        <div class="progress-bar bg-primary-500 h-2.5 rounded-full" style="width:${persen}%"></div>
                    </div>
                    <span class="progress-text text-xs text-gray-600 dark:text-gray-400">${persen}%</span>
                </div>
            `;

            row.data(data).draw(false);
            closeModal(modalEdit);
        });

        // ===== DELETE: UI only untuk row baru =====
        document.addEventListener('click', function(e){
            const btn = e.target.closest('.btn-delete');
            if (!btn) return;

            const tr = btn.closest('tr');
            const isDb = tr.dataset.is_db === "1";

            if (isDb) {
                alert('Delete backend belum dipasang di halaman ini.\nKalau mau, aku bisa buat versi yang pakai route destroy.');
                return;
            }

            if (confirm('Hapus data ini? (UI)')) {
                dt.row(tr).remove().draw(false);
            }
        });
    </script>
@endpush
