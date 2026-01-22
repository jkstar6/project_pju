@extends('layouts.admin.master')

@section('title', 'Verifikasi Aduan Masuk')

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* CSS tambahan agar tampilan tabel lebih rapat dan rapi */
        table.dataTable tbody td {
            vertical-align: top;
        }
    </style>
@endpush

@section('breadcrumb')
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="/dashboard" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">Dashboard</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Aduan Masuk</span>
                </div>
            </li>
        </ol>
    </nav>
@endsection

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
            <th class="text-center">No</th>
            <th class="text-left">Pelapor</th>
            <th class="text-left">Tipe Aduan</th>
            <th class="text-left">Kontak</th>
            <th class="text-left">Lokasi</th>
            <th class="text-center">Foto</th>
            <th class="text-center">Status</th>
            <th class="text-left">Catatan Admin</th>
            <th class="text-left">Tanggal</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($aduan as $item)
            <tr>
                {{-- No --}}
                <td class="text-center">
                    <strong class="text-gray-500">{{ $loop->iteration }}</strong>
                </td>

                {{-- Pelapor --}}
                <td class="text-left">
                    <strong class="text-primary-500">{{ $item->nama_pelapor }}</strong>
                </td>

                {{-- Tipe & Kontak --}}
                <td class="text-left">
                    <span class="block text-xs font-semibold mb-1">{{ $item->tipe_aduan }}</span>
                </td>

                {{-- Tipe & Kontak --}}
                <td class="text-left">
                    <small class="text-gray-500">{{ $item->no_hp }}</small>
                </td>

                {{-- Lokasi --}}
                <td class="text-left">
                    <div class="flex flex-col gap-1">
                        <div class="text-xs">
                            <span class="font-semibold text-gray-700">Titik:</span>
                            <a href="https://maps.google.com/?q={{ $item->latitude }},{{ $item->longitude }}"
                               target="_blank"
                               class="text-blue-500 hover:underline inline-flex items-center ml-1">
                                <i class="material-symbols-outlined !text-[14px]">map</i>
                            </a>
                        </div>
                        <div class="text-xs italic text-gray-500 bg-gray-50 p-1 rounded border border-gray-100">
                            "{{ $item->deskripsi_lokasi }}"
                        </div>
                    </div>
                </td>

                {{-- Foto --}}
                <td class="text-center">
                    @if($item->foto_lapangan)
                        <a href="{{ asset('storage/' . $item->foto_lapangan) }}" target="_blank"
                           class="text-blue-500 hover:text-blue-700 inline-block p-1 bg-blue-50 rounded-full">
                            <i class="material-symbols-outlined !text-md">image</i>
                        </a>
                    @else
                        <span class="text-xs text-gray-300">-</span>
                    @endif
                </td>

                {{-- Status --}}
                <td class="text-center">
                    <span class="px-[8px] py-[3px] inline-block rounded-sm font-medium text-xs
                        @if($item->status_verifikasi == 'Pending') bg-yellow-100 dark:bg-[#15203c] text-yellow-600
                        @elseif($item->status_verifikasi == 'Diterima') bg-green-100 dark:bg-[#15203c] text-green-600
                        @elseif($item->status_verifikasi == 'Ditolak') bg-red-100 dark:bg-[#15203c] text-red-600
                        @endif">
                        {{ $item->status_verifikasi }}
                    </span>
                </td>

                {{-- Catatan --}}
                <td class="text-left">
                    @if($item->catatan_admin)
                        <span class="text-xs text-gray-600">{{ $item->catatan_admin }}</span>
                    @else
                        <span class="text-xs text-gray-300">-</span>
                    @endif
                </td>

                {{-- Tanggal --}}
                <td class="text-left">
                    <div class="flex flex-col text-xs gap-1">
                        <div>
                            <span class="text-gray-400 text-[10px] uppercase">Masuk:</span><br>
                            <span class="font-medium text-gray-800">
                                {{ $item->created_at->format('Y-m-d') }}
                            </span>
                        </div>
                        <div>
                            <span class="text-gray-400 text-[10px] uppercase">Update:</span><br>
                            <span class="font-medium text-blue-600">
                                {{ $item->updated_at->format('Y-m-d') }}
                            </span>
                        </div>
                    </div>
                </td>

                {{-- Aksi --}}
                <td class="text-center">
                    <div class="flex items-center gap-[5px] justify-center">
                        <button onclick="actionVerifikasi({{ $item->id }}, '{{ $item->nama_pelapor }}')"
                                class="text-green-500 hover:text-green-700 transition" title="Verifikasi">
                            <i class="material-symbols-outlined !text-md">check_circle</i>
                        </button>
                        <button onclick="actionTolak({{ $item->id }}, '{{ $item->nama_pelapor }}')"
                                class="text-yellow-500 hover:text-yellow-700 transition" title="Tolak">
                            <i class="material-symbols-outlined !text-md">cancel</i>
                        </button>
                        <button onclick="actionHapus({{ $item->id }}, '{{ $item->nama_pelapor }}')"
                                class="text-red-500 hover:text-red-700 transition" title="Hapus">
                            <i class="material-symbols-outlined !text-md">delete</i>
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

@endsection

@push('scripts')
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.tailwindcss.js') }}"></script>

    <script>
        $('#data-table').DataTable({
            responsive: true,
            "pageLength": 10,
           
        });

        // SWEETALERT FUNCTIONS
        function actionVerifikasi(id, nama) {
            Swal.fire({
                title: 'Verifikasi Aduan',
                text: "Berikan catatan tindak lanjut untuk " + nama,
                icon: 'question',
                input: 'textarea',
                inputLabel: 'Catatan Admin',
                inputPlaceholder: 'Contoh: Laporan valid, tim teknis akan meluncur besok...',
                showCancelButton: true,
                confirmButtonColor: '#10B981',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Ya, Verifikasi!',
                cancelButtonText: 'Batal',
                inputValidator: (value) => {
                    if (!value) return 'Anda harus menuliskan catatan verifikasi!'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Terverifikasi!', 'Status aduan diubah menjadi Diterima.<br>Catatan: ' + result.value, 'success')
                }
            })
        }

        function actionTolak(id, nama) {
            Swal.fire({
                title: 'Tolak Aduan',
                text: "Berikan alasan penolakan untuk " + nama,
                icon: 'warning',
                input: 'textarea',
                inputLabel: 'Alasan Penolakan',
                showCancelButton: true,
                confirmButtonColor: '#F59E0B',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Tolak Aduan',
                inputValidator: (value) => {
                    if (!value) return 'Anda harus menuliskan alasan penolakan!'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Ditolak!', 'Aduan ditolak karena: ' + result.value, 'success')
                }
            })
        }

        function actionHapus(id, nama) {
            Swal.fire({
                title: 'Hapus Data?',
                text: "Data aduan dari " + nama + " akan dihapus permanen.",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#6B7280',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Dihapus!', 'Data berhasil dihapus.', 'success')
                }
            })
        }
    </script>
@endpush