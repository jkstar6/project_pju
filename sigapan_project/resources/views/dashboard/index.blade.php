@extends('layouts.admin.master')

@section('title', 'Dashboard')

@section('breadcrumb')
    {{ Breadcrumbs::render('dashboard') }}
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        {{-- Card 1: Aduan Masuk --}}
        <a href="/halaman-aduan" class="group bg-white dark:bg-[#0c1427] p-6 rounded-xl shadow-sm border-l-4 border-blue-600 flex flex-col justify-between min-h-[160px] transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:bg-slate-50 dark:hover:bg-[#1a2942]">
            <div>
                <div class="flex justify-between items-start">
                    <h4 class="text-gray-600 dark:text-gray-400 font-semibold text-sm">Aduan Masuk</h4>
                    <div class="bg-blue-600 p-2 rounded-full text-white transition-transform duration-300 group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0l-3.586 3.586a2 2 0 01-2.828 0L4 13" />
                        </svg>
                    </div>
                </div>
                <h2 class="text-4xl font-bold text-gray-800 dark:text-gray-100 mt-2">6</h2>
            </div>
            <p class="text-gray-400 dark:text-gray-500 text-xs mt-4">Semua aduan masuk</p>
        </a>

        {{-- Card 2: Tiket Perbaikan --}}
        <a href="/tiket-perbaikan" class="group bg-white dark:bg-[#0c1427] p-6 rounded-xl shadow-sm border-l-4 border-green-500 flex flex-col justify-between min-h-[160px] transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:bg-slate-50 dark:hover:bg-[#1a2942]">
            <div>
                <div class="flex justify-between items-start">
                    <h4 class="text-gray-600 dark:text-gray-400 font-semibold text-sm">Tiket Perbaikan</h4>
                    <div class="bg-green-500 p-2 rounded-full text-white transition-transform duration-300 group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                </div>
                <h2 class="text-4xl font-bold text-gray-800 dark:text-gray-100 mt-2">9</h2>
            </div>
            <p class="text-gray-400 dark:text-gray-500 text-xs mt-4">Daftar perbaikan berjalan</p>
        </a>

        {{-- Card 3: Log Survey --}}
        <a href="/log-survey" class="group bg-white dark:bg-[#0c1427] p-6 rounded-xl shadow-sm border-l-4 border-yellow-500 flex flex-col justify-between min-h-[160px] transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:bg-slate-50 dark:hover:bg-[#1a2942]">
            <div>
                <div class="flex justify-between items-start">
                    <h4 class="text-gray-600 dark:text-gray-400 font-semibold text-sm">Log Survey</h4>
                    <div class="bg-yellow-500 p-2 rounded-full text-white transition-transform duration-300 group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01m-.01 4h.01" />
                        </svg>
                    </div>
                </div>
                <h2 class="text-4xl font-bold text-gray-800 dark:text-gray-100 mt-2">6</h2>
            </div>
            <p class="text-gray-400 dark:text-gray-500 text-xs mt-4">Daftar survey harian</p>
        </a>

        {{-- Card 4: Progres Pengerjaan --}}
        <a href="/progres-pengerjaan" class="group bg-white dark:bg-[#0c1427] p-6 rounded-xl shadow-sm border-l-4 border-red-500 flex flex-col justify-between min-h-[160px] transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:bg-slate-50 dark:hover:bg-[#1a2942]">
            <div>
                <div class="flex justify-between items-start">
                    <h4 class="text-gray-600 dark:text-gray-400 font-semibold text-sm">Progres Pengerjaan</h4>
                    <div class="bg-red-500 p-2 rounded-full text-white transition-transform duration-300 group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>
                <h2 class="text-4xl font-bold text-gray-800 dark:text-gray-100 mt-2">9</h2>
            </div>
            <p class="text-gray-400 dark:text-gray-500 text-xs mt-4">Pengerjaan lampu</p>
        </a>

        {{-- Card 5: Tim Lapangan --}}
        <a href="/tim-lapangan" class="group bg-white dark:bg-[#0c1427] p-6 rounded-xl shadow-sm border-l-4 border-cyan-500 flex flex-col justify-between min-h-[160px] transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:bg-slate-50 dark:hover:bg-[#1a2942]">
            <div>
                <div class="flex justify-between items-start">
                    <h4 class="text-gray-600 dark:text-gray-400 font-semibold text-sm">Tim Lapangan</h4>
                    <div class="bg-cyan-500 p-2 rounded-full text-white transition-transform duration-300 group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
                <h2 class="text-4xl font-bold text-gray-800 dark:text-gray-100 mt-2">26</h2>
            </div>
            <p class="text-gray-400 dark:text-gray-500 text-xs mt-4">Tim Survey dan Teknisi</p>
        </a>

        {{-- Card 6: User --}}
        <a href="/settings/users" class="group bg-white dark:bg-[#0c1427] p-6 rounded-xl shadow-sm border-l-4 border-orange-500 flex flex-col justify-between min-h-[160px] transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:bg-slate-50 dark:hover:bg-[#1a2942]">
            <div>
                <div class="flex justify-between items-start">
                    <h4 class="text-gray-600 dark:text-gray-400 font-semibold text-sm">User</h4>
                    <div class="bg-orange-500 p-2 rounded-full text-white transition-transform duration-300 group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
                <h2 class="text-4xl font-bold text-gray-800 dark:text-gray-100 mt-2">64</h2>
            </div>
            <p class="text-gray-400 dark:text-gray-500 text-xs mt-4">Surveyor, Teknisi, dan Admin</p>
        </a>

        {{-- Card 7: Tindakan Teknisi --}}
        <a href="/tindakan-teknisi" class="group bg-white dark:bg-[#0c1427] p-6 rounded-xl shadow-sm border-l-4 border-pink-500 flex flex-col justify-between min-h-[160px] transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:bg-slate-50 dark:hover:bg-[#1a2942]">
            <div>
                <div class="flex justify-between items-start">
                    <h4 class="text-gray-600 dark:text-gray-400 font-semibold text-sm">Tindakan Teknisi</h4>
                    <div class="bg-pink-500 p-2 rounded-full text-white transition-transform duration-300 group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                </div>
                <h2 class="text-4xl font-bold text-gray-800 dark:text-gray-100 mt-2">37</h2>
            </div>
            <p class="text-gray-400 dark:text-gray-500 text-xs mt-4">Hasil Tindakan Teknisi</p>
        </a>

        {{-- Card 8: Aset PJU --}}
        <a href="/aset-pju" class="group bg-white dark:bg-[#0c1427] p-6 rounded-xl shadow-sm border-l-4 border-purple-500 flex flex-col justify-between min-h-[160px] transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:bg-slate-50 dark:hover:bg-[#1a2942]">
            <div>
                <div class="flex justify-between items-start">
                    <h4 class="text-gray-600 dark:text-gray-400 font-semibold text-sm">Aset PJU</h4>
                    <div class="bg-purple-500 p-2 rounded-full text-white transition-transform duration-300 group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                </div>
                <h2 class="text-4xl font-bold text-gray-800 dark:text-gray-100 mt-2">37</h2>
            </div>
            <p class="text-gray-400 dark:text-gray-500 text-xs mt-4">Jumlah aset PJU</p>
        </a>

        {{-- Card 9: Master Jalan --}}
        <a href="/master-jalan" class="group bg-white dark:bg-[#0c1427] p-6 rounded-xl shadow-sm border-l-4 border-indigo-500 flex flex-col justify-between min-h-[160px] transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:bg-slate-50 dark:hover:bg-[#1a2942]">
            <div>
                <div class="flex justify-between items-start">
                    <h4 class="text-gray-600 dark:text-gray-400 font-semibold text-sm">Master Jalan</h4>
                    <div class="bg-indigo-500 p-2 rounded-full text-white transition-transform duration-300 group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                        </svg>
                    </div>
                </div>
                <h2 class="text-4xl font-bold text-gray-800 dark:text-gray-100 mt-2">15</h2>
            </div>
            <p class="text-gray-400 dark:text-gray-500 text-xs mt-4">Data ruas jalan</p>
        </a>

        {{-- Card 10: Panel Kwh --}}
        <a href="/panel-kwh" class="group bg-white dark:bg-[#0c1427] p-6 rounded-xl shadow-sm border-l-4 border-indigo-500 flex flex-col justify-between min-h-[160px] transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:bg-slate-50 dark:hover:bg-[#1a2942]">
            <div>
                <div class="flex justify-between items-start">
                    <h4 class="text-gray-600 dark:text-gray-400 font-semibold text-sm">Panel Kwh</h4>
                    <div class="bg-indigo-500 p-2 rounded-full text-white transition-transform duration-300 group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                        </svg>
                    </div>
                </div>
                <h2 class="text-4xl font-bold text-gray-800 dark:text-gray-100 mt-2">15</h2>
            </div>
            <p class="text-gray-400 dark:text-gray-500 text-xs mt-4">Data panel KWh</p>
        </a>

        {{-- ✅ Card 11: Koneksi Jaringan (BARU) --}}
        <a href="/koneksi-jaringan" class="group bg-white dark:bg-[#0c1427] p-6 rounded-xl shadow-sm border-l-4 border-fuchsia-500 flex flex-col justify-between min-h-[160px] transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:bg-slate-50 dark:hover:bg-[#1a2942]">
            <div>
                <div class="flex justify-between items-start">
                    <h4 class="text-gray-600 dark:text-gray-400 font-semibold text-sm">Koneksi Jaringan</h4>
                    <div class="bg-fuchsia-500 p-2 rounded-full text-white transition-transform duration-300 group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h8m-8 0a4 4 0 010-8h8a4 4 0 010 8m-8 0a4 4 0 000 8h8a4 4 0 000-8" />
                        </svg>
                    </div>
                </div>

                {{-- angka dinamis (kirim dari controller), fallback 0 --}}
                <h2 class="text-4xl font-bold text-gray-800 dark:text-gray-100 mt-2">{{ $koneksiCount ?? 0 }}</h2>
            </div>
            <p class="text-gray-400 dark:text-gray-500 text-xs mt-4">Mapping jalur kabel PJU → Panel KWh</p>
        </a>

    </div>
</div>
@endsection
