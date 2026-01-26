@extends('layouts.admin.master')

@section('title', 'Log Survey')

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">
    <style>
        #data-table td.text-center { vertical-align: middle; }
        .modal-overlay { display: none; }
        .modal-overlay.active { display: flex; }
        .btn-map {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 8px;
            background-color: #eff6ff;
            color: #2563eb;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 500;
            transition: all 0.2s;
        }
        .btn-map:hover {
            background-color: #dbeafe;
            color: #1d4ed8;
        }
    </style>
@endpush

@section('content')
    <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
        <div class="trezo-card-header mb-[20px] md:mb-[25px] sm:flex sm:items-center sm:justify-between">
            <div class="trezo-card-title">
                <h5 class="mb-0">Data @yield('title') Harian</h5>
            </div>
            <div class="mt-3 sm:mt-0">
                <button type="button" id="btnOpenCreate" class="inline-flex items-center gap-2 px-4 py-2 rounded-md bg-primary-500 text-white hover:bg-primary-600 transition">
                    <i class="material-symbols-outlined !text-md">add</i> Tambah
                </button>
            </div>
        </div>

        <div class="trezo-card-content">
            <div class="table-responsive overflow-x-auto p-2">
                <table id="data-table" class="display stripe group" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-left">Kode Tiang</th>
                            <th class="text-left">Surveyor</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Lokasi</th> {{-- Nama Header Rapi --}}
                            <th class="text-center">Kondisi</th>
                            <th class="text-center">Keberadaan</th>
                            <th class="text-left">Catatan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logSurvey as $index => $log)
                            <tr 
                                data-id="{{ $log->id }}"
                                data-aset_pju_id="{{ $log->aset_pju_id }}"
                                data-user_id="{{ $log->user_id }}"
                                data-tgl_survey="{{ $log->tgl_survey }}"
                                data-kondisi="{{ $log->kondisi }}"
                                data-keberadaan="{{ $log->keberadaan }}"
                                data-catatan="{{ $log->catatan_kerusakan }}"
                                data-lat="{{ $log->lat_input }}"
                                data-long="{{ $log->long_input }}"
                            >
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-left font-medium">{{ $log->aset->kode_tiang ?? '-' }}</td>
                                <td class="text-left">{{ $log->user->name ?? '-' }}</td>
                                <td class="text-center">{{ date('d M Y', strtotime($log->tgl_survey)) }}</td>
                                <td class="text-center">
                                    @if($log->lat_input && $log->long_input)
                                        <a href="https://www.google.com/maps?q={{ $log->lat_input }},{{ $log->long_input }}" 
                                           target="_blank" 
                                           class="btn-map">
                                            <i class="material-symbols-outlined !text-sm">location_on</i>
                                            Lihat Map
                                        </a>
                                    @else
                                        <span class="text-gray-400 text-xs">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="px-2 py-1 rounded text-xs {{ $log->kondisi == 'Nyala' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $log->kondisi }}
                                    </span>
                                </td>
                                <td class="text-center text-xs">{{ $log->keberadaan }}</td>
                                <td class="text-left text-xs">{{ $log->catatan_kerusakan ?? '-' }}</td>
                                <td class="text-center">
                                    <div class="flex items-center gap-2 justify-center">
                                        <button type="button" class="btn-edit text-blue-600 hover:text-blue-800">
                                            <i class="material-symbols-outlined">edit</i>
                                        </button>
                                        <form action="{{ route('log-survey.destroy', $log->id) }}" method="post" class="inline">
                                            @csrf @method('delete')
                                            <button type="submit" onclick="return confirm('Hapus data survey ini?')" class="text-red-500 hover:text-red-700">
                                                <i class="material-symbols-outlined">delete</i>
                                            </button>
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

    {{-- MODAL FORM --}}
    <div id="modalLog" class="modal-overlay fixed inset-0 z-[999] items-center justify-center bg-black/50 p-4">
        <div class="w-full max-w-2xl rounded-md bg-white dark:bg-[#0c1427] p-5 shadow-2xl">
            <h5 id="modalTitle" class="mb-4 font-bold text-lg border-b pb-2">Log Survey</h5>
            <form id="formLog" method="POST" action="{{ route('log-survey.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                
                {{-- Hidden Inputs untuk Koordinat --}}
                <input type="hidden" name="lat_input" id="lat_input">
                <input type="hidden" name="long_input" id="long_input">

                <div>
                    <label class="text-sm font-semibold text-gray-700">Aset PJU (Kode Tiang)</label>
                    <select name="aset_pju_id" id="aset_pju_id_select" class="w-full mt-1 border border-gray-300 rounded-md px-3 py-2 bg-white dark:bg-[#0c1427]" required>
                        <option value="">-- Pilih Kode Tiang --</option>
                        @foreach($asets as $aset)
                            <option value="{{ $aset->id }}" data-lat="{{ $aset->latitude }}" data-long="{{ $aset->longitude }}">
                                {{ $aset->kode_tiang }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-sm font-semibold text-gray-700">Surveyor</label>
                    <select name="user_id" class="w-full mt-1 border border-gray-300 rounded-md px-3 py-2 bg-white dark:bg-[#0c1427]" required>
                        <option value="">-- Pilih Surveyor --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-sm font-semibold text-gray-700">Tanggal Survey</label>
                    <input type="date" name="tgl_survey" class="w-full mt-1 border border-gray-300 rounded-md px-3 py-2 bg-white dark:bg-[#0c1427]" required>
                </div>

                <div>
                    <label class="text-sm font-semibold text-gray-700">Kondisi</label>
                    <select name="kondisi" class="w-full mt-1 border border-gray-300 rounded-md px-3 py-2 bg-white dark:bg-[#0c1427]">
                        <option value="Nyala">Nyala</option>
                        <option value="Mati">Mati</option>
                        <option value="Rusak Fisik">Rusak Fisik</option>
                    </select>
                </div>

                <div>
                    <label class="text-sm font-semibold text-gray-700">Keberadaan</label>
                    <select name="keberadaan" class="w-full mt-1 border border-gray-300 rounded-md px-3 py-2 bg-white dark:bg-[#0c1427]">
                        <option value="Ada">Ada</option>
                        <option value="Hilang">Hilang</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="text-sm font-semibold text-gray-700">Catatan Kerusakan</label>
                    <textarea name="catatan_kerusakan" rows="2" class="w-full mt-1 border border-gray-300 rounded-md px-3 py-2 bg-white dark:bg-[#0c1427]" placeholder="Tulis catatan jika ada kerusakan..."></textarea>
                </div>

                <div class="md:col-span-2 flex justify-end gap-2 mt-4">
                    <button type="button" class="btn-close-modal px-5 py-2 bg-gray-100 text-gray-700 rounded-md border border-gray-200 hover:bg-gray-200">Batal</button>
                    <button type="submit" class="px-5 py-2 bg-primary-500 text-white rounded-md hover:bg-primary-600 shadow-md">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ URL::asset('assets/admin/js/datatables-2.3.4/dataTables.js') }}"></script>
    <script>
        $(document).ready(function() {
            const dt = $('#data-table').DataTable({
                responsive: true,
                order: [[3, 'desc']] // Sort by date desc
            });

            const modal = document.getElementById('modalLog');
            const form = document.getElementById('formLog');

            function toggleModal(show = true) {
                modal.classList.toggle('active', show);
                if(!show) form.reset();
            }

            // Tambah
            document.getElementById('btnOpenCreate').addEventListener('click', () => {
                document.getElementById('modalTitle').innerText = 'Tambah Log Survey';
                document.getElementById('formMethod').value = 'POST';
                form.action = "{{ route('log-survey.store') }}";
                toggleModal(true);
            });

            // Edit
            document.addEventListener('click', function(e) {
                const btnEdit = e.target.closest('.btn-edit');
                if (btnEdit) {
                    const tr = btnEdit.closest('tr');
                    const id = tr.dataset.id;
                    
                    document.getElementById('modalTitle').innerText = 'Edit Log Survey';
                    document.getElementById('formMethod').value = 'PUT';
                    form.action = `/log-survey/${id}`; 

                    form.aset_pju_id.value = tr.dataset.aset_pju_id;
                    form.user_id.value = tr.dataset.user_id;
                    form.tgl_survey.value = tr.dataset.tgl_survey;
                    form.kondisi.value = tr.dataset.kondisi;
                    form.keberadaan.value = tr.dataset.keberadaan;
                    form.catatan_kerusakan.value = tr.dataset.catatan;
                    form.lat_input.value = tr.dataset.lat;
                    form.long_input.value = tr.dataset.long;

                    toggleModal(true);
                }

                if (e.target.closest('.btn-close-modal') || e.target === modal) {
                    toggleModal(false);
                }
            });

            // Auto-Copy Coordinates from Selected Asset
            document.getElementById('aset_pju_id_select').addEventListener('change', function() {
                const selected = this.options[this.selectedIndex];
                const lat = selected.getAttribute('data-lat');
                const long = selected.getAttribute('data-long');

                document.getElementById('lat_input').value = lat || '';
                document.getElementById('long_input').value = long || '';
            });
        });
    </script>
@endpush