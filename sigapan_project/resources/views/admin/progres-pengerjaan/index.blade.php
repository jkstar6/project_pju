@extends('layouts.admin.master')

@section('title', 'Progres Pengerjaan')

@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('progres-pengerjaan') }} --}}
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">
@endpush

@section('content')
    <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
        <div class="trezo-card-header mb-[20px] md:mb-[25px] sm:flex sm:items-center sm:justify-between">
            <div class="trezo-card-title">
                <h5 class="mb-0">
                    Data @yield('title') PJU Baru
                    
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
                            <th class="text-left">Petugas</th>
                            <th class="text-center">Tahapan Terakhir</th>
                            <th class="text-center">Update Terakhir</th>
                            <th class="text-center">Progress</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @can('progres-pengerjaan.read')
                            @php
                                $groupedProgres = collect($progresPengerjaan)->groupBy('aset_pju_id');
                            @endphp
                            @foreach ($groupedProgres as $asetId => $progresses)
                                @php
                                    $latestProgres = $progresses->sortByDesc('tgl_update')->first();
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-left">
                                        <strong class="text-primary-500">{{ $latestProgres['kode_aset'] }}</strong>
                                    </td>
                                    <td class="text-left">{{ $latestProgres['lokasi_proyek'] }}</td>
                                    <td class="text-left">{{ $latestProgres['nama_petugas'] }}</td>
                                    <td class="text-center">
                                        <span class="px-[8px] py-[3px] inline-block rounded-sm font-medium text-xs
                                            @if($latestProgres['tahapan'] == 'Selesai') bg-primary-50 dark:bg-[#15203c] text-primary-500
                                            @elseif($latestProgres['tahapan'] == 'Galian') bg-gray-100 dark:bg-[#15203c] text-gray-600
                                            @else bg-blue-100 dark:bg-[#15203c] text-blue-600
                                            @endif">
                                            {{ $latestProgres['tahapan'] }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        {{ date('d M Y H:i', strtotime($latestProgres['tgl_update'])) }}
                                    </td>
                                    <td class="text-center">
                                        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                            <div class="bg-primary-500 h-2.5 rounded-full" style="width: {{ $latestProgres['persentase'] }}%"></div>
                                        </div>
                                        <span class="text-xs text-gray-600 dark:text-gray-400">{{ $latestProgres['persentase'] }}%</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="flex items-center gap-[9px] justify-center">
                                            @can(abilities: 'progres-pengerjaan.read')
                                                <a href="{{ route('admin.progres-pengerjaan.show', $latestProgres['aset_pju_id']) }}" class="text-primary-500 leading-none custom-tooltip" id="customTooltip" data-text="Lihat Histori">
                                                    <i class="material-symbols-outlined !text-md">
                                                        history
                                                    </i>
                                                </a>
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
            "order": [[5, 'desc']], // Sort by update terakhir descending
            "pageLength": 25
        });
    </script>
@endpush