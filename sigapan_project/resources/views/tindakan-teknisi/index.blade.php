@extends('layouts.admin.master')

@section('title', 'Tindakan Teknisi')

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">
    <style>
        #data-table td { vertical-align: top; }
        .modal-overlay { display: none; }
        .modal-overlay.active { display: flex; }
    </style>
@endpush

@section('breadcrumb')
    <nav class="flex mb-5" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600">Dashboard</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-3 h-3 text-gray-400 mx-1" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-width="2" d="m1 9 4-4-4-4"/></svg>
                    <span class="ml-1 text-sm font-medium text-gray-500">@yield('title')</span>
                </div>
            </li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md shadow-sm">
        <div class="trezo-card-header mb-[20px] md:mb-[25px] sm:flex sm:items-center sm:justify-between border-b pb-4">
            <h5 class="mb-0 text-lg font-bold">Log @yield('title')</h5>
            <button type="button" id="btn-open-create" class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-primary-500 text-white hover:bg-primary-600 transition text-sm font-medium">
                <span class="material-symbols-outlined">add</span> Input Tindakan Baru
            </button>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md text-sm border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        <div class="trezo-card-content">
            <div class="table-responsive overflow-x-auto p-2">
                <table id="data-table" class="display stripe group" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-left">No Tiket & Identitas Lokasi</th>
                            <th class="text-left">Hasil Pengecekan</th>
                            <th class="text-left">Suku Cadang</th>
                            <th class="text-center">Bukti</th> {{-- KOLOM DIKEMBALIKAN --}}
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tindakan as $item)
                            <tr data-id="{{ $item->id }}" data-tiket="{{ $item->tiket_perbaikan_id }}" data-hasil="{{ $item->hasil_cek }}" data-suku="{{ json_encode($item->suku_cadang) }}">
                                <td class="text-center font-bold text-gray-400">{{ $loop->iteration }}</td>
                                
                                <td class="text-left">
                                    <div class="flex flex-col">
                                        <strong class="text-primary-500 text-sm">Tiket #{{ $item->tiket->id ?? $item->tiket_perbaikan_id }}</strong>
                                        
                                        @if($item->tiket && $item->tiket->aset)
                                            <span class="text-[11px] text-gray-700 font-bold uppercase mt-1">{{ $item->tiket->aset->kode_tiang }}</span>
                                            <small class="text-[10px] text-gray-500 italic line-clamp-1">{{ $item->tiket->aset->lokasi_panel }}</small>
                                        @elseif($item->tiket && $item->tiket->pengaduan)
                                            {{-- Fallback jika aset_pju_id NULL --}}
                                            <span class="text-[11px] text-orange-600 font-bold mt-1 uppercase">Lokasi Aduan:</span>
                                            <small class="text-[10px] text-gray-400 italic line-clamp-2">"{{ $item->tiket->pengaduan->deskripsi_lokasi }}"</small>
                                        @else
                                            <span class="text-[10px] text-red-400 italic">Lokasi Tidak Terdeteksi</span>
                                        @endif
                                    </div>
                                </td>

                                <td class="text-left">
                                    <p class="text-xs text-gray-600 italic">"{{ Str::limit($item->hasil_cek, 80) }}"</p>
                                </td>

                                <td class="text-left">
                                    @if($item->suku_cadang)
                                        <div class="flex flex-wrap gap-1">
                                            @foreach($item->suku_cadang as $sc)
                                                <span class="bg-gray-100 text-[9px] px-2 py-0.5 rounded border border-gray-200">{{ $sc['nama'] }} ({{ $sc['jumlah'] }})</span>
                                            @endforeach
                                        </div>
                                    @else <span class="text-gray-300 text-[10px]">-</span> @endif
                                </td>

                                {{-- KOLOM BUKTI FOTO DIKEMBALIKAN --}}
                                <td class="text-center">
                                    @if($item->foto_bukti_selesai)
                                        <a href="{{ asset('storage/'.$item->foto_bukti_selesai) }}" target="_blank" class="text-blue-500 hover:text-blue-700 transition">
                                            <i class="material-symbols-outlined !text-md">image</i>
                                        </a>
                                    @else
                                        <span class="text-gray-300 text-xs">-</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <div class="flex items-center gap-2 justify-center">
                                        <button class="btn-edit text-blue-500 transition"><i class="material-symbols-outlined">edit</i></button>
                                        <form action="{{ route('tindakan-teknisi.destroy', $item->id) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Hapus?')" class="text-red-400"><i class="material-symbols-outlined">delete</i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL TETAP SAMA SEPERTI SEBELUMNYA --}}
    <div id="modalTindakan" class="modal-overlay fixed inset-0 z-[999] items-center justify-center bg-black/50 p-4">
        <div class="w-full max-w-2xl rounded-lg bg-white p-6 shadow-2xl max-h-[90vh] overflow-y-auto">
            <div class="flex items-center justify-between mb-4 border-b pb-3">
                <h5 id="modalTitle" class="text-xl font-bold">Input Tindakan Teknisi</h5>
                <button type="button" class="btn-close-modal text-gray-400"><i class="material-symbols-outlined">close</i></button>
            </div>
            <form id="formTindakan" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <div class="grid grid-cols-1 gap-5">
                    <div>
                        <label class="block text-sm font-semibold mb-1">Pilih Tiket Perbaikan Aktif</label>
                        <select name="tiket_perbaikan_id" id="in_tiket_id" class="w-full border rounded-md px-3 py-2 bg-white" required>
                            <option value="">-- Pilih Tiket --</option>
                            @foreach($tikets as $tkt)
                                <option value="{{ $tkt->id }}">
                                    #{{ $tkt->id }} | 
                                    @if($tkt->aset) {{ $tkt->aset->kode_tiang }}
                                    @else Aduan: {{ Str::limit($tkt->pengaduan->deskripsi_lokasi, 30) }} 
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1">Hasil Pengecekan</label>
                        <textarea name="hasil_cek" id="in_hasil_cek" rows="3" class="w-full border rounded-md px-3 py-2" required></textarea>
                    </div>
                    <div class="border p-4 rounded-md bg-gray-50">
                        <label class="block text-sm font-bold mb-3">Suku Cadang</label>
                        <div id="sparepart-container" class="space-y-2 mb-3"></div>
                        <button type="button" id="add-sparepart" class="text-xs text-blue-600 font-bold">+ Tambah Item</button>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold mb-1">Upload Foto Bukti</label>
                        <input type="file" name="foto_bukti_selesai" class="w-full border rounded-md px-3 py-2 text-sm">
                    </div>
                </div>
                <div class="flex justify-end gap-3 mt-8">
                    <button type="button" class="btn-close-modal px-6 py-2 rounded-md bg-gray-100">Batal</button>
                    <button type="submit" class="px-6 py-2 rounded-md bg-primary-500 text-white shadow-md">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.js') }}"></script>
