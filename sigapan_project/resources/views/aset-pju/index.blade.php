@extends('layouts.admin.master')

@section('title', 'Data Aset PJU')

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">

    <style>
        #data-table td.text-center { vertical-align: middle; }
        #data-table td { vertical-align: middle; }

        #map-aset, #map-edit-aset {
            height: 300px;
            width: 100%;
            border-radius: 12px;
            border: 2px solid #e5e7eb;
            z-index: 10;
        }

        /* modal */
        #modalTambahAset, #modalEditAset { z-index: 9999; }

        .input-error { border-color: #ef4444 !important; background: #fef2f2 !important; }
        .text-error { color: #ef4444 !important; }

        /* simple input style helper */
        .i {
            width: 100%;
            border: 1px solid #e5e7eb;
            border-radius: .5rem;
            padding: .5rem .75rem;
            outline: none;
        }
        .i:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241,.15); }
        .l { font-size: .875rem; font-weight: 600; margin-bottom: .25rem; display:block; }
        .g { display:grid; gap: .75rem; }
        .g2 { display:grid; gap:.75rem; grid-template-columns: repeat(2, minmax(0, 1fr)); }
        @media (max-width: 640px){ .g2 { grid-template-columns: 1fr; } }
    </style>
@endpush

@section('content')
@php
    $canManageAset = auth()->check() && auth()->user()->hasRole('Admin');
@endphp

