@extends('layouts.app')

@section('title', 'Detail Aduan')

@section('content')
    {{-- LINK LEAFLET CSS & JS (Untuk Peta) --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    {{-- KONFIGURASI TAILWIND --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            corePlugins: {
                preflight: false, // Penting agar navbar bawaan tidak rusak
            }
        }
    </script>

    {{-- KONTEN UTAMA --}}
    <section class="py-12 bg-gray-50 dark:bg-neutral-900 min-h-screen">
        <div class="container mx-auto px-4 max-w-5xl">
            
            {{-- Breadcrumb / Tombol Kembali --}}
            <div class="mb-6">
                <a href="{{ url('/daftar-aduan') }}" class="inline-flex items-center text-sm text-gray-500 hover:text-blue-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Daftar
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- KOLOM KIRI: FOTO & PETA --}}
                <div class="lg:col-span-2 space-y-6">
                    
                    <div class="bg-white dark:bg-neutral-800 rounded-2xl shadow-sm border border-gray-200 dark:border-neutral-700 overflow-hidden">
                        <div class="relative h-96 w-full">
                            {{-- Foto Dummy --}}
                            <img src="https://thetapaktuanpost.com/wp-content/uploads/2020/03/Lampu-Jalan-Rusak.JPG.jpg" 
                                 alt="Foto Bukti" 
                                 class="w-full h-full object-cover">
                        </div>
                    </div>

                    <div class="bg-white dark:bg-neutral-800 rounded-2xl shadow-sm border border-gray-200 dark:border-neutral-700 p-1 overflow-hidden">
                        <h4 class="px-4 py-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Lokasi Kejadian</h4>
                        {{-- Container Map --}}
                        <div id="map" class="h-64 w-full rounded-xl z-0"></div>
                        <div class="px-4 py-3 bg-gray-50 dark:bg-neutral-900 mt-1 rounded-b-xl">
                            <p class="text-xs text-gray-500 uppercase tracking-wide font-bold">Alamat Terdeteksi:</p>
                            <p id="address-text" class="text-sm text-gray-700 dark:text-gray-300 mt-1">Memuat alamat...</p>
                        </div>
                    </div>

                </div>

                {{-- KOLOM KANAN: DETAIL INFORMASI --}}
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-neutral-800 rounded-2xl shadow-lg border border-gray-200 dark:border-neutral-700 p-6 sticky top-24">
                        
                        {{-- Header Status --}}
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Lampu Mati</h1>
                                <p class="text-sm text-gray-500 mt-1">ID Aduan: #AD-2026001</p>
                            </div>
                            
                            {{-- Badge Status --}}
                            <span class="bg-yellow-100 text-yellow-700 border border-yellow-200 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                                Pending
                            </span>
                        </div>

                        <hr class="border-gray-100 dark:border-neutral-700 mb-6">

                        {{-- List Informasi --}}
                        <div class="space-y-6">
                            
                            <div>
                                <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-1">Nama Pelapor</label>
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xs">
                                        BU
                                    </div>
                                    <p class="text-base font-medium text-gray-800 dark:text-gray-200">Budi Santoso</p>
                                </div>
                            </div>

                            <div>
                                <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-1">Deskripsi Aduan</label>
                                <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed bg-gray-50 dark:bg-neutral-900 p-3 rounded-lg border border-gray-100 dark:border-neutral-700">
                                    Lampunya mati total di perempatan jalan, sudah 3 hari tidak menyala. Sangat gelap saat malam dan rawan kecelakaan.
                                </p>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-1">Latitude</label>
                                    <p class="font-mono text-sm text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-neutral-900 px-2 py-1 rounded">-7.8923</p>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-1">Longitude</label>
                                    <p class="font-mono text-sm text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-neutral-900 px-2 py-1 rounded">110.3341</p>
                                </div>
                            </div>

                            <div>
                                <label class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-1">Waktu Laporan</label>
                                <div class="flex items-center gap-2 text-gray-600 dark:text-gray-400 text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    12 Januari 2026, 14:30 WIB
                                </div>
                            </div>

                        </div>

                        {{-- Action Buttons --}}
                        <div class="mt-8 pt-6 border-t border-gray-100 dark:border-neutral-700 flex gap-3">
                             <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2.5 rounded-xl text-sm font-semibold transition shadow-md hover:shadow-lg">
                                Proses Aduan
                             </button>
                             <button class="flex-none bg-red-50 hover:bg-red-100 text-red-600 p-2.5 rounded-xl border border-red-200 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                             </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SCRIPT PETA & ALAMAT --}}
    <script>
        // 1. DATA DUMMY
        // CATATAN: Jangan masukkan syntax blade dengan kurung kurawal disini jika variabel belum dikirim dari controller
        
        var lat = -7.8923; 
        var lng = 110.3341;

        // 2. Inisialisasi Map Leaflet
        var map = L.map('map').setView([lat, lng], 15);

        // Tambahkan Layer OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // Tambahkan Marker
        var marker = L.marker([lat, lng]).addTo(map);

        // 3. Fungsi Reverse Geocoding (Mendapatkan alamat dari Lat/Long)
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
    </script>

@endsection