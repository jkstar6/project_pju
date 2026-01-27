@extends('layouts.admin.master')

@section('title', 'Panel KWh')

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">
    {{-- Leaflet CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #data-table td { vertical-align: top; }
        .modal-overlay { display: none; }
        .modal-overlay.active { display: flex; }
        
        /* Map Container */
        #map-panel {
            height: 350px;
            width: 100%;
            border-radius: 8px;
            margin-top: 10px;
            border: 1px solid #e5e7eb;
            z-index: 10;
        }

        /* Custom Style untuk Tombol Lokasi di Map */
        .leaflet-custom-control {
            background: white;
            width: 340px;
            height: 34px;
            line-height: 34px;
            text-align: center;
            cursor: pointer;
            box-shadow: 0 1px 5px rgba(0,0,0,0.4);
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }
        .leaflet-custom-control:hover { background: #f4f4f4; }
    </style>
@endpush

@section('breadcrumb')
    <nav class="flex mb-5" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600">Dashboard</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-3 h-3 text-gray-400 mx-1" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-width="2" d="m1 9 4-4-4-4"/></svg>
                    <span class="ml-1 text-sm font-medium text-gray-500">@yield('title')</span>
                </div>
            </li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md shadow-sm">
        <div class="trezo-card-header mb-[20px] md:mb-[25px] sm:flex sm:items-center sm:justify-between border-b pb-4">
            <h5 class="mb-0 text-lg font-bold">Data @yield('title')</h5>
            <div class="mt-3 sm:mt-0">
                <button type="button" id="btn-open-create" class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-primary-500 text-white hover:bg-primary-600 transition shadow-sm text-sm font-medium">
                    <span class="material-symbols-outlined">add</span> Tambah Panel Baru
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md text-sm border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        <div class="trezo-card-content">
            <div class="table-responsive overflow-x-auto">
                <table id="data-table" class="display stripe group" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-left">No Pelanggan</th>
                            <th class="text-left">Lokasi & GPS</th>
                            <th class="text-center">Daya (VA)</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($panelKwh as $index => $item)
                            <tr
                                data-id="{{ $item->id }}"
                                data-no_pelanggan="{{ $item->no_pelanggan_pln }}"
                                data-lokasi_panel="{{ $item->lokasi_panel }}"
                                data-latitude="{{ $item->latitude }}"
                                data-longitude="{{ $item->longitude }}"
                                data-daya_va="{{ $item->daya_va }}"
                                data-catatan="{{ $item->catatan_admin_pln }}"
                            >
                                <td class="text-center font-bold text-gray-400">{{ $index + 1 }}</td>
                                <td class="text-left"><strong class="text-primary-500">{{ $item->no_pelanggan_pln }}</strong></td>
                                <td class="text-left">
                                    <div class="flex flex-col gap-1">
                                        <span class="text-sm font-medium text-gray-700">{{ $item->lokasi_panel }}</span>
                                        <a href="https://www.google.com/maps?q={{ $item->latitude }},{{ $item->longitude }}" target="_blank" class="text-blue-500 hover:underline text-xs inline-flex items-center">
                                            <i class="material-symbols-outlined !text-[14px] mr-1">location_on</i> Lihat di Map
                                        </a>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <span class="px-2 py-1 bg-blue-50 text-blue-700 rounded text-xs font-bold">{{ number_format($item->daya_va) }} VA</span>
                                </td>
                                <td class="text-center">
                                    <div class="flex items-center gap-3 justify-center">
                                        <button class="btn-edit text-blue-500 hover:text-blue-700 transition"><i class="material-symbols-outlined">edit</i></button>
                                        <form action="{{ route('panel-kwh.destroy', $item->id) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Hapus data ini?')" class="text-red-500 hover:text-red-700 transition"><i class="material-symbols-outlined">delete</i></button>
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

    {{-- MODAL FORM (Dipakai bersama untuk Create & Edit) --}}
    <div id="modalPanel" class="modal-overlay fixed inset-0 z-[999] items-center justify-center bg-black/50 p-4">
        <div class="w-full max-w-2xl rounded-lg bg-white dark:bg-[#0c1427] p-6 shadow-2xl max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between mb-4 border-b pb-3">
                <h5 id="modalTitle" class="text-xl font-bold">Tambah Panel KWh</h5>
                <button type="button" class="btn-close-modal text-gray-400 hover:text-gray-600"><i class="material-symbols-outlined">close</i></button>
            </div>

            <form id="formPanel" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                
                <div class="md:col-span-1">
                    <label class="block text-sm font-semibold mb-1">No. Pelanggan PLN</label>
                    <input name="no_pelanggan_pln" id="in_no_pelanggan" class="w-full border rounded-md px-3 py-2 outline-none focus:border-primary-500" required>
                </div>
                <div class="md:col-span-1">
                    <label class="block text-sm font-semibold mb-1">Daya (VA)</label>
                    <input type="number" name="daya_va" id="in_daya_va" class="w-full border rounded-md px-3 py-2 outline-none" placeholder="1300">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold mb-1 text-primary-600 italic">Klik pada peta atau isi koordinat manual:</label>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <span class="text-[10px] text-gray-400 uppercase">Latitude</span>
                            <input type="number" step="any" name="latitude" id="lat-input" class="w-full border rounded-md px-3 py-1.5 bg-blue-50/30" required>
                        </div>
                        <div>
                            <span class="text-[10px] text-gray-400 uppercase">Longitude</span>
                            <input type="number" step="any" name="longitude" id="lng-input" class="w-full border rounded-md px-3 py-1.5 bg-blue-50/30" required>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <div id="map-panel"></div>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold mb-1">Lokasi Deskripsi</label>
                    <textarea name="lokasi_panel" id="in_lokasi" rows="2" class="w-full border rounded-md px-3 py-2 outline-none" required></textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold mb-1">Catatan Admin</label>
                    <textarea name="catatan_admin_pln" id="in_catatan" rows="1" class="w-full border rounded-md px-3 py-2 outline-none"></textarea>
                </div>

                <div class="md:col-span-2 flex justify-end gap-3 mt-4">
                    <button type="button" class="btn-close-modal px-5 py-2 rounded-md bg-gray-100 hover:bg-gray-200 font-medium">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-md bg-primary-500 text-white hover:bg-primary-600 font-medium shadow-md">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.tailwindcss.js') }}"></script>
    {{-- Leaflet JS --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        $(document).ready(function() {
            $('#data-table').DataTable({ responsive: true });

            const modal = document.getElementById('modalPanel');
            const defaultLoc = [-7.8897, 110.3289]; // Pusat Bantul
            let map, marker;

            // -- Inisialisasi Peta --
            function initMap(lat, lng) {
                if (!map) {
                    map = L.map('map-panel').setView([lat, lng], 15);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap'
                    }).addTo(map);

                    marker = L.marker([lat, lng], {draggable: true}).addTo(map);

                    // Sinkronisasi: Pin digeser -> Input berubah
                    marker.on('dragend', function() {
                        let pos = marker.getLatLng();
                        updateInputCoords(pos.lat, pos.lng);
                    });

                    // Sinkronisasi: Klik Peta -> Pin pindah & Input berubah
                    map.on('click', function(e) {
                        marker.setLatLng(e.latlng);
                        updateInputCoords(e.latlng.lat, e.latlng.lng);
                    });

                    // Tombol Lokasi Saya (Kompas)
                    const LocationButton = L.Control.extend({
                        options: { position: 'topleft' },
                        onAdd: function() {
                            const container = L.DomUtil.create('div', 'leaflet-bar leaflet-control');
                            const button = L.DomUtil.create('a', 'leaflet-custom-control', container);
                            button.innerHTML = '🎯';
                            button.title = "Gunakan Lokasi Saat Ini";
                            button.onclick = function() {
                                map.locate({setView: true, maxZoom: 16});
                            };
                            return container;
                        }
                    });
                    map.addControl(new LocationButton());

                    map.on('locationfound', function(e) {
                        marker.setLatLng(e.latlng);
                        updateInputCoords(e.latlng.lat, e.latlng.lng);
                    });
                } else {
                    map.setView([lat, lng], 15);
                    marker.setLatLng([lat, lng]);
                }
                setTimeout(() => map.invalidateSize(), 300);
            }

            function updateInputCoords(lat, lng) {
                $('#lat-input').val(lat.toFixed(8));
                $('#lng-input').val(lng.toFixed(8));
            }

            // Sinkronisasi: Input Manual -> Map & Pin Berubah
            $('#lat-input, #lng-input').on('input', function() {
                const lat = parseFloat($('#lat-input').val());
                const lng = parseFloat($('#lng-input').val());
                if (!isNaN(lat) && !isNaN(lng)) {
                    map.setView([lat, lng]);
                    marker.setLatLng([lat, lng]);
                }
            });

            // -- Modal Open (Create) --
            $('#btn-open-create').click(function() {
                $('#modalTitle').text('Tambah Panel KWh');
                $('#formMethod').val('POST');
                $('#formPanel').attr('action', "{{ route('panel-kwh.store') }}");
                $('#formPanel')[0].reset();
                
                modal.classList.add('active');
                initMap(defaultLoc[0], defaultLoc[1]);
                updateInputCoords(defaultLoc[0], defaultLoc[1]);
            });

            // -- Modal Open (Edit) --
            $(document).on('click', '.btn-edit', function() {
                const tr = $(this).closest('tr').data();
                $('#modalTitle').text('Edit Panel KWh');
                $('#formMethod').val('PUT');
                $('#formPanel').attr('action', `/panel-kwh/${tr.id}`);
                
                $('#in_no_pelanggan').val(tr.no_pelanggan);
                $('#in_daya_va').val(tr.daya_va);
                $('#in_lokasi').val(tr.lokasi_panel);
                $('#in_catatan').val(tr.catatan);
                $('#lat-input').val(tr.latitude);
                $('#lng-input').val(tr.longitude);

                modal.classList.add('active');
                initMap(tr.latitude, tr.longitude);
            });

            $('.btn-close-modal').click(() => modal.classList.remove('active'));
        });
    </script>
@endpush