@extends('layouts.admin.master')

@section('title', 'Tim Lapangan')

@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('tim-lapangan') }} --}}
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">

    <style>
        #data-table td.text-center { vertical-align: middle; }
        .kategori-select { min-width: 140px; }

        .btn-icon { cursor: pointer; }
        .material-symbols-outlined{ font-size:18px !important; }

        .input-inline{
            width: 100%;
            border: 1px solid #e5e7eb;
            border-radius: .375rem;
            padding: .45rem .6rem;
            font-size: .875rem;
            background: #fff;
        }

        .btn-primary-mini{
            border: 1px solid #3b82f6;
            background: #3b82f6;
            color: #fff;
            padding: .45rem .75rem;
            border-radius: .5rem;
            font-size: .875rem;
        }

        .btn-secondary-mini{
            border: 1px solid #e5e7eb;
            background: #fff;
            padding: .45rem .75rem;
            border-radius: .5rem;
            font-size: .875rem;
        }

        .toolbar{
            display:flex;
            gap:10px;
            align-items:center;
            flex-wrap:wrap;
        }
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
                    class="btn-primary-mini">
                    <span class="material-symbols-outlined" style="font-size:18px;vertical-align:-4px;">add</span>
                    Tambah Tim Baru
                </button>
            </div>
        </div>

        {{-- ✅ Form Create inline (tanpa modal & tanpa route) --}}
        <div id="create-form" class="mb-4 hidden">
            <div class="trezo-card bg-gray-50 dark:bg-[#15203c] p-4 rounded-md">
                <div class="toolbar" style="display:grid;grid-template-columns: 2fr 1fr 2fr 1fr auto;gap:10px;">
                    <input type="text" id="c_nama_tim" class="input-inline" placeholder="Nama Tim (contoh: Tim Teknisi 3)">
                    <select id="c_kategori" class="input-inline">
                        <option value="Teknisi">Teknisi</option>
                        <option value="Surveyor">Surveyor</option>
                    </select>
                    <input type="text" id="c_ketua_tim" class="input-inline" placeholder="Ketua Tim (contoh: Budi Santoso)">
                    <input type="number" id="c_jumlah" class="input-inline" placeholder="Jumlah" min="0">
                    <div style="display:flex;gap:8px;justify-content:flex-end;">
                        <button type="button" id="btn-cancel-create" class="btn-secondary-mini">Batal</button>
                        <button type="button" id="btn-save-create" class="btn-primary-mini">Simpan</button>
                    </div>
                </div>
                <small class="text-gray-500 block mt-2">
                    * Ini hanya frontend dulu. Nanti kalau database sudah siap, tinggal ganti logic JS-nya ke AJAX.
                </small>
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
                            @endphp
                            <tr
                                data-row="1"
                                data-id="{{ $tim['id'] ?? '' }}"
                                data-editing="0"
                            >
                                <td class="text-center col-no">{{ $index + 1 }}</td>

                                <td class="text-left col-nama">
                                    <span class="view">{{ $tim['nama_tim'] ?? '-' }}</span>
                                </td>

                                <td class="text-center col-kategori">
                                    <select class="kategori-select input-inline view">
                                        <option value="Teknisi" {{ $kategori==='Teknisi'?'selected':'' }}>Teknisi</option>
                                        <option value="Surveyor" {{ $kategori==='Surveyor'?'selected':'' }}>Surveyor</option>
                                    </select>
                                </td>

                                <td class="text-left col-ketua">
                                    <span class="view">{{ $tim['leader_name'] ?? '-' }}</span>
                                </td>

                                <td class="text-center col-jumlah">
                                    <span class="view">{{ ($tim['jumlah_personel'] ?? 0) }} orang</span>
                                </td>

                                <td class="text-center col-created">
                                    <span class="view">
                                        {{ isset($tim['created_at']) ? date('d M Y', strtotime($tim['created_at'])) : date('d M Y') }}
                                    </span>
                                </td>

                                <td class="text-center col-aksi">
                                    <div class="flex items-center gap-[10px] justify-center">
                                        {{-- EDIT --}}
                                        <button type="button" class="btn-icon btn-edit" title="Edit">
                                            <i class="material-symbols-outlined text-warning-500">edit</i>
                                        </button>

                                        {{-- SAVE (hidden default) --}}
                                        <button type="button" class="btn-icon btn-save hidden" title="Simpan">
                                            <i class="material-symbols-outlined text-primary-500">save</i>
                                        </button>

                                        {{-- CANCEL (hidden default) --}}
                                        <button type="button" class="btn-icon btn-cancel hidden" title="Batal">
                                            <i class="material-symbols-outlined text-gray-500">close</i>
                                        </button>

                                        {{-- DELETE --}}
                                        <button type="button" class="btn-icon btn-delete" title="Hapus">
                                            <i class="material-symbols-outlined text-danger-500">delete</i>
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

        // === CREATE UI toggle ===
        const createForm = document.getElementById('create-form');
        document.getElementById('btn-open-create').addEventListener('click', () => {
            createForm.classList.toggle('hidden');
        });
        document.getElementById('btn-cancel-create').addEventListener('click', () => {
            createForm.classList.add('hidden');
        });

        // === CREATE (frontend only) ===
        document.getElementById('btn-save-create').addEventListener('click', () => {
            const nama = document.getElementById('c_nama_tim').value.trim();
            const kategori = document.getElementById('c_kategori').value;
            const ketua = document.getElementById('c_ketua_tim').value.trim() || '-';
            const jumlah = document.getElementById('c_jumlah').value ? parseInt(document.getElementById('c_jumlah').value, 10) : 0;

            if(!nama){
                alert('Nama Tim wajib diisi!');
                return;
            }

            const created = new Date();
            const createdText = created.toLocaleDateString('id-ID', { day:'2-digit', month:'short', year:'numeric' });

            const rowHtml = `
                <tr data-row="1" data-id="" data-editing="0">
                    <td class="text-center col-no"></td>

                    <td class="text-left col-nama">
                        <span class="view">${escapeHtml(nama)}</span>
                    </td>

                    <td class="text-center col-kategori">
                        <select class="kategori-select input-inline view">
                            <option value="Teknisi" ${kategori==='Teknisi'?'selected':''}>Teknisi</option>
                            <option value="Surveyor" ${kategori==='Surveyor'?'selected':''}>Surveyor</option>
                        </select>
                    </td>

                    <td class="text-left col-ketua">
                        <span class="view">${escapeHtml(ketua)}</span>
                    </td>

                    <td class="text-center col-jumlah">
                        <span class="view">${jumlah} orang</span>
                    </td>

                    <td class="text-center col-created">
                        <span class="view">${createdText}</span>
                    </td>

                    <td class="text-center col-aksi">
                        <div class="flex items-center gap-[10px] justify-center">
                            <button type="button" class="btn-icon btn-edit" title="Edit">
                                <i class="material-symbols-outlined text-warning-500">edit</i>
                            </button>
                            <button type="button" class="btn-icon btn-save hidden" title="Simpan">
                                <i class="material-symbols-outlined text-primary-500">save</i>
                            </button>
                            <button type="button" class="btn-icon btn-cancel hidden" title="Batal">
                                <i class="material-symbols-outlined text-gray-500">close</i>
                            </button>
                            <button type="button" class="btn-icon btn-delete" title="Hapus">
                                <i class="material-symbols-outlined text-danger-500">delete</i>
                            </button>
                        </div>
                    </td>
                </tr>
            `;

            const newRowNode = $(rowHtml);
            dt.row.add(newRowNode).draw(false);

            // reset form
            document.getElementById('c_nama_tim').value = '';
            document.getElementById('c_ketua_tim').value = '';
            document.getElementById('c_jumlah').value = '';
            document.getElementById('c_kategori').value = 'Teknisi';
            createForm.classList.add('hidden');

            renumber();
        });

        // === EDIT/DELETE handlers ===
        document.addEventListener('click', function(e){
            const btnEdit = e.target.closest('.btn-edit');
            const btnSave = e.target.closest('.btn-save');
            const btnCancel = e.target.closest('.btn-cancel');
            const btnDelete = e.target.closest('.btn-delete');
            const tr = e.target.closest('tr');
            if(!tr) return;

            // DELETE (frontend only)
            if(btnDelete){
                if(confirm('Yakin hapus data ini?')){
                    dt.row(tr).remove().draw(false);
                    renumber();
                }
                return;
            }

            // EDIT
            if(btnEdit){
                if(tr.dataset.editing === '1') return;
                tr.dataset.editing = '1';

                // backup original
                tr._backup = {
                    nama: tr.querySelector('.col-nama .view').textContent.trim(),
                    ketua: tr.querySelector('.col-ketua .view').textContent.trim(),
                    jumlah: tr.querySelector('.col-jumlah .view').textContent.trim().replace(' orang',''),
                    kategori: tr.querySelector('.col-kategori select').value,
                };

                // turn into inputs (kecuali kategori tetap select)
                tr.querySelector('.col-nama').innerHTML = `<input class="input-inline edit-nama" value="${escapeAttr(tr._backup.nama)}">`;
                tr.querySelector('.col-ketua').innerHTML = `<input class="input-inline edit-ketua" value="${escapeAttr(tr._backup.ketua === '-' ? '' : tr._backup.ketua)}" placeholder="-">`;
                tr.querySelector('.col-jumlah').innerHTML = `<input type="number" min="0" class="input-inline edit-jumlah" value="${escapeAttr(tr._backup.jumlah || '0')}">`;

                // tombol
                toggleButtons(tr, true);
                return;
            }

            // CANCEL
            if(btnCancel){
                if(tr.dataset.editing !== '1') return;
                restoreRow(tr);
                toggleButtons(tr, false);
                tr.dataset.editing = '0';
                return;
            }

            // SAVE
            if(btnSave){
                const nama = tr.querySelector('.edit-nama')?.value?.trim();
                const ketua = tr.querySelector('.edit-ketua')?.value?.trim() || '-';
                const jumlah = tr.querySelector('.edit-jumlah')?.value ? parseInt(tr.querySelector('.edit-jumlah').value, 10) : 0;
                const kategori = tr.querySelector('.col-kategori select')?.value || 'Teknisi';

                if(!nama){
                    alert('Nama Tim wajib diisi!');
                    return;
                }

                // apply view
                tr.querySelector('.col-nama').innerHTML = `<span class="view">${escapeHtml(nama)}</span>`;
                tr.querySelector('.col-ketua').innerHTML = `<span class="view">${escapeHtml(ketua)}</span>`;
                tr.querySelector('.col-jumlah').innerHTML = `<span class="view">${jumlah} orang</span>`;
                // kategori tetep select (udah berubah)

                toggleButtons(tr, false);
                tr.dataset.editing = '0';

                return;
            }
        });

        function toggleButtons(tr, editing){
            tr.querySelector('.btn-edit').classList.toggle('hidden', editing);
            tr.querySelector('.btn-delete').classList.toggle('hidden', editing);
            tr.querySelector('.btn-save').classList.toggle('hidden', !editing);
            tr.querySelector('.btn-cancel').classList.toggle('hidden', !editing);
        }

        function restoreRow(tr){
            if(!tr._backup) return;
            tr.querySelector('.col-nama').innerHTML = `<span class="view">${escapeHtml(tr._backup.nama)}</span>`;
            tr.querySelector('.col-ketua').innerHTML = `<span class="view">${escapeHtml(tr._backup.ketua || '-')}</span>`;
            tr.querySelector('.col-jumlah').innerHTML = `<span class="view">${escapeHtml(tr._backup.jumlah || '0')} orang</span>`;
            tr.querySelector('.col-kategori select').value = tr._backup.kategori;
        }

        // === simple escape helpers ===
        function escapeHtml(str){
            return (str ?? '').toString()
                .replaceAll('&','&amp;')
                .replaceAll('<','&lt;')
                .replaceAll('>','&gt;')
                .replaceAll('"','&quot;')
                .replaceAll("'","&#039;");
        }
        function escapeAttr(str){
            return escapeHtml(str).replaceAll('`','&#096;');
        }
    </script>
@endpush
