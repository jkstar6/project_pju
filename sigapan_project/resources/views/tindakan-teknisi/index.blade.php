@extends('layouts.admin.master')

@section('title', 'Log Tindakan Teknisi')

@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('tindakan-teknisi') }} --}}
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">
    <style>
        #data-table td.text-center { vertical-align: middle; }
        .btn-icon { cursor: pointer; }
        .material-symbols-outlined{ font-size:18px !important; }

        /* Modal */
        .yam-modal-backdrop{
            position: fixed; inset: 0; background: rgba(0,0,0,.45);
            display:none; align-items:center; justify-content:center;
            z-index: 9999; padding: 16px;
        }
        .yam-modal{ width:100%; max-width:760px; background:#fff; border-radius:12px; overflow:hidden; }
        .yam-modal-header{ padding:14px 18px; border-bottom:1px solid #eee; display:flex; justify-content:space-between; align-items:center; }
        .yam-modal-body{ padding:16px 18px; }
        .yam-modal-footer{ padding:14px 18px; border-top:1px solid #eee; display:flex; gap:10px; justify-content:flex-end; }
        .yam-input{ width:100%; border:1px solid #e5e7eb; border-radius:8px; padding:10px 12px; font-size:14px; outline:none; }
        .yam-btn{ border-radius:10px; padding:9px 14px; font-size:14px; border:1px solid transparent; }
        .yam-btn-primary{ background:#3b82f6; color:#fff; border-color:#3b82f6; }
        .yam-btn-secondary{ background:#fff; color:#111827; border-color:#e5e7eb; }
        .yam-grid{ display:grid; grid-template-columns: 1fr 1fr; gap:12px; }
        .yam-grid-1{ grid-template-columns:1fr; }
        .yam-label{ font-size:12px; color:#6b7280; margin-bottom:6px; display:block; }
        .yam-kv{ background:#f9fafb; border:1px solid #eef2f7; padding:10px 12px; border-radius:10px; }
        .yam-value{ font-size:14px; color:#111827; white-space:pre-wrap; }

        /* Toast */
        .yam-toast{
            position: fixed; right: 16px; bottom: 16px;
            background:#111827; color:#fff; padding:10px 12px;
            border-radius: 10px; font-size: 13px;
            display:none; z-index: 10000;
        }
    </style>
@endpush

@section('content')
    <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
        <div class="trezo-card-header mb-[20px] md:mb-[25px] sm:flex sm:items-center sm:justify-between">
            <div class="trezo-card-title">
                <h5 class="mb-0">Daftar @yield('title')</h5>
            </div>

            {{-- CREATE UI --}}
            <div class="trezo-card-subtitle sm:flex sm:items-center">
                <button
                    type="button"
                    id="btn-open-create"
                    class="trezo-card-dropdown-btn py-[5px] md:py-[6.5px] px-[12px] md:px-[19px] bg-primary-500 text-white transition-all hover:bg-primary-400 rounded-md border border-primary-500 hover:border-primary-400">
                    <i class="ri-menu-add-line"></i>
                    Tambah Log Tindakan
                </button>
            </div>
        </div>

        <div class="trezo-card-content" id="dataTable">
            <div class="table-responsive overflow-x-auto p-2">
                <table id="data-table" class="display stripe group" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">No. Tiket</th>
                            <th class="text-left">Lokasi PJU</th>
                            <th class="text-left">Hasil Pengecekan</th>
                            <th class="text-left">Teknisi</th>
                            <th class="text-center">Waktu Tindakan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="table-body">
                        @foreach ($logTindakan as $log)
                            @php
                                $id = $log['id'] ?? ('seed-' . $loop->iteration);
                                $createdAt = isset($log['created_at']) ? date('d M Y H:i', strtotime($log['created_at'])) : '-';
                            @endphp

                            <tr
                                data-id="{{ $id }}"
                                data-no_tiket="{{ $log['no_tiket'] ?? '-' }}"
                                data-kode_aset="{{ $log['kode_aset'] ?? '-' }}"
                                data-lokasi_aset="{{ $log['lokasi_aset'] ?? '-' }}"
                                data-hasil_cek="{{ e($log['hasil_cek'] ?? '-') }}"
                                data-nama_teknisi="{{ $log['nama_teknisi'] ?? '-' }}"
                                data-created_at="{{ $createdAt }}"
                            >
                                <td class="text-center">
                                    <strong class="text-primary-500">{{ $log['no_tiket'] ?? '-' }}</strong>
                                </td>

                                <td class="text-left">
                                    <div>
                                        <strong>{{ $log['kode_aset'] ?? '-' }}</strong><br>
                                        <small class="text-gray-500">{{ $log['lokasi_aset'] ?? '-' }}</small>
                                    </div>
                                </td>

                                <td class="text-left">
                                    <div class="max-w-xs">
                                        {{ \Illuminate\Support\Str::limit(($log['hasil_cek'] ?? '-'), 60) }}
                                    </div>
                                </td>

                                <td class="text-left">{{ $log['nama_teknisi'] ?? '-' }}</td>

                                <td class="text-center">{{ $createdAt }}</td>

                                <td class="text-center">
                                    <div class="flex items-center gap-[10px] justify-center">
                                        {{-- ✅ DETAIL: BUTTON (bukan link) jadi tidak pindah halaman --}}
                                        <button type="button" class="btn-icon btn-open-detail text-primary-500" title="Detail">
                                            <i class="material-symbols-outlined">visibility</i>
                                        </button>

                                        <button type="button" class="btn-icon btn-open-edit text-warning-500" title="Edit">
                                            <i class="material-symbols-outlined">edit</i>
                                        </button>

                                        <button type="button" class="btn-icon btn-delete-row text-danger-500" title="Delete">
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

    {{-- MODAL DETAIL --}}
    <div class="yam-modal-backdrop" id="modal-detail">
        <div class="yam-modal">
            <div class="yam-modal-header">
                <div style="font-weight:600;">Detail Log Tindakan</div>
                <button type="button" class="btn-icon" data-close-modal="modal-detail">
                    <i class="material-symbols-outlined">close</i>
                </button>
            </div>

            <div class="yam-modal-body">
                <div class="yam-grid">
                    <div class="yam-kv">
                        <span class="yam-label">No. Tiket</span>
                        <div class="yam-value" id="d_no_tiket">-</div>
                    </div>
                    <div class="yam-kv">
                        <span class="yam-label">Teknisi</span>
                        <div class="yam-value" id="d_nama_teknisi">-</div>
                    </div>
                </div>

                <div class="yam-grid" style="margin-top:12px;">
                    <div class="yam-kv">
                        <span class="yam-label">Kode Aset</span>
                        <div class="yam-value" id="d_kode_aset">-</div>
                    </div>
                    <div class="yam-kv">
                        <span class="yam-label">Lokasi Aset</span>
                        <div class="yam-value" id="d_lokasi_aset">-</div>
                    </div>
                </div>

                <div class="yam-grid yam-grid-1" style="margin-top:12px;">
                    <div class="yam-kv">
                        <span class="yam-label">Waktu Tindakan</span>
                        <div class="yam-value" id="d_created_at">-</div>
                    </div>
                </div>

                <div class="yam-grid yam-grid-1" style="margin-top:12px;">
                    <div class="yam-kv">
                        <span class="yam-label">Hasil Pengecekan</span>
                        <div class="yam-value" id="d_hasil_cek">-</div>
                    </div>
                </div>
            </div>

            <div class="yam-modal-footer">
                <button type="button" class="yam-btn yam-btn-secondary" data-close-modal="modal-detail">Tutup</button>
            </div>
        </div>
    </div>

    {{-- MODAL CREATE --}}
    <div class="yam-modal-backdrop" id="modal-create">
        <div class="yam-modal">
            <div class="yam-modal-header">
                <div style="font-weight:600;">Tambah Log Tindakan</div>
                <button type="button" class="btn-icon" data-close-modal="modal-create">
                    <i class="material-symbols-outlined">close</i>
                </button>
            </div>

            <form id="form-create">
                <div class="yam-modal-body">
                    <div class="yam-grid">
                        <div>
                            <label class="yam-label">No. Tiket</label>
                            <input name="no_tiket" class="yam-input" required>
                        </div>
                        <div>
                            <label class="yam-label">Nama Teknisi</label>
                            <input name="nama_teknisi" class="yam-input" required>
                        </div>
                    </div>

                    <div class="yam-grid" style="margin-top:12px;">
                        <div>
                            <label class="yam-label">Kode Aset</label>
                            <input name="kode_aset" class="yam-input" required>
                        </div>
                        <div>
                            <label class="yam-label">Lokasi Aset</label>
                            <input name="lokasi_aset" class="yam-input" required>
                        </div>
                    </div>

                    <div style="margin-top:12px;">
                        <label class="yam-label">Hasil Pengecekan</label>
                        <textarea name="hasil_cek" class="yam-input" rows="4" required></textarea>
                    </div>
                </div>

                <div class="yam-modal-footer">
                    <button type="button" class="yam-btn yam-btn-secondary" data-close-modal="modal-create">Batal</button>
                    <button type="submit" class="yam-btn yam-btn-primary">Simpan (UI)</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div class="yam-modal-backdrop" id="modal-edit">
        <div class="yam-modal">
            <div class="yam-modal-header">
                <div style="font-weight:600;">Edit Log Tindakan</div>
                <button type="button" class="btn-icon" data-close-modal="modal-edit">
                    <i class="material-symbols-outlined">close</i>
                </button>
            </div>

            <form id="form-edit">
                <input type="hidden" id="e_row_id">

                <div class="yam-modal-body">
                    <div class="yam-grid">
                        <div>
                            <label class="yam-label">No. Tiket</label>
                            <input id="e_no_tiket" class="yam-input" required>
                        </div>
                        <div>
                            <label class="yam-label">Nama Teknisi</label>
                            <input id="e_nama_teknisi" class="yam-input" required>
                        </div>
                    </div>

                    <div class="yam-grid" style="margin-top:12px;">
                        <div>
                            <label class="yam-label">Kode Aset</label>
                            <input id="e_kode_aset" class="yam-input" required>
                        </div>
                        <div>
                            <label class="yam-label">Lokasi Aset</label>
                            <input id="e_lokasi_aset" class="yam-input" required>
                        </div>
                    </div>

                    <div style="margin-top:12px;">
                        <label class="yam-label">Hasil Pengecekan</label>
                        <textarea id="e_hasil_cek" class="yam-input" rows="4" required></textarea>
                    </div>
                </div>

                <div class="yam-modal-footer">
                    <button type="button" class="yam-btn yam-btn-secondary" data-close-modal="modal-edit">Batal</button>
                    <button type="submit" class="yam-btn yam-btn-primary">Update (UI)</button>
                </div>
            </form>
        </div>
    </div>

    <div class="yam-toast" id="yam-toast">OK</div>
@endsection

@push('scripts')
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.tailwindcss.js') }}"></script>

    <script>
        // DataTables aman
        let dt = null;
        if (window.jQuery && jQuery.fn && typeof jQuery.fn.DataTable === 'function') {
            dt = $('#data-table').DataTable({
                responsive: true,
                pageLength: 25,
                order: [[4, 'desc']]
            });
        }

        function openModal(id){ const el=document.getElementById(id); if(el) el.style.display='flex'; }
        function closeModal(id){ const el=document.getElementById(id); if(el) el.style.display='none'; }
        function toast(msg){
            const t=document.getElementById('yam-toast');
            t.textContent=msg; t.style.display='block';
            clearTimeout(window.__toastTimer);
            window.__toastTimer=setTimeout(()=>t.style.display='none', 1600);
        }
        function nowStr(){
            const d=new Date();
            const pad=n=>(n<10?'0'+n:''+n);
            const months=['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
            return `${pad(d.getDate())} ${months[d.getMonth()]} ${d.getFullYear()} ${pad(d.getHours())}:${pad(d.getMinutes())}`;
        }
        function escapeHtml(s){
            return (s ?? '').toString()
                .replaceAll('&','&amp;')
                .replaceAll('<','&lt;')
                .replaceAll('>','&gt;')
                .replaceAll('"','&quot;')
                .replaceAll("'",'&#039;');
        }
        function limitText(s, max=60){
            s = (s ?? '').toString();
            return s.length > max ? (s.slice(0,max)+'...') : s;
        }
        function buildLokasiCell(kode, lokasi){
            return `
                <div>
                    <strong>${escapeHtml(kode)}</strong><br>
                    <small class="text-gray-500">${escapeHtml(lokasi)}</small>
                </div>
            `;
        }
        function buildAksiCell(){
            return `
                <div class="flex items-center gap-[10px] justify-center">
                    <button type="button" class="btn-icon btn-open-detail text-primary-500" title="Detail">
                        <i class="material-symbols-outlined">visibility</i>
                    </button>
                    <button type="button" class="btn-icon btn-open-edit text-warning-500" title="Edit">
                        <i class="material-symbols-outlined">edit</i>
                    </button>
                    <button type="button" class="btn-icon btn-delete-row text-danger-500" title="Delete">
                        <i class="material-symbols-outlined">delete</i>
                    </button>
                </div>
            `;
        }

        // Open create
        document.getElementById('btn-open-create')?.addEventListener('click', () => {
            document.getElementById('form-create')?.reset();
            openModal('modal-create');
        });

        // Close modal by button
        document.addEventListener('click', function(e){
            const closeBtn = e.target.closest('[data-close-modal]');
            if(closeBtn) closeModal(closeBtn.getAttribute('data-close-modal'));
        });

        // Close modal by backdrop
        ['modal-detail','modal-create','modal-edit'].forEach(id=>{
            document.getElementById(id)?.addEventListener('click', (e)=>{
                if(e.target.id === id) closeModal(id);
            });
        });

        // Row actions (detail/edit/delete) - SEMUA DI HALAMAN INI, TIDAK PINDAH ROUTE
        document.addEventListener('click', function(e){
            const tr = e.target.closest('#data-table tbody tr');
            if(!tr) return;

            if(e.target.closest('.btn-open-detail')){
                document.getElementById('d_no_tiket').textContent = tr.dataset.no_tiket || '-';
                document.getElementById('d_nama_teknisi').textContent = tr.dataset.nama_teknisi || '-';
                document.getElementById('d_kode_aset').textContent = tr.dataset.kode_aset || '-';
                document.getElementById('d_lokasi_aset').textContent = tr.dataset.lokasi_aset || '-';
                document.getElementById('d_created_at').textContent = tr.dataset.created_at || '-';
                document.getElementById('d_hasil_cek').textContent = tr.dataset.hasil_cek || '-';
                openModal('modal-detail');
                return;
            }

            if(e.target.closest('.btn-open-edit')){
                document.getElementById('e_row_id').value = tr.dataset.id || '';
                document.getElementById('e_no_tiket').value = tr.dataset.no_tiket || '';
                document.getElementById('e_nama_teknisi').value = tr.dataset.nama_teknisi || '';
                document.getElementById('e_kode_aset').value = tr.dataset.kode_aset || '';
                document.getElementById('e_lokasi_aset').value = tr.dataset.lokasi_aset || '';
                document.getElementById('e_hasil_cek').value = tr.dataset.hasil_cek || '';
                openModal('modal-edit');
                return;
            }

            if(e.target.closest('.btn-delete-row')){
                if(!confirm('Yakin hapus data ini? (UI saja)')) return;
                if(dt) dt.row(tr).remove().draw(false);
                else tr.remove();
                toast('Data terhapus (UI).');
                return;
            }
        });

        // CREATE submit (UI)
        document.getElementById('form-create')?.addEventListener('submit', function(ev){
            ev.preventDefault();

            const fd = new FormData(this);
            const no_tiket = (fd.get('no_tiket')||'').trim();
            const nama_teknisi = (fd.get('nama_teknisi')||'').trim();
            const kode_aset = (fd.get('kode_aset')||'').trim();
            const lokasi_aset = (fd.get('lokasi_aset')||'').trim();
            const hasil_cek = (fd.get('hasil_cek')||'').trim();

            if(!no_tiket || !nama_teknisi || !kode_aset || !lokasi_aset || !hasil_cek){
                toast('Lengkapi semua field.');
                return;
            }

            const id = 'ui-' + Math.random().toString(36).slice(2,9);
            const createdAt = nowStr();

            if(dt){
                const node = dt.row.add([
                    `<strong class="text-primary-500">${escapeHtml(no_tiket)}</strong>`,
                    buildLokasiCell(kode_aset, lokasi_aset),
                    `<div class="max-w-xs">${escapeHtml(limitText(hasil_cek, 60))}</div>`,
                    `${escapeHtml(nama_teknisi)}`,
                    `${escapeHtml(createdAt)}`,
                    buildAksiCell()
                ]).draw(false).node();

                node.dataset.id = id;
                node.dataset.no_tiket = no_tiket;
                node.dataset.kode_aset = kode_aset;
                node.dataset.lokasi_aset = lokasi_aset;
                node.dataset.hasil_cek = hasil_cek;
                node.dataset.nama_teknisi = nama_teknisi;
                node.dataset.created_at = createdAt;
            }else{
                const rowHtml = `
                    <tr data-id="${escapeHtml(id)}"
                        data-no_tiket="${escapeHtml(no_tiket)}"
                        data-kode_aset="${escapeHtml(kode_aset)}"
                        data-lokasi_aset="${escapeHtml(lokasi_aset)}"
                        data-hasil_cek="${escapeHtml(hasil_cek)}"
                        data-nama_teknisi="${escapeHtml(nama_teknisi)}"
                        data-created_at="${escapeHtml(createdAt)}">
                        <td class="text-center"><strong class="text-primary-500">${escapeHtml(no_tiket)}</strong></td>
                        <td class="text-left">${buildLokasiCell(kode_aset, lokasi_aset)}</td>
                        <td class="text-left"><div class="max-w-xs">${escapeHtml(limitText(hasil_cek, 60))}</div></td>
                        <td class="text-left">${escapeHtml(nama_teknisi)}</td>
                        <td class="text-center">${escapeHtml(createdAt)}</td>
                        <td class="text-center">${buildAksiCell()}</td>
                    </tr>
                `;
                document.getElementById('table-body').insertAdjacentHTML('afterbegin', rowHtml);
            }

            closeModal('modal-create');
            toast('Data ditambahkan (UI).');
        });

        // EDIT submit (UI)
        document.getElementById('form-edit')?.addEventListener('submit', function(ev){
            ev.preventDefault();

            const id = document.getElementById('e_row_id').value;
            const no_tiket = document.getElementById('e_no_tiket').value.trim();
            const nama_teknisi = document.getElementById('e_nama_teknisi').value.trim();
            const kode_aset = document.getElementById('e_kode_aset').value.trim();
            const lokasi_aset = document.getElementById('e_lokasi_aset').value.trim();
            const hasil_cek = document.getElementById('e_hasil_cek').value.trim();

            if(!id){ toast('Row tidak ditemukan.'); return; }

            let tr = null;
            document.querySelectorAll('#data-table tbody tr').forEach(r=>{
                if(r.dataset.id === id) tr = r;
            });
            if(!tr){ toast('Row tidak ditemukan.'); return; }

            tr.dataset.no_tiket = no_tiket;
            tr.dataset.nama_teknisi = nama_teknisi;
            tr.dataset.kode_aset = kode_aset;
            tr.dataset.lokasi_aset = lokasi_aset;
            tr.dataset.hasil_cek = hasil_cek;

            if(dt){
                const rowIdx = dt.row(tr).index();
                dt.cell(rowIdx, 0).data(`<strong class="text-primary-500">${escapeHtml(no_tiket)}</strong>`);
                dt.cell(rowIdx, 1).data(buildLokasiCell(kode_aset, lokasi_aset));
                dt.cell(rowIdx, 2).data(`<div class="max-w-xs">${escapeHtml(limitText(hasil_cek, 60))}</div>`);
                dt.cell(rowIdx, 3).data(`${escapeHtml(nama_teknisi)}`);
                dt.draw(false);
            }else{
                tr.children[0].innerHTML = `<strong class="text-primary-500">${escapeHtml(no_tiket)}</strong>`;
                tr.children[1].innerHTML = buildLokasiCell(kode_aset, lokasi_aset);
                tr.children[2].innerHTML = `<div class="max-w-xs">${escapeHtml(limitText(hasil_cek, 60))}</div>`;
                tr.children[3].textContent = nama_teknisi;
            }

            closeModal('modal-edit');
            toast('Data diupdate (UI).');
        });
    </script>
@endpush