<script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.tailwindcss.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#data-table').DataTable({ responsive: true });
        const modal = document.getElementById('modalTindakan');
        let scIndex = 0;

        function addRow(nama = '', jumlah = '') {
            let html = `
                <div class="flex gap-2 items-center sparepart-row">
                    <input type="text" name="suku_cadang[${scIndex}][nama]" value="${nama}" placeholder="Barang" class="flex-1 border rounded px-3 py-1.5 text-sm">
                    <input type="number" name="suku_cadang[${scIndex}][jumlah]" value="${jumlah}" placeholder="Jml" class="w-24 border rounded px-3 py-1.5 text-sm">
                    <button type="button" class="remove-row text-red-500"><i class="material-symbols-outlined">delete</i></button>
                </div>`;
            $('#sparepart-container').append(html);
            scIndex++;
        }

        $('#add-sparepart').click(() => addRow());
        $(document).on('click', '.remove-row', function() { $(this).closest('.sparepart-row').remove(); });

        $('#btn-open-create').click(function() {
            $('#modalTitle').text('Input Tindakan Baru');
            $('#formMethod').val('POST');
            $('#formTindakan').attr('action', "{{ route('tindakan-teknisi.store') }}");
            $('#formTindakan')[0].reset();
            modal.classList.add('active');
            addRow(); 
        });

        $(document).on('click', '.btn-edit', function() {
            const tr = $(this).closest('tr').data();
            $('#modalTitle').text('Edit Log Tindakan');
            $('#formMethod').val('PUT');
            $('#formTindakan').attr('action', `/tindakan-teknisi/${tr.id}`);
            $('#in_tiket_id').val(tr.tiket);
            $('#in_hasil_cek').val(tr.hasil);
            modal.classList.add('active');
            if (tr.suku) { tr.suku.forEach(item => addRow(item.nama, item.jumlah)); } 
            else { addRow(); }
        });

        $('.btn-close-modal').click(() => { modal.classList.remove('active'); $('#sparepart-container').empty(); scIndex = 0; });
    });
</script>
@endpush