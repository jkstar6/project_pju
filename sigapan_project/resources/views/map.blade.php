@extends('layouts.app')

@section('title', 'Peta Distribusi Lampu PJU & Panel KWH')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
    <style>
        body { overflow-x: hidden; }
        
        #map {
            height: 75vh;
            width: 100%;
            z-index: 5;
            border-radius: 12px;
        }

        /* Side Panel Detail */
        #lampPanel {
            position: fixed;
            top: 0;
            right: 0;
            height: 100vh;
            width: 380px;
            background: white;
            box-shadow: -5px 0 15px rgba(0,0,0,0.1);
            z-index: 9999; 
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
            overflow-y: auto;
        }

        #lampPanel.active { transform: translateX(0); }

        #panelOverlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 9998;
            display: none;
        }

        #map .leaflet-tile-pane {
            filter: brightness(0.85) contrast(1.1) saturate(0.9);
        }

        #map .leaflet-overlay-pane,
        #map .leaflet-marker-pane,
        #map .leaflet-popup-pane {
            filter: none;
        }

        .gps-button {
            position: absolute;
            bottom: 20px;
            right: 10px;
            z-index: 1000;
            background: white;
            width: 40px;
            height: 40px;
            border-radius: 4px;
            border: 2px solid rgba(0,0,0,0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 1px 5px rgba(0,0,0,0.4);
        }

        .toggle-cables {
            position: absolute;
            bottom: 70px;
            right: 10px;
            z-index: 1000;
            background: white;
            padding: 8px 12px;
            border-radius: 4px;
            border: 2px solid rgba(0,0,0,0.2);
            cursor: pointer;
            box-shadow: 0 1px 5px rgba(0,0,0,0.4);
            font-size: 12px;
            font-weight: 600;
        }

        .toggle-cables.active {
            background: #14b8a6;
            color: white;
            border-color: #14b8a6;
        }

        .toggle-cluster {
            position: absolute;
            bottom: 120px;
            right: 10px;
            z-index: 1000;
            background: white;
            padding: 8px 12px;
            border-radius: 4px;
            border: 2px solid rgba(0,0,0,0.2);
            cursor: pointer;
            box-shadow: 0 1px 5px rgba(0,0,0,0.4);
            font-size: 12px;
            font-weight: 600;
        }

        .toggle-cluster.active {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }

        .search-container {
            position: relative;
            z-index: 100;
        }

        .legend {
            position: absolute;
            top: 10px;
            left: 10px;
            z-index: 1000;
            background: white;
            padding: 12px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            font-size: 12px;
            max-height: 80vh;
            overflow-y: auto;
        }

        .legend-title {
            font-weight: 700;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin: 6px 0;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: background 0.2s;
        }

        .legend-item:hover {
            background: #f3f4f6;
        }

        .legend-item.disabled {
            opacity: 0.4;
        }

        .legend-color {
            width: 20px;
            height: 12px;
            margin-right: 8px;
            border-radius: 2px;
            flex-shrink: 0;
        }

        .legend-checkbox {
            width: 16px;
            height: 16px;
            margin-right: 8px;
            cursor: pointer;
            flex-shrink: 0;
        }

        .filter-section {
            margin-top: 16px;
            padding-top: 12px;
            border-top: 1px solid #e5e7eb;
        }

        .filter-actions {
            display: flex;
            gap: 8px;
            margin-top: 8px;
        }

        .filter-btn {
            flex: 1;
            padding: 6px;
            font-size: 11px;
            background: #f3f4f6;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.2s;
        }

        .filter-btn:hover {
            background: #e5e7eb;
        }

        .badge {
            display: inline-block;
            padding: 20px;
            background: #e0f2f1;
            border-radius: 12px;
            font-weight: 700;
            font-size: 18px;
            margin-bottom: 16px;
            width: 100%;
            text-align: center;
        }

        .info-card {
            background: #f3f4f6;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 12px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
        }

        .info-label {
            font-weight: 600;
            font-size: 12px;
            color: #6b7280;
        }

        .map-link {
            display: block;
            margin-top: 12px;
            background: #14b8a6;
            color: white;
            text-align: center;
            padding: 10px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
        }

        .map-link:hover {
            background: #0d9488;
        }

        .detail-tab {
            padding: 8px 16px;
            background: transparent;
            border: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 13px;
            color: #6b7280;
            border-bottom: 2px solid transparent;
            transition: all 0.2s;
        }

        .detail-tab.active {
            color: #14b8a6;
            border-bottom-color: #14b8a6;
        }

        .detail-tab:hover {
            color: #0d9488;
        }

        .detail-tab-content {
            animation: fadeIn 0.3s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Marker cluster customization */
        .marker-cluster-small {
            background-color: rgba(16, 185, 129, 0.6);
        }
        
        .marker-cluster-small div {
            background-color: rgba(16, 185, 129, 0.8);
        }

        .marker-cluster-medium {
            background-color: rgba(245, 158, 11, 0.6);
        }
        
        .marker-cluster-medium div {
            background-color: rgba(245, 158, 11, 0.8);
        }

        .marker-cluster-large {
            background-color: rgba(239, 68, 68, 0.6);
        }
        
        .marker-cluster-large div {
            background-color: rgba(239, 68, 68, 0.8);
        }

        .cable-tooltip {
            background: rgba(0, 0, 0, 0.8);
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 11px;
            padding: 4px 8px;
            font-weight: 600;
        }
    </style>
@endpush

@section('content')
    <main class="bg-neutral-200 py-6">
        <div class="container mx-auto px-4 mb-4 search-container">
            <div class="max-w-2xl mx-auto flex shadow-sm bg-white rounded-lg overflow-hidden border">
                <input id="addressSearch" type="text" placeholder="Masukkan nama jalan atau tempat..." class="flex-1 px-4 py-3 outline-none text-sm">
                <button id="searchBtn" class="px-6 bg-teal-600 text-gray-100 font-semibold hover:bg-teal-700 transition cursor-pointer">Search</button>
            </div>
            <div id="searchLoading" class="text-center text-xs text-teal-600 mt-2 hidden italic">Mencari lokasi...</div>
        </div>

        <div class="container mx-auto px-4">
            <div class="relative">
                <div class="legend">
                    <div class="legend-title">Status Lampu PJU</div>
                    
                    <div class="legend-item" data-status="Aktif">
                        <input type="checkbox" class="legend-checkbox" checked data-filter="Aktif">
                        <div class="legend-color" style="background: #10b981;"></div>
                        <span>Aktif</span>
                    </div>
                    <div class="legend-item" data-status="Mati">
                        <input type="checkbox" class="legend-checkbox" checked data-filter="Mati">
                        <div class="legend-color" style="background: #ef4444;"></div>
                        <span>Mati</span>
                    </div>
                    <div class="legend-item" data-status="Rusak">
                        <input type="checkbox" class="legend-checkbox" checked data-filter="Rusak">
                        <div class="legend-color" style="background: #f97316;"></div>
                        <span>Rusak</span>
                    </div>
                    <div class="legend-item" data-status="Pengerjaan">
                        <input type="checkbox" class="legend-checkbox" checked data-filter="Pengerjaan">
                        <div class="legend-color" style="background: #eab308;"></div>
                        <span>Pengerjaan</span>
                    </div>
                    <div class="legend-item" data-status="Tidak Ada">
                        <input type="checkbox" class="legend-checkbox" checked data-filter="Tidak Ada">
                        <div class="legend-color" style="background: #6b7280;"></div>
                        <span>Tidak Ada</span>
                    </div>

                    <div class="filter-section">
                        <div class="legend-title">Panel KWH</div>
                        <div class="legend-item" data-status="Panel">
                            <input type="checkbox" class="legend-checkbox" checked data-filter="Panel">
                            <div class="legend-color" style="background: #f59e0b;"></div>
                            <span>Panel KWH</span>
                        </div>
                    </div>

                    <div class="filter-actions">
                        <button class="filter-btn" id="selectAll">Select All</button>
                        <button class="filter-btn" id="deselectAll">Deselect All</button>
                    </div>
                </div>

                <div id="map">
                    <div class="toggle-cluster" id="toggleCluster">Clustering ON</div>
                    <div class="toggle-cables" id="toggleCables">Show Cables</div>
                    <button class="gps-button" id="gpsBtn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 2v3M12 19v3M5 12H2m17 0h3"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </main>

    <div id="panelOverlay"></div>
    <div id="lampPanel">
        <div class="p-5 border-b flex justify-between items-center bg-gray-50">
            <div class="flex gap-0">
                <button class="detail-tab active" data-tab="pju">PJU</button>
                <button class="detail-tab" data-tab="kwh">KWH Panel</button>
                <button class="detail-tab" data-tab="cables">Cables</button>
            </div>
            <button id="closePanel" class="text-3xl leading-none">&times;</button>
        </div>
        <div id="lampContent" class="p-6">
            <div id="tab-pju" class="detail-tab-content space-y-5"></div>
            <div id="tab-kwh" class="detail-tab-content space-y-5" style="display: none;"></div>
            <div id="tab-cables" class="detail-tab-content space-y-5" style="display: none;"></div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data from backend
            const panelKWH = @json($panelKwh);
            const streetLights = @json($streetLights);
            const koneksiPJUKWH = @json($koneksiPjuKwh);

            // Validate data
            console.log('Panel KWH:', panelKWH.length);
            console.log('Street Lights:', streetLights.length);
            console.log('Connections:', koneksiPJUKWH.length);
            
            // Debug: Log unique status values
            const uniqueStatuses = [...new Set(streetLights.map(l => l.status_aset))];
            console.log('Unique Status Values:', uniqueStatuses);

            // Initialize map
            const map = L.map('map', {
                center: [-7.8753849, 110.3289243],
                zoom: 13,
                zoomControl: true,
                scrollWheelZoom: true
            });

            // Add tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                maxZoom: 19
            }).addTo(map);

            // Layer groups
            const markerClusters = L.markerClusterGroup({
                maxClusterRadius: 50,
                spiderfyOnMaxZoom: true,
                showCoverageOnHover: false,
                zoomToBoundsOnClick: true
            });
            const nonClusteredLayer = L.layerGroup();
            const panelLayer = L.layerGroup();
            const cableLayer = L.layerGroup();
            const glowLayer = L.layerGroup();

            // State variables
            let activeFilters = new Set(['Terelialisasi', 'Aktif', 'Pindah', 'Pengerjaan', 'Usulan', 'Mati', 'Panel']);
            let cablesVisible = false;
            let clusteringEnabled = true;
            let searchMarker;

            // UI Elements
            const lampPanel = document.getElementById('lampPanel');
            const overlay = document.getElementById('panelOverlay');
            const searchInput = document.getElementById('addressSearch');
            const searchBtn = document.getElementById('searchBtn');
            const searchLoading = document.getElementById('searchLoading');
            const toggleCablesBtn = document.getElementById('toggleCables');
            const toggleClusterBtn = document.getElementById('toggleCluster');

            // Helper functions - FIXED: Better color handling
            function getColor(warna) {
                if (!warna) return '#6b7280';
                
                const colorMap = {
                    'green': '#10b981',
                    'red': '#ef4444',
                    'blue': '#3b82f6',
                    'black': '#111827',
                    'yellow': '#facc15',
                    'Hijau': '#10b981',
                    'Merah': '#ef4444',
                    'Biru': '#3b82f6',
                    'Hitam': '#111827',
                    'Kuning': '#facc15',
                    'Aktif': '#10b981',
                    'Terelialisasi': '#10b981',
                    'Pindah': '#ef4444',
                    'Pengerjaan': '#3b82f6',
                    'Mati': '#111827',
                    'Usulan': '#facc15'
                };
                
                const color = colorMap[String(warna).toLowerCase().trim()] || colorMap[String(warna).trim()];
                return color || '#6b7280';
            }

            function getFasaColor(fasa) {
                const fasaMap = {
                    'R': '#ef4444',
                    'S': '#eab308',
                    'T': '#3b82f6'
                };
                return fasaMap[String(fasa).trim()] || '#6b7280';
            }

            // FIXED: Proper coordinate validation
            function isValidCoordinate(lat, lng) {
                const latNum = parseFloat(lat);
                const lngNum = parseFloat(lng);
                
                return !isNaN(latNum) && 
                       !isNaN(lngNum) && 
                       isFinite(latNum) && 
                       isFinite(lngNum) &&
                       latNum >= -90 && latNum <= 90 &&
                       lngNum >= -180 && lngNum <= 180;
            }

            // Search functionality
            async function handleSearch() {
                const query = searchInput.value.trim();
                if (!query) return;

                searchLoading.classList.remove('hidden');
                
                try {
                    const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&limit=1`);
                    const data = await response.json();

                    if (data && data.length > 0) {
                        const lat = parseFloat(data[0].lat);
                        const lon = parseFloat(data[0].lon);
                        
                        map.flyTo([lat, lon], 17);
                        
                        if (searchMarker) map.removeLayer(searchMarker);
                        searchMarker = L.marker([lat, lon]).addTo(map)
                            .bindPopup(`<b>Lokasi Ditemukan</b><br>${data[0].display_name}`)
                            .openPopup();
                    } else {
                        alert("Lokasi tidak ditemukan. Coba masukkan nama jalan yang lebih spesifik.");
                    }
                } catch (error) {
                    console.error("Search error:", error);
                    alert("Terjadi kesalahan saat mencari lokasi.");
                } finally {
                    searchLoading.classList.add('hidden');
                }
            }

            searchBtn.onclick = handleSearch;
            searchInput.onkeypress = (e) => { if (e.key === 'Enter') handleSearch(); };

            function openDetail(light) {
                const connection = koneksiPJUKWH.find(k => k.aset_pju_id === light.id);
                const panel = connection ? panelKWH.find(p => p.id === connection.panel_kwh_id) : null;

                const pjuContent = `
                    <div class="badge">${light.kode_tiang || 'N/A'}</div>
                    <div class="info-card">
                        <div class="info-row">
                            <span class="info-label">Status</span>
                            <span>${light.status_aset || 'N/A'}</span>
                        </div>
                    </div>
                    <div class="info-card">
                        <div class="info-row">
                            <span class="info-label">Jenis Lampu</span>
                            <span>${light.jenis_lampu || 'N/A'}</span>
                        </div>
                    </div>
                    <div class="info-card">
                        <div class="info-row">
                            <span class="info-label">Daya</span>
                            <span>${light.watt || 0} Watt</span>
                        </div>
                    </div>
                    <div style="font-size: 12px; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px;">
                        <strong>Wilayah</strong><br>
                        ${light.kecamatan || 'N/A'}, ${light.desa || 'N/A'}
                    </div>
                    <a href="https://www.google.com/maps/search/?api=1&query=${light.latitude},${light.longitude}"
                       target="_blank" class="map-link">Buka di Google Maps</a>
                `;

                const kwhContent = panel ? `
                    <div class="badge" style="background: #fef3c7; color: #92400e;">${panel.no_pelanggan_pln}</div>
                    <div class="info-card">
                        <div class="info-row">
                            <span class="info-label">Lokasi</span>
                            <span>${panel.lokasi_panel || 'N/A'}</span>
                        </div>
                    </div>
                    <div class="info-card">
                        <div class="info-row">
                            <span class="info-label">Daya</span>
                            <span>${panel.daya_va || 0} VA</span>
                        </div>
                    </div>
                    <a href="https://www.google.com/maps/search/?api=1&query=${panel.latitude},${panel.longitude}"
                       target="_blank" class="map-link">Buka di Google Maps</a>
                ` : `<div class="p-4 text-center text-gray-500">Panel KWH tidak terhubung</div>`;

                const cablesContent = connection ? `
                    <div class="info-card">
                        <div class="info-row">
                            <span class="info-label">Status Koneksi</span>
                            <span>${connection.status_koneksi || 'N/A'}</span>
                        </div>
                    </div>
                    <div class="info-card">
                        <div class="info-row">
                            <span class="info-label">Nomor MCB</span>
                            <span>${connection.nomor_mcb_panel || 'N/A'}</span>
                        </div>
                    </div>
                    <div class="info-card">
                        <div class="info-row">
                            <span class="info-label">Fasa</span>
                            <span>${connection.fasa || 'N/A'}</span>
                        </div>
                    </div>
                    <div class="info-card">
                        <div class="info-row">
                            <span class="info-label">Panjang Kabel (Est)</span>
                            <span>${connection.panjang_kabel_est || 0} m</span>
                        </div>
                    </div>
                    <div class="info-card">
                        <div class="info-row">
                            <span class="info-label">Tanggal Koneksi</span>
                            <span>${connection.tgl_koneksi || 'N/A'}</span>
                        </div>
                    </div>
                    ${connection.keterangan_jalur ? `
                    <div class="info-card">
                        <div class="info-row">
                            <span class="info-label">Keterangan</span>
                            <span>${connection.keterangan_jalur}</span>
                        </div>
                    </div>
                    ` : ''}
                ` : `<div class="p-4 text-center text-gray-500">Tidak ada koneksi kabel</div>`;

                document.getElementById('tab-pju').innerHTML = pjuContent;
                document.getElementById('tab-kwh').innerHTML = kwhContent;
                document.getElementById('tab-cables').innerHTML = cablesContent;

                lampPanel.classList.add('active');
                overlay.style.display = 'block';
            }

            // Tab switching
            document.querySelectorAll('.detail-tab').forEach(tab => {
                tab.addEventListener('click', () => {
                    document.querySelectorAll('.detail-tab').forEach(t => t.classList.remove('active'));
                    tab.classList.add('active');
                    
                    document.querySelectorAll('.detail-tab-content').forEach(content => {
                        content.style.display = 'none';
                    });
                    
                    document.getElementById(`tab-${tab.dataset.tab}`).style.display = 'block';
                });
            });

            // Close panel
            document.getElementById('closePanel').onclick = () => {
                lampPanel.classList.remove('active');
                overlay.style.display = 'none';
            };

            overlay.onclick = () => {
                lampPanel.classList.remove('active');
                overlay.style.display = 'none';
            };

            // GPS button
            document.getElementById('gpsBtn').onclick = () => {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        (position) => {
                            const lat = position.coords.latitude;
                            const lng = position.coords.longitude;
                            map.flyTo([lat, lng], 16);
                            
                            if (searchMarker) map.removeLayer(searchMarker);
                            searchMarker = L.marker([lat, lng]).addTo(map)
                                .bindPopup('<b>Lokasi Anda</b>')
                                .openPopup();
                        },
                        () => {
                            alert('Tidak bisa mendapatkan lokasi Anda.');
                        }
                    );
                } else {
                    alert('Geolocation tidak didukung oleh browser Anda.');
                }
            };

            // FIXED: Draw cables with proper coordinate validation
            function drawCables() {
                cableLayer.clearLayers();

                koneksiPJUKWH.forEach(connection => {
                    const light = streetLights.find(l => l.id === connection.aset_pju_id);
                    const panel = panelKWH.find(p => p.id === connection.panel_kwh_id);

                    if (light && panel && connection.status_koneksi === 'Aktif') {
                        if (isValidCoordinate(panel.latitude, panel.longitude) && 
                            isValidCoordinate(light.latitude, light.longitude)) {
                            
                            const panelLat = parseFloat(panel.latitude);
                            const panelLng = parseFloat(panel.longitude);
                            const lightLat = parseFloat(light.latitude);
                            const lightLng = parseFloat(light.longitude);
                            
                            const line = L.polyline(
                                [[panelLat, panelLng], [lightLat, lightLng]],
                                { 
                                    color: getFasaColor(connection.fasa), 
                                    weight: 3, 
                                    opacity: 0.7,
                                    dashArray: '5, 10'
                                }
                            );

                            line.bindTooltip(`${connection.nomor_mcb_panel || 'N/A'} - Fasa ${connection.fasa || 'N/A'}`, {
                                permanent: false,
                                direction: 'center',
                                className: 'cable-tooltip'
                            });

                            cableLayer.addLayer(line);
                        }
                    }
                });

                if (cablesVisible && cableLayer.getLayers().length > 0) {
                    cableLayer.addTo(map);
                }
            }

            // Toggle cables
            toggleCablesBtn.onclick = () => {
                cablesVisible = !cablesVisible;
                toggleCablesBtn.classList.toggle('active');
                toggleCablesBtn.textContent = cablesVisible ? 'Hide Cables' : 'Show Cables';
                drawCables();
            };

            // Toggle clustering
            toggleClusterBtn.onclick = () => {
                clusteringEnabled = !clusteringEnabled;
                toggleClusterBtn.classList.toggle('active');
                toggleClusterBtn.textContent = clusteringEnabled ? 'Clustering ON' : 'Clustering OFF';
                updateLayers();
            };

            // FIXED: Complete rewrite of updateLayers function
            function updateLayers() {
                // Clear all layers
                markerClusters.clearLayers();
                nonClusteredLayer.clearLayers();
                panelLayer.clearLayers();
                glowLayer.clearLayers();

                // Remove layers from map
                if (map.hasLayer(markerClusters)) map.removeLayer(markerClusters);
                if (map.hasLayer(nonClusteredLayer)) map.removeLayer(nonClusteredLayer);
                if (map.hasLayer(panelLayer)) map.removeLayer(panelLayer);
                if (map.hasLayer(glowLayer)) map.removeLayer(glowLayer);
                if (map.hasLayer(cableLayer)) map.removeLayer(cableLayer);

                // Add panel markers (always non-clustered)
                if (activeFilters.has('Panel')) {
                    panelKWH.forEach(panel => {
                        if (isValidCoordinate(panel.latitude, panel.longitude)) {
                            const lat = parseFloat(panel.latitude);
                            const lng = parseFloat(panel.longitude);
                            
                            const panelIcon = L.divIcon({
                                className: 'custom-panel-icon',
                                html: `<div style="background: #f59e0b; color: black; width: 32px; height: 32px; border-radius: 2px; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.3);">KWH</div>`,
                                iconSize: [32, 32]
                            });

                            L.marker([lat, lng], { icon: panelIcon })
                                .addTo(panelLayer)
                                .bindPopup(`
                                    <div style="font-size: 13px;">
                                        <strong style="color: #f59e0b;">Panel KWH</strong><br>
                                        <strong>No. PLN:</strong> ${panel.no_pelanggan_pln || 'N/A'}<br>
                                        <strong>Lokasi:</strong> ${panel.lokasi_panel || 'N/A'}<br>
                                        <strong>Daya:</strong> ${panel.daya_va || 0} VA
                                    </div>
                                `);
                        }
                    });
                    panelLayer.addTo(map);
                }

                // Add streetlight markers
                const validLights = [];
                
                streetLights.forEach(light => {
                    // Check if coordinates are valid
                

                    // Check if status is in active filters
         

                    validLights.push(light);
                });


                // Create markers for each valid light
                validLights.forEach(light => {
                    const lat = parseFloat(light.latitude);
                    const lng = parseFloat(light.longitude);
                    const color = getColor(light.status_aset);

                    // Create glow effect
                    const glow = L.circleMarker([lat, lng], {
                        radius: 25,
                        fillColor: color,
                        color: color,
                        weight: 0,
                        opacity: 0.3,
                        fillOpacity: 0.2,
                        interactive: false
                    });

                    glowLayer.addLayer(glow);

                    // Create main marker
                    const marker = L.circleMarker([lat, lng], {
                        radius: 10,
                        fillColor: color,
                        color: "#fff",
                        weight: 2,
                        fillOpacity: 1
                    })
                    .bindTooltip(light.kode_tiang || 'N/A', { direction: 'top', offset: [0, -10] })
                    .on('click', () => openDetail(light));

                    // Add to appropriate layer based on clustering state
                    if (clusteringEnabled) {
                        markerClusters.addLayer(marker);
                    } else {
                        nonClusteredLayer.addLayer(marker);
                    }
                });

                // Add glow layer
                if (glowLayer.getLayers().length > 0) {
                    glowLayer.addTo(map);
                }

                // Add appropriate marker layer
                if (clusteringEnabled) {
                    if (markerClusters.getLayers().length > 0) {
                        markerClusters.addTo(map);
                    }
                } else {
                    if (nonClusteredLayer.getLayers().length > 0) {
                        nonClusteredLayer.addTo(map);
                    }
                }

                // Redraw cables
                drawCables();

                // Update legend visual state
                document.querySelectorAll('.legend-item').forEach(item => {
                    const status = item.dataset.status;
                    const checkbox = item.querySelector('.legend-checkbox');
                    
                    if (status && checkbox) {
                        if (activeFilters.has(status)) {
                            item.classList.remove('disabled');
                            checkbox.checked = true;
                        } else {
                            item.classList.add('disabled');
                            checkbox.checked = false;
                        }
                    }
                });
            }

            // Filter functionality
            document.querySelectorAll('.legend-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', (e) => {
                    const filter = e.target.dataset.filter;
                    if (e.target.checked) {
                        activeFilters.add(filter);
                    } else {
                        activeFilters.delete(filter);
                    }
                    updateLayers();
                });
            });

            // Select/Deselect all buttons
            document.getElementById('selectAll').onclick = () => {
                document.querySelectorAll('.legend-checkbox').forEach(cb => {
                    cb.checked = true;
                    activeFilters.add(cb.dataset.filter);
                });
                updateLayers();
            };

            document.getElementById('deselectAll').onclick = () => {
                document.querySelectorAll('.legend-checkbox').forEach(cb => {
                    cb.checked = false;
                    activeFilters.delete(cb.dataset.filter);
                });
                updateLayers();
            };

            // Initialize map with all layers
            updateLayers();
            
            // Fit bounds to show all markers
            const bounds = [];
            streetLights.forEach(light => {
                if (isValidCoordinate(light.latitude, light.longitude)) {
                    bounds.push([parseFloat(light.latitude), parseFloat(light.longitude)]);
                }
            });
            panelKWH.forEach(panel => {
                if (isValidCoordinate(panel.latitude, panel.longitude)) {
                    bounds.push([parseFloat(panel.latitude), parseFloat(panel.longitude)]);
                }
            });
            
            if (bounds.length > 1) {
                map.fitBounds(bounds, { padding: [50, 50] });
            }

            // Log final stats
            console.log('Map initialized with:');
            console.log('- Street lights displayed:', validLights.length);
            console.log('- Panels displayed:', panelKWH.length);
            console.log('- Cables visible:', cablesVisible);
            console.log('- Clustering enabled:', clusteringEnabled);
        });
    </script>
@endpush