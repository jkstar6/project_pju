@extends('layouts.admin.master')

@section('title', 'Tim Lapangan')

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        /* CSS Modal Overlay - PERBAIKAN DI SINI */
        .modal-overlay {
            display: flex;          /* Selalu flex untuk layout center */
            position: fixed;
            inset: 0;
            z-index: 9999;          /* Z-Index sangat tinggi */
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
            
            /* Status Hidden (Default) */
            opacity: 0;
            visibility: hidden;     /* Benar-benar sembunyikan dari render */
            pointer-events: none;   /* PENTING: Agar klik tembus ke belakang saat hidden */
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        /* Status Active (Muncul) */
        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;   /* Aktifkan klik kembali saat muncul */
        }

        /* Fix Z-Index DataTable agar tidak menutupi modal */
        div.dt-container .dt-paging { z-index: 1; }
        
        /* Select2 Customization */
        .select2-container { z-index: 99999 !important; }
        .select2-container .select2-selection--single { height: 45px !important; display: flex; align-items: center; border-color: #e5e7eb; }
        .dark .select2-container .select2-selection--single { background-color: #0c1427; border-color: #172036 !important; color: white; }
        .dark .select2-container--default .select2-selection--single .select2-selection__rendered { color: white; }
        .dark .select2-dropdown { background-color: #0c1427; border-color: #172036; color: white; }
    </style>
@endpush

@section('content')
    @php $canManageTim = auth()->check() && auth()->user()->hasRole('Admin'); @endphp

    <div class="trezo-card bg-white dark:bg-[#0c1427] p-6 rounded-md shadow mb-6">
        <div class="flex items-center justify-between mb-6">
            <h5 class="text-lg font-bold text-gray-800 dark:text-white">Daftar Tim Lapangan</h5>
            @if($canManageTim)
                <button type="button" id="btn-open-create" class="px-4 py-2 bg-primary-500 text-white rounded-md hover:bg-primary-600 flex items-center gap-2 transition-all">
                    <span class="material-symbols-outlined">add</span> Tambah Tim
                </button>
            @endif
        </div>

        {{-- Flash Messages --}}
        @if(session('success')) <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">{{ session('success') }}</div> @endif
        @if(session('error')) <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">{{ session('error') }}</div> @endif

        <div class="overflow-x-auto">
            <table id="data-table" class="display stripe w-full">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama Tim</th>
                        <th class="text-center">Kategori</th>
                        <th>Ketua Tim</th>
                        <th class="text-center">Personel</th>
                        @if($canManageTim) <th class="text-center">Aksi</th> @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($timLapangan as $index => $tim)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td><strong class="text-primary-500">{{ $tim->nama_tim }}</strong></td>
                            <td class="text-center">
                                <span class="px-2 py-1 rounded text-xs font-semibold {{ $tim->kategori == 'Teknisi' ? 'bg-blue-100 text-blue-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ $tim->kategori }}
                                </span>
                            </td>
                            <td>{{ $tim->leader ? $tim->leader->name : '-' }}</td>
                            <td class="text-center">{{ $tim->jumlah_personel }}</td>
                            @if($canManageTim)
                                <td class="text-center">
                                    <div class="flex justify-center gap-2">
                                        <button class="btn-modal-edit-tim text-blue-600 hover:text-blue-800" 
                                            data-url-get="{{ route('tim-lapangan.edit', $tim->id) }}" 
                                            data-url-action="{{ route('tim-lapangan.update', $tim->id) }}">
                                            <i class="material-symbols-outlined">edit</i>
                                        </button>
                                        <form action="{{ route('tim-lapangan.destroy', $tim->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')" style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button class="text-red-500 hover:text-red-700"><i class="material-symbols-outlined">delete</i></button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Include Modals --}}
    @if($canManageTim)
        @include('tim-lapangan.modal-add')
        @include('tim-lapangan.modal-edit')
    @endif
@endsection

@push('scripts')
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.tailwindcss.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Debugging: Cek apakah script jalan
            console.log("Script Tim Lapangan Loaded");

            // --- 1. SETUP DATA & VARIABLE ---
            // Menggunakan try-catch agar jika JSON error, script tidak mati total
            let ALL_USERS = [];
            let CAN_MANAGE = false;

            try {
                ALL_USERS = @json($users ?? []);
                CAN_MANAGE = @json($canManageTim ?? false);
            } catch (e) {
                console.error("Error parsing PHP data:", e);
            }

            // Init Select2 hanya jika Admin
            if (CAN_MANAGE) {
                $('.select2').select2({ width: '100%' });
            }

            // Init DataTable
            $('#data-table').DataTable({
                responsive: true,
                ordering: false, // Matikan sorting sementara jika mengganggu
                pageLength: 10
            });

            // Jika bukan admin, stop script di sini
            if (!CAN_MANAGE) return;

            // --- 2. FUNGSI FILTER LEADERS ---
            function populateLeaders(category, targetSelector, selectedId = null) {
                const filteredUsers = ALL_USERS.filter(user => user.role === category);
                let options = '<option value="">- Pilih Ketua Tim -</option>';
                
                filteredUsers.forEach(user => {
                    const isSelected = (selectedId && user.id == selectedId) ? 'selected' : '';
                    options += `<option value="${user.id}" ${isSelected}>${user.name}</option>`;
                });

                $(targetSelector).html(options).trigger('change');
            }

            // --- 3. EVENT HANDLER: TOMBOL TAMBAH (ADD) ---
            // Menggunakan 'document' binding agar lebih kuat
            $(document).on('click', '#btn-open-create', function(e) {
                e.preventDefault();
                console.log("Tombol Tambah Diklik");

                // Reset Form
                let form = $('form[action*="store"]');
                if(form.length > 0) form[0].reset();

                // Set Default State
                $('select[name="kategori"]').val('Teknisi').trigger('change');
                populateLeaders('Teknisi', 'select[name="leader_id"]');

                // Tampilkan Modal
                $('#modal-add').addClass('active');
            });

            // Event Change Kategori di Modal Add
            $('select[name="kategori"]').on('change', function() {
                // Pastikan ini di dalam form Add
                if ($(this).closest('#modal-add').length > 0) {
                    populateLeaders($(this).val(), 'select[name="leader_id"]');
                }
            });

            // --- 4. EVENT HANDLER: TOMBOL EDIT ---
            $(document).on('click', '.btn-modal-edit-tim', function(e) {
                e.preventDefault();
                console.log("Tombol Edit Diklik");

                const urlGet = $(this).data('url-get');
                const urlAction = $(this).data('url-action');

                $.ajax({
                    url: urlGet,
                    type: 'GET',
                    success: function(response) {
                        console.log("Data Edit Diterima:", response);

                        // Isi Input
                        $('#edit_nama_tim').val(response.nama_tim);
                        $('#edit_jumlah_personel').val(response.jumlah_personel);

                        // Set Select2 Kategori
                        $('#edit_kategori').val(response.kategori).trigger('change');

                        // Isi Leader (Penting: Pass ID leader yang tersimpan)
                        populateLeaders(response.kategori, '#edit_leader_id', response.leader_id);

                        // Update Action Form
                        $('#form-edit').attr('action', urlAction);

                        // Tampilkan Modal
                        $('#modal-edit').addClass('active');
                    },
                    error: function(xhr) {
                        console.error(xhr);
                        alert('Gagal mengambil data. Cek console browser.');
                    }
                });
            });

            // Event Change Kategori di Modal Edit
            $('#edit_kategori').on('change', function() {
                let currentLeader = $('#edit_leader_id').val();
                populateLeaders($(this).val(), '#edit_leader_id', currentLeader);
            });

            // --- 5. TUTUP MODAL ---
            $(document).on('click', '.btn-close-add, .btn-close-edit, .modal-overlay', function(e) {
                // Pastikan yang diklik adalah overlay background atau tombol close
                if ($(e.target).hasClass('modal-overlay') || 
                    $(e.target).closest('.btn-close-add').length > 0 || 
                    $(e.target).closest('.btn-close-edit').length > 0) {
                    
                    $('.modal-overlay').removeClass('active');
                }
            });
        });
    </script>
@endpush