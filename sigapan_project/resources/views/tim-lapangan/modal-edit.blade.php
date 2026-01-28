{{-- Trigger Modal Edit Hidden Button (Optional, used by JS) --}}
<button id="modal-edit-toggle" type="button" class="hidden"></button>

{{-- START: Modal --}}
<div class="modal-edit z-[999] fixed transition-all inset-0 overflow-x-hidden overflow-y-auto" id="modal-edit">
    <div class="popup-dialog flex transition-all items-center justify-center min-h-screen px-4 sm:px-6">
        <div class="trezo-card w-full max-w-[95%] sm:max-w-[720px] md:max-w-[900px] lg:max-w-[1100px] bg-white dark:bg-[#0c1427] p-[20px] md:p-[25px] rounded-md">
            
            {{-- Header --}}
            <div class="trezo-card-header bg-gray-50 dark:bg-[#15203c] mb-[20px] md:mb-[25px] flex items-center justify-between -mx-[20px] md:-mx-[25px] -mt-[20px] md:-mt-[25px] p-[20px] md:p-[25px] rounded-t-md">
                <div class="trezo-card-title">
                    <h5 class="mb-0" id="modal-title">Edit Data Tim Lapangan</h5>
                </div>
                <div class="trezo-card-subtitle">
                    <button type="button" class="btn-close-edit text-[23px] transition-all leading-none text-black dark:text-white hover:text-primary-500">
                        <i class="material-symbols-outlined">close</i>
                    </button>
                </div>
            </div>

            {{-- Form Edit --}}
            <form id="form-edit" method="POST">
                @csrf
                @method('PUT')
                <div class="trezo-card-content pb-[20px] md:pb-[25px]">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-[20px] md:gap-[25px]">
                        
                        {{-- Nama Tim --}}
                        <div>
                            <label class="mb-[12px] font-medium block">Nama Tim <strong class="text-red-500">*</strong></label>
                            <input type="text" name="nama_tim" id="edit_nama_tim" class="h-[45px] rounded-md text-black dark:text-white border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[17px] block w-full outline-0 transition-all focus:border-primary-500" required>
                        </div>

                        {{-- Kategori --}}
                        <div>
                            <label class="mb-[12px] font-medium block">Kategori Tim <strong class="text-red-500">*</strong></label>
                            <select name="kategori" id="edit_kategori" class="select2 h-[45px] rounded-md border border-gray-200" required>
                                <option value="Teknisi">Teknisi</option>
                                <option value="Surveyor">Surveyor</option>
                            </select>
                        </div>

                        {{-- Ketua Tim --}}
                        <div>
                            <label class="mb-[12px] font-medium block">Ketua Tim</label>
                            <select name="leader_id" id="edit_leader_id" class="select2 h-[45px] rounded-md border border-gray-200">
                                <option value="">- Pilih Ketua Tim -</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Jumlah Personel --}}
                        <div>
                            <label class="mb-[12px] font-medium block">Jumlah Personel <strong class="text-red-500">*</strong></label>
                            <input type="number" name="jumlah_personel" id="edit_jumlah_personel" min="1" class="h-[45px] rounded-md text-black dark:text-white border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[17px] block w-full outline-0 transition-all focus:border-primary-500" required>
                        </div>

                    </div>
                </div>

                <div class="trezo-card-footer flex items-center justify-between -mx-[20px] md:-mx-[25px] px-[20px] md:px-[25px] pt-[20px] md:pt-[25px] border-t border-gray-100 dark:border-[#172036]">
                    <button type="button" class="btn-close-edit inline-block py-[10px] px-[30px] bg-danger-500 text-white transition-all hover:bg-danger-400 rounded-md">Batal</button>
                    <button type="submit" class="inline-block py-[10px] px-[30px] bg-primary-500 text-white transition-all hover:bg-primary-400 rounded-md">Simpan Perubahan</button>
                </div>
            </form>

        </div>
    </div>
</div>

{{-- Pastikan class utama adalah 'modal-overlay' agar CSS active bekerja --}}
<div class="modal-overlay" id="modal-edit">
    <div class="popup-dialog w-full max-w-[95%] sm:max-w-[700px] bg-white dark:bg-[#0c1427] p-5 rounded-md relative">
        
        {{-- Header --}}
        <div class="flex items-center justify-between mb-5 border-b pb-4 dark:border-[#172036]">
            <h5 class="text-lg font-semibold text-gray-800 dark:text-white">Edit Data Tim Lapangan</h5>
            <button type="button" class="btn-close-edit text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        {{-- Form Edit --}}
        <form id="form-edit" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                
                {{-- Nama Tim --}}
                <div class="md:col-span-2">
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Nama Tim <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_tim" id="edit_nama_tim" class="w-full h-[45px] rounded-md border border-gray-300 dark:border-[#172036] px-3 bg-white dark:bg-[#0c1427] dark:text-white" required>
                </div>

                {{-- Kategori --}}
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Kategori <span class="text-red-500">*</span></label>
                    <select name="kategori" id="edit_kategori" class="select2 w-full" required>
                        <option value="Teknisi">Teknisi</option>
                        <option value="Surveyor">Surveyor</option>
                    </select>
                </div>

                {{-- Ketua Tim --}}
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Ketua Tim</label>
                    <select name="leader_id" id="edit_leader_id" class="select2 w-full">
                        <option value="">- Pilih Ketua Tim -</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Jumlah Personel --}}
                <div class="md:col-span-2">
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah Personel <span class="text-red-500">*</span></label>
                    <input type="number" name="jumlah_personel" id="edit_jumlah_personel" min="1" class="w-full h-[45px] rounded-md border border-gray-300 dark:border-[#172036] px-3 bg-white dark:bg-[#0c1427] dark:text-white" required>
                </div>
            </div>

            {{-- Footer --}}
            <div class="flex justify-end gap-2 pt-4 border-t dark:border-[#172036]">
                <button type="button" class="btn-close-edit px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Batal</button>
                <button type="submit" class="px-4 py-2 bg-primary-500 text-white rounded-md hover:bg-primary-600">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>