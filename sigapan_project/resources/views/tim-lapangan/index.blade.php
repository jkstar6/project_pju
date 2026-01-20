@extends('layouts.admin.master')

@section('title', 'Tim Lapangan')

@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('tim-lapangan') }} --}}
@endsection

@push('styles')
    {{-- DataTables CSS --}}
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">
    {{-- Select2 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <!-- START: Data Table -->
    <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
        <div class="trezo-card-header mb-[20px] md:mb-[25px] sm:flex sm:items-center sm:justify-between">
            <div class="trezo-card-title">
                <h5 class="mb-0">
                    Daftar @yield('title')
                </h5>
            </div>
            {{-- START: Add New Data --}}
            @can('tim-lapangan.create')
                <div class="trezo-card-subtitle sm:flex sm:items-center">
                    <div class="trezo-card-dropdown relative">
                        <button class="trezo-card-dropdown-btn py-[5px] md:py-[6.5px] px-[12px] md:px-[19px] bg-primary-500 text-white transition-all hover:bg-primary-400 rounded-md border border-primary-500 hover:border-primary-400"
                            type="button" id="modal-add-toggle">
                            <i class="ri-menu-add-line"></i>
                            Tambah Tim Baru
                        </button>
                    </div>
                </div>
            @endcan
            {{-- END: Add New Data --}}
        </div>
        {{-- START: Data Table --}}
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
                    <tbody>
                        {{-- @can('tim-lapangan.read') --}}
                            @foreach ($timLapangan as $index => $tim)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-left">{{ $tim['nama_tim'] }}</td>
                                    <td class="text-center">
                                        <span class="px-[8px] py-[3px] inline-block bg-{{ $tim['kategori'] == 'Teknisi' ? 'primary' : 'orange' }}-50 dark:bg-[#15203c] text-{{ $tim['kategori'] == 'Teknisi' ? 'primary' : 'orange' }}-500 rounded-sm font-medium text-xs">
                                            {{ $tim['kategori'] }}
                                        </span>
                                    </td>
                                    <td class="text-left">{{ $tim['leader_name'] ?? '-' }}</td>
                                    <td class="text-center">{{ $tim['jumlah_personel'] }} orang</td>
                                    <td class="text-center">{{ date('d M Y', strtotime($tim['created_at'])) }}</td>
                                    <td class="text-center">
                                        <div class="flex items-center gap-[9px] justify-center">
                                            @can('tim-lapangan.update')
                                                <button type="button" class="btn-modal-edit-tim text-warning-500 dark:text-warning-400 leading-none custom-tooltip" id="customTooltip" data-text="Edit"
                                                    data-id="{{ $tim['id'] }}"
                                                    data-url-action="{{ route('admin.tim-lapangan.update', $tim['id']) }}"
                                                    data-url-get="{{ route('admin.tim-lapangan.edit', $tim['id']) }}">
                                                    <i class="material-symbols-outlined !text-md">
                                                        edit
                                                    </i>
                                                </button>
                                            @endcan
                                            @can('tim-lapangan.delete')
                                                <form action="{{ route('admin.tim-lapangan.destroy', $tim['id']) }}" method="post" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" onclick="confirmDelete(this);" class="text-danger-500 leading-none custom-tooltip" id="customTooltip" data-text="Delete">
                                                        <i class="material-symbols-outlined !text-md">
                                                            delete
                                                        </i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        {{-- @endcan --}}
                    </tbody>
                </table>
            </div>
        </div>
        {{-- END: Data Table --}}
    </div>
    <!-- END: Data Table -->

    {{-- START: Import Modal Add --}}
    @can('tim-lapangan.create')
        @include('admin.tim-lapangan.partials.modal-add')
    @endcan
    {{-- END: Import Modal Add --}}

    {{-- START: Import Modal Edit --}}
    @can('tim-lapangan.update')
        @include('admin.tim-lapangan.partials.modal-edit')
    @endcan
    {{-- END: Import Modal Edit --}}
@endsection

@push('scripts')
    {{-- DataTables JS --}}
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.tailwindcss.js') }}"></script>
    
    <script>
        $('#data-table').DataTable({
            responsive: true,
            "pageLength": 10
        });
    </script>

    {{-- Select2 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%',
                placeholder: '- Pilih Opsi -',
                allowClear: true
            });
        });
    </script>
@endpush