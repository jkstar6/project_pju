@extends('layouts.admin.master')

@section('title', 'Koneksi Jaringan')

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">

    {{-- Leaflet CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

    <style>
        #data-table td { vertical-align: top; }
        .modal-overlay { display: none; }
        .modal-overlay.active { display: flex; }

        #map-koneksi {
            height: 360px;
            width: 100%;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            background: #f8fafc;
            z-index: 10;
        }

        .badge-status{
            display:inline-block;
            padding: 5px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
        }
        .status-aktif{ background:#dcfce7; color:#166534; }
        .status-diputus{ background:#fee2e2; color:#991b1b; }

        .hint {
            font-size: 12px;
            color: #64748b;
        }
    </style>
@endpush

@section('content')
    <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md shadow-sm">
        <div class="trezo-card-header mb-[20px] md:mb-[25px] sm:flex sm:items-center sm:justify-between border-b pb-4">
            <div>
                <h5 class="mb-0 text-lg font-bold">Data @yield('title')</h5>
                <p class="hint mt-1">Mapping jalur kabel dari Aset PJU ke Panel KWh (Polyline + estimasi panjang otomatis).</p>
            </div>
            <div class="mt-3 sm:mt-0">
                <button type="button" id="btn-open-create"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-primary-500 text-white hover:bg-primary-600 transition shadow-sm text-sm font-medium">
                    <span class="material-symbols-outlined">add</span> Tambah Koneksi
                </button>
            </div>
        </div>

        {{-- Flash --}}
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md text-sm border border-green-200">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-md text-sm border border-red-200">
                {{ session('error') }}
            </div>
        @endif

        <div class="trezo-card-content">
            <div class="table-responsive overflow-x-auto">
                <table id="data-table" class="display stripe group" style="width:100%">
                    <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-left">Aset PJU</th>
                        <th class="text-left">Panel KWh</th>
                        <th class="text-center">No. MCB</th>
                        <th class="text-center">Fasa</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Tgl Koneksi</th>
                        <th class="text-center">Panjang Est. (m)</th>
                        <th class="text-left">Keterangan Jalur</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($koneksi as $index => $item)
                        @php
                            $st = $item->status_koneksi ?? 'Aktif';
                            $stClass = $st === 'Diputus' ? 'status-diputus' : 'status-aktif';

                            // Ambil koordinat relasi jika ada (untuk data-* dipakai edit+map)
                            $ap = $item->asetPju;
                            $pk = $item->panelKwh;

                            $apLat = $ap->latitude ?? null;
                            $apLng = $ap->longitude ?? null;
                            $pkLat = $pk->latitude ?? null;
                            $pkLng = $pk->longitude ?? null;

                            // Label aman (kalau kolom nama/kode beda, minimal tampil ID)
                            $apLabel = $ap->kode_aset ?? $ap->nama_aset ?? ('Aset #' . ($item->aset_pju_id ?? '-'));
                            $pkLabel = $pk->no_pelanggan_pln ?? $pk->lokasi_panel ?? ('Panel #' . ($item->panel_kwh_id ?? '-'));
                        @endphp

                        <tr
                            data-id="{{ $item->id }}"
                            data-aset_pju_id="{{ $item->aset_pju_id }}"
                            data-panel_kwh_id="{{ $item->panel_kwh_id }}"
                            data-nomor_mcb_panel="{{ $item->nomor_mcb_panel }}"
                            data-fasa="{{ $item->fasa }}"
                            data-status_koneksi="{{ $item->status_koneksi }}"
                            data-tgl_koneksi="{{ $item->tgl_koneksi }}"
                            data-panjang_kabel_est="{{ $item->panjang_kabel_est }}"
                            data-keterangan_jalur="{{ e($item->keterangan_jalur) }}"
                            data-aset_lat="{{ $apLat }}"
                            data-aset_lng="{{ $apLng }}"
                            data-panel_lat="{{ $pkLat }}"
                            data-panel_lng="{{ $pkLng }}"
                        >
                            <td class="text-center font-bold text-gray-400">{{ $index + 1 }}</td>

                            <td class="text-left">
                                <div class="flex flex-col gap-1">
                                    <span class="font-semibold text-primary-600">{{ $apLabel }}</span>
                                    @if($apLat && $apLng)
                                        <a class="text-blue-500 hover:underline text-xs inline-flex items-center"
                                           href="https://www.google.com/maps?q={{ $apLat }},{{ $apLng }}" target="_blank">
                                            <i class="material-symbols-outlined !text-[14px] mr-1">location_on</i> Lokasi PJU
                                        </a>
                                    @endif
                                </div>
                            </td>

                            <td class="text-left">
                                <div class="flex flex-col gap-1">
                                    <span class="font-semibold text-gray-700">{{ $pkLabel }}</span>
                                    @if($pkLat && $pkLng)
                                        <a class="text-blue-500 hover:underline text-xs inline-flex items-center"
                                           href="https://www.google.com/maps?q={{ $pkLat }},{{ $pkLng }}" target="_blank">
                                            <i class="material-symbols-outlined !text-[14px] mr-1">location_on</i> Lokasi Panel
                                        </a>
                                    @endif
                                </div>
                            </td>

                            <td class="text-center">{{ $item->nomor_mcb_panel ?? '-' }}</td>
                            <td class="text-center">{{ $item->fasa ?? '-' }}</td>

                            <td class="text-center">
                                <span class="badge-status {{ $stClass }}">{{ $st }}</span>
                            </td>

                            <td class="text-center">{{ $item->tgl_koneksi ? \Carbon\Carbon::parse($item->tgl_koneksi)->format('d-m-Y') : '-' }}</td>

                            <td class="text-center">
                                {{ $item->panjang_kabel_est !== null ? number_format((float)$item->panjang_kabel_est, 2) : '-' }}
                            </td>

                            <td class="text-left">
                                <span class="text-sm text-gray-600">{{ $item->keterangan_jalur ?? '-' }}</span>
                            </td>

                            <td class="text-center">
                                <div class="flex items-center gap-3 justify-center">
                                    <button type="button" class="btn-edit text-blue-500 hover:text-blue-700 transition"
                                            title="Edit">
                                        <i class="material-symbols-outlined">edit</i>
                                    </button>

                                    <form action="{{ route('koneksi-jaringan.destroy', $item->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Hapus koneksi ini?')"
                                                class="text-red-500 hover:text-red-700 transition"
                                                title="Hapus">
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

    {{-- MODAL (Create/Edit) --}}
    <div id="modalKoneksi" class="modal-overlay fixed inset-0 z-[999] items-center justify-center bg-black/50 p-4">
        <div class="w-full max-w-3xl rounded-lg bg-white dark:bg-[#0c1427] p-6 shadow-2xl max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between mb-4 border-b pb-3">
                <h5 id="modalTitle" class="text-xl font-bold">Tambah Koneksi</h5>
                <button type="button" class="btn-close-modal text-gray-400 hover:text-gray-600">
                    <i class="material-symbols-outlined">close</i>
                </button>
            </div>

            <div class="mb-3 p-3 rounded-md bg-slate-50 border text-sm text-slate-600">
                Pilih <b>Aset PJU</b> dan <b>Panel KWh</b> → peta akan menampilkan marker + garis kabel.
                <br>Estimasi panjang kabel akan diisi otomatis dari jarak garis (meter). Kamu tetap bisa edit manual jika perlu.
            </div>

            <form id="formKoneksi" action="{{ route('koneksi-jaringan.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">

                <div>
                    <label class="block text-sm font-semibold mb-1">Aset PJU</label>
                    <select name="aset_pju_id" id="aset_pju_id" class="w-full border rounded-md px-3 py-2 outline-none focus:border-primary-500" required>
                        <option value="">-- Pilih Aset PJU --</option>
                        @foreach($asetPju as $ap)
                            @php
                                $label = $ap->kode_aset ?? $ap->nama_aset ?? ('Aset #' . $ap->id);
                                $lat = $ap->latitude ?? '';
                                $lng = $ap->longitude ?? '';
                            @endphp
                            <option value="{{ $ap->id }}" data-lat="{{ $lat }}" data-lng="{{ $lng }}">
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    <div class="hint mt-1">* Pastikan Aset PJU punya latitude/longitude supaya garis bisa tergambar.</div>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Panel KWh</label>
                    <select name="panel_kwh_id" id="panel_kwh_id" class="w-full border rounded-md px-3 py-2 outline-none focus:border-primary-500" required>
                        <option value="">-- Pilih Panel KWh --</option>
                        @foreach($panelKwh as $pk)
                            @php
                                $label = $pk->no_pelanggan_pln ?? $pk->lokasi_panel ?? ('Panel #' . $pk->id);
                                $lat = $pk->latitude ?? '';
                                $lng = $pk->longitude ?? '';
                            @endphp
                            <option value="{{ $pk->id }}" data-lat="{{ $lat }}" data-lng="{{ $lng }}">
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    <div class="hint mt-1">* Pastikan Panel KWh punya latitude/longitude.</div>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Nomor MCB Panel</label>
                    <input name="nomor_mcb_panel" id="nomor_mcb_panel"
                           class="w-full border rounded-md px-3 py-2 outline-none" placeholder="Contoh: MCB-01">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Fasa</label>
                    <select name="fasa" id="fasa" class="w-full border rounded-md px-3 py-2 outline-none">
                        <option value="">-- Pilih --</option>
                        <option value="R">R</option>
                        <option value="S">S</option>
                        <option value="T">T</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Status Koneksi</label>
                    <select name="status_koneksi" id="status_koneksi" class="w-full border rounded-md px-3 py-2 outline-none" required>
                        <option value="Aktif">Aktif</option>
                        <option value="Diputus">Diputus</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Tanggal Koneksi</label>
                    <input type="date" name="tgl_koneksi" id="tgl_koneksi"
                           class="w-full border rounded-md px-3 py-2 outline-none">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold mb-1">Peta Jalur Kabel</label>
                    <div id="map-koneksi"></div>
                    <div class="hint mt-2" id="mapHint">Pilih Aset PJU & Panel KWh untuk menampilkan jalur.</div>
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Panjang Kabel Estimasi (meter)</label>
                    <input type="number" step="0.01" min="0" name="panjang_kabel_est" id="panjang_kabel_est"
                           class="w-full border rounded-md px-3 py-2 outline-none" placeholder="Otomatis dari peta">
                    <div class="hint mt-1">* Otomatis terisi dari jarak garis. Bisa kamu ubah manual.</div>
                </div>

                <div class="md:col-span-1">
                    <label class="block text-sm font-semibold mb-1">Keterangan Jalur</label>
                    <textarea name="keterangan_jalur" id="keterangan_jalur" rows="2"
                              class="w-full border rounded-md px-3 py-2 outline-none"
                              placeholder="Contoh: lewat tiang A → tiang B, menyebrang jalan, dll."></textarea>
                </div>

                <div class="md:col-span-2 flex justify-end gap-3 mt-4">
                    <button type="button" class="btn-close-modal px-5 py-2 rounded-md bg-gray-100 hover:bg-gray-200 font-medium">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-md bg-primary-500 text-white hover:bg-primary-600 font-medium shadow-md">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Route helper (biar JS tidak pakai route name yang salah) --}}
    <script>
        window.KONEKSI_ROUTE = {
            store: @json(route('koneksi-jaringan.store')),
            updateBase: @json(url('/koneksi-jaringan')) // /koneksi-jaringan/{id}
        };
    </script>
@endsection

@push('scripts')
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.tailwindcss.js') }}"></script>

    {{-- Leaflet JS --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        $(document).ready(function () {
            // DataTable
            const dt = $('#data-table').DataTable({
                responsive: true,
                pageLength: 10,
                columnDefs: [
                    { targets: [0,3,4,5,6,7,9], className: 'text-center' },
                    { targets: [1,2,8], className: 'text-left' }
                ]
            });

            // Modal
            const modal = document.getElementById('modalKoneksi');
            const openModal = () => modal.classList.add('active');
            const closeModal = () => modal.classList.remove('active');
            document.querySelectorAll('.btn-close-modal').forEach(btn => btn.addEventListener('click', closeModal));
            window.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });

            // Leaflet Map (Bantul focus)
            const bantulCenter = [-7.8897, 110.3289];
            let map = null;
            let markerAset = null;
            let markerPanel = null;
            let line = null;

            function initMapOnce() {
                if (map) return;
                map = L.map('map-koneksi').setView(bantulCenter, 13); // lebih zoom ke Bantul
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap'
                }).addTo(map);
            }

            function clearMapLayers() {
                if (markerAset) { map.removeLayer(markerAset); markerAset = null; }
                if (markerPanel) { map.removeLayer(markerPanel); markerPanel = null; }
                if (line) { map.removeLayer(line); line = null; }
            }

            function parseLatLngFromSelect($sel) {
                const opt = $sel.find('option:selected');
                const lat = parseFloat(opt.data('lat'));
                const lng = parseFloat(opt.data('lng'));
                if (Number.isFinite(lat) && Number.isFinite(lng)) return [lat, lng];
                return null;
            }

            function computeDistanceMeters(a, b) {
                // Leaflet distance (meters)
                return L.latLng(a[0], a[1]).distanceTo(L.latLng(b[0], b[1]));
            }

            function drawConnection() {
                if (!map) return;

                const asetPos = parseLatLngFromSelect($('#aset_pju_id'));
                const panelPos = parseLatLngFromSelect($('#panel_kwh_id'));

                clearMapLayers();

                const hintEl = document.getElementById('mapHint');
                if (!asetPos || !panelPos) {
                    hintEl.textContent = 'Pilih Aset PJU & Panel KWh untuk menampilkan jalur.';
                    map.setView(bantulCenter, 13);
                    return;
                }

                hintEl.textContent = 'Jalur kabel ditampilkan dengan garis. Estimasi panjang terisi otomatis.';

                markerAset = L.marker(asetPos).addTo(map).bindPopup('Aset PJU').openPopup();
                markerPanel = L.marker(panelPos).addTo(map).bindPopup('Panel KWh');

                line = L.polyline([asetPos, panelPos]).addTo(map);

                const dist = computeDistanceMeters(asetPos, panelPos);
                $('#panjang_kabel_est').val(dist.toFixed(2));

                const bounds = L.latLngBounds([asetPos, panelPos]);
                map.fitBounds(bounds, { padding: [30, 30] });
            }

            // Open Create
            $('#btn-open-create').on('click', function () {
                $('#modalTitle').text('Tambah Koneksi');
                $('#formMethod').val('POST');
                $('#formKoneksi').attr('action', window.KONEKSI_ROUTE.store);
                $('#formKoneksi')[0].reset();

                openModal();
                initMapOnce();
                clearMapLayers();
                setTimeout(() => map.invalidateSize(), 250);
                map.setView(bantulCenter, 13);
                document.getElementById('mapHint').textContent = 'Pilih Aset PJU & Panel KWh untuk menampilkan jalur.';
            });

            // When select changes -> redraw line
            $('#aset_pju_id, #panel_kwh_id').on('change', function () {
                if (!map) return;
                drawConnection();
            });

            // Open Edit
            $(document).on('click', '.btn-edit', function () {
                const $tr = $(this).closest('tr');

                const id = $tr.data('id');
                $('#modalTitle').text('Edit Koneksi');
                $('#formMethod').val('PUT');
                $('#formKoneksi').attr('action', `${window.KONEKSI_ROUTE.updateBase}/${id}`);

                // set input values
                $('#aset_pju_id').val($tr.data('aset_pju_id'));
                $('#panel_kwh_id').val($tr.data('panel_kwh_id'));
                $('#nomor_mcb_panel').val($tr.data('nomor_mcb_panel') ?? '');
                $('#fasa').val($tr.data('fasa') ?? '');
                $('#status_koneksi').val($tr.data('status_koneksi') ?? 'Aktif');
                $('#tgl_koneksi').val($tr.data('tgl_koneksi') ?? '');
                $('#panjang_kabel_est').val($tr.data('panjang_kabel_est') ?? '');
                $('#keterangan_jalur').val($tr.data('keterangan_jalur') ?? '');

                openModal();
                initMapOnce();
                setTimeout(() => map.invalidateSize(), 250);

                // redraw based on selected dropdown coords
                drawConnection();
            });

            // Safety: redraw after modal shown
            // (kalau ada glitch size)
            const observer = new MutationObserver(() => {
                if (modal.classList.contains('active') && map) {
                    setTimeout(() => map.invalidateSize(), 250);
                }
            });
            observer.observe(modal, { attributes: true, attributeFilter: ['class'] });
        });
    </script>
@endpush
