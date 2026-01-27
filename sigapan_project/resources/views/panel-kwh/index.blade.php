@extends('layouts.admin.master')

@section('title', 'Panel KWh')

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">
    {{-- Leaflet CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        #data-table td { vertical-align: top; }
        .btn-icon { cursor: pointer; }
        .material-symbols-outlined { font-size:18px !important; }

        /* Modal Custom Style */
        .modal-overlay { display: none; }
        .modal-overlay.active { display: flex; }

        /* Map Container Style */
        #map-create, #map-edit {
            height: 300px;
            width: 100%;
            border-radius: 8px;
            margin-top: 8px;
            border: 1px solid #e5e7eb;
            z-index: 10;
        }
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
            <div class="trezo-card-title">
                <h5 class="mb-0 text-lg font-bold">Data @yield('title')</h5>
            </div>
            <div class="mt-3 sm:mt-0">
                <button type="button" id="btn-open-create" class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-primary-500 text-white hover:bg-primary-600 transition shadow-sm text-sm font-medium">
                    <span class="material-symbols-outlined">add</span> Tambah Panel
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
                            <th class="text-left">Catatan</th>
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
                                <td class="text-left">
                                    <strong class="text-primary-500">{{ $item->no_pelanggan_pln }}</strong>
                                </td>
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
                                <td class="text-left">
                                    <span class="text-xs text-gray-500 italic">{{ $item->catatan_admin_pln ?? '-' }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="flex items-center gap-3 justify-center">
                                        <button class="btn-edit text-blue-500 hover:text-blue-700 transition" title="Edit">
                                            <i class="material-symbols-outlined">edit</i>
                                        </button>
                                        <form action="{{ route('panel-kwh.destroy', $item->id) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Hapus panel ini?')" class="text-red-500 hover:text-red-700 transition" title="Hapus">
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

    {{-- MODAL CREATE --}}
    <div id="modalCreate" class="modal-overlay fixed inset-0 z-[999] items-center justify-center bg-black/50 p-4">
        <div class="w-full max-w-2xl rounded-lg bg-white dark:bg-[#0c1427] p-6 shadow-2xl max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between mb-4 border-b pb-3">
                <h5 class="text-xl font-bold">Tambah Panel KWh</h5>
                <button type="button" class="btn-close-modal text-gray-400 hover:text-gray-600"><i class="material-symbols-outlined">close</i></button>
            </div>

            <form action="{{ route('panel-kwh.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf
                <div class="md:col-span-1">
                    <label class="block text-sm font-semibold mb-1">No. Pelanggan PLN</label>
                    <input name="no_pelanggan_pln" class="w-full border rounded-md px-3 py-2 focus:ring-2 focus:ring-primary-500 outline-none" placeholder="ID Pelanggan" required>
                </div>
                <div class="md:col-span-1">
                    <label class="block text-sm font-semibold mb-1">Daya (VA)</label>
                    <input type="number" name="daya_va" class="w-full border rounded-md px-3 py-2 outline-none" placeholder="Contoh: 1300">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold mb-1">Lokasi Deskripsi</label>
                    <textarea name="lokasi_panel" rows="2" class="w-full border rounded-md px-3 py-2 outline-none" placeholder="Alamat atau patokan lokasi" required></textarea>
                </div>
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold mb-2">Pilih Titik Lokasi (Map)</label>
                    <div id="map-create"></div>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Latitude</label>
                    <input type="number" step="any" name="latitude" id="lat-create" class="w-full border rounded-md px-3 py-2 bg-gray-50 outline-none" required readonly>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Longitude</label>
                    <input type="number" step="any" name="longitude" id="lng-create" class="w-full border rounded-md px-3 py-2 bg-gray-50 outline-none" required readonly>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold mb-1">Catatan Admin</label>
                    <textarea name="catatan_admin_pln" rows="2" class="w-full border rounded-md px-3 py-2 outline-none" placeholder="Tambahkan catatan jika perlu"></textarea>
                </div>

                <div class="md:col-span-2 flex justify-end gap-3 mt-4">
                    <button type="button" class="btn-close-modal px-5 py-2 rounded-md bg-gray-100 hover:bg-gray-200 font-medium">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-md bg-primary-500 text-white hover:bg-primary-600 font-medium shadow-md">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div id="modalEdit" class="modal-overlay fixed inset-0 z-[999] items-center justify-center bg-black/50 p-4">
        <div class="w-full max-w-2xl rounded-lg bg-white dark:bg-[#0c1427] p-6 shadow-2xl max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between mb-4 border-b pb-3">
                <h5 class="text-xl font-bold">Edit Panel KWh</h5>
                <button type="button" class="btn-close-modal text-gray-400 hover:text-gray-600"><i class="material-symbols-outlined">close</i></button>
            </div>

            <form id="formEdit" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf @method('PUT')
                <div class="md:col-span-1">
                    <label class="block text-sm font-semibold mb-1">No. Pelanggan PLN</label>
                    <input name="no_pelanggan_pln" id="edit_no_pelanggan" class="w-full border rounded-md px-3 py-2" required>
                </div>
                <div class="md:col-span-1">
                    <label class="block text-sm font-semibold mb-1">Daya (VA)</label>
                    <input type="number" name="daya_va" id="edit_daya_va" class="w-full border rounded-md px-3 py-2">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold mb-1">Lokasi Deskripsi</label>
                    <textarea name="lokasi_panel" id="edit_lokasi_panel" rows="2" class="w-full border rounded-md px-3 py-2" required></textarea>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold mb-2">Pilih Titik Lokasi (Map)</label>
                    <div id="map-edit"></div>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Latitude</label>
                    <input type="number" step="any" name="latitude" id="edit_latitude" class="w-full border rounded-md px-3 py-2 bg-gray-50" required readonly>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Longitude</label>
                    <input type="number" step="any" name="longitude" id="edit_longitude" class="w-full border rounded-md px-3 py-2 bg-gray-50" required readonly>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold mb-1">Catatan</label>
                    <textarea name="catatan_admin_pln" id="edit_catatan" rows="2" class="w-full border rounded-md px-3 py-2"></textarea>
                </div>

                <div class="md:col-span-2 flex justify-end gap-3 mt-4">
                    <button type="button" class="btn-close-modal px-5 py-2 rounded-md bg-gray-100 hover:bg-gray-200">Batal</button>
                    <button type="submit" class="px-5 py-2 rounded-md bg-primary-500 text-white hover:bg-primary-600 shadow-md">Update Data</button>
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
            // -- DataTable Init --
            const dt = $('#data-table').DataTable({
                responsive: true,
                pageLength: 10,
                columnDefs: [{ targets: [0, 3, 5], className: 'text-center' }]
            });

            // -- Modal Logic --
            const modalCreate = document.getElementById('modalCreate');
            const modalEdit = document.getElementById('modalEdit');
            const defaultLoc = [-7.8897, 110.3289]; // Default Bantul

            let mapC, markerC, mapE, markerE;

            function openModal(m){ m.classList.add('active'); }
            function closeModal(m){ m.classList.remove('active'); }

            document.querySelectorAll('.btn-close-modal').forEach(btn => {
                btn.addEventListener('click', () => { closeModal(modalCreate); closeModal(modalEdit); });
            });

            // -- Map Create Handler --
            document.getElementById('btn-open-create').addEventListener('click', () => {
                openModal(modalCreate);
                setTimeout(() => {
                    if (!mapC) {
                        mapC = L.map('map-create').setView(defaultLoc, 13);
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(mapC);
                        markerC = L.marker(defaultLoc, {draggable: true}).addTo(mapC);
                        
                        function updateInputs(lat, lng) {
                            document.getElementById('lat-create').value = lat.toFixed(8);
                            document.getElementById('lng-create').value = lng.toFixed(8);
                        }

                        markerC.on('dragend', (e) => { updateInputs(e.target.getLatLng().lat, e.target.getLatLng().lng); });
                        mapC.on('click', (e) => { markerC.setLatLng(e.latlng); updateInputs(e.latlng.lat, e.latlng.lng); });
                        updateInputs(defaultLoc[0], defaultLoc[1]);
                    }
                    mapC.invalidateSize();
                }, 300);
            });

            // -- Map Edit Handler --
            document.addEventListener('click', (e) => {
                const btn = e.target.closest('.btn-edit');
                if (!btn) return;

                const tr = btn.closest('tr').dataset;
                const lat = parseFloat(tr.latitude);
                const lng = parseFloat(tr.longitude);

                // Populate form
                document.getElementById('formEdit').action = `/panel-kwh/${tr.id}`;
                document.getElementById('edit_no_pelanggan').value = tr.no_pelanggan;
                document.getElementById('edit_lokasi_panel').value = tr.lokasi_panel;
                document.getElementById('edit_daya_va').value = tr.daya_va;
                document.getElementById('edit_latitude').value = lat;
                document.getElementById('edit_longitude').value = lng;
                document.getElementById('edit_catatan').value = tr.catatan;

                openModal(modalEdit);

                setTimeout(() => {
                    if (!mapE) {
                        mapE = L.map('map-edit').setView([lat, lng], 15);
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(mapE);
                        markerE = L.marker([lat, lng], {draggable: true}).addTo(mapE);
                        
                        function updateEditInputs(la, ln) {
                            document.getElementById('edit_latitude').value = la.toFixed(8);
                            document.getElementById('edit_longitude').value = ln.toFixed(8);
                        }

                        markerE.on('dragend', (e) => { updateEditInputs(e.target.getLatLng().lat, e.target.getLatLng().lng); });
                        mapE.on('click', (e) => { markerE.setLatLng(e.latlng); updateEditInputs(e.latlng.lat, e.latlng.lng); });
                    } else {
                        mapE.setView([lat, lng], 15);
                        markerE.setLatLng([lat, lng]);
                    }
                    mapE.invalidateSize();
                }, 300);
            });
        });
    </script>
@endpush