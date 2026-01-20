@extends('layouts.admin.master')

@section('title', 'Tiket Perbaikan')

@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('tiket-perbaikan') }} --}}
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
        </div>

        <div class="trezo-card-content" id="dataTable">
            <div class="table-responsive overflow-x-auto p-2">
                <table id="data-table" class="display stripe group" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">No. Tiket</th>
                            <th class="text-left">Lokasi</th>
                            <th class="text-left">Pelapor</th>
                            <th class="text-left">Tim Teknisi</th>
                            <th class="text-center">Jadwal</th>
                            <th class="text-center">Prioritas</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Surat PLN</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @can('tiket-perbaikan.read') --}}
                            @foreach ($tiketPerbaikan as $tiket)
                                <tr>
                                    <td class="text-center">
                                        <strong class="text-primary-500">{{ $tiket['no_tiket'] }}</strong>
                                    </td>
                                    <td class="text-left">
                                        <div>
                                            <strong>{{ $tiket['kode_aset'] }}</strong>
                                            <br>
                                            <small class="text-gray-500">{{ $tiket['lokasi_aset'] }}</small>
                                        </div>
                                    </td>
                                    <td class="text-left">{{ $tiket['nama_pelapor'] }}</td>
                                    <td class="text-left">{{ $tiket['nama_tim'] ?? '-' }}</td>
                                    <td class="text-center">
                                        {{ $tiket['tgl_jadwal'] ? date('d M Y', strtotime($tiket['tgl_jadwal'])) : '-' }}
                                    </td>
                                    <td class="text-center">
                                        <span
                                            class="px-[8px] py-[3px] inline-block rounded-sm font-medium text-xs
                                            {{ $tiket['prioritas'] == 'Mendesak' ? 'bg-red-100 dark:bg-[#15203c] text-red-600' : 'bg-gray-100 dark:bg-[#15203c] text-gray-600' }}">
                                            {{ $tiket['prioritas'] }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span
                                            class="px-[8px] py-[3px] inline-block rounded-sm font-medium text-xs
                                            @if ($tiket['status_tindakan'] == 'Menunggu') bg-orange-100 dark:bg-[#15203c] text-orange-600
                                            @elseif($tiket['status_tindakan'] == 'Proses') bg-blue-100 dark:bg-[#15203c] text-blue-600
                                            @else bg-primary-50 dark:bg-[#15203c] text-primary-500 @endif">
                                            {{ $tiket['status_tindakan'] }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if ($tiket['perlu_surat_pln'])
                                            <span
                                                class="px-[8px] py-[3px] inline-block bg-orange-100 dark:bg-[#15203c] text-orange-600 rounded-sm font-medium text-xs">
                                                Perlu
                                            </span>
                                        @else
                                            <span
                                                class="px-[8px] py-[3px] inline-block bg-gray-100 dark:bg-[#15203c] text-gray-600 rounded-sm font-medium text-xs">
                                                Tidak
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="flex items-center gap-[9px] justify-center">
                                            {{-- @can('tiket-perbaikan.read') --}}
                                                <a href="{{ route('tiket-perbaikan.show', $tiket['id']) }}"
                                                    class="text-primary-500 leading-none custom-tooltip" id="customTooltip"
                                                    data-text="Detail">
                                                    <i class="material-symbols-outlined !text-md">
                                                        visibility
                                                    </i>
                                                </a>
                                            {{-- @endcan --}}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        {{-- @endcan --}}
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
            "pageLength": 25
        });
    </script>
@endpush
