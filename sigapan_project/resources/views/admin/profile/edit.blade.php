@extends('layouts.admin.master')

@section('title', 'Profile Saya')

@section('breadcrumb')
    {{ Breadcrumbs::render('profile') }}
@endsection

@section('content')
{{-- START : Update Biodata --}}
<div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
    <div class="trezo-card-content">

        @php
            $profile_photo = Auth::user()?->userProfile?->profile_photo
            ? URL::asset('storage/' . Auth::user()->userProfile->profile_photo)
            : URL::asset('assets/admin/images/users/default.jpg');
        @endphp

        <form action="{{ route('profile.update') }}" method="POST" id="generalInformationForm" enctype="multipart/form-data">
            @csrf
            @method('patch')

            {{-- HEADER LAYOUT (Avatar kiri, form kanan) --}}
            <div class="grid grid-cols-1 md:grid-cols-12 gap-[20px] md:gap-[30px] items-start">

                {{-- AVATAR --}}
                <div class="md:col-span-3 flex flex-col items-center md:items-start">

                    {{-- WRAPPER BIAR BULAT & GA GEPENG --}}
                    <div class="w-[140px] h-[140px] md:w-[160px] md:h-[160px] rounded-full overflow-hidden border-[4px] border-primary-500 shadow-lg bg-white dark:bg-[#0c1427]">
                        <img
                            src="{{ $profile_photo }}"
                            alt="user-image"
                            class="w-full h-full object-cover object-center"
                        >
                    </div>

                    <p class="mt-4 ml-5 text-2xl text-gray-600 dark:text-gray-300 text-center md:text-left font-medium">
                        {{ ucwords(implode(', ', $user->roles->pluck('name')->toArray())) }}
                    </p>

                   
                </div>

                {{-- FORM --}}
                <div class="md:col-span-9">

                    {{-- START: Name & Email --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-[20px] md:gap-[25px]">
                        <div>
                            <label class="mb-[10px] text-black dark:text-white font-medium block">
                                Name
                            </label>
                            <input type="text" name="name"
                                class="h-[45px] rounded-md text-black dark:text-white border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[17px] block w-full outline-0 transition-all placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:border-primary-500"
                                value="{{ $user->name }}" required>
                        </div>

                        <div>
                            <label class="mb-[10px] text-black dark:text-white font-medium block">
                                Email
                            </label>
                            <input type="email" name="email"
                                class="h-[45px] rounded-md text-black dark:text-white border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[17px] block w-full outline-0 transition-all placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:border-primary-500"
                                value="{{ $user->email }}" readonly>
                        </div>
                    </div>
                    {{-- END: Name & Email --}}

                    {{-- START: Profile Photo --}}
                    <label class="mb-[10px] text-black dark:text-white font-medium block mt-[20px] md:mt-[25px]">
                        Foto Profile
                    </label>

                    <div id="fileUploader">
                        <div
                            class="relative flex items-center justify-center overflow-hidden rounded-md py-[60px] px-[20px] border-2 border-dashed border-gray-200 dark:border-[#172036] bg-gray-50/50 dark:bg-[#0c1427] hover:border-primary-400 transition">
                            <div class="flex items-center justify-center">
                                <div
                                    class="w-[40px] h-[40px] border border-gray-100 dark:border-[#15203c] flex items-center justify-center rounded-md text-primary-500 text-lg ltr:mr-[12px] rtl:ml-[12px] bg-white dark:bg-[#0c1427]">
                                    <i class="ri-upload-2-line"></i>
                                </div>
                                <p class="leading-[1.5] text-center md:text-left">
                                    <strong class="text-black dark:text-white">Click to upload</strong><br>
                                    <span class="text-gray-500 dark:text-gray-400">file gambar (jpg/png)</span>
                                </p>
                            </div>

                            <input type="file" name="profile_photo" id="fileInput"
                                class="absolute top-0 left-0 right-0 bottom-0 rounded-md z-[1] opacity-0 cursor-pointer"
                                accept="image/*">
                        </div>
                        <ul id="fileList"></ul>
                    </div>
                    {{-- END: Profile Photo --}}

                    {{-- BTN SAVE (kanan) --}}
                    <div class="mt-[20px] md:mt-[25px] flex justify-end">
                        <button type="submit"
                            class="font-medium inline-flex items-center gap-2 transition-all rounded-md md:text-md py-[10px] md:py-[12px] px-[20px] md:px-[22px] bg-primary-500 text-white hover:bg-primary-400">
                            <i class="material-symbols-outlined">check</i>
                            Update Profile
                        </button>
                    </div>

                </div>
            </div>
        </form>

    </div>
</div>
{{-- END : Update Biodata --}}

{{-- START : Update Password --}}
<div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
    <div class="trezo-card-content">
        <form action="{{ route('password.update') }}" id="updatePasswordForm" method="POST">
            @csrf
            @method('put')

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-[20px] md:gap-[25px]">
                <div>
                    <label class="mb-[10px] text-black dark:text-white font-medium block">
                        Current Password
                    </label>
                    <input type="password" name="current_password"
                        class="h-[45px] rounded-md text-black dark:text-white border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[17px] block w-full outline-0 transition-all placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:border-primary-500"
                        placeholder="Type current password ..." required>
                </div>

                <div>
                    <label class="mb-[10px] text-black dark:text-white font-medium block">
                        New Password
                    </label>
                    <input type="password" name="password"
                        class="h-[45px] rounded-md text-black dark:text-white border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[17px] block w-full outline-0 transition-all placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:border-primary-500"
                        placeholder="Type new password ..." required>
                </div>

                <div>
                    <label class="mb-[10px] text-black dark:text-white font-medium block">
                        Confirm New Password
                    </label>
                    <input type="password" name="password_confirmation"
                        class="h-[45px] rounded-md text-black dark:text-white border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[17px] block w-full outline-0 transition-all placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:border-primary-500"
                        placeholder="Confirm new password ..." required>
                </div>
            </div>

            <div class="mt-[20px] md:mt-[25px]">
                <button type="submit"
                    class="font-medium inline-flex items-center gap-2 transition-all rounded-md md:text-md py-[10px] md:py-[12px] px-[20px] md:px-[22px] bg-red-500 text-white hover:bg-red-400">
                    <i class="material-symbols-outlined">key</i>
                    Update Password
                </button>
            </div>
        </form>
    </div>
</div>
{{-- END : Update Password --}}

{{-- START: Delete Account --}}
<div class="trezo-card bg-white dark:bg-[#0c1427] mb-[25px] p-[20px] md:p-[25px] rounded-md">
    <div class="trezo-card-content">
        <form action="{{ route('profile.destroy') }}" id="deleteAccountForm" method="POST">
            @csrf
            @method('delete')

            <div class="grid grid-cols-1 sm:grid-cols-1 gap-[20px] md:gap-[25px]">
                <div>
                    <label class="mb-[10px] text-black dark:text-white font-medium block">
                        Current Password for Confirmation
                    </label>
                    <input type="password" name="password"
                        class="h-[45px] rounded-md text-black dark:text-white border border-gray-200 dark:border-[#172036] bg-white dark:bg-[#0c1427] px-[17px] block w-full outline-0 transition-all placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:border-primary-500"
                        placeholder="Type current password for confirmation if you need delete account ..." required>
                </div>
            </div>

            <div class="mt-[20px] md:mt-[25px]">
                <button type="submit" id="delete-account-btn"
                    class="font-medium inline-flex items-center gap-2 transition-all rounded-md md:text-md py-[10px] md:py-[12px] px-[20px] md:px-[22px] bg-red-500 text-white hover:bg-red-400">
                    <i class="material-symbols-outlined">delete</i>
                    Delete Account
                </button>
            </div>
        </form>
    </div>
</div>
{{-- END: Delete Account --}}
@endsection

@push('scripts')
<script>
    function submitFormGeneralInformation() {
        let form = document.getElementById('generalInformationForm');

        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda ingin memperbarui informasi profile anda?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, perbarui!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

    function submitFormUpdatePassword() {
        let form = document.getElementById('updatePasswordForm');

        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda ingin memperbarui kata sandi?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, perbarui!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

    document.getElementById('delete-account-btn').addEventListener('click', function(event) {
        event.preventDefault();

        let form = document.getElementById('deleteAccountForm');

        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Tindakan ini tidak dapat dibatalkan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus akun saya!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>
@endpush
