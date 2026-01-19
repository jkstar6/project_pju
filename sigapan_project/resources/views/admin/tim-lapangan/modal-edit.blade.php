@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

{{-- Trigger Modal Edit --}}
<button id="modal-edit-toggle" type="button" class="hidden"></button>

{{-- START: Modal --}}
<div class="modal-edit z-[999] fixed transition-all inset-0 overflow-x-hidden overflow-y-auto" id="modal-edit">
    <div class="popup-dialog flex transition-all items-center justify-center min-h-screen px-4 sm:px-6">
        <div class="trezo-card w-full max-w-[95%] sm:max-w-[720px] md:max-w-[900px] lg:max-w-[1100px] bg-white dark:bg-[#0c1427] p-[20px] md:p-[25px] rounded-md">
            
            {{-- START: Modal Header --}}
            <div class="trezo-card-header bg-gray-50 dark:bg-[#15203c] mb-[20px] md:mb-[25px] flex items-center justify-between -mx-[20px] md:-mx-[25px] -mt-[20px] md:-mt-[25px] p-[20px] md:p-[25px] rounded-t-md">
                <div class="trezo-card-title">
                    <h5 class="mb-0" id="modal-title">
                        Edit Data Tim Lapangan
                    </h5>
                </div>
                <div class="trezo-card-subtitle">
                    <button type="button" class="text-[23px] transition-all leading-none text-black dark:text-white hover:text-primary-500" id="modal-edit-toggle">
                        <i class="ri-close-fill"></i>
                    </button>
                </div>
            </div>
            {{-- END: Modal Header --}}

            {{-- START: Form Edit --}}
            <form id="form-edit" method="POST">
                @csrf
                @method('put')
                {{-- START: Modal Body --}}
                <div class="trezo-card-content pb-[20px] md:pb-[25px]">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-[20px] md:gap-[25px]">
                        {{-- START: Nama Tim --}}
                        <div>
                            <label class="mb-[12px] font-medium block">
                                Nama Tim
                                <strong class="text-red-500">*</strong>
                            </label>
                            <input type="text" name="nama_tim" id="nama_tim" class="h-[45px] rounded-md text-black dark:text-white border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[17px] block w-full outline-0 transition-all placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:border-primary-500" 
                                placeholder="Contoh: Tim Teknisi 1" required>
                        </div>
                        {{-- END: Nama Tim --}}

                        {{-- START: Kategori --}}
                        <div>
                            <label class="mb-[12px] font-medium block">
                                Kategori Tim
                                <strong class="text-red-500">*</strong>
                            </label>
                            <select name="kategori" id="kategori" class="select2 h-[45px] rounded-md border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[13px] block w-full outline-0 cursor-pointer transition-all focus:border-primary-500" required>
                                <option value="">- Pilih Kategori -</option>
                                <option value="Teknisi">Teknisi</option>
                                <option value="Surveyor">Surveyor</option>
                            </select>
                        </div>
                        {{-- END: Kategori --}}

                        {{-- START: Ketua Tim --}}
                        <div>
                            <label class="mb-[12px] font-medium block">
                                Ketua Tim
                            </label>
                            <select name="leader_id" id="leader_id" class="select2 h-[45px] rounded-md border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[13px] block w-full outline-0 cursor-pointer transition-all focus:border-primary-500">
                                <option value="">- Pilih Ketua Tim -</option>
                                {{-- TODO: Replace with actual users data from database --}}
                                <option value="2">Budi Santoso</option>
                                <option value="3">Siti Aminah</option>
                                <option value="4">Ahmad Fauzi</option>
                                <option value="5">Dewi Sartika</option>
                                <option value="6">Hendra Wijaya</option>
                            </select>
                        </div>
                        {{-- END: Ketua Tim --}}

                        {{-- START: Jumlah Personel --}}
                        <div>
                            <label class="mb-[12px] font-medium block">
                                Jumlah Personel
                                <strong class="text-red-500">*</strong>
                            </label>
                            <input type="number" name="jumlah_personel" id="jumlah_personel" min="1" class="h-[45px] rounded-md text-black dark:text-white border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[17px] block w-full outline-0 transition-all placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:border-primary-500" 
                                placeholder="Masukkan jumlah personel" required>
                        </div>
                        {{-- END: Jumlah Personel --}}
                    </div>
                </div>
                {{-- END: Modal Body --}}
                {{-- START: Modal Footer --}}
                <div class="trezo-card-footer flex items-center justify-between -mx-[20px] md:-mx-[25px] px-[20px] md:px-[25px] pt-[20px] md:pt-[25px] border-t border-gray-100 dark:border-[#172036]">
                    <button class="inline-block py-[10px] px-[30px] bg-danger-500 text-white transition-all hover:bg-danger-400 rounded-md border border-danger-500 hover:border-danger-400" type="button" id="modal-edit-toggle">
                        Batal
                    </button>
                    <button class="inline-block py-[10px] px-[30px] bg-primary-500 text-white transition-all hover:bg-primary-400 rounded-md border border-primary-500 hover:border-primary-400 ltr:mr-[11px] rtl:ml-[11px] mb-[15px]" 
                    type="submit">
                        Simpan Perubahan
                    </button>
                </div>
                {{-- END: Modal Footer --}}
            </form>
            {{-- END: Form Edit --}}

        </div>
    </div>
</div>
{{-- END: Modal --}}

@push('scripts')
    <script>
        // Edit Popup Toggle
        const editPopupID = document.getElementById("modal-edit");
        if (editPopupID) {
            var buttons = document.querySelectorAll("#modal-edit-toggle");
            buttons.forEach(function(button) {
                button.addEventListener("click", function() {
                    var divElement = document.getElementById("modal-edit");
                    divElement.classList.toggle("active");
                });
            });
        }
    </script>

    {{-- Start Select 2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    {{-- End Select 2 --}}
    
    <!-- Start Edit Tim (Modal) -->
    <script>
        $(document).on('click', '.btn-modal-edit-tim', function(e) {
            e.preventDefault();

            // Trigger button to open modal
            $('#modal-edit-toggle').click();

            // Tim Id
            var timId = $(this).data('id');
            var urlFormAction = $(this).data('url-action');
            var urlGetData = $(this).data('url-get');
            
            // Send request to get tim data
            $.ajax({
                url: urlGetData,
                type: 'GET',
                success: function(response) {
                    // Modal title
                    $('#modal-title').text('Edit Data Tim - ' + response.nama_tim);
                    // Set form action
                    $('#form-edit').attr('action', urlFormAction);
                    // Set value to form inputs
                    $('#form-edit').find('#nama_tim').val(response.nama_tim);
                    $('#form-edit').find('#kategori').val(response.kategori).trigger('change');
                    $('#form-edit').find('#leader_id').val(response.leader_id).trigger('change');
                    $('#form-edit').find('#jumlah_personel').val(response.jumlah_personel);
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal memuat data.',
                    });
                }
            });
        });        
    </script>
    <!-- End Edit Tim (Modal) -->
@endpush