@extends('layouts.admin.master')

@section('title', 'Detail Tiket Perbaikan')

@section('content')
    {{-- START: Header Card --}}
    <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
        <div class="trezo-card-header mb-[20px] md:mb-[25px] flex items-center justify-between">
            <div class="trezo-card-title">
                <h5 class="!mb-2">
                    Tiket: <span class="text-primary-500">#{{ $tiket->id }}</span>
                </h5>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Dibuat pada: {{ \Carbon\Carbon::parse($tiket->created_at)->format('d M Y H:i') }}
                </p>
            </div>
            <div>
                <a href="{{ route('tiket-perbaikan.index') }}"
                    class="inline-block py-[10px] px-[20px] bg-gray-500 text-white transition-all hover:bg-gray-400 rounded-md border border-gray-500 hover:border-gray-400">
                    <i class="material-symbols-outlined align-middle mr-1 !text-sm">arrow_back</i> Kembali
                </a>
            </div>
        </div>

        {{-- START: Status & Prioritas --}}
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-5">
            <div class="bg-gray-50 dark:bg-[#15203c] p-4 rounded-md">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Status Tindakan</p>
                <span class="px-[8px] py-[3px] inline-block rounded-sm font-medium text-sm
                    @if ($tiket->status_tindakan == 'Menunggu') bg-orange-100 text-orange-600
                    @elseif($tiket->status_tindakan == 'Proses') bg-blue-100 text-blue-600
                    @else bg-green-100 text-green-600 @endif">
                    {{ $tiket->status_tindakan }}
                </span>
            </div>
            <div class="bg-gray-50 dark:bg-[#15203c] p-4 rounded-md">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Prioritas</p>
                <span class="px-[8px] py-[3px] inline-block rounded-sm font-medium text-sm
                    {{ $tiket->prioritas == 'Mendesak' ? 'bg-red-100 text-red-600' : 'bg-gray-100 text-gray-600' }}">
                    {{ $tiket->prioritas }}
                </span>
            </div>
            <div class="bg-gray-50 dark:bg-[#15203c] p-4 rounded-md">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Jadwal Perbaikan</p>
                <p class="font-medium">
                    {{ $tiket->tgl_jadwal ? \Carbon\Carbon::parse($tiket->tgl_jadwal)->format('d M Y') : 'Belum dijadwalkan' }}
                </p>
            </div>
            <div class="bg-gray-50 dark:bg-[#15203c] p-4 rounded-md">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Surat PLN</p>
                @if ($tiket->perlu_surat_pln)
                    <span class="px-[8px] py-[3px] inline-block bg-orange-100 text-orange-600 rounded-sm font-medium text-sm border border-orange-200">
                        Diperlukan
                    </span>
                @else
                    <span class="px-[8px] py-[3px] inline-block bg-gray-100 text-gray-600 rounded-sm font-medium text-sm border border-gray-200">
                        Tidak Perlu
                    </span>
                @endif
            </div>
        </div>
        {{-- END: Status & Prioritas --}}
    </div>
    {{-- END: Header Card --}}

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-[25px]">
        {{-- START: Info Pengaduan --}}
        <div class="trezo-card bg-white dark:bg-[#0c1427] p-[20px] md:p-[25px] rounded-md">
            <div class="trezo-card-header mb-[20px]">
                <h6 class="font-semibold">Informasi Pengaduan</h6>
            </div>
            <div class="trezo-card-content">
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Nama Pelapor</p>
                        <p class="font-medium">{{ optional($tiket->pengaduan)->nama_pelapor ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">No. HP</p>
                        <p class="font-medium">{{ optional($tiket->pengaduan)->no_hp ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Tipe Aduan</p>
                        <p class="font-medium">
                            {{ optional($tiket->pengaduan)->tipe_aduan }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Deskripsi Lokasi</p>
                        <p class="font-medium italic">"{{ optional($tiket->pengaduan)->deskripsi_lokasi }}"</p>
                    </div>
                </div>
            </div>
        </div>
        {{-- END: Info Pengaduan --}}

        {{-- START: Info Lokasi & Tim --}}
        <div class="trezo-card bg-white dark:bg-[#0c1427] p-[20px] md:p-[25px] rounded-md">
            <div class="trezo-card-header mb-[20px]">
                <h6 class="font-semibold">Lokasi & Tim Teknisi</h6>
            </div>
            <div class="trezo-card-content">
                <div class="space-y-3">
                    {{-- Karena tabel Aset PJU belum dibuat, kita tampilkan data dari pengaduan dulu --}}
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Kode Aset / ID</p>
                        <p class="font-medium text-primary-500">
                            {{ $tiket->aset_pju_id ?? 'Aset Belum Di-link' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Koordinat</p>
                        <div class="flex items-center gap-2">
                            <span class="font-mono bg-gray-100 px-2 py-1 rounded text-xs">
                                {{ optional($tiket->pengaduan)->latitude ?? '0' }}, 
                                {{ optional($tiket->pengaduan)->longitude ?? '0' }}
                            </span>
                            <a href="https://maps.google.com/?q={{ optional($tiket->pengaduan)->latitude }},{{ optional($tiket->pengaduan)->longitude }}" 
                               target="_blank" class="text-blue-500 text-xs hover:underline">
                                Buka Map
                            </a>
                        </div>
                    </div>
                    <hr class="border-gray-200 dark:border-[#172036]">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Tim Teknisi</p>
                        {{-- Menggunakan optional karena relasi tim_lapangan dinonaktifkan sementara --}}
                        <p class="font-medium">
                            {{ optional($tiket->tim_lapangan)->nama_tim ?? 'Tim Teknisi 1 (Default)' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        {{-- END: Info Lokasi & Tim --}}
    </div>

    {{-- START: Log Tindakan Teknisi (Looping) --}}
    @if ($tiket->log_tindakan && $tiket->log_tindakan->count() > 0)
        <div class="trezo-card bg-white dark:bg-[#0c1427] mt-[25px] p-[20px] md:p-[25px] rounded-md">
            <div class="trezo-card-header mb-[20px]">
                <h6 class="font-semibold">Riwayat Tindakan Teknisi</h6>
            </div>
            <div class="trezo-card-content">
                @foreach($tiket->log_tindakan as $log)
                    <div class="border-b border-gray-100 dark:border-gray-700 pb-4 mb-4 last:border-0 last:pb-0 last:mb-0">
                        <div class="space-y-2">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Hasil Pengecekan</p>
                                <p class="font-medium">{{ $log->hasil_cek }}</p>
                            </div>
                            
                            @if($log->suku_cadang)
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Suku Cadang</p>
                                @php
                                    $sukuCadang = json_decode($log->suku_cadang, true) ?? [];
                                @endphp
                                @if(count($sukuCadang) > 0)
                                    <div class="bg-gray-50 dark:bg-[#15203c] p-3 rounded-md">
                                        <ul class="list-disc list-inside space-y-1 text-sm">
                                            @foreach ($sukuCadang as $item => $qty)
                                                <li><span class="font-semibold">{{ ucfirst($item) }}</span>: {{ $qty }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @else
                                    <span class="text-xs text-gray-400">- Tidak ada suku cadang -</span>
                                @endif
                            </div>
                            @endif

                            <div>
                                <p class="text-xs text-gray-400 mt-2">
                                    Dicatat pada: {{ \Carbon\Carbon::parse($log->created_at)->format('d M Y H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    {{-- END: Log Tindakan Teknisi --}}

@endsection