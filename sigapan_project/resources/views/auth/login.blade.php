@extends('layouts.admin.auth')

@section('title', 'Masuk')

@section('content')
    <div class="min-h-screen w-full grid grid-cols-1 lg:grid-cols-2 bg-white dark:bg-[#0a0e19]">
        
        <div class="hidden lg:block relative h-screen sticky top-0 overflow-hidden bg-gray-100 dark:bg-[#15203c]">
            <img src="{{ URL::asset('/assets/admin/images/sign-in.jpg') }}" 
                 alt="sign-in-image" 
                 class="w-full h-full object-cover">
                 
            <div class="absolute inset-0 bg-black/10 dark:bg-black/30"></div>
        </div>

        <div class="relative flex flex-col justify-center w-full min-h-screen px-4 py-12 sm:px-6 lg:px-20 xl:px-24">
            
            <button type="button" class="absolute top-6 right-6 transition-all text-[#fe7a36] hover:scale-110" id="light-dark-toggle">
                <i class="material-symbols-outlined !text-[24px]">
                    light_mode
                </i>
            </button>

            <div class="w-full max-w-md mx-auto lg:max-w-lg">
                
                <div class="mb-10">
                    <img src="{{ URL::asset('/assets/admin/images/logo/logo-big.svg') }}" 
                         alt="logo" 
                         class="inline-block dark:hidden w-[50px] md:w-[60px] h-auto mb-4">
                    
                    <img src="{{ URL::asset('/assets/admin/images/white-logo-big.svg') }}" 
                         alt="logo" 
                         class="hidden dark:inline-block w-[50px] md:w-[60px] h-auto mb-4">

                    <h1 class="font-bold text-2xl md:text-3xl text-gray-900 dark:text-white mb-2">
                        Selamat datang di {{ $prefs_composer['title'] }}!
                    </h1>
                    <p class="text-gray-500 dark:text-gray-400 text-sm md:text-base">
                        Silahkan masuk dengan akun yang telah anda buat.
                    </p>
                </div>

                @if (session('status'))
                    <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 text-green-700 text-sm font-medium">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 dark:bg-red-900/20 dark:border-red-800 text-red-600 dark:text-red-400 text-sm">
                        <div class="font-bold mb-1 flex items-center gap-2">
                            <i class="bi bi-x-octagon-fill"></i> Error:
                        </div>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-900 dark:text-gray-200 mb-2">
                            Email Address
                        </label>
                        <input name="email" id="email" type="email" required 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0c1427] text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-all placeholder:text-gray-400" 
                            placeholder="Masukkan email anda">
                    </div>

                    <div class="relative" id="passwordHideShow">
                        <label for="password" class="block text-sm font-medium text-gray-900 dark:text-gray-200 mb-2">
                            Password
                        </label>
                        <input name="password" id="password" type="password" required 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-[#0c1427] text-gray-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none transition-all placeholder:text-gray-400" 
                            placeholder="Masukkan password anda">
                        
                        <button type="button" id="toggleButton" 
                            class="absolute right-4 top-[42px] text-gray-500 dark:text-gray-400 hover:text-primary-500 transition-colors">
                            <i class="ri-eye-off-line text-lg"></i>
                        </button>
                    </div>

                    <button type="submit" 
                        class="w-full flex justify-center items-center gap-2 py-3 px-4 border border-transparent rounded-lg text-sm font-semibold text-white bg-primary-500 hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all shadow-lg hover:shadow-primary-500/30">
                        <i class="material-symbols-outlined text-[20px]">login</i>
                        Sign In
                    </button>

                </form>

                </div>
        </div>
    </div>
@endsection