@extends('layouts.admin.master')

@section('title', 'Daftar Aduan Masuk')

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
            'judul' => 'Jalan Berlubang di Mawar',
            'status' => 'Masuk',
            'tanggal' => '2024-01-19',
        ],
        [
            'id' => 2,
            'nama' => 'Siti Aminah',
            'judul' => 'Lampu PJU Mati Total',
            'status' => 'Proses',
            'tanggal' => '2024-01-18',
        ],
        [
            'id' => 3,
            'nama' => 'Ahmad Dani',
            'judul' => 'Sampah Menumpuk di Pasar',
            'status' => 'Selesai',
            'tanggal' => '2024-01-15',
        ],
        [
            'id' => 4,
            'nama' => 'Rina Wati',
            'judul' => 'Saluran Air Mampet',
            'status' => 'Masuk',
            'tanggal' => '2024-01-14',
        ],
    ];
@endphp

<div class="container mx-auto px-4 py-8">
    
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Aduan Masuk</h2>
            <p class="text-sm text-gray-500">Kelola semua laporan yang masuk dari masyarakat.</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                    <tr>
                        <th scope="col" class="px-6 py-4">No</th>
                        <th scope="col" class="px-6 py-4">Pelapor</th>
                        <th scope="col" class="px-6 py-4">Judul Aduan</th>
                        <th scope="col" class="px-6 py-4">Tanggal</th>
                        <th scope="col" class="px-6 py-4">Status</th>
                        <th scope="col" class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($aduan as $item)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold shrink-0">
                                    {{ substr($item['nama'], 0, 1) }}
                                </div>
                                <span class="font-medium text-gray-900">{{ $item['nama'] }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-800">{{ $item['judul'] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item['tanggal'] }}</td>
                        <td class="px-6 py-4">
                            @if($item['status'] == 'Masuk')
                                <span class="inline-flex items-center bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full border border-blue-200">
                                    <span class="w-2 h-2 me-1 bg-blue-500 rounded-full"></span>
                                    Baru
                                </span>
                            @elseif($item['status'] == 'Proses')
                                <span class="inline-flex items-center bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full border border-yellow-200">
                                    <span class="w-2 h-2 me-1 bg-yellow-500 rounded-full"></span>
                                    Proses
                                </span>
                            @else
                                <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full border border-green-200">
                                    <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                                    Selesai
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="#" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Lihat Detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                                <button class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus" onclick="return confirm('Apakah anda yakin?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
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
@endsection