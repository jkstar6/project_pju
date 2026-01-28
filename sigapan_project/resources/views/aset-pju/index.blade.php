@extends('layouts.admin.master')

@section('title', 'Data Aset PJU')

@section('breadcrumb')
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">

    <style>
        #data-table td.text-center { vertical-align: middle; }

        #map-aset, #map-edit-aset {
            height: 300px;
            width: 100%;
            border-radius: 12px;
            border: 2px solid #e5e7eb;
            z-index: 10;
        }

        #modalTambahAset { z-index: 9999; }
    </style>
@endpush

@section('content')
    <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">

        <div class="trezo-card-header mb-[20px] md:mb-[25px] sm:flex sm:items-center sm:justify-between">
            <div class="trezo-card-title">
                <h5 class="mb-0 text-lg font-semibold">Data Aset PJU</h5>
            </div>

            <div class="mt-3 sm:mt-0">
                <button onclick="openTambahAset()"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-primary-500 text-white hover:bg-primary-600 transition">
                    <i class="material-symbols-outlined !text-md">add</i>
                    Tambah Aset
                </button>
            </div>
        </div>

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
                                        @if ($item->status_aset == 'Usulan') bg-yellow-100 text-yellow-700
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
                                    @if ($item->latitude && $item->longitude)
                                        <a href="https://www.google.com/maps?q={{ $item->latitude }},{{ $item->longitude }}"
                                            target="_blank"
                                            class="text-blue-500 hover:underline flex items-center justify-center gap-1">
                                            <i class="material-symbols-outlined text-sm">location_on</i> Maps
                                        </a>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="flex justify-center gap-2">
                                        <button onclick='openEditAset(@json($item))'
                                            class="text-blue-500 hover:text-blue-700 transition">
                                            <i class="material-symbols-outlined text-md">edit</i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- MODAL TAMBAH ASET --}}
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

                        {{-- DROPDOWN PANEL --}}
                        <div class="col-span-2">
                            <label class="text-sm font-medium">Pilih Panel kWh</label>
                            <select id="aset-panel-id" name="panel_kwh_id" required class="w-full border rounded px-3 py-2 mt-1">
                                <option value="">-- Pilih Panel --</option>
                                @foreach ($panelKwh as $p)
                                    <option
                                        value="{{ $p->id }}"
                                        data-lat="{{ $p->latitude }}"
                                        data-lng="{{ $p->longitude }}"
                                        data-label="{{ $p->no_pelanggan_pln }}"
                                    >
                                        {{ $p->no_pelanggan_pln }} ({{ number_format($p->daya_va) }} VA) - {{ $p->lokasi_panel }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Lokasi aset otomatis mengikuti panel yang dipilih.</p>
                        </div>

                        <div class="col-span-2">
                            <label class="text-sm font-medium block mb-2">Lokasi (Terkunci berdasarkan Panel)</label>
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

        {{-- MODAL EDIT ASET --}}
        <div id="modalEditAset"
            class="fixed inset-0 hidden bg-black/50 flex items-start justify-center p-4 overflow-y-auto pt-10 pb-10">
            <div class="bg-white dark:bg-themedark-card rounded-lg w-full max-w-xl p-6 shadow-xl mb-auto">
                <h3 class="text-lg font-semibold mb-4">Edit Aset PJU</h3>

                <form id="formEditAset" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" id="edit-id">

                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-1">
                            <label class="text-sm font-medium">Kode Tiang</label>
                            <input name="kode_tiang" id="edit-kode" required class="w-full border rounded px-3 py-2 mt-1">
                        </div>

                        <div class="col-span-1">
                            <label class="text-sm font-medium">Jenis Lampu</label>
                            <input name="jenis_lampu" id="edit-jenis" class="w-full border rounded px-3 py-2 mt-1">
                        </div>

                        <div class="col-span-1">
                            <label class="text-sm font-medium">Watt</label>
                            <input name="watt" id="edit-watt" type="number" class="w-full border rounded px-3 py-2 mt-1">
                        </div>

                        <div class="col-span-1">
                            <label class="text-sm font-medium">Status Aset</label>
                            <select name="status_aset" id="edit-status" class="w-full border rounded px-3 py-2 mt-1">
                                <option>Usulan</option>
                                <option>Pengerjaan</option>
                                <option>Terelialisasi</option>
                                <option>Mati</option>
                            </select>
                        </div>

                        <div class="col-span-1">
                            <label class="text-sm font-medium">Kecamatan</label>
                            <input name="kecamatan" id="edit-kecamatan" class="w-full border rounded px-3 py-2 mt-1">
                        </div>

                        <div class="col-span-1">
                            <label class="text-sm font-medium">Desa</label>
                            <input name="desa" id="edit-desa" class="w-full border rounded px-3 py-2 mt-1">
                        </div>

                        {{-- DROPDOWN PANEL (EDIT) --}}
                        <div class="col-span-2">
                            <label class="text-sm font-medium">Pilih Panel kWh</label>
                            <select id="edit-panel-id" name="panel_kwh_id" required class="w-full border rounded px-3 py-2 mt-1">
                                <option value="">-- Pilih Panel --</option>
                                @foreach ($panelKwh as $p)
                                    <option
                                        value="{{ $p->id }}"
                                        data-lat="{{ $p->latitude }}"
                                        data-lng="{{ $p->longitude }}"
                                        data-label="{{ $p->no_pelanggan_pln }}"
                                    >
                                        {{ $p->no_pelanggan_pln }} ({{ number_format($p->daya_va) }} VA) - {{ $p->lokasi_panel }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Lokasi aset otomatis mengikuti panel yang dipilih.</p>
                        </div>

                        <div class="col-span-2">
                            <label class="text-sm font-medium block mb-2">Lokasi (Terkunci berdasarkan Panel)</label>
                            <div id="map-edit-aset"></div>

                            <div class="grid grid-cols-2 gap-3 mt-3">
                                <div>
                                    <span class="text-[10px] uppercase text-gray-500">Latitude</span>
                                    <input id="edit-lat" name="latitude" readonly class="w-full border px-3 py-2 bg-gray-50 text-sm">
                                </div>
                                <div>
                                    <span class="text-[10px] uppercase text-gray-500">Longitude</span>
                                    <input id="edit-lng" name="longitude" readonly class="w-full border px-3 py-2 bg-gray-50 text-sm">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 mt-6">
                        <button type="button" onclick="closeEditAset()" class="border px-4 py-2 rounded hover:bg-gray-100">
                            Batal
                        </button>
                        <button type="submit" class="bg-primary-500 text-white px-4 py-2 rounded hover:bg-primary-600">
                            Update Aset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.tailwindcss.js') }}"></script>

    <script>
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
                    { targets: [0, 4, 7, 8], className: 'text-center' },
                    { targets: [1, 2, 3, 5, 6], className: 'text-left' }
                ]
            });
        });

        // ======================
        // MAP TAMBAH (TERKUNCI PANEL)
        // ======================
        let asetMap = null;
        let panelMarker = null;

        function openTambahAset() {
            document.getElementById('modalTambahAset').classList.remove('hidden');
            setTimeout(() => { initMapAset(); }, 400);
        }

        function closeTambahAset() {
            document.getElementById('modalTambahAset').classList.add('hidden');

            // reset map instance
            if (asetMap) {
                asetMap.remove();
                asetMap = null;
                panelMarker = null;
            }

            // reset dropdown & coords (opsional)
            const sel = document.getElementById('aset-panel-id');
            if (sel) sel.value = '';
            document.getElementById('aset-lat').value = '';
            document.getElementById('aset-lng').value = '';
        }

        function initMapAset() {
            if (asetMap) return;

            asetMap = L.map('map-aset').setView([-7.8867194, 110.3277543], 14);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(asetMap);

            asetMap.invalidateSize();
            // TIDAK ADA click event -> terkunci
        }

        function setLatLng(lat, lng) {
            document.getElementById('aset-lat').value = (lat === '' ? '' : Number(lat).toFixed(8));
            document.getElementById('aset-lng').value = (lng === '' ? '' : Number(lng).toFixed(8));
        }

        function applySelectedPanelToTambah() {
            const sel = document.getElementById('aset-panel-id');
            if (!sel) return;

            const opt = sel.options[sel.selectedIndex];
            const lat = parseFloat(opt?.dataset?.lat);
            const lng = parseFloat(opt?.dataset?.lng);
            const label = opt?.dataset?.label || 'Panel';

            if (!asetMap) initMapAset();
            if (isNaN(lat) || isNaN(lng)) return;

            setLatLng(lat, lng);
            asetMap.setView([lat, lng], 16);

            if (!panelMarker) {
                panelMarker = L.marker([lat, lng], { draggable: false }).addTo(asetMap);
            } else {
                panelMarker.setLatLng([lat, lng]);
            }
            panelMarker.bindPopup(`<b>${label}</b>`).openPopup();
        }

        document.addEventListener('change', function(e) {
            if (e.target && e.target.id === 'aset-panel-id') {
                applySelectedPanelToTambah();
            }
        });

        // ======================
        // MAP EDIT (TERKUNCI PANEL)
        // ======================
        let editMap = null;
        let editPanelMarker = null;

        function openEditAset(data) {
            document.getElementById('modalEditAset').classList.remove('hidden');

            document.getElementById('edit-kode').value = data.kode_tiang;
            document.getElementById('edit-jenis').value = data.jenis_lampu ?? '';
            document.getElementById('edit-watt').value = data.watt ?? '';
            document.getElementById('edit-status').value = data.status_aset;
            document.getElementById('edit-kecamatan').value = data.kecamatan ?? '';
            document.getElementById('edit-desa').value = data.desa ?? '';

            // set dropdown panel (butuh field panel_kwh_id ada di data)
            if (data.panel_kwh_id) {
                document.getElementById('edit-panel-id').value = data.panel_kwh_id;
            } else {
                document.getElementById('edit-panel-id').value = '';
            }

            document.getElementById('formEditAset').action = `{{ url('/aset-pju') }}/${data.id}`;

            setTimeout(() => {
                applySelectedPanelToEdit();
            }, 400);
        }

        function closeEditAset() {
            document.getElementById('modalEditAset').classList.add('hidden');

            if (editMap) {
                editMap.remove();
                editMap = null;
                editPanelMarker = null;
            }
        }

        function setEditLatLng(lat, lng) {
            document.getElementById('edit-lat').value = (lat === '' ? '' : Number(lat).toFixed(8));
            document.getElementById('edit-lng').value = (lng === '' ? '' : Number(lng).toFixed(8));
        }

        function initMapEdit(lat, lng, label = 'Panel') {
            if (editMap) {
                editMap.remove();
                editMap = null;
                editPanelMarker = null;
            }

            editMap = L.map('map-edit-aset').setView([lat, lng], 16);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(editMap);

            editMap.invalidateSize();

            editPanelMarker = L.marker([lat, lng], { draggable: false }).addTo(editMap);
            editPanelMarker.bindPopup(`<b>${label}</b>`).openPopup();
            // tidak ada click / drag -> terkunci
        }

        function applySelectedPanelToEdit() {
            const sel = document.getElementById('edit-panel-id');
            if (!sel) return;

            const opt = sel.options[sel.selectedIndex];
            const lat = parseFloat(opt?.dataset?.lat);
            const lng = parseFloat(opt?.dataset?.lng);
            const label = opt?.dataset?.label || 'Panel';

            if (isNaN(lat) || isNaN(lng)) return;

            setEditLatLng(lat, lng);
            initMapEdit(lat, lng, label);
        }

        document.addEventListener('change', function(e) {
            if (e.target && e.target.id === 'edit-panel-id') {
                applySelectedPanelToEdit();
            }
        });
    </script>
@endpush
