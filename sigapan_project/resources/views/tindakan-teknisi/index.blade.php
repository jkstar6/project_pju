@extends('layouts.admin.master')

@section('title', 'Log Tindakan Teknisi')

@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('tindakan-teknisi') }} --}}
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">
@endpush

@section('content')
    <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
        <div class="trezo-card-header mb-[20px] md:mb-[25px] sm:flex sm:items-center sm:justify-between">
            <div class="trezo-card-title">
                <h5 class="mb-0">
                    Daftar @yield('title')
                </h5>
            </div>
            {{-- START: Add New Data --}}
            @can('tindakan-teknisi.create')
                <div class="trezo-card-subtitle sm:flex sm:items-center">
                    <div class="trezo-card-dropdown relative">
                        <button class="trezo-card-dropdown-btn py-[5px] md:py-[6.5px] px-[12px] md:px-[19px] bg-primary-500 text-white transition-all hover:bg-primary-400 rounded-md border border-primary-500 hover:border-primary-400"
                            type="button" id="modal-add-toggle">
                            <i class="ri-menu-add-line"></i>
                            Tambah Log Tindakan
                        </button>
                    </div>
                </div>
            @endcan
            {{-- END: Add New Data --}}
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
                    <tbody>
                        @foreach ($logTindakan as $log)
                            <tr>
                                <td class="text-center">
                                    <strong class="text-primary-500">{{ $log['no_tiket'] }}</strong>
                                </td>
                                <td class="text-left">
                                    <div>
                                        <strong>{{ $log['kode_aset'] }}</strong>
                                        <br>
                                        <small class="text-gray-500">{{ $log['lokasi_aset'] }}</small>
                                    </div>
                                </td>
                                <td class="text-left">
                                    <div class="max-w-xs">
                                        {{ \Illuminate\Support\Str::limit($log['hasil_cek'], 60) }}
                                    </div>
                                </td>
                                <td class="text-left">{{ $log['nama_teknisi'] }}</td>
                                <td class="text-center">
                                    {{ date('d M Y H:i', strtotime($log['created_at'])) }}
                                </td>
                                <td class="text-center">
                                    <div class="flex items-center gap-[9px] justify-center">
                                        @can('tindakan-teknisi.read')
                                            <a href="{{ route('tindakan-teknisi.show', $log['id']) }}"
                                                class="text-primary-500 leading-none custom-tooltip" id="customTooltip"
                                                data-text="Detail">
                                                <i class="material-symbols-outlined !text-md">
                                                    visibility
                                                </i>
                                            </a>
                                        @endcan
                                        @can('tindakan-teknisi.update')
                                            <button type="button" class="btn-modal-edit-log text-warning-500 dark:text-warning-400 leading-none custom-tooltip" id="customTooltip" data-text="Edit"
                                                data-id="{{ $log['id'] }}"
                                                data-url-action="{{ route('tindakan-teknisi.update', $log['id']) }}"
                                                data-url-get="{{ route('tindakan-teknisi.edit', $log['id']) }}">
                                                <i class="material-symbols-outlined !text-md">
                                                    edit
                                                </i>
                                            </button>
                                        @endcan
                                        @can('tindakan-teknisi.delete')
                                            <form action="{{ route('tindakan-teknisi.destroy', $log['id']) }}" method="post" class="d-inline">
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- START: Import Modal Add --}}
    @can('tindakan-teknisi.create')
        @include('tindakan-teknisi.modal-add')
    @endcan
    {{-- END: Import Modal Add --}}

    {{-- START: Import Modal Edit --}}
    @can('tindakan-teknisi.update')
        @include('tindakan-teknisi.modal-edit')
    @endcan
    {{-- END: Import Modal Edit --}}
@endsection

@push('scripts')
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.tailwindcss.js') }}"></script>

    <script>
        $('#data-table').DataTable({
            responsive: true,
            "pageLength": 25,
            "order": [[4, 'desc']] // Sort by date descending
        });
    </script>
@endpush