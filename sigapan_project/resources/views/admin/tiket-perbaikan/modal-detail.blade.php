@extends('layouts.admin.master')

@section('title', 'Detail Tiket Perbaikan')

@section('breadcrumb')
    {{-- {{ Breadcrumbs::render('tiket-perbaikan-detail', $tiket['id']) }} --}}
@endsection

@section('content')
    {{-- START: Header Card --}}
    <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
        <div class="trezo-card-header mb-[20px] md:mb-[25px] flex items-center justify-between">
            <div class="trezo-card-title">
                <h5 class="!mb-2">
                    Tiket: <span class="text-primary-500">{{ $tiket['no_tiket'] }}</span>
                </h5>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Dibuat pada: {{ date('d M Y H:i', strtotime($tiket['created_at'])) }}
                </p>
            </div>
            <div>
                <a href="{{ route('admin.tiket-perbaikan.index') }}" class="inline-block py-[10px] px-[20px] bg-gray-500 text-white transition-all hover:bg-gray-400 rounded-md border border-gray-500 hover:border-gray-400">
                    <i class="ri-arrow-left-line"></i> Kembali
                </a>
            </div>
        </div>

        {{-- START: Status & Prioritas --}}
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-5">
            <div class="bg-gray-50 dark:bg-[#15203c] p-4 rounded-md">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Status Tindakan</p>
                <span class="px-[8px] py-[3px] inline-block rounded-sm font-medium text-sm
                    @if($tiket['status_tindakan'] == 'Menunggu') bg-orange-100 dark:bg-[#15203c] text-orange-600
                    @elseif($tiket['status_tindakan'] == 'Proses') bg-blue-100 dark:bg-[#15203c] text-blue-600
                    @else bg-primary-50 dark:bg-[#15203c] text-primary-500
                    @endif">
                    {{ $tiket['status_tindakan'] }}
                </span>
            </div>
            <div class="bg-gray-50 dark:bg-[#15203c] p-4 rounded-md">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Prioritas</p>
                <span class="px-[8px] py-[3px] inline-block rounded-sm font-medium text-sm
                    {{ $tiket['prioritas'] == 'Mendesak' ? 'bg-red-100 dark:bg-[#15203c] text-red-600' : 'bg-gray-100 dark:bg-[#15203c] text-gray-600' }}">
                    {{ $tiket['prioritas'] }}
                </span>
            </div>
            <div class="bg-gray-50 dark:bg-[#15203c] p-4 rounded-md">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Jadwal Perbaikan</p>
                <p class="font-medium">
                    {{ $tiket['tgl_jadwal'] ? date('d M Y', strtotime($tiket['tgl_jadwal'])) : 'Belum dijadwalkan' }}
                </p>
            </div>
            <div class="bg-gray-50 dark:bg-[#15203c] p-4 rounded-md">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Surat PLN</p>
                @if($tiket['perlu_surat_pln'])
                    <span class="px-[8px] py-[3px] inline-block bg-orange-100 dark:bg-[#15203c] text-orange-600 rounded-sm font-medium text-sm">
                        Diperlukan
                    </span>
                @else
                    <span class="px-[8px] py-[3px] inline-block bg-gray-100 dark:bg-[#15203c] text-gray-600 rounded-sm font-medium text-sm">
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
                        <p class="font-medium">{{ $tiket['pengaduan']['nama_pelapor'] }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">No. HP</p>
                        <p class="font-medium">{{ $tiket['pengaduan']['no_hp'] }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Tipe Aduan</p>
                        <p class="font-medium">
                            {{ $tiket['pengaduan']['tipe_aduan'] == 'lampu_mati' ? 'Lampu Mati' : 'Permohonan PJU Baru' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Judul</p>
                        <p class="font-medium">{{ $tiket['pengaduan']['judul'] }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Deskripsi</p>
                        <p class="font-medium">{{ $tiket['pengaduan']['deskripsi'] }}</p>
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
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Kode Aset</p>
                        <p class="font-medium text-primary-500">{{ $tiket['kode_aset'] }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Lokasi</p>
                        <p class="font-medium">{{ $tiket['lokasi_aset'] }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Koordinat</p>
                        <p class="font-medium">{{ $tiket['pengaduan']['latitude'] }}, {{ $tiket['pengaduan']['longitude'] }}</p>
                    </div>
                    <hr class="border-gray-200 dark:border-[#172036]">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Tim Teknisi</p>
                        <p class="font-medium">{{ $tiket['nama_tim'] ?? 'Belum ditugaskan' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Ketua Tim</p>
                        <p class="font-medium">{{ $tiket['ketua_tim'] ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
        {{-- END: Info Lokasi & Tim --}}
    </div>

    {{-- START: Log Tindakan Teknisi --}}
    @if(isset($tiket['log_tindakan']) && $tiket['log_tindakan'])
        <div class="trezo-card bg-white dark:bg-[#0c1427] mt-[25px] p-[20px] md:p-[25px] rounded-md">
            <div class="trezo-card-header mb-[20px]">
                <h6 class="font-semibold">Hasil Tindakan Teknisi</h6>
            </div>
            <div class="trezo-card-content">
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Hasil Pengecekan</p>
                        <p class="font-medium">{{ $tiket['log_tindakan']['hasil_cek'] }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Suku Cadang yang Digunakan</p>
                        @php
                            $sukuCadang = json_decode($tiket['log_tindakan']['suku_cadang'], true);
                        @endphp
                        <div class="bg-gray-50 dark:bg-[#15203c] p-3 rounded-md">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach($sukuCadang as $item => $qty)
                                    <li>{{ ucfirst($item) }}: {{ $qty }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Waktu Tindakan</p>
                        <p class="font-medium">{{ date('d M Y H:i', strtotime($tiket['log_tindakan']['created_at'])) }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- END: Log Tindakan Teknisi --}}
@endsection