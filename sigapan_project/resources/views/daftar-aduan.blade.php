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
            height: 220px !important;
            width: 100%;
            position: relative;
        }

        .custom-img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        /* --- STATUS BADGE --- */
        .status-badge {
            position: absolute;
            top: 16px;
            right: 16px;
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 800;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.25);
            z-index: 10;
        }

        /* Warna Status Spesifik */
        .status-proses  { background-color: #3b82f6; border: 2px solid #ffffff; } /* Biru */
        .status-tolak   { background-color: #ef4444; border: 2px solid #ffffff; } /* Merah */
        .status-selesai { background-color: #10b981; border: 2px solid #ffffff; } /* Hijau */

        /* Indikator Garis Warna di Atas Kartu */
        .card-border-proses  { border-top: 4px solid #3b82f6; }
        .card-border-tolak   { border-top: 4px solid #ef4444; }
        .card-border-selesai { border-top: 4px solid #10b981; }

    </style>
@endpush

@section('content')
    <section class="py-12 bg-gray-50 dark:bg-neutral-900 min-h-screen bg-neutral-200">
        <div class="container mx-auto px-4">
            
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-neutral-900 dark:text-white mb-2">Daftar Laporan Warga</h2>
                <p class="text-neutral-500 dark:text-neutral-400">Pantau perkembangan laporan terkini dari lingkungan sekitar.</p>
            </div>

            <div class="custom-grid-container">

                @forelse($aduan as $item)
                    @php
                        // --- LOGIKA STATUS ---
                        
                        // Default: Diterima (Biru)
                        $badgeClass = 'status-proses';
                        $borderClass = 'card-border-proses';
                        $statusLabel = 'Diterima';
                        $icon = 'ti ti-check';

                        // Case 1: Ditolak (Merah)
                        if ($item->status_verifikasi == 'Ditolak') {
                            $badgeClass = 'status-tolak';
                            $borderClass = 'card-border-tolak';
                            $statusLabel = 'Ditolak';
                            $icon = 'ti ti-x';
                        }
                        // Case 2: Diterima -> Cek Tiket -> Selesai (Hijau)
                        elseif ($item->tiket && $item->tiket->status_tindakan == 'Selesai') {
                            $badgeClass = 'status-selesai';
                            $borderClass = 'card-border-selesai';
                            $statusLabel = 'Selesai';
                            $icon = 'ti ti-circle-check';
                        }
                        // Case 3: Diterima -> Cek Tiket -> Proses (Biru Label Beda)
                        elseif ($item->tiket && $item->tiket->status_tindakan == 'Proses') {
                            $statusLabel = 'Diproses'; // Visual saja, warna tetap biru
                            $icon = 'ti ti-loader';
                        }
                    @endphp

                    <a href="{{ url('/detail-aduan/' . $item->id) }}" class="custom-card group {{ $borderClass }}">
                        <div class="custom-img-box">
                            @if($item->foto_lapangan)
                                <img src="{{ asset('storage/' . $item->foto_lapangan) }}" alt="{{ $item->tipe_aduan }}">
                            @else
                                <img src="https://via.placeholder.com/400x300?text=Tidak+Ada+Foto" alt="No Image">
                            @endif

                            <span class="status-badge {{ $badgeClass }}">
                                <i class="{{ $icon }} mr-1"></i> {{ $statusLabel }}
                            </span>
                        </div>

                        <div class="p-5 flex-1 flex flex-col bg-neutral-50">
                            <div class="flex items-center gap-2 text-neutral-500 text-xs mb-3 font-medium">
                                <i class="ti ti-calendar"></i> 
                                <span>{{ $item->created_at->diffForHumans() }}</span>
                            </div>
                            
                            <h3 class="text-lg font-bold text-neutral-900 dark:text-white mb-2 group-hover:text-blue-600 transition-colors">
                                {{ $item->tipe_aduan }}
                            </h3>
                            
                            <p class="text-neutral-600 dark:text-neutral-400 text-sm line-clamp-2 mb-4">
                                {{ Str::limit($item->deskripsi_lokasi, 100) }}
                            </p>
                            
                            <div class="flex items-center gap-2 text-neutral-500 text-xs mt-auto">
                                <i class="ti ti-user text-blue-500"></i> {{ $item->nama_pelapor }}
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-1 md:col-span-3 text-center py-12">
                        <div class="inline-block p-4 rounded-full bg-gray-100 mb-4">
                            <i class="ti ti-inbox text-4xl text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900">Belum ada aduan</h3>
                        <p class="text-gray-500 mt-1">Laporan akan muncul setelah diproses oleh admin.</p>
                    </div>
                @endforelse

            </div>
        </div>
    </section>
@endsection