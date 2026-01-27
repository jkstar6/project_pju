@extends('layouts.admin.master')

@section('title', 'Master Jalan')

@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('master-jalan') }} --}}
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">

    <style>
        #data-table td.text-center { vertical-align: middle; }
        .btn-icon { cursor: pointer; }
        .material-symbols-outlined { font-size:18px !important; }

        /* Modal */
        .modal-overlay { display: none; }
        .modal-overlay.active { display: flex; }

        /* Badge Kategori Jalan */
        .badge-kategori {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
        }
        /* Warna Badge Berdasarkan Hierarki Jalan */
        .kategori-nasional { background: #fee2e2; color: #991b1b; } /* Merah */
        .kategori-provinsi { background: #ffedd5; color: #9a3412; } /* Orange */
        .kategori-kabupaten { background: #dbeafe; color: #1e40af; } /* Biru */
        .kategori-desa { background: #dcfce7; color: #166534; } /* Hijau */
        .kategori-lingkungan { background: #f3f4f6; color: #374151; } /* Abu-abu */
    </style>
@endpush

@section('content')
    <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
        <div class="trezo-card-header mb-[20px] md:mb-[25px] sm:flex sm:items-center sm:justify-between">
            <div class="trezo-card-title">
                <h5 class="mb-0">Daftar @yield('title')</h5>
            </div>

            <div class="trezo-card-subtitle sm:flex sm:items-center">
                <button type="button" id="btn-open-create"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-primary-500 text-white hover:bg-primary-600 transition">
                    <span class="material-symbols-outlined" style="font-size:18px;">add</span>
                    Tambah Jalan Baru
                </button>
            </div>
        </div>

        {{-- Flash Message --}}
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-md">
                {{ session('error') }}
            </div>
        @endif

        <div class="trezo-card-content" id="dataTable">
            <div class="table-responsive overflow-x-auto p-2">
                <table id="data-table" class="display stripe group" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-left">Nama Jalan</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Lebar (m)</th>
                            <th class="text-center">Panjang (m)</th>
                            <th class="text-center">Tipe Perkerasan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($jalan as $index => $item)
                            @php
                                $kategori = $item->kategori_jalan;
                                $badgeClass = match($kategori) {
                                    'Nasional' => 'kategori-nasional',
                                    'Provinsi' => 'kategori-provinsi',
                                    'Kabupaten' => 'kategori-kabupaten',
                                    'Desa' => 'kategori-desa',
                                    default => 'kategori-lingkungan',
                                };
                            @endphp
                            <tr
                                data-id="{{ $item->id }}"
                                data-nama_jalan="{{ $item->nama_jalan }}"
                                data-kategori_jalan="{{ $item->kategori_jalan }}"
                                data-lebar_jalan="{{ $item->lebar_jalan }}"
                                data-panjang_jalan="{{ $item->panjang_jalan }}"
                                data-tipe_perkerasan="{{ $item->tipe_perkerasan }}"
                            >
                                <td class="text-center col-no">{{ $index + 1 }}</td>

                                <td class="text-left">
                                    <strong class="text-primary-500">{{ $item->nama_jalan }}</strong>
                                </td>

                                <td class="text-center">
                                    <span class="badge-kategori {{ $badgeClass }}">{{ $kategori }}</span>
                                </td>

                                <td class="text-center">
                                    {{ $item->lebar_jalan }} m
                                </td>

                                <td class="text-center">
                                    {{ $item->panjang_jalan }} m
                                </td>

                                <td class="text-center">
                                    {{ $item->tipe_perkerasan }}
                                </td>

                                <td class="text-center">
                                    <div class="flex items-center gap-[10px] justify-center">
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

    {{-- MODAL CREATE --}}
    <div id="modalCreate" class="modal-overlay fixed inset-0 z-[999] items-center justify-center bg-black/50 p-4">
        <div class="w-full max-w-2xl rounded-md bg-white dark:bg-[#0c1427] p-5">
            <div class="flex items-center justify-between mb-4">
                <h5 class="mb-0 font-semibold text-gray-800 dark:text-gray-100">Tambah Jalan Baru</h5>
                <button type="button" class="btn-close-modal text-gray-500 hover:text-gray-800 dark:hover:text-gray-200">
                    <i class="material-symbols-outlined">close</i>
                </button>
            </div>

            <form action="{{ route('master-jalan.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf
                <div class="md:col-span-2">
                    <label class="text-sm text-gray-600 dark:text-gray-300">Nama Jalan</label>
                    <input name="nama_jalan" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" placeholder="Contoh: Jl. Merdeka No. 1" required>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Kategori Jalan</label>
                    <select name="kategori_jalan" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
                        <option value="Nasional">Nasional</option>
                        <option value="Provinsi">Provinsi</option>
                        <option value="Kabupaten">Kabupaten</option>
                        <option value="Desa">Desa</option>
                        <option value="Lingkungan">Lingkungan</option>
                    </select>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Tipe Perkerasan</label>
                    <select name="tipe_perkerasan" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
                        <option value="Aspal">Aspal</option>
                        <option value="Beton">Beton</option>
                        <option value="Paving">Paving</option>
                        <option value="Tanah">Tanah</option>
                    </select>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Lebar Jalan (meter)</label>
                    <input type="number" step="0.01" name="lebar_jalan" min="0" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required placeholder="0.00">
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Panjang Jalan (meter)</label>
                    <input type="number" step="0.01" name="panjang_jalan" min="0" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required placeholder="0.00">
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
                <h5 class="mb-0 font-semibold text-gray-800 dark:text-gray-100">Edit Data Jalan</h5>
                <button type="button" class="btn-close-modal text-gray-500 hover:text-gray-800 dark:hover:text-gray-200">
                    <i class="material-symbols-outlined">close</i>
                </button>
            </div>

            {{-- Form Edit action di-set lewat JS --}}
            <form id="formEdit" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf
                @method('PUT')
                
                <div class="md:col-span-2">
                    <label class="text-sm text-gray-600 dark:text-gray-300">Nama Jalan</label>
                    <input name="nama_jalan" id="edit_nama_jalan" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Kategori Jalan</label>
                    <select name="kategori_jalan" id="edit_kategori_jalan" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
                        <option value="Nasional">Nasional</option>
                        <option value="Provinsi">Provinsi</option>
                        <option value="Kabupaten">Kabupaten</option>
                        <option value="Desa">Desa</option>
                        <option value="Lingkungan">Lingkungan</option>
                    </select>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Tipe Perkerasan</label>
                    <select name="tipe_perkerasan" id="edit_tipe_perkerasan" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
                        <option value="Aspal">Aspal</option>
                        <option value="Beton">Beton</option>
                        <option value="Paving">Paving</option>
                        <option value="Tanah">Tanah</option>
                    </select>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Lebar Jalan (meter)</label>
                    <input type="number" step="0.01" name="lebar_jalan" id="edit_lebar_jalan" min="0" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Panjang Jalan (meter)</label>
                    <input type="number" step="0.01" name="panjang_jalan" id="edit_panjang_jalan" min="0" class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
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
                { targets: [0,2,3,4,5,6], className: 'text-center' },
                { targets: [1], className: 'text-left' }
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

        // === Modal helpers ===
        const modalCreate = document.getElementById('modalCreate');
        const modalEdit = document.getElementById('modalEdit');

        function openModal(m){ m.classList.add('active'); }
        function closeModal(m){ m.classList.remove('active'); }

        document.getElementById('btn-open-create').addEventListener('click', () => {
            openModal(modalCreate);
        });

        document.querySelectorAll('.btn-close-modal').forEach(btn => {
            btn.addEventListener('click', () => {
                closeModal(modalCreate);
                closeModal(modalEdit);
            });
        });

        // Close when clicking outside
        window.addEventListener('click', function(e){
            if (e.target === modalCreate) closeModal(modalCreate);
            if (e.target === modalEdit) closeModal(modalEdit);
        });

        // === OPEN EDIT MODAL & POPULATE DATA ===
        document.addEventListener('click', function(e){
            const btn = e.target.closest('.btn-edit');
            if (!btn) return;

            const tr = btn.closest('tr');
            
            // Ambil data dari atribut data- di <tr>
            const id = tr.dataset.id;
            const nama = tr.dataset.nama_jalan;
            const kategori = tr.dataset.kategori_jalan;
            const tipe = tr.dataset.tipe_perkerasan;
            const lebar = tr.dataset.lebar_jalan;
            const panjang = tr.dataset.panjang_jalan;

            // Set Action URL Form Update
            const form = document.getElementById('formEdit');
            form.action = `/master-jalan/${id}`; // Sesuaikan dengan Route Laravel Resource

            // Isi Input
            document.getElementById('edit_nama_jalan').value = nama;
            document.getElementById('edit_kategori_jalan').value = kategori;
            document.getElementById('edit_tipe_perkerasan').value = tipe;
            document.getElementById('edit_lebar_jalan').value = lebar;
            document.getElementById('edit_panjang_jalan').value = panjang;

            openModal(modalEdit);
        });
    </script>
@endpush