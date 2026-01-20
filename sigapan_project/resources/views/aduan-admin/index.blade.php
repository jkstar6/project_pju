@extends('layouts.admin.master')

@section('title', 'Verifikasi Aduan Masuk')

{{-- CDN SweetAlert2 --}}
@section('styles')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('breadcrumb')
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="/dashboard" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">Dashboard</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Aduan Masuk</span>
                </div>
            </li>
        </ol>
    </nav>
@endsection

@section('content')

{{-- DATA DUMMY --}}
@php
    $aduan = [
        [
            'id' => 1,
            'nama' => 'Budi Santoso',
            'nomor_hp' => '0812-3456-7890',
            'tipe' => 'Lampu Mati',
            'lokasi' => 'Jl. Mawar No. 10, RT 02/RW 05',
            'deskripsi' => 'Dekat toko baju "Jaya Abadi", sekitar 50 meter ke barat dari pos kamling.',
            'foto' => 'https://via.placeholder.com/600x400?text=Bukti+Foto+1',
            'status' => 'Pending',
            'catatan' => null,
            'tanggal' => '2024-01-20',
            'updated_at' => '2024-01-20',
        ],
        [
            'id' => 2,
            'nama' => 'Siti Aminah',
            'nomor_hp' => '0857-1122-3344',
            'tipe' => 'Permohonan PJU Baru',
            'lokasi' => 'Gang Kelinci, Area Pemukiman Baru',
            'deskripsi' => 'Masuk gang sebelah masjid besar, lurus terus sampai mentok sawah. Lokasi gelap rawan begal.',
            'foto' => 'https://via.placeholder.com/600x400?text=Bukti+Foto+2',
            'status' => 'Diterima',
            'catatan' => 'Akan dijadwalkan survei minggu depan.',
            'tanggal' => '2024-01-18',
            'updated_at' => '2024-01-19',
        ],
        [
            'id' => 3,
            'nama' => 'Ahmad Dani',
            'nomor_hp' => '0813-9988-7766',
            'tipe' => 'Lampu Mati',
            'lokasi' => 'Jl. Pasar Baru, Tiang PJU-045',
            'deskripsi' => 'Tiang nomor 45 depan pintu masuk pasar sisi selatan.',
            'foto' => 'https://via.placeholder.com/600x400?text=Bukti+Foto+3',
            'status' => 'Ditolak',
            'catatan' => 'Lokasi bukan kewenangan Pemda (Area Privat).',
            'tanggal' => '2024-01-15',
            'updated_at' => '2024-01-16',
        ],
    ];
@endphp

