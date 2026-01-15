@extends('layouts.app')

@section('title', 'map')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
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
        }

        .legend-title {
            font-weight: 700;
            margin-bottom: 8px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin: 4px 0;
        }

        .legend-color {
            width: 20px;
            height: 12px;
            margin-right: 8px;
            border-radius: 2px;
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
            width: 100%;
            text-align: center;
            padding: 12px;
            background: #14b8a6;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            margin-top: 16px;
        }

        .map-link:hover {
            background: #0f9488;
        }
    </style>
@endpush

@section('content')
    <main class="bg-neutral-200 py-6">
        <div class="container mx-auto px-4 mb-4 search-container">
            <div class="max-w-2xl mx-auto flex shadow-sm bg-white rounded-lg overflow-hidden border">
                <input id="addressSearch" type="text" placeholder="Masukkan nama jalan atau tempat..." class="flex-1 px-4 py-3 outline-none text-sm">
                <button id="searchBtn" class="px-6 bg-teal-600 text-white font-semibold hover:bg-teal-700 transition cursor-pointer">Search</button>
            </div>
            <div id="searchLoading" class="text-center text-xs text-teal-600 mt-2 hidden italic">Mencari lokasi...</div>
        </div>

        <div class="container mx-auto px-4">
            <div class="relative">
                <div class="legend">
                    <div class="legend-title">Status Lampu</div>
                    <div class="legend-item">
                        <div class="legend-color" style="background: #10b981;"></div>
                        <span>Aktif</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background: #ef4444;"></div>
                        <span>Pindah / Mati</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background: #3b82f6;"></div>
                        <span>Pengerjaan</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background: #facc15;"></div>
                        <span>Usulan</span>
                    </div>
                </div>

                <div id="map" class="border shadow-md"></div>
                
                <button id="toggleCables" class="toggle-cables">Show Cables</button>
                
                <button id="gpsBtn" class="gps-button" title="Lokasi Terkini">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="3"></circle>
                        <path d="M13 2v3M13 19v3M5 12H2m17 0h3"></path>
                    </svg>
                </button>
            </div>
        </div>
    </main>

    <div id="panelOverlay"></div>
    <div id="lampPanel">
        <div class="p-5 border-b flex justify-between items-center bg-gray-50">
            <h3 class="font-bold text-gray-800 text-base">Street Light Detail</h3>
            <button id="closePanel" class="text-3xl leading-none">&times;</button>
        </div>
        <div id="lampContent" class="p-6 space-y-5">
            <p class="text-gray-400 text-sm">Klik marker lampu untuk melihat informasi.</p>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        // Data Panel KWH
        const panelKWH = [
            {
                id: 1,
                no_pelanggan_pln: "PLN-001-2024",
                lokasi_panel: "Jl. Kaliurang KM 5",
                latitude: -7.89600,
                longitude: 110.33800,
                daya_va: 10000
            },
            {
                id: 2,
                no_pelanggan_pln: "PLN-002-2024",
                lokasi_panel: "Jl. Gejayan",
                latitude: -7.89700,
                longitude: 110.33850,
                daya_va: 8000
            },
            {
                id: 3,
                no_pelanggan_pln: "PLN-003-2024",
                lokasi_panel: "Jl. Seturan",
                latitude: -7.89550,
                longitude: 110.33750,
                daya_va: 12000
            },
            {
                id: 4,
                no_pelanggan_pln: "PLN-004-2024",
                lokasi_panel: "Jl. Ring Road Utara",
                latitude: -7.89650,
                longitude: 110.33900,
                daya_va: 15000
            }
        ];

        // Data Lampu PJU
        const streetLights = [
            {
                id: 1,
                panel_kwh_id: 1,
                kode_tiang: "PJU-001",
                jenis_lampu: "LED",
                watt: 60,
                status_aset: "Aktif",
                warna_map: "Hijau",
                latitude: -7.89610,
                longitude: 110.33843,
                kecamatan: "Umbulharjo",
                desa: "Muja Muju"
            },
            {
                id: 2,
                panel_kwh_id: 1,
                kode_tiang: "PJU-002",
                jenis_lampu: "Halogen",
                watt: 100,
                status_aset: "Pindah",
                warna_map: "Merah",
                latitude: -7.89582,
                longitude: 110.33801,
                kecamatan: "Umbulharjo",
                desa: "Muja Muju"
            },
            {
                id: 3,
                panel_kwh_id: 2,
                kode_tiang: "PJU-003",
                jenis_lampu: "Solar",
                watt: 80,
                status_aset: "Pengerjaan",
                warna_map: "Biru",
                latitude: -7.89645,
                longitude: 110.33902,
                kecamatan: "Kotagede",
                desa: "Rejowinangun"
            },
            {
                id: 4,
                panel_kwh_id: 2,
                kode_tiang: "PJU-004",
                jenis_lampu: "LED",
                watt: 70,
                status_aset: "Aktif",
                warna_map: "Hijau",
                latitude: -7.89701,
                longitude: 110.33789,
                kecamatan: "Kotagede",
                desa: "Rejowinangun"
            },
            {
                id: 5,
                panel_kwh_id: 3,
                kode_tiang: "PJU-005",
                jenis_lampu: "LED",
                watt: 50,
                status_aset: "Usulan",
                warna_map: "Kuning",
                latitude: -7.89554,
                longitude: 110.33745,
                kecamatan: "Banguntapan",
                desa: "Jambidan"
            },
            {
                id: 6,
                panel_kwh_id: 3,
                kode_tiang: "PJU-006",
                jenis_lampu: "Solar",
                watt: 90,
                status_aset: "Mati",
                warna_map: "Hitam",
                latitude: -7.89672,
                longitude: 110.33888,
                kecamatan: "Banguntapan",
                desa: "Jambidan"
            },
            {
                id: 7,
                panel_kwh_id: 4,
                kode_tiang: "PJU-007",
                jenis_lampu: "Halogen",
                watt: 120,
                status_aset: "Pindah",
                warna_map: "Merah",
                latitude: -7.89591,
                longitude: 110.33931,
                kecamatan: "Depok",
                desa: "Caturtunggal"
            },
            {
                id: 8,
                panel_kwh_id: 4,
                kode_tiang: "PJU-008",
                jenis_lampu: "LED",
                watt: 60,
                status_aset: "Aktif",
                warna_map: "Hijau",
                latitude: -7.89633,
                longitude: 110.33771,
                kecamatan: "Depok",
                desa: "Caturtunggal"
            },
            {
                id: 9,
                panel_kwh_id: 1,
                kode_tiang: "PJU-009",
                jenis_lampu: "LED",
                watt: 65,
                status_aset: "Aktif",
                warna_map: "Hijau",
                latitude: -7.89742,
                longitude: 110.33812,
                kecamatan: "Sewon",
                desa: "Bangunharjo"
            },
            {
                id: 10,
                panel_kwh_id: 2,
                kode_tiang: "PJU-010",
                jenis_lampu: "Solar",
                watt: 100,
                status_aset: "Usulan",
                warna_map: "Kuning",
                latitude: -7.89788,
                longitude: 110.33856,
                kecamatan: "Sewon",
                desa: "Bangunharjo"
            },
            {
                id: 11,
                panel_kwh_id: 3,
                kode_tiang: "PJU-011",
                jenis_lampu: "LED",
                watt: 75,
                status_aset: "Pengerjaan",
                warna_map: "Biru",
                latitude: -7.89821,
                longitude: 110.33902,
                kecamatan: "Kasihan",
                desa: "Tirtonirmolo"
            },
            {
                id: 12,
                panel_kwh_id: 3,
                kode_tiang: "PJU-012",
                jenis_lampu: "Halogen",
                watt: 150,
                status_aset: "Mati",
                warna_map: "Hitam",
                latitude: -7.89864,
                longitude: 110.33941,
                kecamatan: "Kasihan",
                desa: "Tirtonirmolo"
            },
            {
                id: 13,
                panel_kwh_id: 4,
                kode_tiang: "PJU-013",
                jenis_lampu: "LED",
                watt: 80,
                status_aset: "Pindah",
                warna_map: "Merah",
                latitude: -7.89905,
                longitude: 110.33798,
                kecamatan: "Gamping",
                desa: "Ambarketawang"
            },
            {
                id: 14,
                panel_kwh_id: 4,
                kode_tiang: "PJU-014",
                jenis_lampu: "Solar",
                watt: 90,
                status_aset: "Aktif",
                warna_map: "Hijau",
                latitude: -7.89944,
                longitude: 110.33847,
                kecamatan: "Gamping",
                desa: "Ambarketawang"
            },
            {
                id: 15,
                panel_kwh_id: 2,
                kode_tiang: "PJU-015",
                jenis_lampu: "LED",
                watt: 60,
                status_aset: "Usulan",
                warna_map: "Kuning",
                latitude: -7.89981,
                longitude: 110.33903,
                kecamatan: "Mlati",
                desa: "Sinduadi"
            },
            {
                id: 16,
                panel_kwh_id: 1,
                kode_tiang: "PJU-016",
                jenis_lampu: "Halogen",
                watt: 130,
                status_aset: "Mati",
                warna_map: "Hitam",
                latitude: -7.90022,
                longitude: 110.33962,
                kecamatan: "Mlati",
                desa: "Sinduadi"
            }
        ];

        // Data Koneksi (Cable connections)
        const koneksiPJUKWH = [
            { id: 1, aset_pju_id: 1, panel_kwh_id: 1, nomor_mcb_panel: "MCB-1", fasa: "R", status_koneksi: "Aktif" },
            { id: 2, aset_pju_id: 2, panel_kwh_id: 1, nomor_mcb_panel: "MCB-2", fasa: "S", status_koneksi: "Aktif" },
            { id: 3, aset_pju_id: 3, panel_kwh_id: 2, nomor_mcb_panel: "MCB-1", fasa: "T", status_koneksi: "Aktif" },
            { id: 4, aset_pju_id: 4, panel_kwh_id: 2, nomor_mcb_panel: "MCB-2", fasa: "R", status_koneksi: "Aktif" },
            { id: 5, aset_pju_id: 5, panel_kwh_id: 3, nomor_mcb_panel: "MCB-1", fasa: "S", status_koneksi: "Aktif" },
            { id: 6, aset_pju_id: 6, panel_kwh_id: 3, nomor_mcb_panel: "MCB-2", fasa: "T", status_koneksi: "Aktif" },
            { id: 7, aset_pju_id: 7, panel_kwh_id: 4, nomor_mcb_panel: "MCB-1", fasa: "R", status_koneksi: "Aktif" },
            { id: 8, aset_pju_id: 8, panel_kwh_id: 4, nomor_mcb_panel: "MCB-2", fasa: "S", status_koneksi: "Aktif" },
            { id: 9, aset_pju_id: 9, panel_kwh_id: 1, nomor_mcb_panel: "MCB-3", fasa: "T", status_koneksi: "Aktif" },
            { id: 10, aset_pju_id: 10, panel_kwh_id: 2, nomor_mcb_panel: "MCB-3", fasa: "R", status_koneksi: "Aktif" },
            { id: 11, aset_pju_id: 11, panel_kwh_id: 3, nomor_mcb_panel: "MCB-3", fasa: "S", status_koneksi: "Aktif" },
            { id: 12, aset_pju_id: 12, panel_kwh_id: 3, nomor_mcb_panel: "MCB-4", fasa: "T", status_koneksi: "Aktif" },
            { id: 13, aset_pju_id: 13, panel_kwh_id: 4, nomor_mcb_panel: "MCB-3", fasa: "R", status_koneksi: "Aktif" },
            { id: 14, aset_pju_id: 14, panel_kwh_id: 4, nomor_mcb_panel: "MCB-4", fasa: "S", status_koneksi: "Aktif" },
            { id: 15, aset_pju_id: 15, panel_kwh_id: 2, nomor_mcb_panel: "MCB-4", fasa: "T", status_koneksi: "Aktif" },
            { id: 16, aset_pju_id: 16, panel_kwh_id: 1, nomor_mcb_panel: "MCB-4", fasa: "R", status_koneksi: "Aktif" }
        ];

        document.addEventListener('DOMContentLoaded', () => {
            const map = L.map('map').setView([-7.89610, 110.33843], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            const lampPanel = document.getElementById('lampPanel');
            const lampContent = document.getElementById('lampContent');
            const overlay = document.getElementById('panelOverlay');
            const searchInput = document.getElementById('addressSearch');
            const searchBtn = document.getElementById('searchBtn');
            const searchLoading = document.getElementById('searchLoading');
            const toggleCablesBtn = document.getElementById('toggleCables');
            
            let searchMarker;
            let cableLines = [];
            let cablesVisible = false;

            // Helper function to get color
            function getColor(warna) {
                switch (warna) {    
                    case 'Hijau': return '#10b981';
                    case 'Merah': return '#ef4444';
                    case 'Biru': return '#3b82f6';
                    case 'Hitam': return '#111827';
                    case 'Kuning':
                    default: return '#facc15';
                }
            }

            // Helper function to get fasa color
            function getFasaColor(fasa) {
                switch (fasa) {
                    case 'R': return '#ef4444'; // Red
                    case 'S': return '#facc15'; // Yellow
                    case 'T': return '#3b82f6'; // Blue
                    default: return '#6b7280'; // Gray
                }
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

            // Open detail panel
            function openDetail(light) {
                const connection = koneksiPJUKWH.find(k => k.aset_pju_id === light.id);
                const panel = connection ? panelKWH.find(p => p.id === connection.panel_kwh_id) : null;

                lampContent.innerHTML = `
                    <div class="badge">${light.kode_tiang}</div>

                    <div class="info-card">
                        <div class="info-row">
                            <span class="info-label">Status</span>
                            <span>${light.status_aset}</span>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-row">
                            <span class="info-label">Jenis Lampu</span>
                            <span>${light.jenis_lampu}</span>
                        </div>
                    </div>

                    <div class="info-card">
                        <div class="info-row">
                            <span class="info-label">Daya</span>
                            <span>${light.watt} Watt</span>
                        </div>
                    </div>

                    ${connection ? `
                        <div class="info-card">
                            <div class="info-row">
                                <span class="info-label">MCB Panel</span>
                                <span>${connection.nomor_mcb_panel}</span>
                            </div>
                        </div>

                        <div class="info-card">
                            <div class="info-row">
                                <span class="info-label">Fasa</span>
                                <span style="color: ${getFasaColor(connection.fasa)}; font-weight: 700;">${connection.fasa}</span>
                            </div>
                        </div>

                        <div class="info-card">
                            <div class="info-row">
                                <span class="info-label">Status Koneksi</span>
                                <span>${connection.status_koneksi}</span>
                            </div>
                        </div>
                    ` : ''}

                    ${panel ? `
                        <div style="margin-top: 16px; padding: 12px; background: #fef3c7; border-radius: 8px; border-left: 4px solid #f59e0b;">
                            <div style="font-weight: 700; margin-bottom: 8px; font-size: 13px;">📍 Panel KWH</div>
                            <div style="font-size: 12px; color: #92400e;">
                                <div><strong>No. PLN:</strong> ${panel.no_pelanggan_pln}</div>
                                <div><strong>Lokasi:</strong> ${panel.lokasi_panel}</div>
                                <div><strong>Daya:</strong> ${panel.daya_va} VA</div>
                            </div>
                        </div>
                    ` : ''}

                    <div style="font-size: 12px; padding: 12px; border: 1px solid #e5e7eb; border-radius: 8px; margin-top: 16px;">
                        <strong>Wilayah</strong><br>
                        ${light.kecamatan}, ${light.desa}
                    </div>

                    <a href="https://www.google.com/maps?q=${light.latitude},${light.longitude}"
                       target="_blank"
                       class="map-link">
                        Buka di Google Maps
                    </a>
                `;

                lampPanel.classList.add('active');
                overlay.style.display = 'block';
            }

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
                navigator.geolocation.getCurrentPosition((pos) => {
                    map.flyTo([pos.coords.latitude, pos.coords.longitude], 18);
                }, (err) => alert("Izin lokasi ditolak atau tidak tersedia."));
            };

            // Draw cable connections
            function drawCables() {
                // Clear existing cables
                cableLines.forEach(line => map.removeLayer(line));
                cableLines = [];

                if (!cablesVisible) return;

                koneksiPJUKWH.forEach(connection => {
                    const light = streetLights.find(l => l.id === connection.aset_pju_id);
                    const panel = panelKWH.find(p => p.id === connection.panel_kwh_id);

                    if (light && panel && connection.status_koneksi === 'Aktif') {
                        const line = L.polyline(
                            [[panel.latitude, panel.longitude], [light.latitude, light.longitude]],
                            {
                                color: getFasaColor(connection.fasa),
                                weight: 2,
                                opacity: 0.6,
                                dashArray: '5, 10'
                            }
                        ).addTo(map);

                        line.bindTooltip(`${connection.nomor_mcb_panel} - Fasa ${connection.fasa}`, {
                            permanent: false,
                            direction: 'center'
                        });

                        cableLines.push(line);
                    }
                });
            }

            // Toggle cables
            toggleCablesBtn.onclick = () => {
                cablesVisible = !cablesVisible;
                toggleCablesBtn.classList.toggle('active');
                toggleCablesBtn.textContent = cablesVisible ? 'Hide Cables' : 'Show Cables';
                drawCables();
            };

            // Render Panel KWH markers
            panelKWH.forEach(panel => {
                const panelIcon = L.divIcon({
                    className: 'custom-panel-icon',
                    html: `<div style="background: #eeeeee; color: white; width: 32px; height: 32px; border-radius: 4px; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.3);">⚡</div>`,
                    iconSize: [32, 32]
                });

                L.marker([panel.latitude, panel.longitude], { icon: panelIcon })
                    .addTo(map)
                    .bindPopup(`
                        <div style="font-size: 13px;">
                            <strong style="color: #f59e0b;">Panel KWH</strong><br>
                            <strong>No. PLN:</strong> ${panel.no_pelanggan_pln}<br>
                            <strong>Lokasi:</strong> ${panel.lokasi_panel}<br>
                            <strong>Daya:</strong> ${panel.daya_va} VA
                        </div>
                    `);
            });

            // Render streetlights
            streetLights.forEach(light => {
                const color = getColor(light.warna_map);
                
                // Glow effect for certain statuses
                if (['Aktif', 'Mati', 'Pengerjaan'].includes(light.status_aset)) {
                    L.circleMarker([light.latitude, light.longitude], {
                        radius: 25,
                        fillColor: color,
                        color: color,
                        weight: 0,
                        opacity: 0.3,
                        fillOpacity: 0.2,
                        interactive: false
                    }).addTo(map);
                }
                
                // Main marker
                L.circleMarker([light.latitude, light.longitude], {
                    radius: 10,
                    fillColor: color,
                    color: "#fff",
                    weight: 2,
                    fillOpacity: 1
                })
                .addTo(map)
                .bindTooltip(light.kode_tiang)
                .on('click', () => openDetail(light));
            });
        });
    </script>
@endpush