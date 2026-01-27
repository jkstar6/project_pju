@extends('layouts.admin.master')

@section('title', 'Data Aset PJU')

@section('breadcrumb')
    {{-- Breadcrumbs jika diperlukan --}}
@endsection

@push('styles')
    {{-- Style dari Log Survey (DataTables Tailwind) --}}
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">
    
    {{-- Leaflet CSS (Bawaan Aset PJU - Tetap Dipertahankan) --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">

    <style>
        /* Style Tambahan agar mirip Log Survey */
        #data-table td.text-center { vertical-align: middle; }
        
        /* Map Styles (Bawaan Aset PJU) */
        #map-aset {
            height: 300px;
            width: 100%;
            border-radius: 12px;
            border: 2px solid #e5e7eb;
            z-index: 10;
        }
        /* Pastikan container modal punya z-index lebih tinggi dari peta */
        #modalTambahAset {
            z-index: 9999;
        }
    </style>
@endpush

@section('content')
    {{-- Wrapper Container disamakan dengan Log Survey (Trezo Card) --}}
    <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
        
        {{-- Header Card --}}
        <div class="trezo-card-header mb-[20px] md:mb-[25px] sm:flex sm:items-center sm:justify-between">
            <div class="trezo-card-title">
                <h5 class="mb-0 text-lg font-semibold">
                    Data Aset PJU
                </h5>
            </div>

            {{-- Tombol Tambah --}}
            <div class="mt-3 sm:mt-0">
                <button onclick="openTambahAset()"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-primary-500 text-white hover:bg-primary-600 transition">
                    <i class="material-symbols-outlined !text-md">add</i>
                    Tambah Aset
                </button>
            </div>
        </div>

        {{-- Content Table --}}
        <div class="trezo-card-content">
            <div class="table-responsive overflow-x-auto p-2">
                <table id="data-table" class="display stripe hover" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-left">Kode Tiang</th>
                            <th class="text-left">Jenis Lampu</th>
                            <th class="text-left">Watt</th>
                            <th class="text-center">Status</th>
                            <th class="text-left">Kecamatan</th>
                            <th class="text-left">Desa</th>
                            <th class="text-center">Lokasi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($asetPju as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-left font-semibold">{{ $item->kode_tiang }}</td>
                            <td class="text-left">{{ $item->jenis_lampu ?? '-' }}</td>
                            <td class="text-left">{{ $item->watt ?? '-' }} W</td>
                            <td class="text-center">
                                <span class="px-2 py-1 text-xs rounded
                                    @if($item->status_aset == 'Usulan') bg-yellow-100 text-yellow-700
                                    @elseif($item->status_aset == 'Pengerjaan') bg-blue-100 text-blue-700
                                    @elseif($item->status_aset == 'Terelialisasi') bg-green-100 text-green-700
                                    @elseif($item->status_aset == 'Mati') bg-red-100 text-red-700
                                    @endif">
                                    {{ $item->status_aset }}
                                </span>
                            </td>
                            <td class="text-left">{{ $item->kecamatan ?? '-' }}</td>
                            <td class="text-left">{{ $item->desa ?? '-' }}</td>
                            <td class="text-center">
                                @if($item->latitude && $item->longitude)
                                    <a href="https://www.google.com/maps?q={{ $item->latitude }},{{ $item->longitude }}"
                                       target="_blank" class="text-blue-500 hover:underline flex items-center justify-center gap-1">
                                       <i class="material-symbols-outlined text-sm">location_on</i> Maps
                                    </a>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="flex justify-center gap-2">
                                    <button class="text-blue-500 hover:text-blue-700 transition"><i class="material-symbols-outlined text-md">edit</i></button>
                                    <button class="text-red-500 hover:text-red-700 transition"><i class="material-symbols-outlined text-md">delete</i></button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- MODAL TAMBAH ASET - DIPERBAIKI AGAR TIDAK TERPOTONG --}}
        <div id="modalTambahAset"
            class="fixed inset-0 hidden bg-black/50 flex items-start justify-center p-4 overflow-y-auto pt-10 pb-10">
            <div class="bg-white dark:bg-themedark-card rounded-lg w-full max-w-xl p-6 shadow-xl mb-auto">

                <h3 class="text-lg font-semibold mb-4">Tambah Aset PJU</h3>

                <form action="{{ route('aset-pju.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-1">
                            <label class="text-sm font-medium">Kode Tiang</label>
                            <input name="kode_tiang" required class="w-full border rounded px-3 py-2 mt-1">
                        </div>

                        <div class="col-span-1">
                            <label class="text-sm font-medium">Jenis Lampu</label>
                            <input name="jenis_lampu" class="w-full border rounded px-3 py-2 mt-1">
                        </div>

                        <div class="col-span-1">
                            <label class="text-sm font-medium">Watt</label>
                            <input name="watt" type="number" class="w-full border rounded px-3 py-2 mt-1">
                        </div>

                        <div class="col-span-1">
                            <label class="text-sm font-medium">Status Aset</label>
                            <select name="status_aset" class="w-full border rounded px-3 py-2 mt-1">
                                <option>Usulan</option>
                                <option>Pengerjaan</option>
                                <option>Terelialisasi</option>
                                <option>Mati</option>
                            </select>
                        </div>

                        <div class="col-span-1">
                            <label class="text-sm font-medium">Kecamatan</label>
                            <input name="kecamatan" class="w-full border rounded px-3 py-2 mt-1">
                        </div>

                        <div class="col-span-1">
                            <label class="text-sm font-medium">Desa</label>
                            <input name="desa" class="w-full border rounded px-3 py-2 mt-1">
                        </div>

                        <div class="col-span-2">
                            <label class="text-sm font-medium block mb-2">Pilih Lokasi di Peta</label>
                            <div id="map-aset"></div>

                            <div class="grid grid-cols-2 gap-3 mt-3">
                                <div>
                                    <span class="text-[10px] uppercase text-gray-500">Latitude</span>
                                    <input id="aset-lat" name="latitude" readonly class="w-full border px-3 py-2 bg-gray-50 text-sm">
                                </div>
                                <div>
                                    <span class="text-[10px] uppercase text-gray-500">Longitude</span>
                                    <input id="aset-lng" name="longitude" readonly class="w-full border px-3 py-2 bg-gray-50 text-sm">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 mt-6">
                        <button type="button" onclick="closeTambahAset()" class="border px-4 py-2 rounded hover:bg-gray-100">
                            Batal
                        </button>
                        <button type="submit" class="bg-primary-500 text-white px-4 py-2 rounded hover:bg-primary-600">
                            Simpan Aset
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    {{-- Leaflet JS (Bawaan) --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    
    {{-- DataTables JS (Disamakan dengan Log Survey) --}}
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.tailwindcss.js') }}"></script>

    <script>
        // 1. Perbaikan Icon Marker Leaflet (Logic Bawaan - Tidak Diubah)
        delete L.Icon.Default.prototype._getIconUrl;
        L.Icon.Default.mergeOptions({
            iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
            iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
            shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
        });

        // 2. Init Datatable (Disesuaikan stylenya agar responsive seperti Log Survey)
        $(document).ready(function() {
            $('#data-table').DataTable({
                responsive: true,
                pageLength: 25,
                // Memastikan text alignment sesuai header
                columnDefs: [
                    { targets: [0, 4, 7, 8], className: 'text-center' },
                    { targets: [1, 2, 3, 5, 6], className: 'text-left' }
                ]
            });
        });

        // 3. Logic Map & Modal (Logic Bawaan - Tidak Diubah)
        let asetMap = null;
        let asetMarker = null;

        function openTambahAset() {
            document.getElementById('modalTambahAset').classList.remove('hidden');
            
            // Timeout sedikit lebih lama untuk memastikan modal transisi selesai
            setTimeout(() => {
                initMapAset();
            }, 400);
        }

        function closeTambahAset() {
            document.getElementById('modalTambahAset').classList.add('hidden');
            
            // Reset Map saat modal ditutup agar tidak terjadi penumpukan instance
            if (asetMap) {
                asetMap.remove();
                asetMap = null;
                asetMarker = null;
            }
        }

        function initMapAset() {
            if (asetMap) return;

            // Inisialisasi awal
            asetMap = L.map('map-aset').setView([-7.8867194, 110.3277543], 14);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(asetMap);

            // FUNGSI KRUSIAL: Memaksa peta mengenali ukuran container yang baru muncul
            asetMap.invalidateSize();

            asetMap.on('click', function (e) {
                const { lat, lng } = e.latlng;

                if (!asetMarker) {
                    asetMarker = L.marker([lat, lng], { draggable: true }).addTo(asetMap);
                    
                    asetMarker.on('dragend', function() {
                        const pos = asetMarker.getLatLng();
                        setLatLng(pos.lat, pos.lng);
                    });
                } else {
                    asetMarker.setLatLng([lat, lng]);
                }

                setLatLng(lat, lng);
            });
        }

        function setLatLng(lat, lng) {
            document.getElementById('aset-lat').value = lat.toFixed(8);
            document.getElementById('aset-lng').value = lng.toFixed(8);
        }
    </script>
@endpush