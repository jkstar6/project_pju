@extends('layouts.app')

@section('title', 'Daftar Aduan')

@push('styles')
    <style>
        /* --- GRID SYSTEM --- */
        .custom-grid-container {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 24px;
            margin-top: 20px;
        }

        @media (min-width: 768px) {
            .custom-grid-container {
                grid-template-columns: repeat(3, 1fr) !important;
            }
        }

        /* --- CARD STYLING --- */
        .custom-card {
            background-color: #ffffff;
            border: 1px solid #e5e5e5;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            text-decoration: none;
            color: inherit;
            position: relative;
        }

        .custom-card:hover {
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            transform: translateY(-4px);
        }

        /* --- IMAGE BOX --- */
        .custom-img-box {
            height: 220px !important; /* Sedikit dipertinggi agar lega */
            width: 100%;
            position: relative;
        }

        .custom-img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        /* --- STATUS BADGE (YANG DIPERBAIKI) --- */
        .status-badge {
            position: absolute;
            top: 16px;
            right: 16px;
            padding: 6px 16px; /* Padding lebih besar */
            border-radius: 50px;
            font-size: 11px;
            font-weight: 800; /* Font lebih tebal */
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.25); /* Shadow lebih kuat agar kontras */
            z-index: 10;
        }

        /* Warna Status Spesifik */
        .status-menunggu {
            background-color: #f59e0b; /* Oranye/Amber: Menarik perhatian */
            border: 2px solid #ffffff; /* Border putih agar memisah dari gambar */
        }

        .status-selesai {
            background-color: #10b981; /* Hijau Emerald: Menenangkan/Sukses */
            border: 2px solid #ffffff;
        }

        .status-proses {
            background-color: #3b82f6; /* Biru: Informatif */
            border: 2px solid #ffffff;
        }

        /* Indikator Garis Warna di Atas Kartu (Opsional, agar lebih jelas) */
        .card-border-menunggu { border-top: 4px solid #f59e0b; }
        .card-border-selesai { border-top: 4px solid #10b981; }
        .card-border-proses { border-top: 4px solid #3b82f6; }

    </style>
@endpush

@section('content')
    <section class="py-12 bg-gray-50 dark:bg-neutral-900 min-h-screen">
        <div class="container mx-auto px-4">
            
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-neutral-900 dark:text-white mb-2">Daftar Laporan Warga</h2>
                <p class="text-neutral-500 dark:text-neutral-400">Pantau perkembangan laporan terkini dari lingkungan sekitar.</p>
            </div>

            <div class="custom-grid-container">

                {{-- Tambahkan class 'card-border-menunggu' di parent card --}}
                <a href="{{ url('/detail-aduan/1') }}" class="custom-card group card-border-menunggu">
                    <div class="custom-img-box">
                        <img src="https://images.unsplash.com/photo-1515162816999-a0c47dc192f7?q=80&w=2070&auto=format&fit=crop" alt="Jalan Rusak">
                        {{-- Gunakan class .status-menunggu --}}
                        <span class="status-badge status-menunggu">
                            <i class="ti ti-clock-hour-4 mr-1"></i> Menunggu
                        </span>
                    </div>
                    <div class="p-5 flex-1 flex flex-col">
                        <div class="flex items-center gap-2 text-neutral-500 text-xs mb-3 font-medium">
                            <i class="ti ti-calendar"></i> <span>2 days ago</span>
                        </div>
                        <h3 class="text-lg font-bold text-neutral-900 dark:text-white mb-2 group-hover:text-blue-600 transition-colors">
                            Jalan Bocor
                        </h3>
                        <p class="text-neutral-600 dark:text-neutral-400 text-sm line-clamp-2 mb-4">
                            Sepanjang jalan bantul banyak yang berlubang pak, mohon segera diperbaiki.
                        </p>
                        <div class="flex items-center gap-2 text-neutral-500 text-xs mt-auto">
                            <i class="ti ti-map-pin text-red-500"></i> Bantul
                        </div>
                    </div>
                </a>

                <a href="{{ url('/detail-aduan/2') }}" class="custom-card group card-border-menunggu">
                    <div class="custom-img-box">
                        <img src="https://thetapaktuanpost.com/wp-content/uploads/2020/03/Lampu-Jalan-Rusak.JPG.jpg" alt="Lampu Mati">
                        <span class="status-badge status-menunggu">
                            <i class="ti ti-clock-hour-4 mr-1"></i> Menunggu
                        </span>
                    </div>
                    <div class="p-5 flex-1 flex flex-col">
                        <div class="flex items-center gap-2 text-neutral-500 text-xs mb-3 font-medium">
                            <i class="ti ti-calendar"></i> <span>3 days ago</span>
                        </div>
                        <h3 class="text-lg font-bold text-neutral-900 dark:text-white mb-2 group-hover:text-blue-600 transition-colors">
                            Lampu Mati
                        </h3>
                        <p class="text-neutral-600 dark:text-neutral-400 text-sm line-clamp-2 mb-4">
                            Lampunya mati total di perempatan jalan, sangat gelap saat malam.
                        </p>
                        <div class="flex items-center gap-2 text-neutral-500 text-xs mt-auto">
                            <i class="ti ti-map-pin text-red-500"></i> Kominfo
                        </div>
                    </div>
                </a>

                {{-- Tambahkan class 'card-border-selesai' di parent card --}}
                <a href="{{ url('/detail-aduan/3') }}" class="custom-card group card-border-selesai">
                    <div class="custom-img-box">
                        <img src="https://images.unsplash.com/photo-1530587191325-3db32d826c18?q=80&w=2069&auto=format&fit=crop" alt="Sampah">
                        {{-- Gunakan class .status-selesai --}}
                        <span class="status-badge status-selesai">
                            <i class="ti ti-check mr-1"></i> Selesai
                        </span>
                    </div>
                    <div class="p-5 flex-1 flex flex-col">
                        <div class="flex items-center gap-2 text-neutral-500 text-xs mb-3 font-medium">
                            <i class="ti ti-calendar"></i> <span>5 days ago</span>
                        </div>
                        <h3 class="text-lg font-bold text-neutral-900 dark:text-white mb-2 group-hover:text-blue-600 transition-colors">
                            Sampah Numpuk
                        </h3>
                        <p class="text-neutral-600 dark:text-neutral-400 text-sm line-clamp-2 mb-4">
                            Bau menyengat di sekitar pasar karena sampah menumpuk belum diangkut.
                        </p>
                        <div class="flex items-center gap-2 text-neutral-500 text-xs mt-auto">
                            <i class="ti ti-map-pin text-red-500"></i> Pasar Seni
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </section>
@endsection