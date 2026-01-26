@extends('layouts.admin.master')

@section('title', 'Tim Lapangan')

@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('tim-lapangan') }} --}}
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">

    <style>
        #data-table td.text-center { vertical-align: middle; }

        .btn-icon { cursor: pointer; }
        .material-symbols-outlined{ font-size:18px !important; }

        /* Modal */
        .modal-overlay { display: none; }
        .modal-overlay.active { display: flex; }

        /* Badge kategori */
        .badge-kategori {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
        }
        .kategori-teknisi { background: #dbeafe; color: #1e40af; }
        .kategori-surveyor { background: #fef3c7; color: #92400e; }
    </style>
@endpush

@section('content')
    @php
        // data dari controller kamu (biar tabel tetap tampil normal)
        // kalau null, fallback array kosong
        $initialData = $timLapangan ?? [];
    @endphp

    <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
        <div class="trezo-card-header mb-[20px] md:mb-[25px] sm:flex sm:items-center sm:justify-between">
            <div class="trezo-card-title">
                <h5 class="mb-0">Daftar @yield('title')</h5>
            </div>

            {{-- ✅ CREATE UI (Frontend only) --}}
            <div class="trezo-card-subtitle sm:flex sm:items-center">
                <button type="button" id="btn-open-create"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-primary-500 text-white hover:bg-primary-600 transition">
                    <span class="material-symbols-outlined" style="font-size:18px;">add</span>
                    Tambah Tim Baru
                </button>
            </div>
        </div>

        <div class="trezo-card-content" id="dataTable">
            <div class="table-responsive overflow-x-auto p-2">
                <table id="data-table" class="display stripe group" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-left">Nama Tim</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-left">Ketua Tim</th>
                            <th class="text-center">Jumlah Personel</th>
                            <th class="text-center">Dibuat Pada</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="tbody-data">
                        @foreach ($initialData as $index => $tim)
                            @php
                                $kategori = $tim['kategori'] ?? 'Teknisi';
                                $badgeClass = $kategori === 'Teknisi' ? 'kategori-teknisi' : 'kategori-surveyor';
                            @endphp
                            <tr
                                data-row="1"
                                data-id="{{ $tim['id'] ?? '' }}"
                                data-is_db="1"
                                data-nama_tim="{{ $tim['nama_tim'] ?? '-' }}"
                                data-kategori="{{ $kategori }}"
                                data-ketua_tim="{{ $tim['leader_name'] ?? '-' }}"
                                data-jumlah="{{ $tim['jumlah_personel'] ?? 0 }}"
                            >
                                <td class="text-center col-no">{{ $index + 1 }}</td>

                                <td class="text-left col-nama">
                                    <strong class="text-primary-500">{{ $tim['nama_tim'] ?? '-' }}</strong>
                                </td>

                                <td class="text-center col-kategori">
                                    <span class="badge-kategori {{ $badgeClass }}">{{ $kategori }}</span>
                                </td>

                                <td class="text-left col-ketua">
                                    {{ $tim['leader_name'] ?? '-' }}
                                </td>

                                <td class="text-center col-jumlah">
                                    {{ ($tim['jumlah_personel'] ?? 0) }} orang
                                </td>

                                <td class="text-center col-created">
                                    {{ isset($tim['created_at']) ? date('d M Y', strtotime($tim['created_at'])) : date('d M Y') }}
                                </td>

                                <td class="text-center col-aksi">
                                    <div class="flex items-center gap-[10px] justify-center">
                                        {{-- EDIT --}}
                                        <button type="button" class="btn-icon btn-edit text-blue-600 custom-tooltip" data-text="Edit">
                                            <i class="material-symbols-outlined">edit</i>
                                        </button>

                                        {{-- DELETE --}}
                                        <button type="button" class="btn-icon btn-delete text-danger-500 custom-tooltip" data-text="Hapus">
                                            <i class="material-symbols-outlined">delete</i>
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

    {{-- MODAL CREATE --}}
    <div id="modalCreate" class="modal-overlay fixed inset-0 z-[999] items-center justify-center bg-black/50 p-4">
        <div class="w-full max-w-2xl rounded-md bg-white dark:bg-[#0c1427] p-5">
            <div class="flex items-center justify-between mb-4">
                <h5 class="mb-0 font-semibold text-gray-800 dark:text-gray-100">Tambah Tim Lapangan</h5>
                <button type="button" class="btn-close-modal text-gray-500 hover:text-gray-800 dark:hover:text-gray-200">
                    <i class="material-symbols-outlined">close</i>
                </button>
            </div>

            <form id="formCreate" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Nama Tim</label>
                    <input name="nama_tim" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" placeholder="Contoh: Tim Teknisi 3" required>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Kategori</label>
                    <select name="kategori" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]">
                        <option value="Teknisi">Teknisi</option>
                        <option value="Surveyor">Surveyor</option>
                    </select>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Ketua Tim</label>
                    <input name="ketua_tim" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" placeholder="Contoh: Budi Santoso" required>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Jumlah Personel</label>
                    <input type="number" name="jumlah" min="0" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
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
                <h5 class="mb-0 font-semibold text-gray-800 dark:text-gray-100">Edit Tim Lapangan</h5>
                <button type="button" class="btn-close-modal text-gray-500 hover:text-gray-800 dark:hover:text-gray-200">
                    <i class="material-symbols-outlined">close</i>
                </button>
            </div>

            <form id="formEdit" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="hidden" name="id">

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Nama Tim</label>
                    <input name="nama_tim" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Kategori</label>
                    <select name="kategori" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]">
                        <option value="Teknisi">Teknisi</option>
                        <option value="Surveyor">Surveyor</option>
                    </select>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Ketua Tim</label>
                    <input name="ketua_tim" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Jumlah Personel</label>
                    <input type="number" name="jumlah" min="0" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
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
        // === DataTable init ===
        const dt = $('#data-table').DataTable({
            responsive: true,
            pageLength: 10,
            columnDefs: [
                { targets: [0,2,4,5,6], className: 'text-center' },
                { targets: [1,3], className: 'text-left' }
            ]
        });

        // === helper renumber (kolom No.) ===
        function renumber(){
            const nodes = dt.rows({search:'applied', order:'applied'}).nodes();
            let i = 1;
            $(nodes).each(function(){
                $(this).find('.col-no').text(i++);
            });
        }
        dt.on('draw', renumber);
        renumber();

        function getBadgeClass(kategori) {
            return kategori === 'Teknisi' ? 'kategori-teknisi' : 'kategori-surveyor';
        }

        function escapeHtml(str){
            return (str ?? '').toString()
                .replaceAll('&','&amp;')
                .replaceAll('<','&lt;')
                .replaceAll('>','&gt;')
                .replaceAll('"','&quot;')
                .replaceAll("'","&#039;");
        }

        // === modal helpers ===
        const modalCreate = document.getElementById('modalCreate');
        const modalEdit = document.getElementById('modalEdit');
        function openModal(m){ m.classList.add('active'); }
        function closeModal(m){ m.classList.remove('active'); }

        document.getElementById('btn-open-create').addEventListener('click', () => {
            document.getElementById('formCreate').reset();
            openModal(modalCreate);
        });

        document.addEventListener('click', function(e){
            if (e.target.closest('.btn-close-modal')) {
                closeModal(modalCreate); closeModal(modalEdit);
            }
            if (e.target === modalCreate) closeModal(modalCreate);
            if (e.target === modalEdit) closeModal(modalEdit);
        });

        // === CREATE ===
        document.getElementById('formCreate').addEventListener('submit', function(e){
            e.preventDefault();
            const fd = new FormData(this);
            const p = Object.fromEntries(fd.entries());

            const nama = p.nama_tim?.trim();
            const kategori = p.kategori || 'Teknisi';
            const ketua = p.ketua_tim?.trim() || '-';
            const jumlah = p.jumlah ? parseInt(p.jumlah, 10) : 0;

            if(!nama){
                alert('Nama Tim wajib diisi!');
                return;
            }

            const id = Date.now();
            const created = new Date();
            const createdText = created.toLocaleDateString('id-ID', { day:'2-digit', month:'short', year:'numeric' });
            const badgeClass = getBadgeClass(kategori);

            const aksiHtml = `
                <div class="flex items-center gap-[10px] justify-center">
                    <button type="button" class="btn-icon btn-edit text-blue-600 custom-tooltip" data-text="Edit">
                        <i class="material-symbols-outlined">edit</i>
                    </button>
                    <button type="button" class="btn-icon btn-delete text-danger-500 custom-tooltip" data-text="Hapus">
                        <i class="material-symbols-outlined">delete</i>
                    </button>
                </div>
            `;

            const node = dt.row.add([
                '',
                `<strong class="text-primary-500">${escapeHtml(nama)}</strong>`,
                `<span class="badge-kategori ${badgeClass}">${escapeHtml(kategori)}</span>`,
                `${escapeHtml(ketua)}`,
                `${jumlah} orang`,
                `${createdText}`,
                aksiHtml
            ]).draw(false).node();

            node.dataset.row = "1";
            node.dataset.id = id;
            node.dataset.is_db = "0";
            node.dataset.nama_tim = nama;
            node.dataset.kategori = kategori;
            node.dataset.ketua_tim = ketua;
            node.dataset.jumlah = jumlah;

            closeModal(modalCreate);
            renumber();
        });

        // === OPEN EDIT ===
        document.addEventListener('click', function(e){
            const btn = e.target.closest('.btn-edit');
            if (!btn) return;

            const tr = btn.closest('tr');
            const form = document.getElementById('formEdit');

            form.id.value = tr.dataset.id || '';
            form.nama_tim.value = tr.dataset.nama_tim || '';
            form.kategori.value = tr.dataset.kategori || 'Teknisi';
            form.ketua_tim.value = tr.dataset.ketua_tim || '';
            form.jumlah.value = tr.dataset.jumlah || 0;

            openModal(modalEdit);
        });

        // === EDIT SUBMIT ===
        document.getElementById('formEdit').addEventListener('submit', function(e){
            e.preventDefault();

            const fd = new FormData(this);
            const p = Object.fromEntries(fd.entries());
            const id = p.id;

            const nama = p.nama_tim?.trim();
            const kategori = p.kategori || 'Teknisi';
            const ketua = p.ketua_tim?.trim() || '-';
            const jumlah = p.jumlah ? parseInt(p.jumlah, 10) : 0;

            if(!nama){
                alert('Nama Tim wajib diisi!');
                return;
            }

            const tr = document.querySelector(`#data-table tbody tr[data-id="${CSS.escape(id)}"]`);
            if (!tr) { alert('Data tidak ditemukan'); return; }

            const badgeClass = getBadgeClass(kategori);

            tr.dataset.nama_tim = nama;
            tr.dataset.kategori = kategori;
            tr.dataset.ketua_tim = ketua;
            tr.dataset.jumlah = jumlah;

            const row = dt.row(tr);
            const data = row.data();

            data[1] = `<strong class="text-primary-500">${escapeHtml(nama)}</strong>`;
            data[2] = `<span class="badge-kategori ${badgeClass}">${escapeHtml(kategori)}</span>`;
            data[3] = `${escapeHtml(ketua)}`;
            data[4] = `${jumlah} orang`;

            row.data(data).draw(false);
            closeModal(modalEdit);
        });

        // === DELETE ===
        document.addEventListener('click', function(e){
            const btn = e.target.closest('.btn-delete');
            if (!btn) return;

            const tr = btn.closest('tr');
            const isDb = tr.dataset.is_db === "1";

            if (isDb) {
                alert('Delete backend belum dipasang di halaman ini.');
                return;
            }

            if(confirm('Yakin hapus data ini?')){
                dt.row(tr).remove().draw(false);
                renumber();
            }
        });
    </script>
@endpush