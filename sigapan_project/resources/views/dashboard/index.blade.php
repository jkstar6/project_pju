@extends('layouts.admin.master')

@section('title', 'Dashboard')

@section('breadcrumb')
    {{ Breadcrumbs::render('dashboard') }}
@endsection

@section('content')
 <div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <a href="/halaman-aduan" class="group bg-white p-6 rounded-xl shadow-sm border-l-4 border-blue-600 flex flex-col justify-between min-h-[160px] transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:bg-slate-50">
            <div>
                <div class="flex justify-between items-start">
                    <h4 class="text-gray-600 font-semibold text-sm">Aduan Masuk</h4>
                    <div class="bg-blue-600 p-2 rounded-full text-white transition-transform duration-300 group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0l-3.586 3.586a2 2 0 01-2.828 0L4 13" />
                        </svg>
                    </div>
                </div>
                <h2 class="text-4xl font-bold text-gray-800 mt-2">6</h2>
            </div>
            <p class="text-gray-400 text-xs mt-4">Semua aduan terdaftar</p>
        </a>

        <a href="/tiket-perbaikan" class="group bg-white p-6 rounded-xl shadow-sm border-l-4 border-green-500 flex flex-col justify-between min-h-[160px] transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:bg-slate-50">
            <div>
                <div class="flex justify-between items-start">
                    <h4 class="text-gray-600 font-semibold text-sm">Tiket Perbaikan</h4>
                    <div class="bg-green-500 p-2 rounded-full text-white transition-transform duration-300 group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                </div>
                <h2 class="text-4xl font-bold text-gray-800 mt-2">9</h2>
            </div>
            <p class="text-gray-400 text-xs mt-4">Perbaikan berjalan normal</p>
        </a>

        <a href="/log-survey" class="group bg-white p-6 rounded-xl shadow-sm border-l-4 border-yellow-500 flex flex-col justify-between min-h-[160px] transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:bg-slate-50">
            <div>
                <div class="flex justify-between items-start">
                    <h4 class="text-gray-600 font-semibold text-sm">Log Survey</h4>
                    <div class="bg-yellow-500 p-2 rounded-full text-white transition-transform duration-300 group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01m-.01 4h.01" />
                        </svg>
                    </div>
                </div>
                <h2 class="text-4xl font-bold text-gray-800 mt-2">6</h2>
            </div>
            <p class="text-gray-400 text-xs mt-4">Survey tidak aktif</p>
        </a>

        <a href="/progres-pengerjaan" class="group bg-white p-6 rounded-xl shadow-sm border-l-4 border-red-500 flex flex-col justify-between min-h-[160px] transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:bg-slate-50">
            <div>
                <div class="flex justify-between items-start">
                    <h4 class="text-gray-600 font-semibold text-sm">Progres pengerjaan</h4>
                    <div class="bg-red-500 p-2 rounded-full text-white transition-transform duration-300 group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>
                <h2 class="text-4xl font-bold text-gray-800 mt-2">9</h2>
            </div>
            <p class="text-gray-400 text-xs mt-4">Perlu ditindak lanjut</p>
        </a>

    </div>
</div>
        
@endsection

