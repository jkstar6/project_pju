@extends('layouts.app')

@section('title', 'Detail Aduan')

{{-- 
    STYLE MANUAL (CSS)
--}}
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    
    <style>
        /* --- GRID SYSTEM --- */
        .detail-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 20px;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 30px;
        }

        /* Laptop: 2 Kolom (Kiri 60%, Kanan 40%) */
        @media (min-width: 992px) {
            .detail-grid {
                grid-template-columns: 1.5fr 1fr; 
            }
        }

        /* --- CARD STYLING --- */
        .glass-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.06);
            border: 1px solid rgba(0,0,0,0.03);
            overflow: hidden;
            transition: transform 0.2s;
        }

        /* --- IMAGES & MAP --- */
        .hero-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            display: block;
        }

        #map {
            height: 280px;
            width: 100%;
            z-index: 1;
        }

        /* --- TYPOGRAPHY & ELEMENTS --- */
        .section-title {
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #94a3b8;
            margin-bottom: 12px;
        }

        /* Badge Status Modern */
        .status-pill {
            display: inline-flex;
            align-items: center;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .status-pending { background: #fffbeb; color: #b45309; border: 1px solid #fcd34d; }
        .status-proses  { background: #eff6ff; color: #1d4ed8; border: 1px solid #93c5fd; }
        .status-selesai { background: #f0fdf4; color: #15803d; border: 1px solid #86efac; }
        .status-tolak   { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

        /* User Info Row */
        .info-row {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background-color: #f8fafc;
            border-radius: 12px;
            margin-bottom: 15px;
        }

        .avatar-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
        }

        /* Sticky Sidebar */
        .sidebar-sticky {
            position: sticky;
            top: 100px;
        }
    </style>
@endpush

@section('content')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <section class="py-12 bg-gray-50 dark:bg-neutral-900 min-h-screen">
        <div class="detail-container">
            
            {{-- Breadcrumb --}}
            <div class="mb-8">
                <a href="{{ url('/daftar-aduan') }}" style="text-decoration: none;" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" /></svg>
                    Kembali ke Daftar Laporan
                </a>
            </div>

            <div class="detail-grid">
                
                {{-- KOLOM KIRI: Visual (Foto & Peta) --}}
                <div class="space-y-8">
                    
                    {{-- FOTO LAPANGAN DINAMIS --}}
                    <div class="glass-card">
                        @if($aduan->foto_lapangan)
                            <img src="{{ asset('storage/' . $aduan->foto_lapangan) }}" 
                                 alt="{{ $aduan->tipe_aduan }}" 
                                 class="hero-image">
                        @else
                            <img src="https://via.placeholder.com/800x400?text=Tidak+Ada+Foto" 
                                 alt="Tidak Ada Foto" 
                                 class="hero-image">
                        @endif
                    </div>

                    {{-- PETA LOKASI DINAMIS --}}
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

                {{-- KOLOM KANAN: Informasi Detail (Sidebar) --}}
                <div class="sidebar-sticky">
                    <div class="glass-card" style="padding: 30px;">
                        
                        {{-- Header: Judul & Status --}}
                        <div class="mb-6">
                            <div class="flex justify-between items-start mb-3">
                                <span class="text-xs font-mono text-gray-400">#AD-{{ $aduan->id }}</span>
                                
                                {{-- LOGIK STATUS BADGE --}}
                                @if($aduan->status_verifikasi == 'Pending')
                                    <span class="status-pill status-pending">Menunggu Verifikasi</span>
                                @elseif($aduan->status_verifikasi == 'Diterima')
                                    <span class="status-pill status-proses">Diterima / Proses</span>
                                @elseif($aduan->status_verifikasi == 'Ditolak')
                                    <span class="status-pill status-tolak">Ditolak</span>
                                @else
                                    <span class="status-pill status-selesai">Selesai</span>
                                @endif
                            </div>
                            <h1 class="text-3xl font-extrabold text-gray-900 leading-tight mb-2">{{ $aduan->tipe_aduan }}</h1>
                            <p class="text-sm text-gray-500">
                                Dilaporkan pada: {{ \Carbon\Carbon::parse($aduan->created_at)->translatedFormat('d F Y') }}
                            </p>
                        </div>

                        <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 20px 0;">

                        {{-- Data Pelapor --}}
                        <div class="mb-6">
                            <div class="section-title">Informasi Pelapor</div>
                            <div class="info-row">
                                {{-- Inisial Nama --}}
                                <div class="avatar-circle">
                                    {{ substr($aduan->nama_pelapor, 0, 2) }}
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-gray-800">{{ $aduan->nama_pelapor }}</div>
                                    {{-- Hapus Nomor HP, ganti dengan label generic agar layout tetap rapi --}}
                                    <div class="text-xs text-gray-500">Masyarakat / Pelapor</div>
                                </div>
                            </div>
                        </div>

                        {{-- Deskripsi Lokasi --}}
                        <div class="mb-6">
                            <div class="section-title">Deskripsi Lokasi</div>
                            <p class="text-gray-600 text-sm leading-relaxed" style="text-align: justify;">
                                {{ $aduan->deskripsi_lokasi }}
                            </p>
                        </div>

                        {{-- 
                            BAGIAN CATATAN ADMIN TELAH DIHAPUS 
                        --}}

                        {{-- Koordinat Teknis --}}
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

    {{-- SCRIPT LOGIC --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Data Koordinat dari Database (Blade Injection)
            var lat = {{ $aduan->latitude }}; 
            var lng = {{ $aduan->longitude }};

            // Inisialisasi Map
            var map = L.map('map', { scrollWheelZoom: false }).setView([lat, lng], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);

            var marker = L.marker([lat, lng]).addTo(map);

            // Fetch Alamat dari Nominatim API
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                .then(response => response.json())
                .then(data => {
                    const addressElement = document.getElementById('address-text');
                    if(data && data.display_name) {
                        addressElement.innerText = data.display_name;
                    } else {
                        addressElement.innerText = "Alamat tidak ditemukan.";
                    }
                })
                .catch(error => {
                    console.error('Error fetching address:', error);
                    document.getElementById('address-text').innerText = "Gagal memuat alamat.";
                });
        });
    </script>
@endsection