@extends('layouts.admin.master')

@section('title', 'Master Jalan')

@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('master-jalan') }} --}}
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">

    {{-- Leaflet (CDN) --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

    <style>
        #data-table td.text-center { vertical-align: middle; }
        .btn-icon { cursor: pointer; }
        .material-symbols-outlined { font-size:18px !important; }

        /* Modal Overlay */
        .modal-overlay { display: none; }
        .modal-overlay.active { display: flex; }

        /* Badge Kategori Jalan */
        .badge-kategori {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
        }
        /* Warna Badge Berdasarkan Hierarki Jalan */
        .kategori-nasional { background: #fee2e2; color: #991b1b; }
        .kategori-provinsi { background: #ffedd5; color: #9a3412; }
        .kategori-kabupaten { background: #dbeafe; color: #1e40af; }
        .kategori-desa { background: #dcfce7; color: #166534; }
        .kategori-lingkungan { background: #f3f4f6; color: #374151; }

        /* Map */
        #mapCreate, #mapEdit {
            height: 280px;
            border-radius: 10px;
            z-index: 1; /* Pastikan map tidak menutupi elemen lain */
        }
    </style>
@endpush

@section('content')
    <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
        <div class="trezo-card-header mb-[20px] md:mb-[25px] sm:flex sm:items-center sm:justify-between">
            <div class="trezo-card-title">
                <h5 class="mb-0">Daftar @yield('title')</h5>
            </div>

            <div class="trezo-card-subtitle sm:flex sm:items-center">
                <button type="button" id="btn-open-create"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-primary-500 text-white hover:bg-primary-600 transition">
                    <span class="material-symbols-outlined" style="font-size:18px;">add</span>
                    Tambah Jalan Baru
                </button>
            </div>
        </div>

        {{-- Flash Message --}}
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-md">
                {{ session('error') }}
            </div>
        @endif

        <div class="trezo-card-content" id="dataTable">
            <div class="table-responsive overflow-x-auto p-2">
                <table id="data-table" class="display stripe group" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-left">Nama Jalan</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Lebar (m)</th>
                            <th class="text-center">Panjang (m)</th>
                            <th class="text-center">Tipe Perkerasan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($jalan as $index => $item)
                            @php
                                $kategori = $item->kategori_jalan;
                                $badgeClass = match($kategori) {
                                    'Nasional' => 'kategori-nasional',
                                    'Provinsi' => 'kategori-provinsi',
                                    'Kabupaten' => 'kategori-kabupaten',
                                    'Desa' => 'kategori-desa',
                                    default => 'kategori-lingkungan',
                                };
                            @endphp
                            <tr
                                data-id="{{ $item->id }}"
                                data-nama_jalan="{{ $item->nama_jalan }}"
                                data-kategori_jalan="{{ $item->kategori_jalan }}"
                                data-lebar_jalan="{{ $item->lebar_jalan }}"
                                data-panjang_jalan="{{ $item->panjang_jalan }}"
                                data-tipe_perkerasan="{{ $item->tipe_perkerasan }}"
                                data-geom_polygon='@json($item->geom_polygon ?? null)'
                            >
                                <td class="text-center col-no">{{ $index + 1 }}</td>

                                <td class="text-left">
                                    <strong class="text-primary-500">{{ $item->nama_jalan }}</strong>
                                </td>

                                <td class="text-center">
                                    <span class="badge-kategori {{ $badgeClass }}">{{ $kategori }}</span>
                                </td>

                                <td class="text-center">{{ $item->lebar_jalan }} m</td>
                                <td class="text-center">{{ $item->panjang_jalan }} m</td>
                                <td class="text-center">{{ $item->tipe_perkerasan }}</td>

                                <td class="text-center">
                                    <div class="flex items-center gap-[10px] justify-center">
                                        <button type="button" class="btn-icon btn-edit text-blue-600 custom-tooltip" data-text="Edit">
                                            <i class="material-symbols-outlined">edit</i>
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

    {{-- MODAL CREATE --}}
    {{-- PERBAIKAN: Menambahkan max-h-[90vh] dan overflow-y-auto pada child div agar bisa scroll --}}
    <div id="modalCreate" class="modal-overlay fixed inset-0 z-[999] items-center justify-center bg-black/50 p-4">
        <div class="w-full max-w-2xl rounded-md bg-white dark:bg-[#0c1427] p-5 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between mb-4">
                <h5 class="mb-0 font-semibold text-gray-800 dark:text-gray-100">Tambah Jalan Baru</h5>
                <button type="button" class="btn-close-modal text-gray-500 hover:text-gray-800 dark:hover:text-gray-200">
                    <i class="material-symbols-outlined">close</i>
                </button>
            </div>

            <form action="{{ route('master-jalan.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf

                {{-- MAP + GEOM --}}
                <div class="md:col-span-2">
                    <label class="text-sm text-gray-600 dark:text-gray-300">
                        Peta Bantul (ketik alamat di Nama Jalan → map ikut; atau klik 2 titik untuk arah jalan)
                    </label>
                    <div id="mapCreate" class="mt-2"></div>
                    <input type="hidden" name="geom_polygon" id="geom_polygon_create">
                </div>

                <div class="md:col-span-2">
                    <label class="text-sm text-gray-600 dark:text-gray-300">Nama Jalan</label>
                    <input name="nama_jalan" id="nama_jalan_create"
                        class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]"
                        placeholder="Contoh: Jl. Sudirman, Bantul" required>
                    <p class="text-xs text-gray-500 mt-1">
                        Tips: setelah alamat ketemu, isi Lebar & Panjang → polygon otomatis terbentuk di lokasi tersebut.
                    </p>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Kategori Jalan</label>
                    <select name="kategori_jalan"
                        class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
                        <option value="Nasional">Nasional</option>
                        <option value="Provinsi">Provinsi</option>
                        <option value="Kabupaten">Kabupaten</option>
                        <option value="Desa">Desa</option>
                        <option value="Lingkungan">Lingkungan</option>
                    </select>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Tipe Perkerasan</label>
                    <select name="tipe_perkerasan"
                        class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
                        <option value="Aspal">Aspal</option>
                        <option value="Beton">Beton</option>
                        <option value="Paving">Paving</option>
                        <option value="Tanah">Tanah</option>
                    </select>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Lebar Jalan (meter)</label>
                    <input type="number" step="0.01" name="lebar_jalan" id="lebar_jalan_create" min="0"
                        class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]"
                        required placeholder="0.00">
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Panjang Jalan (meter)</label>
                    <input type="number" step="0.01" name="panjang_jalan" id="panjang_jalan_create" min="0"
                        class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]"
                        required placeholder="0.00">
                </div>

                <div class="md:col-span-2 flex justify-end gap-2 mt-2">
                    <button type="button"
                        class="btn-close-modal px-4 py-2 rounded-md bg-gray-100 dark:bg-[#15203c] text-gray-700 dark:text-gray-200">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-md bg-primary-500 text-white hover:bg-primary-600">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    {{-- PERBAIKAN: Menambahkan max-h-[90vh] dan overflow-y-auto --}}
    <div id="modalEdit" class="modal-overlay fixed inset-0 z-[999] items-center justify-center bg-black/50 p-4">
        <div class="w-full max-w-2xl rounded-md bg-white dark:bg-[#0c1427] p-5 max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between mb-4">
                <h5 class="mb-0 font-semibold text-gray-800 dark:text-gray-100">Edit Data Jalan</h5>
                <button type="button" class="btn-close-modal text-gray-500 hover:text-gray-800 dark:hover:text-gray-200">
                    <i class="material-symbols-outlined">close</i>
                </button>
            </div>

            <form id="formEdit" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf
                @method('PUT')

                {{-- MAP + GEOM --}}
                <div class="md:col-span-2">
                    <label class="text-sm text-gray-600 dark:text-gray-300">
                        Peta Bantul (edit alamat di Nama Jalan → map ikut; atau klik 2 titik untuk arah jalan)
                    </label>
                    <div id="mapEdit" class="mt-2"></div>
                    <input type="hidden" name="geom_polygon" id="geom_polygon_edit">
                </div>

                <div class="md:col-span-2">
                    <label class="text-sm text-gray-600 dark:text-gray-300">Nama Jalan</label>
                    <input name="nama_jalan" id="edit_nama_jalan"
                        class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]"
                        required>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Kategori Jalan</label>
                    <select name="kategori_jalan" id="edit_kategori_jalan"
                        class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
                        <option value="Nasional">Nasional</option>
                        <option value="Provinsi">Provinsi</option>
                        <option value="Kabupaten">Kabupaten</option>
                        <option value="Desa">Desa</option>
                        <option value="Lingkungan">Lingkungan</option>
                    </select>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Tipe Perkerasan</label>
                    <select name="tipe_perkerasan" id="edit_tipe_perkerasan"
                        class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]" required>
                        <option value="Aspal">Aspal</option>
                        <option value="Beton">Beton</option>
                        <option value="Paving">Paving</option>
                        <option value="Tanah">Tanah</option>
                    </select>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Lebar Jalan (meter)</label>
                    <input type="number" step="0.01" name="lebar_jalan" id="edit_lebar_jalan" min="0"
                        class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]"
                        required>
                </div>

                <div>
                    <label class="text-sm text-gray-600 dark:text-gray-300">Panjang Jalan (meter)</label>
                    <input type="number" step="0.01" name="panjang_jalan" id="edit_panjang_jalan" min="0"
                        class="w-full mt-1 border rounded-md px-3 py-2 bg-white dark:bg-[#0c1427] dark:border-[#15203c]"
                        required>
                </div>

                <div class="md:col-span-2 flex justify-end gap-2 mt-2">
                    <button type="button"
                        class="btn-close-modal px-4 py-2 rounded-md bg-gray-100 dark:bg-[#15203c] text-gray-700 dark:text-gray-200">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-md bg-primary-500 text-white hover:bg-primary-600">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.tailwindcss.js') }}"></script>

    {{-- Leaflet (CDN) --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        // ==========================
        // DataTable
        // ==========================
        const dt = $('#data-table').DataTable({
            responsive: true,
            pageLength: 10,
            columnDefs: [
                { targets: [0,2,3,4,5,6], className: 'text-center' },
                { targets: [1], className: 'text-left' }
            ]
        });

        function renumber(){
            const nodes = dt.rows({search:'applied', order:'applied'}).nodes();
            let i = 1;
            $(nodes).each(function(){
                $(this).find('.col-no').text(i++);
            });
        }
        dt.on('draw', renumber);
        renumber();

        // ==========================
        // Modal helpers
        // ==========================
        const modalCreate = document.getElementById('modalCreate');
        const modalEdit = document.getElementById('modalEdit');

        function openModal(m){ m.classList.add('active'); }
        function closeModal(m){ m.classList.remove('active'); }

        document.getElementById('btn-open-create').addEventListener('click', () => {
            openModal(modalCreate);
            initMapCreateOnce();
            resetCreateMapState();
            setTimeout(() => mapCreate.invalidateSize(), 150);
        });

        document.querySelectorAll('.btn-close-modal').forEach(btn => {
            btn.addEventListener('click', () => {
                closeModal(modalCreate);
                closeModal(modalEdit);
            });
        });

        window.addEventListener('click', function(e){
            if (e.target === modalCreate) closeModal(modalCreate);
            if (e.target === modalEdit) closeModal(modalEdit);
        });

        // ==========================
        // Bantul focus (lebih zoom)
        // ==========================
        const BANTUL_CENTER = [-7.900, 110.330];
        const BANTUL_DEFAULT_ZOOM = 15;
        const BANTUL_WORK_ZOOM = 17;

        const BANTUL_BOUNDS = L.latLngBounds(
            [-8.050, 110.200],
            [-7.750, 110.500]
        );

        // baseline auto dari hasil geocode
        const DEFAULT_BEARING_RAD = 0;       // 0 = utara-selatan
        const BASELINE_SEED_METERS = 10;     // seed baseline sebelum di-extend sesuai panjang input

        // ==========================
        // Debounce
        // ==========================
        function debounce(fn, delay = 700) {
            let t;
            return (...args) => {
                clearTimeout(t);
                t = setTimeout(() => fn(...args), delay);
            };
        }

        // ==========================
        // Nominatim geocode (OSM)
        // ==========================
        async function geocodeToBantul(query) {
            const q = `${query}, Bantul, DI Yogyakarta, Indonesia`;
            const url = new URL('https://nominatim.openstreetmap.org/search');
            url.searchParams.set('format', 'json');
            url.searchParams.set('q', q);
            url.searchParams.set('limit', '1');

            const res = await fetch(url.toString(), { headers: { 'Accept': 'application/json' } });
            if (!res.ok) return null;

            const data = await res.json();
            if (!data || !data.length) return null;

            return {
                lat: parseFloat(data[0].lat),
                lng: parseFloat(data[0].lon),
                display: data[0].display_name
            };
        }

        let markerCreate = null;
        let markerEdit = null;

        function setMarker(map, markerRef, latlng, popupText = '') {
            if (markerRef) map.removeLayer(markerRef);
            markerRef = L.marker(latlng).addTo(map);
            if (popupText) markerRef.bindPopup(popupText).openPopup();
            map.setView(latlng, BANTUL_WORK_ZOOM, { animate: true });
            return markerRef;
        }

        // ==========================
        // Geo helpers: offset & polygon
        // ==========================
        function offsetPoint(latlng, distMeters, bearingRad) {
            const R = 6378137;
            const d = distMeters / R;
            const brng = bearingRad;

            const lat1 = latlng.lat * Math.PI / 180;
            const lng1 = latlng.lng * Math.PI / 180;

            const lat2 = Math.asin(
                Math.sin(lat1) * Math.cos(d) +
                Math.cos(lat1) * Math.sin(d) * Math.cos(brng)
            );

            const lng2 = lng1 + Math.atan2(
                Math.sin(brng) * Math.sin(d) * Math.cos(lat1),
                Math.cos(d) - Math.sin(lat1) * Math.sin(lat2)
            );

            return L.latLng(lat2 * 180 / Math.PI, lng2 * 180 / Math.PI);
        }

        function buildRectangleFromLine(p1, p2, widthMeters) {
            const angle = Math.atan2((p2.lng - p1.lng), (p2.lat - p1.lat));
            const half = widthMeters / 2;

            const left1  = offsetPoint(p1, half, angle + Math.PI / 2);
            const right1 = offsetPoint(p1, half, angle - Math.PI / 2);
            const left2  = offsetPoint(p2, half, angle + Math.PI / 2);
            const right2 = offsetPoint(p2, half, angle - Math.PI / 2);

            return [left1, left2, right2, right1];
        }

        function extendLineToLength(p1, p2, targetLengthMeters) {
            const angle = Math.atan2((p2.lng - p1.lng), (p2.lat - p1.lat));
            return offsetPoint(p1, targetLengthMeters, angle);
        }

        // ==========================
        // Map Create
        // ==========================
        let mapCreate, baseLineCreate = [], lineLayerCreate = null, polygonLayerCreate = null;

        function renderCreate() {
            const width = parseFloat(document.getElementById('lebar_jalan_create').value);
            const length = parseFloat(document.getElementById('panjang_jalan_create').value);

            if (baseLineCreate.length < 2 || !width || !length) return;

            let p1 = baseLineCreate[0];
            let p2 = baseLineCreate[1];

            // extend sesuai panjang input
            p2 = extendLineToLength(p1, p2, length);

            if (lineLayerCreate) mapCreate.removeLayer(lineLayerCreate);
            lineLayerCreate = L.polyline([p1, p2], { weight: 4 }).addTo(mapCreate);

            const rect = buildRectangleFromLine(p1, p2, width);

            if (polygonLayerCreate) mapCreate.removeLayer(polygonLayerCreate);
            polygonLayerCreate = L.polygon(rect, { color: '#6366f1', fillOpacity: 0.35 }).addTo(mapCreate);

            document.getElementById('geom_polygon_create').value = JSON.stringify(polygonLayerCreate.toGeoJSON());
            mapCreate.fitBounds(polygonLayerCreate.getBounds(), { padding: [20,20] });
        }

        function initMapCreateOnce() {
            if (mapCreate) return;

            mapCreate = L.map('mapCreate', {
                maxBounds: BANTUL_BOUNDS,
                maxBoundsViscosity: 1.0,
                minZoom: 13
            }).setView(BANTUL_CENTER, BANTUL_DEFAULT_ZOOM);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19 }).addTo(mapCreate);

            // Klik manual 2 titik untuk arah jalan (override baseline)
            mapCreate.on('click', (e) => {
                baseLineCreate.push(e.latlng);
                if (baseLineCreate.length > 2) baseLineCreate = [baseLineCreate[1], e.latlng];
                renderCreate();
            });

            // Geocode: ketik alamat -> map pindah + baseline otomatis -> polygon ikut lebar/panjang input
            const inputCreate = document.getElementById('nama_jalan_create');
            inputCreate.addEventListener('input', debounce(async () => {
                const val = inputCreate.value.trim();
                if (val.length < 5) return;

                const result = await geocodeToBantul(val);
                if (!result) return;

                const latlng = L.latLng(result.lat, result.lng);
                if (!BANTUL_BOUNDS.contains(latlng)) return;

                markerCreate = setMarker(mapCreate, markerCreate, latlng, result.display);

                // baseline otomatis dari lokasi geocode
                baseLineCreate = [
                    latlng,
                    offsetPoint(latlng, BASELINE_SEED_METERS, DEFAULT_BEARING_RAD)
                ];

                // supaya saat user sudah isi lebar/panjang, polygon langsung muncul
                renderCreate();
            }, 750));
        }

        function resetCreateMapState() {
            baseLineCreate = [];
            document.getElementById('geom_polygon_create').value = '';

            if (lineLayerCreate) { mapCreate.removeLayer(lineLayerCreate); lineLayerCreate = null; }
            if (polygonLayerCreate) { mapCreate.removeLayer(polygonLayerCreate); polygonLayerCreate = null; }
            if (markerCreate) { mapCreate.removeLayer(markerCreate); markerCreate = null; }

            mapCreate.setView(BANTUL_CENTER, BANTUL_DEFAULT_ZOOM);
        }

        ['lebar_jalan_create', 'panjang_jalan_create'].forEach(id => {
            document.getElementById(id).addEventListener('input', renderCreate);
        });

        // ==========================
        // Map Edit
        // ==========================
        let mapEdit, baseLineEdit = [], lineLayerEdit = null, polygonLayerEdit = null;

        function renderEdit() {
            const width = parseFloat(document.getElementById('edit_lebar_jalan').value);
            const length = parseFloat(document.getElementById('edit_panjang_jalan').value);

            if (baseLineEdit.length < 2 || !width || !length) return;

            let p1 = baseLineEdit[0];
            let p2 = baseLineEdit[1];

            p2 = extendLineToLength(p1, p2, length);

            if (lineLayerEdit) mapEdit.removeLayer(lineLayerEdit);
            lineLayerEdit = L.polyline([p1, p2], { weight: 4 }).addTo(mapEdit);

            const rect = buildRectangleFromLine(p1, p2, width);

            if (polygonLayerEdit) mapEdit.removeLayer(polygonLayerEdit);
            polygonLayerEdit = L.polygon(rect, { color: '#6366f1', fillOpacity: 0.35 }).addTo(mapEdit);

            document.getElementById('geom_polygon_edit').value = JSON.stringify(polygonLayerEdit.toGeoJSON());
            mapEdit.fitBounds(polygonLayerEdit.getBounds(), { padding: [20,20] });
        }

        function initMapEditOnce() {
            if (mapEdit) return;

            mapEdit = L.map('mapEdit', {
                maxBounds: BANTUL_BOUNDS,
                maxBoundsViscosity: 1.0,
                minZoom: 13
            }).setView(BANTUL_CENTER, BANTUL_DEFAULT_ZOOM);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19 }).addTo(mapEdit);

            // Klik manual 2 titik (override baseline)
            mapEdit.on('click', (e) => {
                baseLineEdit.push(e.latlng);
                if (baseLineEdit.length > 2) baseLineEdit = [baseLineEdit[1], e.latlng];
                renderEdit();
            });

            // Geocode edit
            const inputEdit = document.getElementById('edit_nama_jalan');
            inputEdit.addEventListener('input', debounce(async () => {
                const val = inputEdit.value.trim();
                if (val.length < 5) return;

                const result = await geocodeToBantul(val);
                if (!result) return;

                const latlng = L.latLng(result.lat, result.lng);
                if (!BANTUL_BOUNDS.contains(latlng)) return;

                markerEdit = setMarker(mapEdit, markerEdit, latlng, result.display);

                baseLineEdit = [
                    latlng,
                    offsetPoint(latlng, BASELINE_SEED_METERS, DEFAULT_BEARING_RAD)
                ];

                renderEdit();
            }, 750));
        }

        function clearEditMapLayers() {
            baseLineEdit = [];
            document.getElementById('geom_polygon_edit').value = '';

            if (lineLayerEdit) { mapEdit.removeLayer(lineLayerEdit); lineLayerEdit = null; }
            if (polygonLayerEdit) { mapEdit.removeLayer(polygonLayerEdit); polygonLayerEdit = null; }
            if (markerEdit) { mapEdit.removeLayer(markerEdit); markerEdit = null; }

            mapEdit.setView(BANTUL_CENTER, BANTUL_DEFAULT_ZOOM);
        }

        ['edit_lebar_jalan', 'edit_panjang_jalan'].forEach(id => {
            document.getElementById(id).addEventListener('input', renderEdit);
        });

        function loadEditPolygonFromSaved(geojsonStr) {
            clearEditMapLayers();
            if (!geojsonStr) return;

            try {
                const gj = (typeof geojsonStr === 'string') ? JSON.parse(geojsonStr) : geojsonStr;
                const layer = L.geoJSON(gj);
                layer.eachLayer(l => {
                    polygonLayerEdit = l;
                    polygonLayerEdit.setStyle({ color:'#6366f1', fillOpacity:0.35 });
                    polygonLayerEdit.addTo(mapEdit);
                });

                if (polygonLayerEdit) {
                    document.getElementById('geom_polygon_edit').value = JSON.stringify(polygonLayerEdit.toGeoJSON());
                    mapEdit.fitBounds(polygonLayerEdit.getBounds(), { padding: [20,20] });
                }
            } catch(err) {
                console.warn('geom_polygon invalid:', err);
            }
        }

        // ==========================
        // Open Edit Modal
        // ==========================
        document.addEventListener('click', function(e){
            const btn = e.target.closest('.btn-edit');
            if (!btn) return;

            const tr = btn.closest('tr');

            const id = tr.dataset.id;
            const nama = tr.dataset.nama_jalan;
            const kategori = tr.dataset.kategori_jalan;
            const tipe = tr.dataset.tipe_perkerasan;
            const lebar = tr.dataset.lebar_jalan;
            const panjang = tr.dataset.panjang_jalan;
            const geomPolygon = tr.dataset.geom_polygon;

            const form = document.getElementById('formEdit');
            form.action = `/master-jalan/${id}`;

            document.getElementById('edit_nama_jalan').value = nama;
            document.getElementById('edit_kategori_jalan').value = kategori;
            document.getElementById('edit_tipe_perkerasan').value = tipe;
            document.getElementById('edit_lebar_jalan').value = lebar;
            document.getElementById('edit_panjang_jalan').value = panjang;

            openModal(modalEdit);
            initMapEditOnce();

            setTimeout(() => {
                mapEdit.invalidateSize();
                loadEditPolygonFromSaved(geomPolygon);

                // kalau belum ada geom, seed baseline dari nama jalan (biar input lebar/panjang langsung bisa render)
                if (!geomPolygon && nama && nama.length >= 5) {
                    const inputEdit = document.getElementById('edit_nama_jalan');
                    inputEdit.dispatchEvent(new Event('input'));
                }
            }, 150);
        });
    </script>
@endpush