<div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
    <div class="trezo-card-header mb-[20px] md:mb-[25px] sm:flex sm:items-center sm:justify-between">
        <div class="trezo-card-title">
            <h5 class="mb-0 text-lg font-semibold">Data Aset PJU</h5>
        </div>

        @if($canManageAset)
            <div class="mt-3 sm:mt-0">
                <button type="button" onclick="openTambahAset()"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-primary-500 text-white hover:bg-primary-600 transition">
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
                                <a href="https://www.google.com/maps?q={{ $item->panelKwh->latitude }},{{ $item->panelKwh->longitude }}"
                                   target="_blank"
                                   class="text-green-600 hover:text-green-800 hover:underline flex items-center justify-center gap-1">
                                    <i class="material-symbols-outlined text-sm">map</i> Panel
                                </a>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>

                        <td class="text-center">
                            @if ($item->latitude && $item->longitude)
                                <a href="https://www.google.com/maps?q={{ $item->latitude }},{{ $item->longitude }}"
                                   target="_blank"
                                   class="text-blue-500 hover:text-blue-700 hover:underline flex items-center justify-center gap-1">
                                    <i class="material-symbols-outlined text-sm">location_on</i> Aset
                                </a>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>

                        @if($canManageAset)
                            <td class="text-center">
                                <div class="flex justify-center gap-2">
                                    <button type="button" onclick='openEditAset(@json($item))'
                                        class="text-blue-500 hover:text-blue-700 transition" title="Edit Aset">
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

    {{-- ✅ MODAL hanya Admin --}}
    @if($canManageAset)
        {{-- ===================== MODAL TAMBAH ===================== --}}
        <div id="modalTambahAset" class="fixed inset-0 hidden bg-black/50 flex items-start justify-center p-4 overflow-y-auto pt-10 pb-10">
            <div class="bg-white dark:bg-themedark-card rounded-lg w-full max-w-2xl p-6 shadow-xl mb-auto">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">Tambah Aset PJU</h3>
                    <button type="button" onclick="closeTambahAset()" class="p-2 rounded hover:bg-gray-100">
                        <i class="material-symbols-outlined">close</i>
                    </button>
                </div>

                <form action="{{ route('aset-pju.store') }}" method="POST" class="g" id="formTambahAset">
                    @csrf

                    <div class="g2">
                        <div>
                            <label class="l">Kode Tiang</label>
                            <input type="text" name="kode_tiang" class="i" placeholder="Contoh: PJU-001" required>
                        </div>

                        <div>
                            <label class="l">Status Aset</label>
                            <select name="status_aset" class="i" required>
                                <option value="">-- pilih --</option>
                                <option value="Usulan">Usulan</option>
                                <option value="Pengerjaan">Pengerjaan</option>
                                <option value="Terelialisasi">Terelialisasi</option>
                                <option value="Pindah">Pindah</option>
                                <option value="Mati">Mati</option>
                            </select>
                        </div>
                    </div>

                    <div class="g2">
                        <div>
                            <label class="l">Panel KWh</label>
                            <select name="panel_kwh_id" class="i" id="aset-panel-id">
                                <option value="">-- pilih panel (opsional) --</option>
                                @foreach(($panelKwhList ?? []) as $p)
                                    <option value="{{ $p->id }}"
                                        data-lat="{{ $p->latitude }}"
                                        data-lng="{{ $p->longitude }}">
                                        {{ $p->no_pelanggan_pln }} - {{ Str::limit($p->lokasi_panel, 35) }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Kalau panel punya koordinat, map akan diarahkan ke dekat panel.</p>
                        </div>

                        <div>
                            <label class="l">Nama Jalan</label>
                            <select name="jalan_id" class="i">
                                <option value="">-- pilih jalan (opsional) --</option>
                                @foreach(($jalanList ?? []) as $j)
                                    <option value="{{ $j->id }}">{{ $j->nama_jalan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="g2">
                        <div>
                            <label class="l">Jenis Lampu</label>
                            <input type="text" name="jenis_lampu" class="i" placeholder="Contoh: LED" />
                        </div>
                        <div>
                            <label class="l">Watt</label>
                            <input type="number" name="watt" class="i" placeholder="Contoh: 90" min="0" />
                        </div>
                    </div>

                    <div class="g2">
                        <div>
                            <label class="l">Kecamatan</label>
                            <input type="text" name="kecamatan" class="i" placeholder="Contoh: Bantul" />
                        </div>
                        <div>
                            <label class="l">Desa</label>
                            <input type="text" name="desa" class="i" placeholder="Contoh: Trirenggo" />
                        </div>
                    </div>

                    <div>
                        <label class="l">Tentukan Lokasi Aset (klik peta)</label>
                        <div id="map-aset"></div>
                        <p class="text-xs text-gray-500 mt-2">Klik peta untuk mengisi Latitude & Longitude.</p>
                    </div>

                    <div class="g2">
                        <div>
                            <label class="l">Latitude</label>
                            <input type="text" name="latitude" id="lat-aset" class="i" readonly required>
                        </div>
                        <div>
                            <label class="l">Longitude</label>
                            <input type="text" name="longitude" id="lng-aset" class="i" readonly required>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-2">
                        <button type="button" onclick="closeTambahAset()" class="px-4 py-2 rounded-md border hover:bg-gray-50">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 rounded-md bg-primary-500 text-white hover:bg-primary-600">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ===================== MODAL EDIT ===================== --}}
        <div id="modalEditAset" class="fixed inset-0 hidden bg-black/50 flex items-start justify-center p-4 overflow-y-auto pt-10 pb-10">
            <div class="bg-white dark:bg-themedark-card rounded-lg w-full max-w-2xl p-6 shadow-xl mb-auto">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">Edit Aset PJU</h3>
                    <button type="button" onclick="closeEditAset()" class="p-2 rounded hover:bg-gray-100">
                        <i class="material-symbols-outlined">close</i>
                    </button>
                </div>

                <form id="formEditAset" method="POST" class="g">
                    @csrf
                    @method('PUT')

                    <div class="g2">
                        <div>
                            <label class="l">Kode Tiang</label>
                            <input type="text" name="kode_tiang" id="edit-kode-tiang" class="i" required>
                        </div>

                        <div>
                            <label class="l">Status Aset</label>
                            <select name="status_aset" id="edit-status-aset" class="i" required>
                                <option value="">-- pilih --</option>
                                <option value="Usulan">Usulan</option>
                                <option value="Pengerjaan">Pengerjaan</option>
                                <option value="Terelialisasi">Terelialisasi</option>
                                <option value="Pindah">Pindah</option>
                                <option value="Mati">Mati</option>
                            </select>
                        </div>
                    </div>

                    <div class="g2">
                        <div>
                            <label class="l">Panel KWh</label>
                            <select name="panel_kwh_id" class="i" id="edit-panel-id">
                                <option value="">-- pilih panel (opsional) --</option>
                                @foreach(($panelKwhList ?? []) as $p)
                                    <option value="{{ $p->id }}"
                                        data-lat="{{ $p->latitude }}"
                                        data-lng="{{ $p->longitude }}">
                                        {{ $p->no_pelanggan_pln }} - {{ Str::limit($p->lokasi_panel, 35) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="l">Nama Jalan</label>
                            <select name="jalan_id" class="i" id="edit-jalan-id">
                                <option value="">-- pilih jalan (opsional) --</option>
                                @foreach(($jalanList ?? []) as $j)
                                    <option value="{{ $j->id }}">{{ $j->nama_jalan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="g2">
                        <div>
                            <label class="l">Jenis Lampu</label>
                            <input type="text" name="jenis_lampu" id="edit-jenis-lampu" class="i" />
                        </div>
                        <div>
                            <label class="l">Watt</label>
                            <input type="number" name="watt" id="edit-watt" class="i" min="0" />
                        </div>
                    </div>

                    <div class="g2">
                        <div>
                            <label class="l">Kecamatan</label>
                            <input type="text" name="kecamatan" id="edit-kecamatan" class="i" />
                        </div>
                        <div>
                            <label class="l">Desa</label>
                            <input type="text" name="desa" id="edit-desa" class="i" />
                        </div>
                    </div>

                    <div>
                        <label class="l">Tentukan Lokasi Aset (klik peta)</label>
                        <div id="map-edit-aset"></div>
                        <p class="text-xs text-gray-500 mt-2">Klik peta untuk update Latitude & Longitude.</p>
                    </div>

                    <div class="g2">
                        <div>
                            <label class="l">Latitude</label>
                            <input type="text" name="latitude" id="edit-lat" class="i" readonly required>
                        </div>
                        <div>
                            <label class="l">Longitude</label>
                            <input type="text" name="longitude" id="edit-lng" class="i" readonly required>
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-2">
                        <button type="button" onclick="closeEditAset()" class="px-4 py-2 rounded-md border hover:bg-gray-50">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 rounded-md bg-primary-500 text-white hover:bg-primary-600">
                            Update
                        </button>
                    </div>
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
    // ===================== DataTables =====================
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

    // ===================== Leaflet defaults =====================
    delete L.Icon.Default.prototype._getIconUrl;
    L.Icon.Default.mergeOptions({
        iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
        iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
        shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
    });

    // ===================== Modal helpers =====================
    function openTambahAset() {
        if (!CAN_MANAGE_ASET) return;

        document.getElementById('modalTambahAset').classList.remove('hidden');

        // init map after modal visible
        setTimeout(() => {
            initMapTambah();
        }, 150);
    }

    function closeTambahAset() {
        document.getElementById('modalTambahAset').classList.add('hidden');
    }

    function closeEditAset() {
        document.getElementById('modalEditAset').classList.add('hidden');
    }

    // close on overlay click
    document.addEventListener('click', function(e){
        const mt = document.getElementById('modalTambahAset');
        const me = document.getElementById('modalEditAset');
        if (mt && !mt.classList.contains('hidden') && e.target === mt) closeTambahAset();
        if (me && !me.classList.contains('hidden') && e.target === me) closeEditAset();
    });

    // ===================== Map Tambah =====================
    let mapTambah, markerTambah;

    function initMapTambah() {
        // destroy if exists
        if (mapTambah) {
            mapTambah.remove();
            mapTambah = null;
            markerTambah = null;
        }

        const mapEl = document.getElementById('map-aset');
        const latInput = document.getElementById('lat-aset');
        const lngInput = document.getElementById('lng-aset');

        // default Bantul approx
        const defaultLat = -7.885;
        const defaultLng = 110.333;

        mapTambah = L.map(mapEl).setView([defaultLat, defaultLng], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19
        }).addTo(mapTambah);

        function setMarker(lat, lng) {
            latInput.value = lat.toFixed(6);
            lngInput.value = lng.toFixed(6);

            if (!markerTambah) {
                markerTambah = L.marker([lat, lng], { draggable: true }).addTo(mapTambah);
                markerTambah.on('dragend', function(ev){
                    const p = ev.target.getLatLng();
                    latInput.value = p.lat.toFixed(6);
                    lngInput.value = p.lng.toFixed(6);
                });
            } else {
                markerTambah.setLatLng([lat, lng]);
            }
        }

        // click to place marker
        mapTambah.on('click', function(e) {
            setMarker(e.latlng.lat, e.latlng.lng);
        });

        // if panel selected, move map near panel
        const selPanel = document.getElementById('aset-panel-id');
        if (selPanel) {
            selPanel.addEventListener('change', function(){
                const opt = selPanel.options[selPanel.selectedIndex];
                const lat = opt?.dataset?.lat;
                const lng = opt?.dataset?.lng;
                if (lat && lng) {
                    mapTambah.setView([parseFloat(lat), parseFloat(lng)], 16);
                }
            });

            // trigger initial change if any
            selPanel.dispatchEvent(new Event('change'));
        }
    }

    // ===================== Map Edit =====================
    let mapEdit, markerEdit;

    function initMapEdit(lat, lng) {
        if (mapEdit) {
            mapEdit.remove();
            mapEdit = null;
            markerEdit = null;
        }

        const mapEl = document.getElementById('map-edit-aset');
        const latInput = document.getElementById('edit-lat');
        const lngInput = document.getElementById('edit-lng');

        const initLat = lat ?? -7.885;
        const initLng = lng ?? 110.333;

        mapEdit = L.map(mapEl).setView([initLat, initLng], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19 }).addTo(mapEdit);

        function setMarker(lat, lng) {
            latInput.value = Number(lat).toFixed(6);
            lngInput.value = Number(lng).toFixed(6);

            if (!markerEdit) {
                markerEdit = L.marker([lat, lng], { draggable: true }).addTo(mapEdit);
                markerEdit.on('dragend', function(ev){
                    const p = ev.target.getLatLng();
                    latInput.value = p.lat.toFixed(6);
                    lngInput.value = p.lng.toFixed(6);
                });
            } else {
                markerEdit.setLatLng([lat, lng]);
            }
        }

        // set initial marker
        setMarker(initLat, initLng);

        mapEdit.on('click', function(e){
            setMarker(e.latlng.lat, e.latlng.lng);
        });

        // panel change center
        const selPanel = document.getElementById('edit-panel-id');
        if (selPanel) {
            selPanel.addEventListener('change', function(){
                const opt = selPanel.options[selPanel.selectedIndex];
                const plat = opt?.dataset?.lat;
                const plng = opt?.dataset?.lng;
                if (plat && plng) mapEdit.setView([parseFloat(plat), parseFloat(plng)], 16);
            });
        }
    }

    // ===================== Open Edit (fill form) =====================
    function openEditAset(data) {
        if (!CAN_MANAGE_ASET) return;

        // set action url: /aset-pju/{id}
        // Pastikan route('aset-pju.update', id) ada.
        const form = document.getElementById('formEditAset');
        form.action = `{{ url('aset-pju') }}/${data.id}`;

        // fill fields
        document.getElementById('edit-kode-tiang').value = data.kode_tiang ?? '';
        document.getElementById('edit-status-aset').value = data.status_aset ?? '';
        document.getElementById('edit-jenis-lampu').value = data.jenis_lampu ?? '';
        document.getElementById('edit-watt').value = data.watt ?? '';
        document.getElementById('edit-kecamatan').value = data.kecamatan ?? '';
        document.getElementById('edit-desa').value = data.desa ?? '';

        // select panel & jalan
        const panelSel = document.getElementById('edit-panel-id');
        if (panelSel) panelSel.value = data.panel_kwh_id ?? '';

        const jalanSel = document.getElementById('edit-jalan-id');
        if (jalanSel) jalanSel.value = data.jalan_id ?? '';

        // lat lng
        const lat = data.latitude ? parseFloat(data.latitude) : -7.885;
        const lng = data.longitude ? parseFloat(data.longitude) : 110.333;
        document.getElementById('edit-lat').value = lat.toFixed(6);
        document.getElementById('edit-lng').value = lng.toFixed(6);

        // show modal then init map
        document.getElementById('modalEditAset').classList.remove('hidden');
        setTimeout(() => {
            initMapEdit(lat, lng);
        }, 150);
    }
</script>
@endpush
