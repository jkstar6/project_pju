@extends('layouts.admin.master')

@section('title', 'Log Survey')

@push('styles')
    <link rel="stylesheet" href="{{ URL::asset('assets/admin/css/datatables-2.3.4/datatables.tailwindcss.css') }}">
    <style>
        #data-table td.text-center { vertical-align: middle; }
        #data-table td { padding: 12px 8px; }
        #data-table th { padding: 12px 8px; }
        .btn-icon { cursor: pointer; }
        .material-symbols-outlined { font-size: 18px !important; }

        /* Modal */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            padding: 16px;
        }
        .modal-overlay.active { display: flex; }
        
        .modal-content {
            width: 100%;
            max-width: 760px;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
        }
        
        .modal-header {
            padding: 16px 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .modal-body { padding: 20px; }
        
        .modal-footer {
            padding: 16px 20px;
            border-top: 1px solid #eee;
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .btn-map {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 6px 10px;
            background-color: #eff6ff;
            color: #2563eb;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 500;
            transition: all 0.2s;
        }
        .btn-map:hover {
            background-color: #dbeafe;
            color: #1d4ed8;
        }

        /* Badge Styling */
        .badge {
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 500;
            display: inline-block;
        }
        .badge-success {
            background-color: #dcfce7;
            color: #166534;
        }
        .badge-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }
        .badge-warning {
            background-color: #fef3c7;
            color: #92400e;
        }
    </style>
@endpush

@section('content')
    <div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
        <div class="trezo-card-header mb-[20px] md:mb-[25px] sm:flex sm:items-center sm:justify-between">
            <div class="trezo-card-title">
                <h5 class="mb-0">Data @yield('title') Harian</h5>
            </div>
            <div class="trezo-card-subtitle sm:flex sm:items-center">
                <button
                    type="button"
                    id="btnOpenCreate"
                    class="trezo-card-dropdown-btn py-[5px] md:py-[6.5px] px-[12px] md:px-[19px] bg-primary-500 text-white transition-all hover:bg-primary-400 rounded-md border border-primary-500 hover:border-primary-400">
                    <i class="ri-menu-add-line"></i>
                    Tambah Log Survey
                </button>
            </div>
        </div>

        <div class="trezo-card-content">
            <div class="table-responsive overflow-x-auto p-2">
                <table id="data-table" class="display stripe group" style="width:100%">
                    <thead class="bg-gray-100/75">
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
                                <td class="text-left">
                                    <strong class="text-primary-500">{{ $log->aset->kode_tiang ?? '-' }}</strong>
                                </td>
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
                                    @if($log->kondisi == 'Nyala')
                                        <span class="badge badge-success">{{ $log->kondisi }}</span>
                                    @elseif($log->kondisi == 'Mati')
                                        <span class="badge badge-danger">{{ $log->kondisi }}</span>
                                    @else
                                        <span class="badge badge-warning">{{ $log->kondisi }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="text-xs">{{ $log->keberadaan }}</span>
                                </td>
                                <td class="text-left">
                                    <div class="max-w-xs text-xs leading-relaxed">
                                        {{ $log->catatan_kerusakan ?? '-' }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="flex items-center gap-[10px] justify-center">
                                        <button type="button" class="btn-icon btn-edit text-warning-500" title="Edit">
                                            <i class="material-symbols-outlined">edit</i>
                                        </button>
                                        <form action="{{ route('log-survey.destroy', $log->id) }}" method="post" class="inline">
                                            @csrf @method('delete')
                                            <button type="submit" onclick="return confirm('Hapus data survey ini?')" class="btn-icon text-danger-500" title="Delete">
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
    <div id="modalLog" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <div style="font-weight:600;" id="modalTitle">Log Survey</div>
                <button type="button" class="btn-icon btn-close-modal">
                    <i class="material-symbols-outlined">close</i>
                </button>
            </div>

            <form id="formLog" method="POST" action="{{ route('log-survey.store') }}">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST">
                    
                    {{-- Hidden Inputs untuk Koordinat --}}
                    <input type="hidden" name="lat_input" id="lat_input">
                    <input type="hidden" name="long_input" id="long_input">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Aset PJU (Kode Tiang)</label>
                            <select name="aset_pju_id" id="aset_pju_id_select" class="w-full border border-gray-300 rounded-md px-3 py-2.5" required>
                                <option value="">-- Pilih Kode Tiang --</option>
                                @foreach($asets as $aset)
                                    <option value="{{ $aset->id }}" data-lat="{{ $aset->latitude }}" data-long="{{ $aset->longitude }}">
                                        {{ $aset->kode_tiang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Surveyor</label>
                            <select name="user_id" class="w-full border border-gray-300 rounded-md px-3 py-2.5" required>
                                <option value="">-- Pilih Surveyor --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Survey</label>
                            <input type="date" name="tgl_survey" class="w-full border border-gray-300 rounded-md px-3 py-2.5" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kondisi</label>
                            <select name="kondisi" class="w-full border border-gray-300 rounded-md px-3 py-2.5">
                                <option value="Nyala">Nyala</option>
                                <option value="Mati">Mati</option>
                                <option value="Rusak Fisik">Rusak Fisik</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Keberadaan</label>
                            <select name="keberadaan" class="w-full border border-gray-300 rounded-md px-3 py-2.5">
                                <option value="Ada">Ada</option>
                                <option value="Hilang">Hilang</option>
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Kerusakan</label>
                            <textarea name="catatan_kerusakan" rows="3" class="w-full border border-gray-300 rounded-md px-3 py-2.5" placeholder="Tulis catatan jika ada kerusakan..."></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-close-modal px-5 py-2.5 bg-gray-100 text-gray-700 rounded-md border border-gray-200 hover:bg-gray-200 transition">Batal</button>
                    <button type="submit" class="px-5 py-2.5 bg-primary-500 text-white rounded-md hover:bg-primary-600 transition">Simpan Data</button>
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