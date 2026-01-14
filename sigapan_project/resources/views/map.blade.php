@section('title', 'map')

<!doctype html>
<html lang="en" class="preset-hrm preset-ai" data-pc-direction="ltr" dir="ltr" data-pc-theme="light">
  <head>
    <title>MAP</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Ready-to-use HRM landing page template." />
    <meta name="author" content="Phoenixcoded" />

    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon" />

    <link rel="stylesheet" href="../assets/fonts/satoshi/Satoshi.css">
    <link rel="stylesheet" href="../assets/fonts/uncut-sans/Uncut-Sans.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css" id="main-style-link" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
      body { overflow-x: hidden; }
      
      /* Container Map */
      #map {
        height: 75vh;
        width: 100%;
        z-index: 10; 
        border-radius: 12px;
      }

      /* Tombol GPS Costum */
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
      .gps-button:hover { background: #f4f4f4; }

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
      }

      #lampPanel.active { transform: translateX(0); }

      #panelOverlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.4);
        z-index: 9998;
        display: none;
      }

      .leaflet-interactive { cursor: pointer !important; }
      
      .user-location-marker {
        background: #3b82f6;
        border: 2px solid white;
        border-radius: 50%;
      }
    </style>
  </head>
  <body class="bg-gray-50">
    <nav class="z-50 w-full relative bg-neutral-200">
      <div class="container">
        <div class="static flex py-4 items-center justify-between">
          <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-between">
            <div class="flex flex-1 flex-shrink-0 items-center justify-between text-primary-500">
              <a href="#">
                  <h3 class="">LOGO</h3>
              </a>
            </div>
            <div class="nav-collapse grow hidden w-full lg:flex lg:w-full flex-auto justify-center"
              id="main-navbar-collapse">
              <div class="justify-center flex flex-col lg:flex-row p-0 lg:bg-neutral-200 lg:rounded-full">
                <a class="inline-block text-neutral-900 hover:bg-primary-500/[.04] dark:text-themedark-bodycolor rounded-full px-[18px] lg:px-6 py-3 text-[14px] font-medium transition-all leading-[1.429] open:text-primary-500 open:font-semibold"
                  href="../">Home</a>
                <a href="../map"
                  class="inline-block text-neutral-900 hover:bg-primary-500/[.04] dark:text-themedark-bodycolor rounded-full px-[18px] lg:px-6 py-3 text-[14px] font-medium transition-all leading-[1.429] open:text-primary-500 open:font-semibold">Map</a>
                <a href="../aduan"
                  class="inline-block text-neutral-900 hover:bg-primary-500/[.04] dark:text-themedark-bodycolor rounded-full px-[18px] lg:px-6 py-3 text-[14px] font-medium transition-all leading-[1.429] open:text-primary-500 open:font-semibold">Aduan</a>
              </div>
            </div>
          </div>
          <div class="flex items-center gap-3">
            @if (Route::has('login'))
                <a href="{{ route('login') }}" class="btn btn-primary px-4 py-2.5 shrink-0">Login</a>
            @endif
          </div>
        </div>
      </div>
    </nav>
    <main class="py-6">
      <div class="container mx-auto px-4 mb-4">
          <div class="max-w-2xl mx-auto flex shadow-sm bg-white rounded-lg overflow-hidden border">
              <input id="addressSearch" type="text" placeholder="Cari alamat..." class="flex-1 px-4 py-3 outline-none text-sm">
              <button id="searchBtn" class="px-6 bg-teal-600 text-white font-semibold hover:bg-teal-700 transition">Search</button>
          </div>
      </div>

      <div class="container mx-auto px-4">
          <div class="relative">
              <div id="map" class="border shadow-md"></div>
              <button id="gpsBtn" class="gps-button" title="Lokasi Terkini">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M13 2v3M13 19v3M5 12H2m17 0h3"></path></svg>
              </button>
          </div>
      </div>
    </main>

    <div id="panelOverlay"></div>
    <div id="lampPanel">
        <div class="p-5 border-b flex justify-between items-center bg-gray-50">
            <h3 class="font-bold text-gray-800">Street Light Detail</h3>
            <button id="closePanel" class="text-3xl leading-none">&times;</button>
        </div>
        <div id="lampContent" class="p-6 space-y-5">
            <p class="text-gray-500 text-sm">Pilih marker untuk melihat detail.</p>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
      const streetLights = [
        { id: 1, name: "Street Light 1", status: "on", lat: -7.89610, lng: 110.33843, power: "LED" },
        { id: 2, name: "Street Light 2", status: "off", lat: -7.89582, lng: 110.33801, power: "Halogen" },
        { id: 3, name: "Street Light 3", status: "fault", lat: -7.89645, lng: 110.33902, power: "Solar" },
        { id: 4, name: "Street Light 4", status: "on", lat: -7.89701, lng: 110.33789, power: "LED" },
        { id: 5, name: "Street Light 5", status: "off", lat: -7.89554, lng: 110.33745, power: "Halogen" },
        { id: 6, name: "Street Light 6", status: "on", lat: -7.89672, lng: 110.33888, power: "Solar" },
        { id: 7, name: "Street Light 7", status: "on", lat: -7.89591, lng: 110.33931, power: "LED" },
        { id: 8, name: "Street Light 8", status: "fault", lat: -7.89633, lng: 110.33771, power: "Halogen" },
        { id: 9, name: "Street Light 9", status: "off", lat: -7.89724, lng: 110.33815, power: "Solar" },
        { id: 10, name: "Street Light 10", status: "on", lat: -7.89566, lng: 110.33954, power: "LED" },
        { id: 11, name: "Street Light 11", status: "on", lat: -7.89681, lng: 110.33792, power: "LED" },
        { id: 12, name: "Street Light 12", status: "off", lat: -7.89538, lng: 110.33866, power: "Solar" },
        { id: 13, name: "Street Light 13", status: "fault", lat: -7.89659, lng: 110.33919, power: "Halogen" },
        { id: 14, name: "Street Light 14", status: "on", lat: -7.89712, lng: 110.33764, power: "LED" },
        { id: 15, name: "Street Light 15", status: "off", lat: -7.89577, lng: 110.33894, power: "Solar" },
        { id: 16, name: "Street Light 16", status: "on", lat: -7.89604, lng: 110.33973, power: "Halogen" },
        { id: 17, name: "Street Light 17", status: "on", lat: -7.89731, lng: 110.33841, power: "LED" },
        { id: 18, name: "Street Light 18", status: "fault", lat: -7.89548, lng: 110.33783, power: "Solar" },
        { id: 19, name: "Street Light 19", status: "off", lat: -7.89668, lng: 110.33822, power: "Halogen" },
        { id: 20, name: "Street Light 20", status: "on", lat: -7.89593, lng: 110.33907, power: "LED" },
        { id: 21, name: "Street Light 21", status: "on", lat: -7.89621, lng: 110.33752, power: "Solar" },
        { id: 22, name: "Street Light 22", status: "off", lat: -7.89708, lng: 110.33876, power: "Halogen" },
        { id: 23, name: "Street Light 23", status: "fault", lat: -7.89562, lng: 110.33938, power: "LED" },
        { id: 24, name: "Street Light 24", status: "on", lat: -7.89694, lng: 110.33791, power: "Solar" },
        { id: 25, name: "Street Light 25", status: "off", lat: -7.89529, lng: 110.33853, power: "Halogen" },
        { id: 26, name: "Street Light 26", status: "on", lat: -7.89647, lng: 110.33962, power: "LED" },
        { id: 27, name: "Street Light 27", status: "on", lat: -7.89719, lng: 110.33805, power: "Solar" },
        { id: 28, name: "Street Light 28", status: "fault", lat: -7.89583, lng: 110.33766, power: "Halogen" },
        { id: 29, name: "Street Light 29", status: "off", lat: -7.89656, lng: 110.33889, power: "LED" },
        { id: 30, name: "Street Light 30", status: "on", lat: -7.89597, lng: 110.33921, power: "Solar" },
        { id: 31, name: "Street Light 31", status: "on", lat: -7.89612, lng: 110.33784, power: "LED" },
        { id: 32, name: "Street Light 32", status: "off", lat: -7.89703, lng: 110.33847, power: "Solar" },
        { id: 33, name: "Street Light 33", status: "fault", lat: -7.89571, lng: 110.33911, power: "Halogen" },
        { id: 34, name: "Street Light 34", status: "on", lat: -7.89685, lng: 110.33758, power: "LED" },
        { id: 35, name: "Street Light 35", status: "off", lat: -7.89544, lng: 110.33892, power: "Solar" },
        { id: 36, name: "Street Light 36", status: "on", lat: -7.89663, lng: 110.33948, power: "Halogen" },
        { id: 37, name: "Street Light 37", status: "on", lat: -7.89727, lng: 110.33819, power: "LED" },
        { id: 38, name: "Street Light 38", status: "fault", lat: -7.89588, lng: 110.33774, power: "Solar" },
        { id: 39, name: "Street Light 39", status: "off", lat: -7.89654, lng: 110.33861, power: "Halogen" },
        { id: 40, name: "Street Light 40", status: "on", lat: -7.89599, lng: 110.33932, power: "LED" },
        { id: 41, name: "Street Light 41", status: "on", lat: -7.89618, lng: 110.33795, power: "Solar" },
        { id: 42, name: "Street Light 42", status: "off", lat: -7.89706, lng: 110.33888, power: "Halogen" },
        { id: 43, name: "Street Light 43", status: "fault", lat: -7.89569, lng: 110.33955, power: "LED" },
        { id: 44, name: "Street Light 44", status: "on", lat: -7.89692, lng: 110.33771, power: "Solar" },
        { id: 45, name: "Street Light 45", status: "off", lat: -7.89533, lng: 110.33834, power: "Halogen" },
        { id: 46, name: "Street Light 46", status: "on", lat: -7.89651, lng: 110.33966, power: "LED" },
        { id: 47, name: "Street Light 47", status: "on", lat: -7.89722, lng: 110.33827, power: "Solar" },
        { id: 48, name: "Street Light 48", status: "fault", lat: -7.89586, lng: 110.33782, power: "Halogen" },
        { id: 49, name: "Street Light 49", status: "off", lat: -7.89661, lng: 110.33873, power: "LED" },
        { id: 50, name: "Street Light 50", status: "on", lat: -7.89595, lng: 110.33944, power: "Solar" }
      ];

      document.addEventListener('DOMContentLoaded', () => {
        const map = L.map('map').setView([-7.89610, 110.33843], 17);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        const lampPanel = document.getElementById('lampPanel');
        const lampContent = document.getElementById('lampContent');
        const overlay = document.getElementById('panelOverlay');
        let userMarker;

        // Fungsi Detail Panel
        function openDetail(light) {
            lampContent.innerHTML = `
                <div class="space-y-4">
                    <div class="p-4 bg-teal-50 rounded-xl border border-teal-100">
                        <h4 class="text-xl font-bold text-teal-800">${light.name}</h4>
                        <p class="text-xs text-teal-600 font-mono">Device ID: #${light.id}</p>
                    </div>
                    <div class="space-y-3">
                        <div class="flex justify-between p-3 bg-gray-50 rounded-lg">
                            <span class="text-gray-500 text-sm font-medium uppercase">Status</span>
                            <span class="px-3 py-1 rounded-full text-xs font-bold text-white ${
                                light.status === 'on' ? 'bg-green-500' : (light.status === 'fault' ? 'bg-red-500' : 'bg-gray-400')
                            }">${light.status.toUpperCase()}</span>
                        </div>
                        <div class="flex justify-between p-3 bg-gray-50 rounded-lg">
                            <span class="text-gray-500 text-sm font-medium uppercase">Power</span>
                            <span class="text-gray-800 font-bold">${light.power}</span>
                        </div>
                    </div>
                    <div class="p-4 border rounded-lg text-sm">
                        <p class="text-gray-400 font-bold uppercase mb-2 text-xs">Coordinates</p>
                        <p>Lat: ${light.lat}</p><p>Lng: ${light.lng}</p>
                    </div>
                    <a href="https://www.google.com/maps/search/?api=1&query=${light.lat},${light.lng}" target="_blank" 
                       class="block w-full text-center py-3 bg-teal-600 text-white rounded-lg font-bold hover:bg-teal-700 transition">
                       Google Maps
                    </a>
                </div>
            `;
            lampPanel.classList.add('active');
            overlay.style.display = 'block';
        }

        // Fungsi GPS Lokasi Terkini
        function locateUser() {
            if (!navigator.geolocation) {
                alert("GPS tidak didukung oleh browser Anda.");
                return;
            }
            navigator.geolocation.getCurrentPosition((pos) => {
                const { latitude, longitude } = pos.coords;
                map.flyTo([latitude, longitude], 18);
                if (userMarker) userMarker.setLatLng([latitude, longitude]);
                else {
                    userMarker = L.circleMarker([latitude, longitude], {
                        radius: 8, fillColor: '#3b82f6', color: '#fff', weight: 2, fillOpacity: 1
                    }).addTo(map).bindTooltip("Lokasi Anda").openTooltip();
                }
            }, (err) => alert("Gagal akses lokasi: " + err.message));
        }

        document.getElementById('gpsBtn').onclick = locateUser;
        document.getElementById('closePanel').onclick = () => { lampPanel.classList.remove('active'); overlay.style.display = 'none'; };
        overlay.onclick = () => { lampPanel.classList.remove('active'); overlay.style.display = 'none'; };

        // Render 50 Markers
        streetLights.forEach(light => {
            const color = light.status === 'on' ? '#10b981' : (light.status === 'fault' ? '#ef4444' : '#9ca3af');
            const marker = L.circleMarker([light.lat, light.lng], {
                radius: 10, fillColor: color, color: "#fff", weight: 2.5, fillOpacity: 1, interactive: true
            }).addTo(map);

            marker.on('click', (e) => { L.DomEvent.stopPropagation(e); openDetail(light); });
            marker.bindTooltip(light.name);
        });

        // Search Address
        document.getElementById('searchBtn').onclick = async () => {
            const q = document.getElementById('addressSearch').value;
            if(!q) return;
            const res = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${q}`);
            const data = await res.json();
            if(data.length > 0) map.setView([data[0].lat, data[0].lon], 18);
        };
      });
    </script>
  </body>
</html>