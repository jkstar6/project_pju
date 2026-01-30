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
    <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
        <div class="trezo-card-header mb-[20px] md:mb-[25px] sm:flex sm:items-center sm:justify-between">
            <div class="trezo-card-title">
                <h5 class="mb-0 text-lg font-semibold">Data Aset PJU</h5>
            </div>
            <div class="mt-3 sm:mt-0">
                <button onclick="openTambahAset()" class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-primary-500 text-white hover:bg-primary-600 transition">
                    <i class="material-symbols-outlined !text-md">add</i> Tambah Aset
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
                            <th class="text-left">Panel KWh</th>
                            <th class="text-left">Nama Jalan</th>
                            <th class="text-left">Jenis Lampu</th>
                            <th class="text-left">Watt</th>
                            <th class="text-center">Status</th>
                            <th class="text-left">Kecamatan</th>
                            <th class="text-left">Desa</th>
                            <th class="text-center">Lokasi Panel</th>
                            <th class="text-center">Lokasi Aset</th>
                            <th class="text-center">Aksi</th>
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
                                    @else <span class="text-gray-400 text-sm">-</span> @endif
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
                                    @else <span class="text-gray-400">-</span> @endif
                                </td>
                                <td class="text-center">
                                    @if ($item->latitude && $item->longitude)
                                        <a href="https://www.google.com/maps?q={{ $item->latitude }},{{ $item->longitude }}" target="_blank"
                                            class="text-blue-500 hover:text-blue-700 hover:underline flex items-center justify-center gap-1">
                                            <i class="material-symbols-outlined text-sm">location_on</i> Aset
                                        </a>
                                    @else <span class="text-gray-400">-</span> @endif
                                </td>
                                <td class="text-center">
                                    <div class="flex justify-center gap-2">
                                        <button onclick='openEditAset(@json($item))' class="text-blue-500 hover:text-blue-700 transition" title="Edit Aset">
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
        <div id="modalTambahAset" class="fixed inset-0 hidden bg-black/50 flex items-start justify-center p-4 overflow-y-auto pt-10 pb-10">
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
                                <option>Pindah</option>
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
                            <label class="text-sm font-medium">Nama Jalan</label>
                            <select name="jalan_id" class="w-full border rounded px-3 py-2 mt-1">
                                <option value="">-- Pilih Jalan --</option>
                                @foreach ($masterJalan as $jalan)
                                    <option value="{{ $jalan->id }}">{{ $jalan->nama_jalan }} ({{ $jalan->kategori_jalan }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label class="text-sm font-medium">Pilih Panel kWh</label>
                            <select id="aset-panel-id" name="panel_kwh_id" required class="w-full border rounded px-3 py-2 mt-1">
                                <option value="">-- Pilih Panel --</option>
                                @foreach ($panelKwh as $p)
                                    <option value="{{ $p->id }}" data-lat="{{ $p->latitude }}" data-lng="{{ $p->longitude }}" data-label="{{ $p->no_pelanggan_pln }}">
                                        {{ $p->no_pelanggan_pln }} ({{ number_format($p->daya_va) }} VA) - {{ $p->lokasi_panel }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Pilih panel dulu, lalu klik peta untuk menentukan lokasi aset.</p>
                        </div>
                        <div class="col-span-2">
                            <label class="text-sm font-medium">Jarak Panel ke Aset (meter)</label>
                            <div class="flex items-center gap-3 mt-1">
                                <input id="jarak-meter" type="number" min="0" step="1" class="w-32 border rounded px-3 py-2 bg-gray-50 text-sm" value="0">
                                <input id="jarak-slider" type="range" min="0" max="500" value="0" class="flex-1">
                                <span id="jarak-label" class="text-sm text-gray-600">0 m</span>
                            </div>
                            <p id="jarak-warning" class="text-xs mt-2 hidden"></p>
                        </div>
                        <div class="col-span-2">
                            <label class="text-sm font-medium block mb-2">Lokasi (Panel & Aset)</label>
                            <div id="map-aset"></div>
                            <div class="grid grid-cols-2 gap-3 mt-3">
                                <div><span class="text-[10px] uppercase text-gray-500">Latitude</span><input id="aset-lat" name="latitude" readonly class="w-full border px-3 py-2 bg-gray-50 text-sm"></div>
                                <div><span class="text-[10px] uppercase text-gray-500">Longitude</span><input id="aset-lng" name="longitude" readonly class="w-full border px-3 py-2 bg-gray-50 text-sm"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end gap-2 mt-6">
                        <button type="button" onclick="closeTambahAset()" class="border px-4 py-2 rounded hover:bg-gray-100">Batal</button>
                        <button type="submit" class="bg-primary-500 text-white px-4 py-2 rounded hover:bg-primary-600">Simpan Aset</button>
                    </div>
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
                                <option>Pindah</option>
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

                        {{-- NAMA JALAN (EDIT) --}}
                        <div class="col-span-2">
                            <label class="text-sm font-medium">Nama Jalan</label>
                            <select name="jalan_id" id="edit-jalan-id" class="w-full border rounded px-3 py-2 mt-1">
                                <option value="">-- Pilih Jalan --</option>
                                @foreach ($masterJalan as $jalan)
                                    <option value="{{ $jalan->id }}">{{ $jalan->nama_jalan }} ({{ $jalan->kategori_jalan }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-span-2">
                            <label class="text-sm font-medium">Pilih Panel kWh</label>
                            <select id="edit-panel-id" name="panel_kwh_id" required class="w-full border rounded px-3 py-2 mt-1">
                                <option value="">-- Pilih Panel --</option>
                                @foreach ($panelKwh as $p)
                                    <option value="{{ $p->id }}" data-lat="{{ $p->latitude }}" data-lng="{{ $p->longitude }}" data-label="{{ $p->no_pelanggan_pln }}">
                                        {{ $p->no_pelanggan_pln }} ({{ number_format($p->daya_va) }} VA) - {{ $p->lokasi_panel }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label class="text-sm font-medium">Jarak Panel ke Aset (meter)</label>
                            <div class="flex items-center gap-3 mt-1">
                                <input id="edit-jarak-meter" type="number" min="0" step="1" class="w-32 border rounded px-3 py-2 bg-gray-50 text-sm" value="0">
                                <input id="edit-jarak-slider" type="range" min="0" max="500" value="0" class="flex-1">
                                <span id="edit-jarak-label" class="text-sm text-gray-600">0 m</span>
                            </div>
                            <p id="edit-jarak-warning" class="text-xs mt-2 hidden"></p>
                        </div>
                        <div class="col-span-2">
                            <label class="text-sm font-medium block mb-2">Lokasi (Panel & Aset)</label>
                            <div id="map-edit-aset"></div>
                            <div class="grid grid-cols-2 gap-3 mt-3">
                                <div><span class="text-[10px] uppercase text-gray-500">Latitude</span><input id="edit-lat" name="latitude" readonly class="w-full border px-3 py-2 bg-gray-50 text-sm"></div>
                                <div><span class="text-[10px] uppercase text-gray-500">Longitude</span><input id="edit-lng" name="longitude" readonly class="w-full border px-3 py-2 bg-gray-50 text-sm"></div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end gap-2 mt-6">
                        <button type="button" onclick="closeEditAset()" class="border px-4 py-2 rounded hover:bg-gray-100">Batal</button>
                        <button type="submit" class="bg-primary-500 text-white px-4 py-2 rounded hover:bg-primary-600">Update Aset</button>
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
                    { targets: [0, 6, 9, 10, 11], className: 'text-center' },
                    { targets: [1, 2, 3, 4, 5, 7, 8], className: 'text-left' }
                ]
            });
        });

        const UI_TAMBAH = { meterId: 'jarak-meter', sliderId: 'jarak-slider', labelId: 'jarak-label', warnId: 'jarak-warning', submitSelector: '#modalTambahAset button[type="submit"]' };
        const UI_EDIT = { meterId: 'edit-jarak-meter', sliderId: 'edit-jarak-slider', labelId: 'edit-jarak-label', warnId: 'edit-jarak-warning', submitSelector: '#modalEditAset button[type="submit"]' };

        function setWarning(ui, message) {
            const el = document.getElementById(ui.warnId);
            const meter = document.getElementById(ui.meterId);
            const slider = document.getElementById(ui.sliderId);
            const submit = document.querySelector(ui.submitSelector);
            if (!el || !meter || !slider || !submit) return;

            if (message) {
                el.classList.remove('hidden'); el.classList.add('text-error'); el.textContent = message;
                meter.classList.add('input-error'); slider.classList.add('input-error');
                submit.disabled = true; submit.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                el.classList.add('hidden'); el.textContent = '';
                meter.classList.remove('input-error'); slider.classList.remove('input-error');
                submit.disabled = false; submit.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }

        function disableSubmit(ui, message) {
            const submit = document.querySelector(ui.submitSelector);
            if (submit) { submit.disabled = true; submit.classList.add('opacity-50', 'cursor-not-allowed'); }
            if (message) setWarning(ui, message);
        }

        function clampDistance(m) { return Math.min(Math.max(0, Number(m || 0)), MAX_DISTANCE); }

        function updateDistanceUI(ui, meters) {
            const meter = document.getElementById(ui.meterId);
            const slider = document.getElementById(ui.sliderId);
            const label = document.getElementById(ui.labelId);
            if (meter) meter.value = Math.round(meters);
            if (slider) { slider.max = String(MAX_DISTANCE); slider.value = String(Math.min(Math.round(meters), MAX_DISTANCE)); }
            if (label) label.textContent = `${Math.round(meters)} m`;
            if (meters > MAX_DISTANCE) { setWarning(ui, `Jarak melebihi batas ${MAX_DISTANCE} meter.`); } else { setWarning(ui, ''); }
        }

        function initDistanceControls(meterId, sliderId, labelId, onChange, uiConfig) {
            const meter = document.getElementById(meterId);
            const slider = document.getElementById(sliderId);
            if (!meter || !slider) return;
            slider.max = String(MAX_DISTANCE);
            const apply = (val) => {
                const v = clampDistance(val);
                meter.value = v; slider.value = v;
                document.getElementById(labelId).textContent = `${Math.round(v)} m`;
                onChange(v);
                setWarning(uiConfig, '');
            };
            meter.addEventListener('input', () => apply(meter.value));
            slider.addEventListener('input', () => apply(slider.value));
        }

        function toRad(d) { return d * Math.PI / 180; }
        function toDeg(r) { return r * 180 / Math.PI; }
        function bearingDeg(a, b) {
            const lat1 = toRad(a.lat), lat2 = toRad(b.lat), dLon = toRad(b.lng - a.lng);
            const y = Math.sin(dLon) * Math.cos(lat2);
            const x = Math.cos(lat1) * Math.sin(lat2) - Math.sin(lat1) * Math.cos(lat2) * Math.cos(dLon);
            return (toDeg(Math.atan2(y, x)) + 360) % 360;
        }
        function destinationPoint(start, bearing, distanceMeters) {
            const R = 6371000, brng = toRad(bearing), lat1 = toRad(start.lat), lon1 = toRad(start.lng), dr = distanceMeters / R;
            const lat2 = Math.asin(Math.sin(lat1) * Math.cos(dr) + Math.cos(lat1) * Math.sin(dr) * Math.cos(brng));
            const lon2 = lon1 + Math.atan2(Math.sin(brng) * Math.sin(dr) * Math.cos(lat1), Math.cos(dr) - Math.sin(lat1) * Math.sin(lat2));
            return L.latLng(toDeg(lat2), toDeg(lon2));
        }

        // ======================
        // MAP TAMBAH
        // ======================
        let asetMap = null, panelMarker = null, asetMarker = null, linePA = null;
        let selectedPanelLatLng = null, assetLatLng = null, lastBearingDeg = null;

        function openTambahAset() {
            document.getElementById('modalTambahAset').classList.remove('hidden');
            setTimeout(() => {
                initMapAset();
                disableSubmit(UI_TAMBAH, 'Silakan klik peta untuk menentukan lokasi aset.');
                const sel = document.getElementById('aset-panel-id');
                if (sel) sel.dispatchEvent(new Event('change'));
            }, 400);
        }

        function closeTambahAset() {
            document.getElementById('modalTambahAset').classList.add('hidden');
            if (asetMap) { asetMap.remove(); asetMap = null; panelMarker = null; asetMarker = null; linePA = null; }
            selectedPanelLatLng = null; assetLatLng = null; lastBearingDeg = null;
            document.getElementById('aset-panel-id').value = '';
            document.getElementById('aset-lat').value = ''; document.getElementById('aset-lng').value = '';
            updateDistanceUI(UI_TAMBAH, 0); setWarning(UI_TAMBAH, '');
        }

        function initMapAset() {
            if (asetMap) return;
            asetMap = L.map('map-aset').setView([-7.8867194, 110.3277543], 14);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '© OpenStreetMap' }).addTo(asetMap);
            asetMap.invalidateSize();
            asetMap.on('click', function(e) {
                if (!selectedPanelLatLng) { alert('Pilih Panel KWh terlebih dahulu.'); return; }
                setAssetPoint(e.latlng, true);
            });
            initDistanceControls('jarak-meter', 'jarak-slider', 'jarak-label', (m) => applyDistanceAdjustment(m), UI_TAMBAH);
        }

        document.getElementById('aset-panel-id').addEventListener('change', function() {
            const opt = this.options[this.selectedIndex];
            const lat = parseFloat(opt?.dataset?.lat), lng = parseFloat(opt?.dataset?.lng);
            if (!asetMap) initMapAset();
            if (isNaN(lat) || isNaN(lng)) return;
            selectedPanelLatLng = L.latLng(lat, lng);
            if (!panelMarker) panelMarker = L.marker(selectedPanelLatLng).addTo(asetMap); else panelMarker.setLatLng(selectedPanelLatLng);
            panelMarker.bindPopup(`<b>${opt.dataset.label}</b>`).openPopup();
            asetMap.setView(selectedPanelLatLng, 16);
            if (asetMarker) { asetMap.removeLayer(asetMarker); asetMarker = null; }
            if (linePA) { asetMap.removeLayer(linePA); linePA = null; }
            assetLatLng = null; lastBearingDeg = null;
            document.getElementById('aset-lat').value = ''; document.getElementById('aset-lng').value = '';
            updateDistanceUI(UI_TAMBAH, 0);
            disableSubmit(UI_TAMBAH, 'Silakan klik peta untuk menentukan lokasi aset.');
        });

        function setAssetPoint(latlng, fromClick = false) {
            assetLatLng = latlng;
            if (!asetMarker) {
                asetMarker = L.marker(latlng, { draggable: true }).addTo(asetMap);
                asetMarker.on('dragend', () => setAssetPoint(asetMarker.getLatLng(), true));
            } else { asetMarker.setLatLng(latlng); }
            if (fromClick && selectedPanelLatLng) lastBearingDeg = bearingDeg(selectedPanelLatLng, assetLatLng);
            if (selectedPanelLatLng && assetLatLng) {
                const pts = [selectedPanelLatLng, assetLatLng];
                if (!linePA) linePA = L.polyline(pts, { weight: 4 }).addTo(asetMap); else linePA.setLatLngs(pts);
                const dist = selectedPanelLatLng.distanceTo(assetLatLng);
                updateDistanceUI(UI_TAMBAH, dist);
            }
            document.getElementById('aset-lat').value = latlng.lat.toFixed(8);
            document.getElementById('aset-lng').value = latlng.lng.toFixed(8);
        }

        function applyDistanceAdjustment(meter) {
            if (!selectedPanelLatLng || lastBearingDeg === null) return;
            setAssetPoint(destinationPoint(selectedPanelLatLng, lastBearingDeg, Number(meter || 0)), false);
        }

        // ======================
        // MAP EDIT
        // ======================
        let editMap = null, editPanelMarker = null, editAsetMarker = null, editLine = null;
        let editPanelLatLng = null, editAssetLatLng = null, editBearingDeg = null;

        function openEditAset(data) {
            document.getElementById('modalEditAset').classList.remove('hidden');
            document.getElementById('edit-kode').value = data.kode_tiang;
            document.getElementById('edit-jenis').value = data.jenis_lampu ?? '';
            document.getElementById('edit-watt').value = data.watt ?? '';
            document.getElementById('edit-status').value = data.status_aset;
            document.getElementById('edit-kecamatan').value = data.kecamatan ?? '';
            document.getElementById('edit-desa').value = data.desa ?? '';
            document.getElementById('edit-panel-id').value = data.panel_kwh_id ?? '';

            // [FIX: POPULATE NAMA JALAN]
            document.getElementById('edit-jalan-id').value = data.jalan_id ?? '';

            document.getElementById('formEditAset').action = `{{ url('/aset-pju') }}/${data.id}`;

            setTimeout(() => {
                initMapEdit();

                // [FIX: MANUAL SET PANEL LOCATION agar tidak error "Pilih Panel"]
                const sel = document.getElementById('edit-panel-id');
                const opt = sel.options[sel.selectedIndex];
                const pLat = parseFloat(opt?.dataset?.lat);
                const pLng = parseFloat(opt?.dataset?.lng);
                
                if (!isNaN(pLat) && !isNaN(pLng)) {
                    editPanelLatLng = L.latLng(pLat, pLng);
                    if (!editPanelMarker) editPanelMarker = L.marker(editPanelLatLng).addTo(editMap);
                    else editPanelMarker.setLatLng(editPanelLatLng);
                    editPanelMarker.bindPopup(`<b>${opt.dataset.label}</b>`);
                }

                if (data.latitude && data.longitude) {
                    setEditAssetPoint(L.latLng(parseFloat(data.latitude), parseFloat(data.longitude)), true);
                    // Update garis dan jarak tanpa user harus klik ulang
                    if(editPanelLatLng) {
                         const dist = editPanelLatLng.distanceTo(editAssetLatLng);
                         updateDistanceUI(UI_EDIT, dist);
                         editBearingDeg = bearingDeg(editPanelLatLng, editAssetLatLng);
                    }
                } else {
                    disableSubmit(UI_EDIT, 'Silakan klik peta untuk menentukan lokasi aset.');
                }
                
                editMap.invalidateSize();
            }, 400);
        }

        function closeEditAset() {
            document.getElementById('modalEditAset').classList.add('hidden');
            if (editMap) { editMap.remove(); editMap = null; editPanelMarker = null; editAsetMarker = null; editLine = null; }
            editPanelLatLng = null; editAssetLatLng = null; editBearingDeg = null;
            setWarning(UI_EDIT, '');
        }

        function initMapEdit() {
            if (editMap) return;
            editMap = L.map('map-edit-aset').setView([-7.8867194, 110.3277543], 14);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '© OpenStreetMap' }).addTo(editMap);
            editMap.on('click', function(e) {
                if (!editPanelLatLng) { alert('Pilih Panel KWh terlebih dahulu.'); return; }
                setEditAssetPoint(e.latlng, true);
            });
            initDistanceControls('edit-jarak-meter', 'edit-jarak-slider', 'edit-jarak-label', (m) => applyEditDistance(m), UI_EDIT);
        }

        // Listener jika user GANTI panel saat EDIT
        document.getElementById('edit-panel-id').addEventListener('change', function() {
            const opt = this.options[this.selectedIndex];
            const lat = parseFloat(opt?.dataset?.lat), lng = parseFloat(opt?.dataset?.lng);
            if (!editMap) initMapEdit();
            if (isNaN(lat) || isNaN(lng)) return;

            editPanelLatLng = L.latLng(lat, lng);
            if (!editPanelMarker) editPanelMarker = L.marker(editPanelLatLng).addTo(editMap); 
            else editPanelMarker.setLatLng(editPanelLatLng);
            
            editPanelMarker.bindPopup(`<b>${opt.dataset.label}</b>`).openPopup();
            
            if (editAssetLatLng) {
                drawEditLine();
                const dist = editPanelLatLng.distanceTo(editAssetLatLng);
                updateDistanceUI(UI_EDIT, dist);
                editBearingDeg = bearingDeg(editPanelLatLng, editAssetLatLng);
            } else {
                editMap.setView(editPanelLatLng, 16);
                disableSubmit(UI_EDIT, 'Silakan klik peta untuk menentukan lokasi aset.');
            }
        });

        function setEditAssetPoint(latlng, fromClick = false) {
            editAssetLatLng = latlng;
            if (!editAsetMarker) {
                editAsetMarker = L.marker(latlng, { draggable: true }).addTo(editMap);
                editAsetMarker.on('dragend', () => setEditAssetPoint(editAsetMarker.getLatLng(), true));
            } else { editAsetMarker.setLatLng(latlng); }

            if (fromClick && editPanelLatLng) editBearingDeg = bearingDeg(editPanelLatLng, editAssetLatLng);
            drawEditLine();
            
            if (editPanelLatLng) {
                const dist = editPanelLatLng.distanceTo(editAssetLatLng);
                updateDistanceUI(UI_EDIT, dist);
            }
            document.getElementById('edit-lat').value = latlng.lat.toFixed(8);
            document.getElementById('edit-lng').value = latlng.lng.toFixed(8);
        }

        function drawEditLine() {
            if (!editPanelLatLng || !editAssetLatLng) return;
            const pts = [editPanelLatLng, editAssetLatLng];
            if (!editLine) editLine = L.polyline(pts, { weight: 4 }).addTo(editMap); else editLine.setLatLngs(pts);
        }

        function applyEditDistance(meter) {
            if (!editPanelLatLng || editBearingDeg === null) return;
            setEditAssetPoint(destinationPoint(editPanelLatLng, editBearingDeg, Number(meter || 0)), false);
        }
    </script>
@endpush