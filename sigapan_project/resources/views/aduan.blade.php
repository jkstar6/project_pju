@extends('layouts.app')

@section('title', 'aduan')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
<style>
  :root{
    --panel:#d9d9d9;
    --field:#ededed;
    --text:#111827;
    --muted:#6b7280;
    --stroke: rgba(17,24,39,0.75);
    --softstroke: rgba(17,24,39,0.18);
  }

  /* ====== PAGE ====== */
  .aduan-page { padding: 60px 0 90px; background:#fff; }
  .aduan-title {
    text-align:center;
    font-size:48px;
    font-weight:900;
    letter-spacing:-0.02em;
    margin: 0 0 22px;
    color: var(--text);
  }

  /* top action */
  .aduan-topbar{
    max-width: 1280px;
    margin: 0 auto 14px;
    display:flex;
    justify-content:flex-end;
    gap:10px;
    padding: 0 6px;
  }
  .btn-top{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    padding: 10px 14px;
    border-radius: 14px;
    border: 1px solid var(--softstroke);
    background:#fff;
    color:#111;
    font-weight:900;
    font-size: 13px;
    text-decoration:none;
    box-shadow: 0 10px 24px rgba(0,0,0,0.06);
    transition: .15s ease;
  }
  .btn-top:hover{ transform: translateY(-1px); }

  /* ====== CARD ====== */
  .aduan-panel {
    max-width: 1280px;
    margin: 0 auto;
    background: var(--panel);
    border-radius: 20px;
    padding: 40px 42px;
    box-shadow: 0 18px 45px rgba(0,0,0,0.12);
  }

  /* ====== LAYOUT ====== */
  .aduan-row {
    display: grid;
    grid-template-columns: 1.1fr 0.9fr; /* kiri sedikit lebih lebar */
    gap: 36px;
    align-items: start;
  }
  .aduan-col-left, .aduan-col-right { min-width: 0; }

  /* ====== FIELD ====== */
  .field { margin-bottom: 20px; }
  .label { font-size:15px; font-weight:900; color: var(--text); margin-bottom: 8px; }

  /* ====== INPUT ====== */
  .input, .textarea {
    width:100%;
    background: var(--field);
    border: 2px solid var(--stroke);
    border-radius: 14px;
    padding: 14px 16px;
    font-size:15px;
    color: var(--text);
    outline:none;
    box-sizing:border-box;
    transition: .15s ease;
  }
  .input::placeholder, .textarea::placeholder { color: var(--muted); }
  .input:focus, .textarea:focus {
    border-color:#000;
    box-shadow: 0 0 0 4px rgba(0,0,0,0.10);
  }
  .textarea { height: 180px; resize:none; line-height:1.45; }

  /* ====== SELECT ====== */
  select.input {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image:
      linear-gradient(45deg, transparent 50%, #111 50%),
      linear-gradient(135deg, #111 50%, transparent 50%);
    background-position:
      calc(100% - 22px) 50%,
      calc(100% - 16px) 50%;
    background-size: 6px 6px, 6px 6px;
    background-repeat: no-repeat;
    padding-right: 46px;
    cursor: pointer;
  }

  /* ====== UPLOAD ====== */
  .upload-row { display:flex; align-items:center; gap:16px; }
  .btn-file {
    background:#000;
    color:#fff;
    border:none;
    border-radius:12px;
    padding: 12px 26px;
    font-size:14px;
    font-weight:900;
    cursor:pointer;
    transition:.15s ease;
  }
  .btn-file:hover { transform: translateY(-1px); }
  .file-hint { color: var(--muted); font-size:13px; }

  /* ====== MAP ====== */
  .map-label { font-size:15px; font-weight:900; color: var(--text); margin-bottom:10px; }

  .map-wrap {
    position: relative;
    border-radius:18px;
    overflow:hidden;
    border: 2px solid var(--softstroke);
    background:
      linear-gradient(#cdeedb 1px, transparent 1px),
      linear-gradient(90deg, #cdeedb 1px, transparent 1px),
      linear-gradient(#e9f4ff, #e9f4ff);
    background-size: 34px 34px, 34px 34px, 100% 100%;
  }

  #map { height: 300px; width: 100%; background: transparent; }

  .map-hint {
    position:absolute;
    right: 14px;
    bottom: 14px;
    background: rgba(255,255,255,0.95);
    border: 1px solid var(--softstroke);
    border-radius: 12px;
    padding: 8px 12px;
    font-size: 12px;
    color: var(--muted);
    z-index: 999;
  }

  /* ====== COORD + ADDR ====== */
  .coord-row { display:flex; gap: 12px; margin-top: 14px; }
  .coord {
    flex:1;
    width:100%;
    background: rgba(255,255,255,0.25);
    border: 1px solid var(--softstroke);
    border-radius: 14px;
    padding: 12px 14px;
    font-size:13px;
    color:#374151;
    box-sizing:border-box;
  }

  .addr {
    width:100%;
    margin-top: 12px;
    background: rgba(255,255,255,0.25);
    border: 1px solid var(--softstroke);
    border-radius: 14px;
    padding: 12px 14px;
    font-size:13px;
    color:#374151;
    box-sizing:border-box;
  }

  .addr-status {
    margin-top: 6px;
    font-size: 12px;
    color: var(--muted);
    min-height: 16px;
  }

  /* ====== AUTOCOMPLETE ====== */
  .addr-wrap { position: relative; }
  .addr-suggest {
    position: absolute;
    left: 0;
    right: 0;
    top: calc(100% + 8px);
    background: #ffffff;
    border: 1px solid var(--softstroke);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 18px 40px rgba(0,0,0,0.15);
    z-index: 2000;
    display: none;
    max-height: 240px;
    overflow-y: auto;
  }
  .addr-item {
    padding: 12px 14px;
    font-size: 13px;
    color: #111;
    cursor: pointer;
    border-bottom: 1px solid #eef0f3;
    line-height: 1.35;
  }
  .addr-item:last-child { border-bottom: none; }
  .addr-item:hover,
  .addr-item.active { background: #f3f4f6; }

  /* ====== SUBMIT ====== */
  .submit-btn {
    width:100%;
    margin-top: 26px;
    padding: 20px 16px;
    border-radius: 18px;
    background:#000;
    color:#fff;
    font-size:19px;
    font-weight:900;
    border:none;
    cursor:pointer;
    transition:.15s ease;
  }
  .submit-btn:hover { transform: translateY(-1px); }

  /* ====== Responsive ====== */
  @media (max-width: 1200px) {
    .aduan-panel { padding: 32px; }
  }
  @media (max-width: 980px) {
    .aduan-title { font-size:34px; }
    .aduan-row { grid-template-columns: 1fr; gap: 26px; }
    #map { height: 260px; }
    .aduan-topbar{ justify-content:center; }
  }
  @media (max-width: 520px){
    .aduan-panel { padding: 22px; }
    .upload-row { flex-direction: column; align-items: flex-start; }
  }

  /* Leaflet */
  .leaflet-container { background: transparent; }
</style>
@endpush

@section('content')
<div class="aduan-page">
  <div class="container">
    <div class="aduan-title">Buat Pengaduan</div>

    {{-- tombol ke daftar aduan --}}
    <div class="aduan-topbar">
      <a class="btn-top" href="{{ url('/daftar-aduan') }}">Lihat Daftar Aduan</a>
    </div>

    <div class="aduan-panel">

      @if (session('success'))
        <div style="margin-bottom:14px; padding:12px 14px; border-radius:14px; background:#eaf7ee; border:1px solid #bfe5c9; color:#1f7a36;">
          {{ session('success') }}
        </div>
      @endif

      @if ($errors->any())
        <div style="margin-bottom:14px; padding:12px 14px; border-radius:14px; background:#fdecec; border:1px solid #f3b4b4; color:#a11;">
          <div style="font-weight:900; margin-bottom:6px;">Ada input yang perlu diperbaiki.</div>
          <ul style="margin:0; padding-left:18px;">
            @foreach ($errors->all() as $err)
              <li>{{ $err }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('aduan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="aduan-row">
          <!-- LEFT -->
          <div class="aduan-col-left">

            <div class="field">
              <div class="label">Nama Pelapor</div>
              <input class="input" type="text" name="nama_pelapor" value="{{ old('nama_pelapor') }}" placeholder="Contoh: Budi Santoso">
              @error('nama_pelapor') <div style="color:#c00; margin-top:6px; font-size:13px;">{{ $message }}</div> @enderror
            </div>

            <div class="field">
              <div class="label">Nomor HP Pelapor</div>
              <input class="input" type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="Contoh: 08xxxxxxxxxx" inputmode="numeric">
              @error('no_hp') <div style="color:#c00; margin-top:6px; font-size:13px;">{{ $message }}</div> @enderror
            </div>

            <div class="field">
              <div class="label">Tipe Aduan</div>
              <select class="input" name="tipe_aduan">
                <option value="" {{ old('tipe_aduan') == '' ? 'selected' : '' }}>-- Pilih Tipe Aduan --</option>
                <option value="lampu_mati" {{ old('tipe_aduan') == 'lampu_mati' ? 'selected' : '' }}>Lampu Mati</option>
                <option value="permohonan_pju_baru" {{ old('tipe_aduan') == 'permohonan_pju_baru' ? 'selected' : '' }}>Permohonan PJU Baru</option>
              </select>
              @error('tipe_aduan') <div style="color:#c00; margin-top:6px; font-size:13px;">{{ $message }}</div> @enderror
            </div>

            <div class="field">
              <div class="label">Judul / Topik Pengaduan</div>
              <input class="input" type="text" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Lampu Jalan Rusak">
              @error('judul') <div style="color:#c00; margin-top:6px; font-size:13px;">{{ $message }}</div> @enderror
            </div>

            <div class="field">
              <div class="label">Deskripsi Detail</div>
              <textarea class="textarea" name="deskripsi" placeholder="Jelaskan masalah secara detail...">{{ old('deskripsi') }}</textarea>
              @error('deskripsi') <div style="color:#c00; margin-top:6px; font-size:13px;">{{ $message }}</div> @enderror
            </div>

            <div class="field" style="margin-bottom:0;">
              <div class="label">Lampiran Foto Bukti</div>
              <div class="upload-row">
                <label for="foto" class="btn-file">Pilih File</label>
                <span id="file-name" class="file-hint">Tidak ada file yang dipilih</span>
                <input id="foto" type="file" name="foto" accept="image/*" style="display:none;">
              </div>
              @error('foto') <div style="color:#c00; margin-top:6px; font-size:13px;">{{ $message }}</div> @enderror
            </div>
          </div>

          <!-- RIGHT -->
          <div class="aduan-col-right">
            <div class="map-label">Tentukan Lokasi (Klik pada peta)</div>

            <div class="map-wrap">
              <div id="map"></div>
              <div class="map-hint">Klik peta atau pilih alamat</div>
            </div>

            <div class="coord-row">
              {{-- ✅ awalnya kosong --}}
              <input id="lat" class="coord" type="text" name="latitude" value="{{ old('latitude') }}" readonly placeholder="Latitude">
              <input id="lng" class="coord" type="text" name="longitude" value="{{ old('longitude') }}" readonly placeholder="Longitude">
            </div>

            <div class="addr-wrap">
              {{-- ✅ alamat awalnya kosong, bisa diketik --}}
              <input id="alamat" class="addr" type="text" name="alamat" value="{{ old('alamat') }}"
                     placeholder="Ketik alamat atau klik peta untuk mengisi otomatis" autocomplete="off">
              <div id="alamat-suggest" class="addr-suggest"></div>
            </div>
            <div id="alamat-status" class="addr-status"></div>
          </div>
        </div>

        <button type="submit" class="submit-btn">Kirim Laporan Sekarang</button>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
  // tampilkan nama file
  const fileInput = document.getElementById('foto');
  const fileNameEl = document.getElementById('file-name');
  if (fileInput && fileNameEl) {
    fileInput.addEventListener('change', function () {
      fileNameEl.textContent = this.files?.[0]?.name ?? 'Tidak ada file yang dipilih';
    });
  }

  // ===== MAP INIT =====
  const latEl = document.getElementById('lat');
  const lngEl = document.getElementById('lng');
  const alamatEl = document.getElementById('alamat');
  const alamatStatus = document.getElementById('alamat-status');
  const suggestBox = document.getElementById('alamat-suggest');

  // posisi default hanya untuk VIEW map (bukan isi input)
  const defaultLat = -7.886719404147378;
  const defaultLng = 110.32775434922764;

  // kalau old lat/lng ada (misal habis error), pakai itu dan tampilkan marker
  const hasOldLatLng = !!(latEl.value && lngEl.value);
  const startLat = hasOldLatLng ? parseFloat(latEl.value) : defaultLat;
  const startLng = hasOldLatLng ? parseFloat(lngEl.value) : defaultLng;

  const map = L.map('map').setView([startLat, startLng], hasOldLatLng ? 16 : 14);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; OpenStreetMap'
  }).addTo(map);

  const redPin = L.divIcon({
    className: '',
    html: `<div style="font-size:28px; transform: translate(-50%, -100%);">📍</div>`,
    iconSize: [28, 28],
    iconAnchor: [14, 28]
  });

  // marker dibuat, tapi baru "muncul" saat user pilih lokasi (kecuali old lat/lng ada)
  let markerAdded = false;
  const marker = L.marker([startLat, startLng], { icon: redPin, draggable: true });

  function ensureMarker(lat, lng) {
    if (!markerAdded) {
      marker.setLatLng([lat, lng]).addTo(map);
      markerAdded = true;
    } else {
      marker.setLatLng([lat, lng]);
    }
  }

  function setFields(lat, lng) {
    latEl.value = lat.toFixed(12);
    lngEl.value = lng.toFixed(12);
  }

  function setStatus(text, isError = false) {
    if (!alamatStatus) return;
    alamatStatus.textContent = text || '';
    alamatStatus.style.color = isError ? '#b91c1c' : '#6b7280';
  }

  // kalau ada old lat/lng => tampilkan marker
  if (hasOldLatLng) {
    ensureMarker(startLat, startLng);
    if (alamatEl.value) setStatus('Alamat tersimpan ✔');
    else setStatus('Klik peta atau ketik alamat untuk mengisi.');
  } else {
    // ✅ awalnya: lat/lng kosong, alamat kosong
    latEl.value = '';
    lngEl.value = '';
    if (!alamatEl.value) setStatus('Ketik alamat atau klik peta untuk mengisi.');
  }

  // ===== AUTOCOMPLETE STATE =====
  let suggestions = [];
  let activeIndex = -1;
  let suggestTimer = null;
  let lastQuery = '';

  function openSuggest() { if (suggestBox) suggestBox.style.display = 'block'; }
  function closeSuggest() {
    if (suggestBox) suggestBox.style.display = 'none';
    activeIndex = -1;
  }

  function renderSuggest(list) {
    if (!suggestBox) return;
    if (!list || list.length === 0) {
      suggestBox.innerHTML = '';
      closeSuggest();
      return;
    }
    suggestBox.innerHTML = list.map((it, idx) => {
      return `<div class="addr-item ${idx === activeIndex ? 'active' : ''}" data-idx="${idx}">${it.display_name}</div>`;
    }).join('');
    openSuggest();
  }

  async function searchSuggestions(query) {
    try {
      const url = `https://nominatim.openstreetmap.org/search?format=jsonv2&q=${encodeURIComponent(query)}&limit=5&addressdetails=1`;
      const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
      if (!res.ok) return [];
      const data = await res.json();
      return (data || []).map(d => ({
        lat: parseFloat(d.lat),
        lng: parseFloat(d.lon),
        display_name: d.display_name
      }));
    } catch (e) {
      return [];
    }
  }

  function applyLocation(item, sourceText = 'Alamat dipilih ✔') {
    if (!item) return;
    ensureMarker(item.lat, item.lng);
    map.setView([item.lat, item.lng], 16);
    setFields(item.lat, item.lng);
    alamatEl.value = item.display_name;
    setStatus(sourceText);
    closeSuggest();
  }

  async function reverseGeocode(lat, lng) {
    try {
      const url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`;
      const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
      if (!res.ok) return;
      const data = await res.json();
      if (data?.display_name) {
        alamatEl.value = data.display_name;
        setStatus('Alamat terisi dari peta ✔');
        closeSuggest();
      }
    } catch (e) {}
  }

  // klik map -> marker muncul + isi lat/lng + isi alamat
  map.on('click', (e) => {
    ensureMarker(e.latlng.lat, e.latlng.lng);
    setFields(e.latlng.lat, e.latlng.lng);
    reverseGeocode(e.latlng.lat, e.latlng.lng);
  });

  // drag marker -> update
  marker.on('dragend', () => {
    if (!markerAdded) return;
    const p = marker.getLatLng();
    setFields(p.lat, p.lng);
    reverseGeocode(p.lat, p.lng);
  });

  // klik suggestion
  if (suggestBox) {
    suggestBox.addEventListener('click', (e) => {
      const el = e.target.closest('.addr-item');
      if (!el) return;
      const idx = parseInt(el.getAttribute('data-idx'), 10);
      applyLocation(suggestions[idx]);
    });
  }

  // input alamat -> fetch suggestion (debounce)
  alamatEl.addEventListener('input', function () {
    const q = (alamatEl.value || '').trim();
    lastQuery = q;

    if (!q) {
      suggestions = [];
      renderSuggest([]);
      setStatus('Ketik alamat atau klik peta untuk mengisi.');
      return;
    }

    clearTimeout(suggestTimer);
    suggestTimer = setTimeout(async () => {
      setStatus('Mencari saran alamat...');
      const list = await searchSuggestions(q);
      if (q !== lastQuery) return;

      suggestions = list;
      activeIndex = -1;

      if (!list.length) {
        renderSuggest([]);
        setStatus('Tidak ada saran. Coba tulis lebih lengkap.', true);
        return;
      }

      renderSuggest(list);
      setStatus('Pilih salah satu saran di bawah.');
    }, 450);
  });

  // keyboard navigation
  alamatEl.addEventListener('keydown', function (e) {
    if (!suggestions.length) return;

    if (e.key === 'ArrowDown') {
      e.preventDefault();
      activeIndex = Math.min(activeIndex + 1, suggestions.length - 1);
      renderSuggest(suggestions);
      return;
    }

    if (e.key === 'ArrowUp') {
      e.preventDefault();
      activeIndex = Math.max(activeIndex - 1, 0);
      renderSuggest(suggestions);
      return;
    }

    if (e.key === 'Enter') {
      e.preventDefault();
      const idx = activeIndex >= 0 ? activeIndex : 0;
      applyLocation(suggestions[idx], 'Alamat dipilih ✔');
      return;
    }

    if (e.key === 'Escape') {
      closeSuggest();
      return;
    }
  });

  // klik di luar -> tutup suggestion
  document.addEventListener('click', (e) => {
    if (!e.target.closest('.addr-wrap')) closeSuggest();
  });

  // fix tile blank
  setTimeout(() => map.invalidateSize(), 200);
</script>
@endpush
