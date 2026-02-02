@extends('layouts.admin.master')

@section('title', 'Data Aset PJU')

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">

    <style>
        #data-table td.text-center { vertical-align: middle; }
        #data-table td { vertical-align: middle; }
        #map-aset, #map-edit-aset { height: 300px; width: 100%; border-radius: 12px; border: 2px solid #e5e7eb; z-index: 10; }
        #modalTambahAset, #modalEditAset { z-index: 9999; }
        .input-error { border-color: #ef4444 !important; background: #fef2f2 !important; }
        .text-error { color: #ef4444 !important; }
    </style>
@endpush

@section('content')
    @php
        // ✅ patokan UI: hanya admin boleh CRUD
        $canManageAset = auth()->check() && auth()->user()->hasRole('Admin');
    @endphp

    <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
        <div class="trezo-card-header mb-[20px] md:mb-[25px] sm:flex sm:items-center sm:justify-between">
            <div class="trezo-card-title">
                <h5 class="mb-0 text-lg font-semibold">Data Aset PJU</h5>
            </div>

            {{-- ✅ tombol tambah hanya admin --}}
            @if($canManageAset)
                <div class="mt-3 sm:mt-0">
                    <button onclick="openTambahAset()" class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-primary-500 text-white hover:bg-primary-600 transition">
                        <i class="material-symbols-outlined !text-md">add</i> Tambah Aset
                    </button>
                </div>
            @endif
        </div>

        <div class="trezo-card-content">
            <div class="table-responsive overflow-x-auto p-2">
                <table id="data-table" class="display stripe hover" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-left">Kode Tiang</th>
                            <th class="text-left">Panel KWh</th>
                            <th class="text-left">Nama Jalan</th>
                            <th class="text-left">Jenis Lampu</th>
                            <th class="text-left">Watt</th>
                            <th class="text-center">Status</th>
                            <th class="text-left">Kecamatan</th>
                            <th class="text-left">Desa</th>
                            <th class="text-center">Lokasi Panel</th>
                            <th class="text-center">Lokasi Aset</th>

                            {{-- ✅ kolom aksi hanya admin --}}
                            @if($canManageAset)
                                <th class="text-center">Aksi</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($asetPju as $index => $item)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-left font-semibold">{{ $item->kode_tiang }}</td>
                                <td class="text-left">
                                    @if($item->panelKwh)
                                        <div class="flex flex-col">
                                            <span class="font-bold text-gray-700">{{ $item->panelKwh->no_pelanggan_pln }}</span>
                                            <span class="text-xs text-gray-500">{{ Str::limit($item->panelKwh->lokasi_panel, 20) }}</span>
                                        </div>
                                    @else
                                        <span class="text-gray-400 text-sm">-</span>
                                    @endif
                                </td>
                                <td class="text-left">{{ $item->jalan->nama_jalan ?? '-' }}</td>
                                <td class="text-left">{{ $item->jenis_lampu ?? '-' }}</td>
                                <td class="text-left">{{ $item->watt ?? '-' }} W</td>
                                <td class="text-center">
                                    <span class="px-2 py-1 text-xs rounded
                                        @if ($item->status_aset == 'Usulan') bg-yellow-100 text-yellow-700
                                        @elseif($item->status_aset == 'Pengerjaan') bg-blue-100 text-blue-700
                                        @elseif($item->status_aset == 'Terelialisasi') bg-green-100 text-green-700
                                        @elseif($item->status_aset == 'Pindah') bg-purple-100 text-purple-700
                                        @elseif($item->status_aset == 'Mati') bg-red-100 text-red-700 @endif">
                                        {{ $item->status_aset }}
                                    </span>
                                </td>
                                <td class="text-left">{{ $item->kecamatan ?? '-' }}</td>
                                <td class="text-left">{{ $item->desa ?? '-' }}</td>

                                <td class="text-center">
                                    @if ($item->panelKwh && $item->panelKwh->latitude && $item->panelKwh->longitude)
                                        <a href="https://www.google.com/maps?q={{ $item->panelKwh->latitude }},{{ $item->panelKwh->longitude }}" target="_blank"
                                            class="text-green-600 hover:text-green-800 hover:underline flex items-center justify-center gap-1">
                                            <i class="material-symbols-outlined text-sm">map</i> Panel
                                        </a>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    @if ($item->latitude && $item->longitude)
                                        <a href="https://www.google.com/maps?q={{ $item->latitude }},{{ $item->longitude }}" target="_blank"
                                            class="text-blue-500 hover:text-blue-700 hover:underline flex items-center justify-center gap-1">
                                            <i class="material-symbols-outlined text-sm">location_on</i> Aset
                                        </a>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>

                                {{-- ✅ aksi hanya admin --}}
                                @if($canManageAset)
                                    <td class="text-center">
                                        <div class="flex justify-center gap-2">
                                            <button onclick='openEditAset(@json($item))' class="text-blue-500 hover:text-blue-700 transition" title="Edit Aset">
                                                <i class="material-symbols-outlined text-md">edit</i>
                                            </button>
                                        </div>
                                    </td>
                                @endif

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- ✅ MODAL hanya Admin (biar teknisi/survey ga “lihat” fitur input) --}}
        @if($canManageAset)
            {{-- MODAL TAMBAH ASET --}}
            <div id="modalTambahAset" class="fixed inset-0 hidden bg-black/50 flex items-start justify-center p-4 overflow-y-auto pt-10 pb-10">
                <div class="bg-white dark:bg-themedark-card rounded-lg w-full max-w-xl p-6 shadow-xl mb-auto">
                    <h3 class="text-lg font-semibold mb-4">Tambah Aset PJU</h3>
                    <form action="{{ route('aset-pju.store') }}" method="POST">
                        @csrf
                        {{-- (isi form kamu tetap sama) --}}
                        {!! '' !!}
                        {{-- ⬇️ TEMPATKAN KODE FORM TAMBAH MU DI SINI (PASTE DARI FILE LAMA) --}}
                    </form>
                </div>
            </div>

            {{-- MODAL EDIT ASET --}}
            <div id="modalEditAset" class="fixed inset-0 hidden bg-black/50 flex items-start justify-center p-4 overflow-y-auto pt-10 pb-10">
                <div class="bg-white dark:bg-themedark-card rounded-lg w-full max-w-xl p-6 shadow-xl mb-auto">
                    <h3 class="text-lg font-semibold mb-4">Edit Aset PJU</h3>
                    <form id="formEditAset" method="POST">
                        @csrf
                        @method('PUT')
                        {{-- (isi form kamu tetap sama) --}}
                        {!! '' !!}
                        {{-- ⬇️ TEMPATKAN KODE FORM EDIT MU DI SINI (PASTE DARI FILE LAMA) --}}
                    </form>
                </div>
            </div>
        @endif

    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.tailwindcss.js') }}"></script>

    <script>
        const CAN_MANAGE_ASET = @json($canManageAset);
    </script>

    <script>
        const MAX_DISTANCE = 500;
        delete L.Icon.Default.prototype._getIconUrl;
        L.Icon.Default.mergeOptions({
            iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
            iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
            shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
        });

        $(document).ready(function() {
            $('#data-table').DataTable({
                responsive: true,
                pageLength: 25,
                columnDefs: [
                    { targets: [0, 6, 9, 10{{ $canManageAset ? ', 11' : '' }}], className: 'text-center' },
                    { targets: [1, 2, 3, 4, 5, 7, 8], className: 'text-left' }
                ]
            });
        });

        // ✅ proteksi biar non-admin ga bisa buka modal via console
        function openTambahAset() {
            if (!CAN_MANAGE_ASET) return;
            document.getElementById('modalTambahAset').classList.remove('hidden');
            setTimeout(() => {
                initMapAset();
                disableSubmit(UI_TAMBAH, 'Silakan klik peta untuk menentukan lokasi aset.');
                const sel = document.getElementById('aset-panel-id');
                if (sel) sel.dispatchEvent(new Event('change'));
            }, 400);
        }

        function openEditAset(data) {
            if (!CAN_MANAGE_ASET) return;
            // ⬇️ fungsi openEditAset kamu (paste utuh dari file lama) tetap jalan untuk admin
            // (kodenya ada di bawah file kamu sebelumnya, jadi tinggal tempel balik)
        }
    </script>

    {{-- ⬇️ PASTE SISA SCRIPT MAP & VALIDATION KAMU DI SINI (utuh) --}}
@endpush
