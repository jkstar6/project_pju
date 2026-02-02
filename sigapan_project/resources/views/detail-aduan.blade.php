@extends('layouts.app')

@section('title', 'Detail Aduan')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    
    <style>
        .detail-container { max-width: 1100px; margin: 0 auto; padding: 20px; }
        .detail-grid { display: grid; grid-template-columns: 1fr; gap: 30px; }
        @media (min-width: 992px) { .detail-grid { grid-template-columns: 1.5fr 1fr; } }
        
        .glass-card { background: #ffffff; border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.06); border: 1px solid rgba(0,0,0,0.03); overflow: hidden; }
        .hero-image { width: 100%; height: 400px; object-fit: cover; display: block; }
        #map { height: 280px; width: 100%; z-index: 1; }
        .section-title { font-size: 14px; font-weight: 700; text-transform: uppercase; color: #94a3b8; margin-bottom: 12px; letter-spacing: 0.8px; }

        .status-pill { display: inline-flex; align-items: center; padding: 6px 16px; border-radius: 50px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }
        .status-pending { background: #fffbeb; color: #b45309; border: 1px solid #fcd34d; }
        .status-proses  { background: #eff6ff; color: #1d4ed8; border: 1px solid #93c5fd; }
        .status-selesai { background: #f0fdf4; color: #15803d; border: 1px solid #86efac; }
        .status-tolak   { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

        .info-row { display: flex; align-items: center; gap: 12px; padding: 12px; background-color: #f8fafc; border-radius: 12px; margin-bottom: 15px; }
        .avatar-circle { width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 14px; }
        .sidebar-sticky { position: sticky; top: 100px; }

        .timeline-container { position: relative; padding-left: 20px; border-left: 2px solid #e2e8f0; margin-top: 10px; margin-bottom: 20px; }
        .timeline-item { position: relative; padding-left: 20px; padding-bottom: 25px; }
        .timeline-item:last-child { padding-bottom: 0; }
        .timeline-dot { position: absolute; left: -29px; top: 0; width: 16px; height: 16px; border-radius: 50%; border: 2px solid #fff; box-shadow: 0 0 0 2px #fff; z-index: 10; }
        
        .dot-green { background-color: #10b981; box-shadow: 0 0 0 2px #d1fae5; }
        .dot-blue  { background-color: #3b82f6; box-shadow: 0 0 0 2px #dbeafe; }
        .dot-red   { background-color: #ef4444; box-shadow: 0 0 0 2px #fee2e2; }
        .dot-gray  { background-color: #cbd5e1; }
        .dot-amber { background-color: #f59e0b; box-shadow: 0 0 0 2px #fef3c7; }
    </style>
@endpush

@section('content')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <section class="py-12 bg-gray-50 dark:bg-neutral-900 min-h-screen">
        <div class="detail-container">
            
            <div class="mb-8">
                <a href="{{ url('/daftar-aduan') }}" style="text-decoration: none;" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" /></svg>
                    Kembali ke Daftar Laporan
                </a>
            </div>

            <div class="detail-grid">
                
                {{-- KOLOM KIRI --}}
                <div class="space-y-8">
                    <div class="glass-card">
                        @if($aduan->foto_lapangan)
                            <img src="{{ asset('storage/' . $aduan->foto_lapangan) }}" alt="{{ $aduan->tipe_aduan }}" class="hero-image">
                        @else
                            <img src="https://via.placeholder.com/800x400?text=Tidak+Ada+Foto" alt="Tidak Ada Foto" class="hero-image">
                        @endif
                    </div>

                    <div class="glass-card">
                        <div style="padding: 20px; border-bottom: 1px solid #f1f5f9;">
                            <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                Titik Lokasi
                            </h3>
                        </div>
                        <div id="map"></div>
                        <div style="padding: 15px 20px; background: #f8fafc;">
                            <p class="text-xs text-gray-400 font-bold uppercase mb-1">Alamat Terdeteksi Sistem:</p>
                            <p id="address-text" class="text-sm text-gray-700 leading-snug">Memuat alamat...</p>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN --}}
                <div class="sidebar-sticky">
                    <div class="glass-card" style="padding: 30px;">
                        
                        <div class="mb-6">
                            <div class="flex justify-between items-start mb-3">
                                <span class="text-xs font-mono text-gray-400">#AD-{{ $aduan->id }}</span>
                                @if($aduan->status_verifikasi == 'Pending')
                                    <span class="status-pill status-pending">Pending</span>
                                @elseif($aduan->status_verifikasi == 'Ditolak')
                                    <span class="status-pill status-tolak">Ditolak</span>
                                @else 
                                    @if($aduan->tiket && $aduan->tiket->status_tindakan == 'Selesai')
                                        <span class="status-pill status-selesai">Selesai</span>
                                    @elseif($aduan->tiket && $aduan->tiket->status_tindakan == 'Proses')
                                        <span class="status-pill status-proses">Proses</span>
                                    @else
                                        <span class="status-pill status-proses">Diterima</span>
                                    @endif
                                @endif
                            </div>
                            <h1 class="text-3xl font-extrabold text-gray-900 leading-tight mb-2">{{ $aduan->tipe_aduan }}</h1>
                            <p class="text-sm text-gray-500">
                                Dilaporkan pada: {{ \Carbon\Carbon::parse($aduan->created_at)->setTimezone('Asia/Jakarta')->translatedFormat('d F Y, H:i') }} WIB
                            </p>
                        </div>

                        <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 20px 0;">

                        {{-- TIMELINE --}}
                        <div class="mb-8">
                            <div class="section-title">Timeline Pengaduan</div>
                            <div class="timeline-container">
                                
                                {{-- 1. Laporan Masuk --}}
                                <div class="timeline-item">
                                    <div class="timeline-dot dot-green"></div>
                                    <h4 class="text-sm font-bold text-gray-900">Laporan Dikirim</h4>
                                    <p class="text-xs text-gray-500 mt-1">{{ \Carbon\Carbon::parse($aduan->created_at)->setTimezone('Asia/Jakarta')->translatedFormat('d F Y, H:i') }} WIB</p>
                                    <p class="text-xs text-gray-600 mt-1">Laporan berhasil masuk ke sistem.</p>
                                </div>

                                {{-- 2. Verifikasi --}}
                                <div class="timeline-item">
                                    @if($aduan->status_verifikasi == 'Pending')
                                        <div class="timeline-dot dot-amber"></div>
                                        <h4 class="text-sm font-bold text-gray-900">Verifikasi Admin</h4>
                                        <p class="text-xs text-orange-600 font-semibold mt-1">Sedang Ditinjau</p>
                                    @elseif($aduan->status_verifikasi == 'Diterima')
                                        <div class="timeline-dot dot-blue"></div>
                                        <h4 class="text-sm font-bold text-gray-900">Laporan Diterima</h4>
                                        <p class="text-xs text-gray-500 mt-1">{{ \Carbon\Carbon::parse($aduan->updated_at)->setTimezone('Asia/Jakarta')->translatedFormat('d F Y, H:i') }} WIB</p>
                                        <span class="inline-block mt-1 px-2 py-1 text-[10px] font-bold text-white bg-blue-500 rounded">DITERIMA</span>
                        
                                    @elseif($aduan->status_verifikasi == 'Ditolak')
                                        <div class="timeline-dot dot-red"></div>
                                        <h4 class="text-sm font-bold text-gray-900">Laporan Ditolak</h4>
                                        <p class="text-xs text-gray-500 mt-1">{{ \Carbon\Carbon::parse($aduan->updated_at)->setTimezone('Asia/Jakarta')->translatedFormat('d F Y, H:i') }} WIB</p>
                                        <span class="inline-block mt-1 px-2 py-1 text-[10px] font-bold text-white bg-red-500 rounded">DITOLAK</span>
                                        
                                    @endif
                                </div>

                               {{-- 3. PENUGASAN (TIKET) --}}
                                @if($aduan->status_verifikasi == 'Diterima')
                                    <div class="timeline-item">
                                        @if($aduan->tiket)
                                            <div class="timeline-dot dot-blue"></div>
                                            <h4 class="text-sm font-bold text-gray-900">Penugasan Teknisi</h4>
                                            <p class="text-xs text-gray-500 mt-1">
                                                {{ \Carbon\Carbon::parse($aduan->tiket->created_at)->setTimezone('Asia/Jakarta')->translatedFormat('d F Y, H:i') }} WIB
                                            </p>
                                            
                                            {{-- KOTAK INFORMASI TIM --}}
                                            <div class="mt-2 p-3 bg-blue-50 rounded border border-blue-100 text-xs text-gray-700">
                                                <div class="flex flex-col gap-1">
                                                    {{-- NAMA TIM --}}
                                                    <div>
                                                        <span class="font-bold text-blue-800">Tim:</span> 
                                                        {{ optional($aduan->tiket->tim_lapangan)->nama_tim ?? 'Belum ditentukan' }}
                                                    </div>

                                                    {{-- ✅ NAMA KETUA TIM (DARI RELASI USER) --}}
                                                    <div>
                                                        <span class="font-bold text-blue-800">Ketua Tim:</span> 
                                                        {{-- Mengakses: Tiket -> TimLapangan -> Leader (User) -> Name --}}
                                                        {{ optional(optional($aduan->tiket->tim_lapangan)->leader)->name ?? '-' }}
                                                    </div>

                                                    {{-- JADWAL --}}
                                                    <div>
                                                        <span class="font-bold text-blue-800">Jadwal:</span> 
                                                        {{ $aduan->tiket->tgl_jadwal ? \Carbon\Carbon::parse($aduan->tiket->tgl_jadwal)->translatedFormat('d F Y') : '-' }}
                                                    </div>
                                                </div>
                                            </div>

                                        @else
                                            <div class="timeline-dot dot-gray"></div>
                                            <h4 class="text-sm font-bold text-gray-400">Penugasan Teknisi</h4>
                                            <p class="text-xs text-gray-400 mt-1">Menunggu penjadwalan.</p>
                                        @endif
                                    </div>

                                    {{-- 4. PROSES PENGERJAAN --}}
                                    <div class="timeline-item">
                                        @if($aduan->tiket && ($aduan->tiket->status_tindakan == 'Proses' || $aduan->tiket->status_tindakan == 'Selesai'))
                                            <div class="timeline-dot dot-blue"></div>
                                            <h4 class="text-sm font-bold text-gray-900">Sedang Dikerjakan</h4>
                                            <p class="text-xs text-gray-500 mt-1">{{ \Carbon\Carbon::parse($aduan->tiket->updated_at)->setTimezone('Asia/Jakarta')->translatedFormat('d F Y, H:i') }} WIB</p>
                                            <p class="text-xs text-gray-600 mt-1">Teknisi sedang melakukan perbaikan di lokasi.</p>
                                        @else
                                            <div class="timeline-dot dot-gray"></div>
                                            <h4 class="text-sm font-bold text-gray-400">Sedang Dikerjakan</h4>
                                        @endif
                                    </div>

                                    {{-- 5. SELESAI --}}
                                    <div class="timeline-item">
                                        @if($aduan->tiket && $aduan->tiket->status_tindakan == 'Selesai')
                                            <div class="timeline-dot dot-green"></div>
                                            <h4 class="text-sm font-bold text-gray-900">Selesai</h4>
                                            <p class="text-xs text-gray-500 mt-1">{{ \Carbon\Carbon::parse($aduan->tiket->updated_at)->setTimezone('Asia/Jakarta')->translatedFormat('d F Y, H:i') }} WIB</p>
                                            <span class="inline-block mt-1 px-2 py-1 text-[10px] font-bold text-white bg-green-500 rounded">SUKSES</span>
                                            <p class="text-xs text-gray-600 mt-2">Perbaikan telah selesai dilakukan. Terima kasih.</p>
                                        @else
                                            <div class="timeline-dot dot-gray"></div>
                                            <h4 class="text-sm font-bold text-gray-400">Selesai</h4>
                                        @endif
                                    </div>
                                @elseif($aduan->status_verifikasi == 'Ditolak')
                                    <div class="timeline-item">
                                        <div class="timeline-dot dot-red"></div>
                                        <h4 class="text-sm font-bold text-red-500">Proses Dihentikan</h4>
                                    </div>
                                @endif

                            </div>
                        </div>

                        <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 20px 0;">

                        <div class="mb-6">
                            <div class="section-title">Informasi Pelapor</div>
                            <div class="info-row">
                                <div class="avatar-circle">{{ substr($aduan->nama_pelapor, 0, 2) }}</div>
                                <div>
                                    <div class="text-sm font-bold text-gray-800">{{ $aduan->nama_pelapor }}</div>
                                    <div class="text-xs text-gray-500">Masyarakat / Pelapor</div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6">
                            <div class="section-title">Deskripsi Lokasi</div>
                            <p class="text-gray-600 text-sm leading-relaxed" style="text-align: justify;">{{ $aduan->deskripsi_lokasi }}</p>
                        </div>

                        @if($aduan->catatan_admin)
                            <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                                <div class="section-title !text-yellow-600 !mb-1">Catatan Petugas</div>
                                <p class="text-gray-700 text-sm italic">"{{ $aduan->catatan_admin }}"</p>
                            </div>
                        @endif

                        <div class="mb-8">
                            <div class="section-title">Koordinat GPS</div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                                <div style="background: #f1f5f9; padding: 8px; border-radius: 8px; text-align: center;">
                                    <span class="block text-xs text-gray-400">Latitude</span>
                                    <span class="block text-sm font-mono font-bold text-gray-700">{{ $aduan->latitude }}</span>
                                </div>
                                <div style="background: #f1f5f9; padding: 8px; border-radius: 8px; text-align: center;">
                                    <span class="block text-xs text-gray-400">Longitude</span>
                                    <span class="block text-sm font-mono font-bold text-gray-700">{{ $aduan->longitude }}</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var lat = {{ $aduan->latitude }}; 
            var lng = {{ $aduan->longitude }};
            var map = L.map('map', { scrollWheelZoom: false }).setView([lat, lng], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19, attribution: '© OpenStreetMap' }).addTo(map);
            var marker = L.marker([lat, lng]).addTo(map);
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                .then(response => response.json())
                .then(data => {
                    const addressElement = document.getElementById('address-text');
                    if(data && data.display_name) addressElement.innerText = data.display_name;
                    else addressElement.innerText = "Alamat tidak ditemukan.";
                })
                .catch(error => { document.getElementById('address-text').innerText = "Gagal memuat alamat."; });
        });
    </script>
@endsection