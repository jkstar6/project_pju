@extends('layouts.admin.master')

@section('title', 'Verifikasi Aduan Masuk')

@section('styles')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('breadcrumb')
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="/dashboard" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                    Dashboard
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-3 h-3 text-gray-400 mx-1" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-width="2" d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Aduan Masuk</span>
                </div>
            </li>
        </ol>
    </nav>
@endsection

@section('content')

    <div class="container mx-auto px-4 py-8">

        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Verifikasi Aduan Masuk</h2>
            <p class="text-sm text-gray-500">
                Daftar aduan masyarakat yang perlu diverifikasi dan ditindaklanjuti.
            </p>
        </div>

        <div class="bg-white rounded-xl shadow-sm overflow-hidden border">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">Pelapor</th>
                            <th class="px-6 py-4">No HP</th>
                            <th class="px-6 py-4">Tipe Aduan</th>
                            <th class="px-6 py-4">Lokasi</th>
                            <th class="px-6 py-4">Deskripsi</th>
                            <th class="px-6 py-4 text-center">Foto</th>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Catatan</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse($aduan as $item)
                            <tr class="hover:bg-gray-50 transition duration-150 align-top">
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $loop->iteration }}</td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="font-bold text-gray-900">{{ $item->nama_pelapor }}</span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                                    {{ $item->no_hp }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded border">
                                        {{ $item->tipe_aduan }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-xs leading-relaxed text-gray-600">
                                    {{ $item->deskripsi_lokasi }}
                                    <a href="https://maps.google.com/?q={{ $item->latitude }},{{ $item->longitude }}"
                                        target="_blank" class="text-blue-500 hover:underline block mt-1 text-[10px]">
                                        Buka Peta
                                    </a>
                                </td>

                                <td class="px-6 py-4 text-xs leading-relaxed text-gray-600 bg-gray-50/50 italic">
                                    "{{ $item->deskripsi_lokasi }}"
                                </td>

                                <td class="px-6 py-4 text-center">
                                    @if ($item->foto_lapangan)
                                        <a href="{{ $item->foto_lapangan }}" target="_blank"
                                            class="inline-flex flex-col items-center justify-center p-2 text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition">
                                            <span class="text-[10px] font-medium">Lihat</span>
                                        </a>
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-xs">
                                    {{ $item->created_at }}
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($item->status_verifikasi === 'Pending')
                                        <span
                                            class="inline-flex items-center bg-yellow-100 text-yellow-800 text-xs px-2.5 py-0.5 rounded-full">
                                            Pending
                                        </span>
                                    @elseif($item->status_verifikasi === 'Diterima')
                                        <span
                                            class="inline-flex items-center bg-green-100 text-green-800 text-xs px-2.5 py-0.5 rounded-full">
                                            Diterima
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center bg-red-100 text-red-800 text-xs px-2.5 py-0.5 rounded-full">
                                            Ditolak
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-xs">
                                    {{ $item->catatan_admin ?? '-' }}
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button
                                            onclick="actionVerifikasi({{ $item->id }}, '{{ $item->nama_pelapor }}')"
                                            class="p-2 text-white bg-green-500 hover:bg-green-600 rounded-lg">
                                            ✔
                                        </button>
                                        <button onclick="actionTolak({{ $item->id }}, '{{ $item->nama_pelapor }}')"
                                            class="p-2 text-white bg-yellow-500 hover:bg-yellow-600 rounded-lg">
                                            ✖
                                        </button>
                                        <button onclick="actionHapus({{ $item->id }}, '{{ $item->nama_pelapor }}')"
                                            class="p-2 text-white bg-red-500 hover:bg-red-600 rounded-lg">
                                            🗑
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="px-6 py-8 text-center text-gray-500">
                                    Belum ada data aduan masuk.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <div class="px-6 py-4 bg-gray-50 text-sm text-gray-500">
                Menampilkan {{ count($aduan) }} data
            </div>
        </div>
    </div>

    {{-- SWEETALERT --}}
    <script>
        function actionVerifikasi(id, nama) {
            Swal.fire({
                title: 'Verifikasi Aduan',
                text: 'Berikan catatan untuk ' + nama,
                input: 'textarea',
                showCancelButton: true,
                confirmButtonText: 'Verifikasi'
            })
        }

        function actionTolak(id, nama) {
            Swal.fire({
                title: 'Tolak Aduan',
                text: 'Alasan penolakan untuk ' + nama,
                input: 'textarea',
                showCancelButton: true,
                confirmButtonText: 'Tolak'
            })
        }

        function actionHapus(id, nama) {
            Swal.fire({
                title: 'Hapus Aduan?',
                text: 'Data dari ' + nama + ' akan dihapus',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus'
            })
        }
    </script>

@endsection
