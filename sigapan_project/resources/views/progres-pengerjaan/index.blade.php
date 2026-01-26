@extends('layouts.admin.master')

@section('title', 'Progres Pengerjaan')

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">

    <style>
        #data-table td.text-center { vertical-align: middle; }
        #data-table td:last-child, #data-table td:last-child * { pointer-events: auto; }

        .btn-icon{ cursor:pointer; position:relative; z-index:10; }
        .material-symbols-outlined{ font-size:18px !important; }

        /* modal */
        .modal-overlay{ display:none; }
        .modal-overlay.active{ display:flex; }

        /* Badge tahapan */
        .badge-tahapan {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
        }
        .tahapan-galian { background: #fef3c7; color: #92400e; }
        .tahapan-pengecoran { background: #ddd6fe; color: #5b21b6; }
        .tahapan-pemasangan-tiang { background: #bfdbfe; color: #1e40af; }
        .tahapan-pemasangan-jaringan { background: #bbf7d0; color: #166534; }
        .tahapan-selesai { background: #d1fae5; color: #065f46; }
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
                            <th class="text-left">Lokasi (Maps)</th>
                            <th class="text-left">Keterangan</th>
                            <th class="text-left">Petugas</th>
                            <th class="text-center">Tahapan Terbaru</th>
                            <th class="text-center">Update Terbaru</th>
                            <th class="text-center">Progress</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $mapPersen = [
                                'Galian' => 20,
                                'Pengecoran' => 40,
                                'Pemasangan Tiang dan Armatur' => 60,
                                'Pemasangan Jaringan' => 80,
                                'Selesai' => 100,
                            ];
                        @endphp

                        @foreach ($progresPengerjaan as $item)
                            @php
                                $tahapan = $item->tahapan;
                                $persen = $mapPersen[$tahapan] ?? 0;
                                
                                $badgeClass = match($tahapan) {
                                    'Galian' => 'tahapan-galian',
                                    'Pengecoran' => 'tahapan-pengecoran',
                                    'Pemasangan Tiang dan Armatur' => 'tahapan-pemasangan-tiang',
                                    'Pemasangan Jaringan' => 'tahapan-pemasangan-jaringan',
                                    'Selesai' => 'tahapan-selesai',
                                    default => 'tahapan-galian'
                                };

                                $desa = $item->asetPju->desa ?? '-';
                                $kecamatan = $item->asetPju->kecamatan ?? '-';
                                $lokasiText = "{$desa}, {$kecamatan}";
                                $lat = $item->asetPju->latitude ?? null;
                                $long = $item->asetPju->longitude ?? null;
                            @endphp

                            <tr data-id="{{ $item->id }}" 
                                data-aset_id="{{ $item->aset_pju_id }}"
                                data-kode="{{ $item->asetPju->kode_tiang ?? '-' }}"
                                data-lokasi="{{ $lokasiText }}"
                                data-petugas="{{ $item->user->name ?? '-' }}"
                                data-tahapan="{{ $tahapan }}"
                                data-keterangan="{{ $item->keterangan }}">
                                
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-left"><strong class="text-primary-500">{{ $item->asetPju->kode_tiang ?? '-' }}</strong></td>
                                
                                {{-- Lokasi --}}
                                <td class="text-left">
                                    <div class="flex flex-col">
                                        <span class="font-medium text-gray-700 dark:text-gray-200">{{ $lokasiText }}</span>
                                        @if($lat && $long)
                                            <a href="https://www.google.com/maps?q={{ $lat }},{{ $long }}" 
                                               target="_blank" 
                                               class="text-xs text-blue-500 hover:underline flex items-center gap-1 mt-1">
                                                <i class="material-symbols-outlined text-[14px]">map</i> Lihat Peta
                                            </a>
                                        @endif
                                    </div>
                                </td>

                                {{-- Keterangan --}}
                                <td class="text-left text-sm text-gray-600 dark:text-gray-400">
                                    {{ Str::limit($item->keterangan ?? '-', 50) }}
                                </td>

                                <td class="text-left">{{ $item->user->name ?? '-' }}</td>

                                {{-- Tahapan --}}
                                <td class="text-center">
                                    <span class="badge-tahapan {{ $badgeClass }}">{{ $tahapan }}</span>
                                </td>

                                {{-- Last Update (WIB) --}}
                                <td class="text-center">
                                    <span class="last-update text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        {{ \Carbon\Carbon::parse($item->tgl_update)->timezone('Asia/Jakarta')->format('d M Y H:i') }}
                                    </span>
                                </td>

                                {{-- Progress --}}
                                <td class="text-center">
                                    <div class="w-full max-w-[220px] mx-auto">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700 overflow-hidden">
                                            <div class="progress-bar bg-primary-500 h-2.5 rounded-full" style="width: {{ $persen }}%"></div>
                                        </div>
                                        <span class="progress-text text-xs text-gray-600 dark:text-gray-400">{{ $persen }}%</span>
                                    </div>
                                </td>

                                {{-- Aksi --}}
                                <td class="text-center">
                                    <div class="flex items-center gap-[12px] justify-center">
                                        <button type="button" class="btn-icon btn-edit text-blue-600 custom-tooltip" data-text="Edit">
                                            <i class="material-symbols-outlined">edit</i>
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

    {{-- =========================
        MODAL CREATE
    ========================== --}}
    <div id="modalCreate" class="modal-overlay fixed inset-0 z-[999] items-center justify-center bg-black/50 p-4">
        <div class="w-full max-w-2xl rounded-md bg-white dark:bg-[#0c1427] p-5">
            <div class="flex items-center justify-between mb-4">
                <h5 class="mb-0 font-semibold text-gray-800 dark:text-gray-100">Tambah Progres Pengerjaan</h5>
                <button type="button" class="btn-close-modal text-gray-500 hover:text-gray-800 dark:hover:text-gray-200">
                    <i class="material-symbols-outlined">close</i>
                </button>
            </div>

            <form action="{{ route('progres-pengerjaan.store') }}" method="POST" class="grid grid-cols-1 gap-4">
                @csrf
                
                {{-- Pilih Aset (Filtered by Controller) --}}
                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Pilih Aset PJU</label>
                    <select name="aset_pju_id" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
                        <option value="">-- Pilih Kode Tiang / Lokasi --</option>
                        @foreach($listAset as $aset)
                            <option value="{{ $aset->id }}">
                                {{ $aset->kode_tiang }} - {{ $aset->desa }}, {{ $aset->kecamatan }}
                            </option>
                        @endforeach
                    </select>
                    {{-- Pesan jika kosong --}}
                    @if($listAset->isEmpty())
                        <p class="text-xs text-amber-500 mt-1">Semua aset sudah dalam pengerjaan.</p>
                    @endif
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Tahapan Awal</label>
                    <select name="tahapan" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]">
                        <option value="Galian" selected>Galian (20%)</option>
                        <option value="Pengecoran">Pengecoran (40%)</option>
                        <option value="Pemasangan Tiang dan Armatur">Pemasangan Tiang dan Armatur (60%)</option>
                        <option value="Pemasangan Jaringan">Pemasangan Jaringan (80%)</option>
                        <option value="Selesai">Selesai (100%)</option>
                    </select>
                </div>

                <div class="flex justify-end gap-2 mt-4">
                    <button type="button" class="btn-close-modal px-4 py-2 rounded-md bg-gray-100 dark:bg-[#15203c] text-gray-700 dark:text-gray-200">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-md bg-primary-500 text-white hover:bg-primary-600" {{ $listAset->isEmpty() ? 'disabled' : '' }}>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- =========================
        MODAL EDIT
    ========================== --}}
    <div id="modalEdit" class="modal-overlay fixed inset-0 z-[999] items-center justify-center bg-black/50 p-4">
        <div class="w-full max-w-2xl rounded-md bg-white dark:bg-[#0c1427] p-5">
            <div class="flex items-center justify-between mb-4">
                <h5 class="mb-0 font-semibold text-gray-800 dark:text-gray-100">Edit Progres Pengerjaan</h5>
                <button type="button" class="btn-close-modal text-gray-500 hover:text-gray-800 dark:hover:text-gray-200">
                    <i class="material-symbols-outlined">close</i>
                </button>
            </div>

            <form id="formEdit" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf
                @method('PUT')
                
                {{-- Readonly Data --}}
                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Kode Aset</label>
                    <input type="text" id="edit_kode" class="w-full mt-1 border rounded-md px-3 py-2 bg-gray-100 dark:bg-[#15203c] dark:border-[#15203c]" readonly>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Lokasi</label>
                    <input type="text" id="edit_lokasi" class="w-full mt-1 border rounded-md px-3 py-2 bg-gray-100 dark:bg-[#15203c] dark:border-[#15203c]" readonly>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Petugas Update (Anda)</label>
                    <input type="text" value="{{ Auth::user()->name }}" class="w-full mt-1 border rounded-md px-3 py-2 bg-gray-100 dark:bg-[#15203c] dark:border-[#15203c]" readonly>
                </div>

                {{-- Input Editable --}}
                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Tahapan</label>
                    <select name="tahapan" id="edit_tahapan" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]">
                        <option value="Galian">Galian (20%)</option>
                        <option value="Pengecoran">Pengecoran (40%)</option>
                        <option value="Pemasangan Tiang dan Armatur">Pemasangan Tiang dan Armatur (60%)</option>
                        <option value="Pemasangan Jaringan">Pemasangan Jaringan (80%)</option>
                        <option value="Selesai">Selesai (100%)</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="text-sm text-gray-600 dark:text-gray-300">Keterangan</label>
                    <textarea name="keterangan" id="edit_keterangan" rows="3" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" placeholder="Masukkan keterangan progres..."></textarea>
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
        const dt = $('#data-table').DataTable({
            responsive: true,
            order: [[6, 'desc']], 
            pageLength: 25,
            columnDefs: [
                { targets: [0,5,6,7,8], className: 'text-center' },
                { targets: [1,2,3,4], className: 'text-left' }
            ]
        });

        const modalCreate = document.getElementById('modalCreate');
        const modalEdit = document.getElementById('modalEdit');
        
        function openModal(m){ m.classList.add('active'); }
        function closeModal(m){ m.classList.remove('active'); }

        document.getElementById('btnOpenCreate').addEventListener('click', () => {
            openModal(modalCreate);
        });

        document.addEventListener('click', function(e){
            if (e.target.closest('.btn-close-modal')) { 
                closeModal(modalCreate); 
                closeModal(modalEdit); 
            }
            if (e.target === modalCreate) closeModal(modalCreate);
            if (e.target === modalEdit) closeModal(modalEdit);
        });

        document.addEventListener('click', function(e){
            const btn = e.target.closest('.btn-edit');
            if (!btn) return;

            const tr = btn.closest('tr');
            const id = tr.dataset.id;
            const kode = tr.dataset.kode;
            const lokasi = tr.dataset.lokasi;
            const tahapan = tr.dataset.tahapan;
            const keterangan = tr.dataset.keterangan;

            const form = document.getElementById('formEdit');
            form.action = "{{ url('progres-pengerjaan') }}/" + id;

            document.getElementById('edit_kode').value = kode;
            document.getElementById('edit_lokasi').value = lokasi;
            document.getElementById('edit_tahapan').value = tahapan;
            document.getElementById('edit_keterangan').value = (keterangan === '-') ? '' : keterangan;

            openModal(modalEdit);
        });
    </script>
@endpush