{{-- START: Modal --}}
<div class="modal-add z-[999] fixed transition-all inset-0 overflow-x-hidden overflow-y-auto" id="modal-add">
    <div class="popup-dialog flex transition-all items-center justify-center min-h-screen px-4 sm:px-6">
        <div class="trezo-card w-full max-w-[95%] sm:max-w-[720px] md:max-w-[900px] lg:max-w-[1100px] bg-white dark:bg-[#0c1427] p-[20px] md:p-[25px] rounded-md">
            
            {{-- START: Modal Header --}}
            <div class="trezo-card-header bg-gray-50 dark:bg-[#15203c] mb-[20px] md:mb-[25px] flex items-center justify-between -mx-[20px] md:-mx-[25px] -mt-[20px] md:-mt-[25px] p-[20px] md:p-[25px] rounded-t-md">
                <div class="trezo-card-title">
                    <h5 class="mb-0">
                        Tambah Tim Lapangan Baru
                    </h5>
                </div>
                <div class="trezo-card-subtitle">
                    <button type="button" class="text-[23px] transition-all leading-none text-black dark:text-white hover:text-primary-500" id="modal-add-toggle">
                        <i class="ri-close-fill"></i>
                    </button>
                </div>
            </div>
            {{-- END: Modal Header --}}

            {{-- START: Form Add --}}
            <form action="{{ route('admin.tim-lapangan.store') }}" method="POST">
                @csrf
                {{-- START: Modal Body --}}
                <div class="trezo-card-content pb-[20px] md:pb-[25px]">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-[20px] md:gap-[25px]">
                        {{-- START: Nama Tim --}}
                        <div>
                            <label class="mb-[12px] font-medium block">
                                Nama Tim
                                <strong class="text-red-500">*</strong>
                            </label>
                            <input type="text" name="nama_tim" class="h-[45px] rounded-md text-black dark:text-white border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[17px] block w-full outline-0 transition-all placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:border-primary-500" 
                                placeholder="Contoh: Tim Teknisi 1" required>
                        </div>
                        {{-- END: Nama Tim --}}

                        {{-- START: Kategori --}}
                        <div>
                            <label class="mb-[12px] font-medium block">
                                Kategori Tim
                                <strong class="text-red-500">*</strong>
                            </label>
                            <select name="kategori" class="select2 h-[45px] rounded-md border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[13px] block w-full outline-0 cursor-pointer transition-all focus:border-primary-500" required>
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
                            <select name="leader_id" class="select2 h-[45px] rounded-md border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[13px] block w-full outline-0 cursor-pointer transition-all focus:border-primary-500">
                                <option value="">- Pilih Ketua Tim -</option>
                                {{-- TODO: Replace with actual users data from database --}}
                                {{-- @foreach($users as $user) --}}
                                <option value="2">Budi Santoso</option>
                                <option value="3">Siti Aminah</option>
                                <option value="4">Ahmad Fauzi</option>
                                <option value="5">Dewi Sartika</option>
                                <option value="6">Hendra Wijaya</option>
                                {{-- @endforeach --}}
                            </select>
                        </div>
                        {{-- END: Ketua Tim --}}

                        {{-- START: Jumlah Personel --}}
                        <div>
                            <label class="mb-[12px] font-medium block">
                                Jumlah Personel
                                <strong class="text-red-500">*</strong>
                            </label>
                            <input type="number" name="jumlah_personel" min="1" class="h-[45px] rounded-md text-black dark:text-white border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[17px] block w-full outline-0 transition-all placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:border-primary-500" 
                                placeholder="Masukkan jumlah personel" required>
                        </div>
                        {{-- END: Jumlah Personel --}}
                    </div>
                </div>
                {{-- END: Modal Body --}}
                {{-- START: Modal Footer --}}
                <div class="trezo-card-footer flex items-center justify-between -mx-[20px] md:-mx-[25px] px-[20px] md:px-[25px] pt-[20px] md:pt-[25px] border-t border-gray-100 dark:border-[#172036]">
                    <button class="inline-block py-[10px] px-[30px] bg-danger-500 text-white transition-all hover:bg-danger-400 rounded-md border border-danger-500 hover:border-danger-400" type="button" id="modal-add-toggle">
                        Batal
                    </button>
                    <button type="submit" class="inline-block py-[10px] px-[30px] bg-primary-500 text-white transition-all hover:bg-primary-400 rounded-md border border-primary-500 hover:border-primary-400 ltr:mr-[11px] rtl:ml-[11px] mb-[15px]">
                        Simpan Data
                    </button>
                </div>
                {{-- END: Modal Footer --}}
            </form>
            {{-- END: Form Add --}}

        </div>
    </div>
</div>
{{-- END: Modal --}}

@push('scripts')
<script>
    // Add New Popup Toggle
    const addNewPopupID = document.getElementById("modal-add");
    if (addNewPopupID) {
        var buttons = document.querySelectorAll("#modal-add-toggle");
        buttons.forEach(function(button) {
            button.addEventListener("click", function() {
                var divElement = document.getElementById("modal-add");
                divElement.classList.toggle("active");
            });
        });
    }
</script>
@endpush