<div class="modal-overlay" id="modal-edit">
    <div class="popup-dialog flex items-center justify-center min-h-screen px-4 w-full">
        <div class="trezo-card w-full max-w-[700px] bg-white dark:bg-[#0c1427] p-6 rounded-md shadow-lg">
            
            <div class="flex justify-between mb-4 border-b pb-4 dark:border-[#172036]">
                <h5 class="text-lg font-bold text-gray-800 dark:text-white">Edit Tim Lapangan</h5>
                <button type="button" class="btn-close-edit text-gray-500 hover:text-red-500"><i class="material-symbols-outlined">close</i></button>
            </div>

            <form id="form-edit" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    
                    {{-- Nama Tim --}}
                    <div>
                        <label class="block mb-2 font-medium dark:text-white">Nama Tim <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_tim" id="edit_nama_tim" class="w-full h-11 px-3 rounded border dark:bg-[#0c1427] dark:border-[#172036] dark:text-white" required>
                    </div>

                    {{-- Kategori --}}
                    <div>
                        <label class="block mb-2 font-medium dark:text-white">Kategori <span class="text-red-500">*</span></label>
                        <select name="kategori" id="edit_kategori" class="select2 w-full" required>
                            <option value="Teknisi">Teknisi</option>
                            <option value="Surveyor">Surveyor</option>
                        </select>
                    </div>

                    {{-- Ketua Tim --}}
                    <div>
                        {{-- PERBAIKAN: Tambah bintang merah --}}
                        <label class="block mb-2 font-medium dark:text-white">Ketua Tim <span class="text-red-500">*</span></label>
                        {{-- PERBAIKAN: Tambah attribute required --}}
                        <select name="leader_id" id="edit_leader_id" class="select2 w-full" required>
                            <option value="">- Pilih Ketua Tim -</option>
                        </select>
                        <small class="text-xs text-gray-500 mt-1">*Menyesuaikan kategori yang dipilih</small>
                    </div>

                    {{-- Jumlah Personel --}}
                    <div>
                        <label class="block mb-2 font-medium dark:text-white">Jumlah Personel <span class="text-red-500">*</span></label>
                        <input type="number" name="jumlah_personel" id="edit_jumlah_personel" min="1" class="w-full h-11 px-3 rounded border dark:bg-[#0c1427] dark:border-[#172036] dark:text-white" required>
                    </div>

                </div>

                <div class="flex justify-end gap-2 border-t pt-4 dark:border-[#172036]">
                    <button type="button" class="btn-close-edit px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-primary-500 text-white rounded hover:bg-primary-600">Simpan Perubahan</button>
                </div>
            </form>

        </div>
    </div>
</div>