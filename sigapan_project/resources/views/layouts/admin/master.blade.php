<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Styles --}}
    @include('layouts.admin.partials.styles')


    <title>@yield('title') | {{ $prefs_composer['title'] }}</title>

    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    @vite('resources/css/app.css')
</head>

<body>
    {{-- Start: Sidebar --}}
    @include('layouts.admin.partials.sidebar')
    {{-- End: Sidebar --}}

    {{-- Start: Topbar --}}
    @include('layouts.admin.partials.topbar')
    {{-- End: Topbar --}}

    <div class="main-content transition-all flex flex-col overflow-hidden min-h-screen" id="main-content">
        <!-- Start: Breadcrumb -->
        <div class="mb-[25px] md:flex items-center justify-between">
            <h5 class="mb-0">
                @yield('title')
            </h5>
            <ol class="breadcrumb mt-[12px] md:mt-0">
                @yield('breadcrumb')
            </ol>
        </div>
        <!-- End : Breadcrumb -->

        {{-- Start : Main Content --}}

        @yield('content')
        <div class="container">
            <div class="flex flex-col gap-6 sm:gap-8 mb-20">
                <div class="flex flex-col items-center text-center gap-2 sm:gap-3">
                    <div class="grid grid-cols-12 gap-3">
                        <div class="col-span-12 sm:col-span-3 lg:col-span-3">
                            <a href="#"
                                class="block group rounded-3xl sm:rounded-[32px] md:rounded-[40px] bg-neutral-100 overflow-hidden h-full transition-all duration-300 hover:bg-neutral-200 hover:shadow-lg active:scale-95">
                                <div class="flex flex-col h-full">
                                    <div class="flex-1 flex items-center justify-center pt-4 sm:pt-6 px-30">
                                        <span
                                            class="text-3xl sm:text-4xl font-bold text-neutral-800 group-hover:text-primary-600 transition-colors">
                                            6
                                        </span>
                                    </div>

                                    <div class="p-4 sm:p-5 mt-auto">
                                        <h4 class="text-sm sm:text-base font-medium text-neutral-600 leading-tight">
                                            Aduan Masuk
                                        </h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3">
                            <a href="#"
                                class="block group rounded-3xl sm:rounded-[32px] md:rounded-[40px] bg-neutral-100 overflow-hidden h-full transition-all duration-300 hover:bg-neutral-200 hover:shadow-lg active:scale-95">
                                <div class="flex flex-col h-full">
                                    <div class="flex-1 flex items-center justify-center pt-4 sm:pt-6 px-30">
                                        <span
                                            class="text-3xl sm:text-4xl font-bold text-neutral-800 group-hover:text-primary-600 transition-colors">
                                            9
                                        </span>
                                    </div>

                                    <div class="p-4 sm:p-5 mt-auto">
                                        <h4 class="text-sm sm:text-base font-medium text-neutral-600 leading-tight">
                                            Tiket Perbaikan
                                        </h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3">
                            <a href="#"
                                class="block group rounded-3xl sm:rounded-[32px] md:rounded-[40px] bg-neutral-100 overflow-hidden h-full transition-all duration-300 hover:bg-neutral-200 hover:shadow-lg active:scale-95">
                                <div class="flex flex-col h-full">
                                    <div class="flex-1 flex items-center justify-center pt-4 sm:pt-6  px-30">
                                        <span
                                            class="text-3xl sm:text-4xl font-bold text-neutral-800 group-hover:text-primary-600 transition-colors">
                                            6
                                        </span>
                                    </div>

                                    <div class="p-4 sm:p-5 mt-auto">
                                        <h4 class="text-sm sm:text-base font-medium text-neutral-600 leading-tight">
                                            Log Survey
                                        </h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-span-12 sm:col-span-6 lg:col-span-3">
                            <a href="#"
                                class="block group rounded-3xl sm:rounded-[32px] md:rounded-[40px] bg-neutral-100 overflow-hidden h-full transition-all duration-300 hover:bg-neutral-200 hover:shadow-lg active:scale-95">
                                <div class="flex flex-col h-full">
                                    <div class="flex-1 flex items-center justify-center pt-4 sm:pt-6 px-30">
                                        <span
                                            class="text-3xl sm:text-4xl font-bold text-neutral-800 group-hover:text-primary-600 transition-colors">
                                            9
                                        </span>
                                    </div>

                                    <div class="p-4 sm:p-5 mt-auto">
                                        <h4 class="text-sm sm:text-base font-medium text-neutral-600 leading-tight">
                                            Progres pengerjaan
                                        </h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- End : Main Content --}}

        {{-- Start: Footer --}}
        @include('layouts.admin.partials.footer')
        {{-- End: Footer --}}
    </div>
    {{-- Scripts --}}
    @include('layouts.admin.partials.scripts')
    {{-- SweetAlert2 --}}
    @include('layouts.admin.partials.alerts-script')
</body>

</html>