<div class="container mx-auto px-4 py-8">
    
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Verifikasi Aduan Masuk</h2>
            <p class="text-sm text-gray-500">Daftar aduan masyarakat yang perlu diverifikasi dan ditindaklanjuti.</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b whitespace-nowrap">
                    <tr>
                        <th scope="col" class="px-6 py-4">No</th>
                        <th scope="col" class="px-6 py-4">Pelapor</th>
                        <th scope="col" class="px-6 py-4">No. HP</th>
                        <th scope="col" class="px-6 py-4">Tipe Aduan</th>
                        
                        <th scope="col" class="px-6 py-4 min-w-[200px]">
                            <div class="flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Titik Lokasi (Maps)
                            </div>
                        </th>
                        
                        <th scope="col" class="px-6 py-4 min-w-[250px] bg-gray-100">
                            <div class="flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                Patokan / Deskripsi
                            </div>
                        </th>

                        <th scope="col" class="px-6 py-4 text-center">Foto</th>
                        <th scope="col" class="px-6 py-4">Tanggal</th>
                        <th scope="col" class="px-6 py-4">Status</th>
                        <th scope="col" class="px-6 py-4 min-w-[200px]">Catatan Admin</th>
                        <th scope="col" class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($aduan as $item)
                    <tr class="hover:bg-gray-50 transition duration-150 align-top">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap"><span class="font-bold text-gray-900">{{ $item['nama'] }}</span></td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $item['nomor_hp'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded border border-gray-200">{{ $item['tipe'] }}</span>
                        </td>
                        <td class="px-6 py-4 text-xs leading-relaxed text-gray-600">
                            <span class="font-medium text-gray-900 block mb-1">Titik Koordinat:</span>
                            {{ $item['lokasi'] }}
                            <a href="https://maps.google.com/?q={{ $item['lokasi'] }}" target="_blank" class="text-blue-500 hover:underline block mt-1 text-[10px] flex items-center gap-1">
                                Buka Peta <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            </a>
                        </td>
                        <td class="px-6 py-4 text-xs leading-relaxed text-gray-600 bg-gray-50/50 italic border-l border-r border-gray-100">"{{ $item['deskripsi'] }}"</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ $item['foto'] }}" target="_blank" class="inline-flex flex-col items-center justify-center p-2 text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition group">
                                <svg class="w-5 h-5 mb-1 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="text-[10px] font-medium">Lihat</span>
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-col text-xs">
                                <span class="text-gray-900 font-medium">{{ $item['tanggal'] }}</span>
                                <span class="text-gray-400 text-[10px]">Update: {{ $item['updated_at'] }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($item['status'] == 'Pending')
                                <span class="inline-flex items-center bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full border border-yellow-200">
                                    <span class="w-2 h-2 me-1 bg-yellow-400 rounded-full animate-pulse"></span> Pending
                                </span>
                            @elseif($item['status'] == 'Diterima')
                                <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full border border-green-200">
                                    <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span> Diterima
                                </span>
                            @elseif($item['status'] == 'Ditolak')
                                <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full border border-red-200">
                                    <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span> Ditolak
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-xs">
                            @if($item['catatan'])
                                <span class="text-gray-600 italic border-l-2 border-gray-300 pl-2 block">"{{ $item['catatan'] }}"</span>
                            @else
                                <span class="text-gray-300 text-center block">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            <div class="flex items-center justify-center gap-2">
                                <button onclick="actionVerifikasi({{ $item['id'] }}, '{{ $item['nama'] }}')" class="p-2 text-white bg-green-500 hover:bg-green-600 rounded-lg transition shadow-sm" title="Verifikasi">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </button>
                                <button onclick="actionTolak({{ $item['id'] }}, '{{ $item['nama'] }}')" class="p-2 text-white bg-yellow-500 hover:bg-yellow-600 rounded-lg transition shadow-sm" title="Tolak">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                                <button onclick="actionHapus({{ $item['id'] }}, '{{ $item['nama'] }}')" class="p-2 text-white bg-red-500 hover:bg-red-600 rounded-lg transition shadow-sm" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="px-6 py-8 text-center text-gray-500">
                            <p>Belum ada data aduan masuk.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between bg-gray-50">
            <span class="text-sm text-gray-500">Menampilkan {{ count($aduan) }} data</span>
            <div class="flex gap-2">
                <button class="px-3 py-1 text-sm bg-white border border-gray-300 rounded text-gray-400 cursor-not-allowed" disabled>Previous</button>
                <button class="px-3 py-1 text-sm bg-white border border-gray-300 rounded text-gray-400 cursor-not-allowed" disabled>Next</button>
            </div>
        </div>
    </div>
</div>

{{-- SCRIPT SWEETALERT (LOGIKA POPUP DIPERBARUI) --}}
<script>
    // 1. FUNGSI VERIFIKASI (Sekarang Menggunakan Input Catatan)
    function actionVerifikasi(id, nama) {
        Swal.fire({
            title: 'Verifikasi Aduan',
            text: "Berikan catatan tindak lanjut untuk " + nama,
            icon: 'question', // Icon tanda tanya
            input: 'textarea', // MEMUNCULKAN KOTAK TEXT
            inputLabel: 'Catatan Admin (Untuk User)',
            inputPlaceholder: 'Contoh: Laporan valid, tim teknis akan meluncur besok...',
            showCancelButton: true,
            confirmButtonColor: '#10B981', // Hijau
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, Verifikasi!',
            cancelButtonText: 'Batal',
            inputValidator: (value) => {
                if (!value) {
                    return 'Anda harus menuliskan catatan verifikasi!'
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // result.value berisi teks yang diketik admin
                Swal.fire(
                    'Terverifikasi!',
                    'Status aduan diubah menjadi Diterima.<br>Catatan: ' + result.value,
                    'success'
                )
            }
        })
    }

    // 2. FUNGSI TOLAK (Sama seperti sebelumnya)
    function actionTolak(id, nama) {
        Swal.fire({
            title: 'Tolak Aduan',
            text: "Berikan alasan penolakan untuk " + nama,
            icon: 'warning', // Icon peringatan
            input: 'textarea',
            inputLabel: 'Alasan Penolakan',
            inputPlaceholder: 'Contoh: Lokasi tidak ditemukan...',
            showCancelButton: true,
            confirmButtonColor: '#F59E0B', // Kuning/Orange
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Tolak Aduan',
            inputValidator: (value) => {
                if (!value) {
                    return 'Anda harus menuliskan alasan penolakan!'
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Ditolak!',
                    'Aduan ditolak karena: ' + result.value,
                    'success'
                )
            }
        })
    }

    // 3. FUNGSI HAPUS (Sama seperti sebelumnya)
    function actionHapus(id, nama) {
        Swal.fire({
            title: 'Hapus Data?',
            text: "Data aduan dari " + nama + " akan dihapus permanen.",
            icon: 'error', // Icon merah
            showCancelButton: true,
            confirmButtonColor: '#EF4444', // Merah
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Dihapus!',
                    'Data berhasil dihapus.',
                    'success'
                )
            }
        })
    }
</script>

@endsection