@extends('layouts.admin.master')

@section('title', 'Tim Lapangan')

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        #data-table td.text-center { vertical-align: middle; }
        .btn-icon { cursor: pointer; }
        .material-symbols-outlined { font-size:18px !important; }

        /* --- CSS MODAL STANDARD --- */
        .modal-overlay { 
            display: none; 
            position: fixed; 
            inset: 0; 
            z-index: 999; 
            background-color: rgba(0, 0, 0, 0.5); 
            align-items: center; 
            justify-content: center; 
            overflow-y: auto;
        }
        .modal-overlay.active { 
            display: flex; 
        }

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
        
        /* Fix Select2 di dalam Modal */
        .select2-container { z-index: 99999 !important; }
        .select2-container .select2-selection--single {
            height: 45px !important;
            border-color: #e5e7eb !important;
            display: flex;
            align-items: center;
        }
        .dark .select2-container .select2-selection--single {
            background-color: #0c1427;
            border-color: #172036 !important;
            color: white;
        }
        .dark .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: white;
        }
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
                    Tambah Tim Baru
                </button>
            </div>
        </div>

        {{-- Flash Message --}}
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-md">{{ session('error') }}</div>
        @endif

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
                            <th class="text-center">Diupdate Pada</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="tbody-data">
                        @foreach ($timLapangan as $index => $tim)
                            @php
                                $kategori = $tim->kategori;
                                $badgeClass = $kategori === 'Teknisi' ? 'kategori-teknisi' : 'kategori-surveyor';
                            @endphp
                            <tr>
                                <td class="text-center col-no">{{ $index + 1 }}</td>
                                <td class="text-left col-nama">
                                    <strong class="text-primary-500">{{ $tim->nama_tim }}</strong>
                                </td>
                                <td class="text-center col-kategori">
                                    <span class="badge-kategori {{ $badgeClass }}">{{ $kategori }}</span>
                                </td>
                                <td class="text-left col-ketua">
                                    {{ $tim->leader ? $tim->leader->name : '-' }}
                                </td>
                                <td class="text-center col-jumlah">
                                    {{ $tim->jumlah_personel }} orang
                                </td>
                                
                                {{-- Kolom Dibuat Pada (WIB) --}}
                                <td class="text-center col-created">
                                    {{ $tim->created_at ? $tim->created_at->timezone('Asia/Jakarta')->format('d M Y, H:i') : '-' }}
                                </td>

                                {{-- Kolom Diupdate Pada (WIB) --}}
                                <td class="text-center col-updated">
                                    {{ $tim->updated_at ? $tim->updated_at->timezone('Asia/Jakarta')->format('d M Y, H:i') : '-' }}
                                </td>

                                <td class="text-center col-aksi">
                                    <div class="flex items-center gap-[10px] justify-center">
                                        {{-- TOMBOL EDIT --}}
                                        <button type="button" 
                                            class="btn-icon btn-modal-edit-tim text-blue-600 custom-tooltip" 
                                            data-text="Edit"
                                            data-url-get="{{ route('tim-lapangan.edit', $tim->id) }}"
                                            data-url-action="{{ route('tim-lapangan.update', $tim->id) }}">
                                            <i class="material-symbols-outlined">edit</i>
                                        </button>

                                        {{-- TOMBOL DELETE --}}
                                        <form action="{{ route('tim-lapangan.destroy', $tim->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?');" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon text-danger-500 custom-tooltip" data-text="Hapus">
                                                <i class="material-symbols-outlined">delete</i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- INCLUDE MODALS (Hanya HTML) --}}
    @include('tim-lapangan.modal-add')
    @include('tim-lapangan.modal-edit')

@endsection

@push('scripts')
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.tailwindcss.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // 1. Init Select2
            $('.select2').select2({ width: '100%' });

            // 2. Init DataTable
            const dt = $('#data-table').DataTable({
                responsive: true,
                pageLength: 10,
                columnDefs: [
                    // Kolom Center: No(0), Kategori(2), Jml(4), Dibuat(5), Diupdate(6), Aksi(7)
                    { targets: [0,2,4,5,6,7], className: 'text-center' },
                    // Kolom Left: Nama(1), Ketua(3)
                    { targets: [1,3], className: 'text-left' }
                ]
            });
            dt.on('draw', function(){
                let i = 1;
                dt.rows({search:'applied', order:'applied'}).nodes().each(function(cell, j) {
                    $(cell).find('.col-no').text(i++);
                });
            });

            // 3. Logic Modal CREATE
            $('#btn-open-create').on('click', function() {
                $('#modal-add').addClass('active');
            });
            $('.btn-close-add').on('click', function() {
                $('#modal-add').removeClass('active');
            });

            // 4. Logic Modal EDIT (AJAX)
            $('body').on('click', '.btn-modal-edit-tim', function(e) {
                e.preventDefault();
                
                let urlGet = $(this).data('url-get');
                let urlAction = $(this).data('url-action');

                $.ajax({
                    url: urlGet,
                    type: 'GET',
                    success: function(response) {
                        $('#edit_nama_tim').val(response.nama_tim);
                        $('#edit_jumlah_personel').val(response.jumlah_personel);
                        
                        $('#edit_kategori').val(response.kategori).trigger('change');
                        $('#edit_leader_id').val(response.leader_id).trigger('change');

                        $('#form-edit').attr('action', urlAction);

                        $('#modal-edit').addClass('active');
                    },
                    error: function(xhr) {
                        alert('Gagal mengambil data. Coba lagi.');
                        console.error(xhr);
                    }
                });
            });

            $('.btn-close-edit').on('click', function() {
                $('#modal-edit').removeClass('active');
            });

            $(window).on('click', function(e) {
                if ($(e.target).is('#modal-add')) {
                    $('#modal-add').removeClass('active');
                }
                if ($(e.target).is('#modal-edit')) {
                    $('#modal-edit').removeClass('active');
                }
            });
        });
    </script>
@endpush