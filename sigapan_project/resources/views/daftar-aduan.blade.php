@extends('layouts.app')

@section('title', 'Daftar Aduan')

@section('content')
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            corePlugins: {
                preflight: false, 
            }
        }
    </script>

    <section class="py-12 bg-white dark:bg-gray-900 min-h-screen">
        <div class="container mx-auto px-4"> 
            
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-neutral-900 dark:text-white mb-2">Daftar Laporan Warga</h2>
                <p class="text-neutral-500">Pantau laporan terkini dari lingkungan sekitar.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="group relative bg-white dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-700 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all">
                    <div class="relative h-48 w-full overflow-hidden">
                        {{-- LINK DITAMBAHKAN DISINI --}}
                        <a href="{{ url('detail-aduan') }}" class="block w-full h-full cursor-pointer">
                            <img src="https://images.unsplash.com/photo-1515162816999-a0c47dc192f7?q=80&w=2070&auto=format&fit=crop" 
                                 alt="Jalan Rusak" 
                                 class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        </a>
                        {{-- Status Badge tetap di luar tag <a> agar tidak ikut ter-hover effect jika tidak diinginkan, tapi posisinya absolute tetap diatas gambar --}}
                        <span class="absolute top-3 right-3 bg-blue-600 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wide pointer-events-none">
                            Menunggu
                        </span>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-2 text-neutral-500 text-xs mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span>2 days ago</span>
                        </div>
                        {{-- Judul juga bisa diklik --}}
                        <a href="{{ url('detail-aduan') }}">
                            <h3 class="text-lg font-bold text-neutral-900 dark:text-white mb-1 group-hover:text-blue-600 hover:underline">
                                Jalan Bocor
                            </h3>
                        </a>
                        <p class="text-neutral-600 dark:text-neutral-400 text-sm line-clamp-2 mb-4">
                            Sepanjang jalan bantul banyak yang berlubang pak, mohon segera diperbaiki.
                        </p>
                        <div class="flex items-center gap-2 text-neutral-500 text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            Bantul
                        </div>
                    </div>
                </div>

                <div class="group relative bg-white dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-700 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all">
                    <div class="relative h-48 w-full overflow-hidden">
                         {{-- LINK DITAMBAHKAN DISINI --}}
                        <a href="{{ url('detail-aduan') }}" class="block w-full h-full cursor-pointer">
                            <img src="https://thetapaktuanpost.com/wp-content/uploads/2020/03/Lampu-Jalan-Rusak.JPG.jpg" 
                                 alt="Lampu" 
                                 class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        </a>
                        <span class="absolute top-3 right-3 bg-blue-600 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wide pointer-events-none">
                            Menunggu
                        </span>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-2 text-neutral-500 text-xs mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span>3 days ago</span>
                        </div>
                        <a href="{{ url('detail-aduan') }}">
                            <h3 class="text-lg font-bold text-neutral-900 dark:text-white mb-1 group-hover:text-blue-600 hover:underline">
                                Lampu Mati
                            </h3>
                        </a>
                        <p class="text-neutral-600 dark:text-neutral-400 text-sm line-clamp-2 mb-4">
                            Lampunya mati total di perempatan jalan, sangat gelap saat malam.
                        </p>
                        <div class="flex items-center gap-2 text-neutral-500 text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            Kominfo
                        </div>
                    </div>
                </div>

                <div class="group relative bg-white dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-700 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all">
                    <div class="relative h-48 w-full overflow-hidden">
                         {{-- LINK DITAMBAHKAN DISINI --}}
                        <a href="{{ url('detail-aduan') }}" class="block w-full h-full cursor-pointer">
                            <img src="https://images.unsplash.com/photo-1530587191325-3db32d826c18?q=80&w=2069&auto=format&fit=crop" 
                                 alt="Sampah" 
                                 class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        </a>
                        <span class="absolute top-3 right-3 bg-green-600 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wide pointer-events-none">
                            Selesai
                        </span>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-2 text-neutral-500 text-xs mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span>5 days ago</span>
                        </div>
                        <a href="{{ url('detail-aduan') }}">
                            <h3 class="text-lg font-bold text-neutral-900 dark:text-white mb-1 group-hover:text-blue-600 hover:underline">
                                Sampah Numpuk
                            </h3>
                        </a>
                        <p class="text-neutral-600 dark:text-neutral-400 text-sm line-clamp-2 mb-4">
                            Bau menyengat di sekitar pasar karena sampah menumpuk belum diangkut.
                        </p>
                        <div class="flex items-center gap-2 text-neutral-500 text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            Pasar Seni
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection