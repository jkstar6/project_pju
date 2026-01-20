@extends('layouts.admin.master')

@section('title', 'Log Survey')

@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('log-survey') }} --}}
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">
@endpush

@section('content')
    <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
        <div class="trezo-card-header mb-[20px] md:mb-[25px] sm:flex sm:items-center sm:justify-between">
            <div class="trezo-card-title">
                <h5 class="mb-0">
                    Data @yield('title') Harian
                </h5>
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
                            <th class="text-left">Surveyor</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Kondisi</th>
                            <th class="text-center">Keberadaan</th>
                            <th class="text-left">Catatan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @can('log-survey.read')
                            @foreach ($logSurvey as $index => $log)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-left">{{ $log['kode_aset'] }}</td>
                                    <td class="text-left">{{ $log['lokasi_aset'] }}</td>
                                    <td class="text-left">{{ $log['nama_surveyor'] }}</td>
                                    <td class="text-center">{{ date('d M Y', strtotime($log['tgl_survey'])) }}</td>
                                    <td class="text-center">
                                        <span class="px-[8px] py-[3px] inline-block rounded-sm font-medium text-xs
                                            @if($log['kondisi'] == 'Nyala') bg-primary-50 dark:bg-[#15203c] text-primary-500
                                            @elseif($log['kondisi'] == 'Mati') bg-orange-100 dark:bg-[#15203c] text-orange-600
                                            @else bg-red-100 dark:bg-[#15203c] text-red-600
                                            @endif">
                                            {{ $log['kondisi'] }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="px-[8px] py-[3px] inline-block rounded-sm font-medium text-xs
                                            {{ $log['keberadaan'] == 'Ada' ? 'bg-primary-50 dark:bg-[#15203c] text-primary-500' : 'bg-red-100 dark:bg-[#15203c] text-red-600' }}">
                                            {{ $log['keberadaan'] }}
                                        </span>
                                    </td>
                                    <td class="text-left">{{ $log['catatan_kerusakan'] ?? '-' }}</td>
                                    <td class="text-center">
                                        <div class="flex items-center gap-[9px] justify-center">
                                            @can('log-survey.read')
                                                <a href="#" class="text-primary-500 leading-none custom-tooltip" id="customTooltip" data-text="Detail">
                                                    <i class="material-symbols-outlined !text-md">
                                                        visibility
                                                    </i>
                                                </a>
                                            @endcan
                                            @can('log-survey.delete')
                                                <form action="{{ route('admin.log-survey.destroy', $log['id']) }}" method="post" class="d-inline">
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
                        @endcan
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
        $('#data-table').DataTable({
            responsive: true,
            "order": [[4, 'desc']], // Sort by tanggal survey descending
            "pageLength": 25
        });
    </script>
@endpush