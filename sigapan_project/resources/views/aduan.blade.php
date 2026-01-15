@extends('layouts.app')

@section('title', 'aduan')

@push('styles')
<style>
  /* ====== Layout persis wireframe (tanpa Tailwind) ====== */
  .aduan-page { padding: 40px 0 60px; background:#fff; }
  .aduan-title { text-align:center; font-size:56px; font-weight:800; margin: 10px 0 26px; color:#111; }

  .aduan-panel {
    max-width: 1050px;
    margin: 0 auto;
    background: #d9d9d9;
    border-radius: 14px;
    padding: 28px;
  }

  .aduan-row {
    display: flex;
    gap: 34px;
    align-items: flex-start;
  }

  .aduan-col-left { flex: 1; min-width: 420px; }
  .aduan-col-right { flex: 1; min-width: 420px; }

  .field { margin-bottom: 22px; }
  .label { font-size:18px; font-weight:700; color:#111; margin-bottom: 10px; }

  .input, .textarea {
    width:100%;
    background:#e6e6e6;
    border: 2px solid #222;
    border-radius: 8px;
    padding: 14px 16px;
    font-size:18px;
    color:#111;
    outline:none;
    box-sizing:border-box;
  }
  .input::placeholder, .textarea::placeholder { color:#666; }
  .textarea { height: 190px; resize:none; padding-top: 16px; }

  /* ✅ Tambahan kecil: select biar sama feel-nya */
  select.input {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image:
      linear-gradient(45deg, transparent 50%, #111 50%),
      linear-gradient(135deg, #111 50%, transparent 50%),
      linear-gradient(to right, transparent, transparent);
    background-position:
      calc(100% - 22px) calc(50% - 2px),
      calc(100% - 16px) calc(50% - 2px),
      100% 0;
    background-size:
      6px 6px,
      6px 6px,
      2.5em 2.5em;
    background-repeat: no-repeat;
    padding-right: 48px;
    cursor: pointer;
  }

  .upload-row { display:flex; align-items:center; gap:18px; }
  .btn-file {
    background:#000;
    color:#fff;
    border:none;
    border-radius:6px;
    padding: 12px 28px;
    font-size:16px;
    font-weight:700;
    cursor:pointer;
  }
  .file-hint { color:#3a3a3a; font-size:16px; }

  /* ====== Map block mirip wireframe ====== */
  .map-label { font-size:18px; font-weight:700; color:#1f2937; margin-bottom:10px; }
  .map-wrap {
    position: relative;
    border-radius:10px;
    overflow:hidden;
    border: 2px solid #cfd3d8;
    background:
      linear-gradient(#cdeedb 1px, transparent 1px),
      linear-gradient(90deg, #cdeedb 1px, transparent 1px),
      linear-gradient(#e9f4ff, #e9f4ff);
    background-size: 34px 34px, 34px 34px, 100% 100%;
  }
  #map {
    height: 260px;
    width: 100%;
    background: transparent;
  }
  .map-hint {
    position:absolute;
    right: 12px;
    bottom: 12px;
    background: rgba(255,255,255,0.85);
    border: 1px solid #d8dde3;
    border-radius: 8px;
    padding: 8px 10px;
    font-size: 12px;
    color:#4b5563;
    z-index: 999;
  }

  .coord-row { display:flex; gap: 12px; margin-top: 12px; }
  .coord {
    flex:1;
    width:100%;
    background:#d9d9d9;
    border: 1px solid #c8cdd3;
    border-radius: 10px;
    padding: 12px 14px;
    font-size:14px;
    color:#555;
    box-sizing:border-box;
  }
  .addr {
    width:100%;
    margin-top: 10px;
    background:#d9d9d9;
    border: 1px solid #c8cdd3;
    border-radius: 10px;
    padding: 12px 14px;
    font-size:14px;
    color:#555;
    box-sizing:border-box;
  }

  .submit-btn {
    width:100%;
    margin-top: 26px;
    padding: 18px 16px;
    border-radius: 10px;
    background:#000;
    color:#fff;
    font-size:20px;
    font-weight:800;
    border:none;
    cursor:pointer;
  }

  /* ====== Responsive: kalau layar kecil baru turun satu kolom ====== */
  @media (max-width: 980px) {
    .aduan-title { font-size:38px; }
    .aduan-row { flex-direction: column; }
    .aduan-col-left, .aduan-col-right { min-width: 0; }
  }

  /* Leaflet default style fix supaya tile kebaca */
  .leaflet-container { background: transparent; }
</style>
@endpush

@section('content')

<div class="aduan-page">
  <div class="container">
    <div class="aduan-title">Buat Pengaduan</div>

    <div class="aduan-panel">

      @if (session('success'))
        <div style="margin-bottom:14px; padding:12px 14px; border-radius:10px; background:#eaf7ee; border:1px solid #bfe5c9; color:#1f7a36;">
          {{ session('success') }}
        </div>
      @endif

      @if ($errors->any())
        <div style="margin-bottom:14px; padding:12px 14px; border-radius:10px; background:#fdecec; border:1px solid #f3b4b4; color:#a11;">
          <div style="font-weight:800; margin-bottom:6px;">Ada input yang perlu diperbaiki.</div>
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

            {{-- ✅ TAMBAHAN 1: Nama Pelapor --}}
            <div class="field">
              <div class="label">Nama Pelapor</div>
              <input class="input" type="text" name="nama_pelapor" value="{{ old('nama_pelapor') }}"
                     placeholder="Contoh: Budi Santoso">
              @error('nama_pelapor') <div style="color:#c00; margin-top:6px;">{{ $message }}</div> @enderror
            </div>

            {{-- ✅ TAMBAHAN 2: Nomor HP Pelapor --}}
            <div class="field">
              <div class="label">Nomor HP Pelapor</div>
              <input class="input" type="text" name="no_hp" value="{{ old('no_hp') }}"
                     placeholder="Contoh: 08xxxxxxxxxx" inputmode="numeric">
              @error('no_hp') <div style="color:#c00; margin-top:6px;">{{ $message }}</div> @enderror
            </div>

            {{-- ✅ TAMBAHAN 3: Dropdown tipe aduan --}}
            <div class="field">
              <div class="label">Tipe Aduan</div>
              <select class="input" name="tipe_aduan">
                <option value="" {{ old('tipe_aduan') == '' ? 'selected' : '' }}>-- Pilih Tipe Aduan --</option>
                <option value="lampu_mati" {{ old('tipe_aduan') == 'lampu_mati' ? 'selected' : '' }}>Lampu Mati</option>
                <option value="permohonan_pju_baru" {{ old('tipe_aduan') == 'permohonan_pju_baru' ? 'selected' : '' }}>Permohonan PJU Baru</option>
              </select>
              @error('tipe_aduan') <div style="color:#c00; margin-top:6px;">{{ $message }}</div> @enderror
            </div>

            {{-- ✅ YANG LAMA TETAP --}}
            <div class="field">
              <div class="label">Judul / Topik Pengaduan</div>
              <input class="input" type="text" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Lampu Jalan Rusak">
              @error('judul') <div style="color:#c00; margin-top:6px;">{{ $message }}</div> @enderror
            </div>

            <div class="field">
              <div class="label" style="color:#1f2937;">Deskripsi Detail</div>
              <textarea class="textarea" name="deskripsi" placeholder="Jelaskan masalah secara detail...">{{ old('deskripsi') }}</textarea>
              @error('deskripsi') <div style="color:#c00; margin-top:6px;">{{ $message }}</div> @enderror
            </div>

            <div class="field" style="margin-bottom:0;">
              <div class="label" style="color:#1f2937;">Lampiran Foto Bukti</div>
              <div class="upload-row">
                <label for="foto" class="btn-file">Pilih File</label>
                <span id="file-name" class="file-hint">Tidak ada file yang dipilih</span>
                <input id="foto" type="file" name="foto" accept="image/*" style="display:none;">
              </div>
              @error('foto') <div style="color:#c00; margin-top:6px;">{{ $message }}</div> @enderror
            </div>
          </div>

          <!-- RIGHT -->
          <div class="aduan-col-right">
            <div class="map-label">Tentukan Lokasi (Klik pada peta)</div>

            <div class="map-wrap">
              <div id="map"></div>
              <div class="map-hint">Klik untuk menentukan lokasi</div>
            </div>

            <div class="coord-row">
              <input id="lat" class="coord" type="text" name="latitude" value="{{ old('latitude') }}" readonly placeholder="-7.8867...">
              <input id="lng" class="coord" type="text" name="longitude" value="{{ old('longitude') }}" readonly placeholder="110.3277...">
            </div>

            <input id="alamat" class="addr" type="text" name="alamat" value="{{ old('alamat') }}" readonly
              placeholder="Alamat akan otomatis terisi setelah klik peta">
          </div>
        </div>

        <button type="submit" class="submit-btn">Kirim Laporan Sekarang</button>
      </form>
    </div>
  </div>
</div>

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

  // Map init (Leaflet)
  const latEl = document.getElementById('lat');
  const lngEl = document.getElementById('lng');
  const alamatEl = document.getElementById('alamat');

  const defaultLat = -7.886719404147378;
  const defaultLng = 110.32775434922764;

  const startLat = parseFloat(latEl.value) || defaultLat;
  const startLng = parseFloat(lngEl.value) || defaultLng;

  const map = L.map('map').setView([startLat, startLng], 14);

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

  const marker = L.marker([startLat, startLng], { icon: redPin, draggable: true }).addTo(map);

  function setFields(lat, lng) {
    latEl.value = lat.toFixed(12);
    lngEl.value = lng.toFixed(12);
  }

  async function reverseGeocode(lat, lng) {
    try {
      const url = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`;
      const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
      if (!res.ok) return;
      const data = await res.json();
      if (data?.display_name) alamatEl.value = data.display_name;
    } catch (e) {}
  }

  setFields(startLat, startLng);
  if (!alamatEl.value) reverseGeocode(startLat, startLng);

  map.on('click', (e) => {
    marker.setLatLng(e.latlng);
    setFields(e.latlng.lat, e.latlng.lng);
    reverseGeocode(e.latlng.lat, e.latlng.lng);
  });

  marker.on('dragend', () => {
    const p = marker.getLatLng();
    setFields(p.lat, p.lng);
    reverseGeocode(p.lat, p.lng);
  });

  setTimeout(() => map.invalidateSize(), 200);
</script>
@endpush
@endsection
