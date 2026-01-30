@extends('layouts.admin.master')

@section('title', 'Dashboard')

@section('breadcrumb')
    {{ Breadcrumbs::render('dashboard') }}
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">

    {{-- HEADER (tanpa search lokal) --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 dark:text-white">
                Dashboard
            </h1>
            <p class="text-sm text-slate-400 dark:text-slate-500">
                Ringkasan data & navigasi cepat menu sistem
            </p>

            {{-- indikator filter --}}
            <p id="dashFilterInfo" class="text-xs text-slate-400 mt-2 hidden">
                Filter: <span class="font-semibold" id="dashFilterText"></span>
            </p>
        </div>
    </div>

    {{-- GRID CARD DASHBOARD --}}
    <div id="dashboardGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach ($dashboardCards as $card)
            <a href="{{ $card['href'] }}"
               class="dashboard-card group relative overflow-hidden rounded-2xl
                      bg-white dark:bg-[#0c1427]
                      border border-slate-100 dark:border-slate-800
                      shadow-sm hover:shadow-xl
                      transition-all duration-300 hover:-translate-y-1
                      min-h-[170px] p-6 flex flex-col justify-between
                      border-l-4 {{ $card['border'] }}"
               data-title="{{ $card['title'] }}">

                {{-- Background Accent Blur --}}
                <div class="absolute -top-16 -right-16 w-40 h-40 rounded-full opacity-10 {{ $card['bg'] }}"></div>

                {{-- TOP --}}
                <div>
                    <div class="flex justify-between items-start gap-3">
                        <div>
                            <h4 class="text-sm font-semibold text-slate-700 dark:text-white">
                                {{ $card['title'] }}
                            </h4>
                            <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">
                                {{ $card['desc'] }}
                            </p>
                        </div>

                        {{-- ICON --}}
                        <div class="p-2 rounded-full text-white {{ $card['bg'] }}
                                    transition-transform duration-300 group-hover:scale-110">
                            @include('dashboard.partials.icon', ['name' => $card['icon']])
                        </div>
                    </div>

                    {{-- COUNT --}}
                    <h2 class="text-4xl font-bold text-slate-800 dark:text-white mt-4">
                        {{ $card['count'] }}
                    </h2>
                </div>

                {{-- FOOTER --}}
                <div class="flex justify-between items-center text-xs text-slate-400 mt-5">
                    <span>Lihat detail</span>
                    <span class="group-hover:translate-x-1 transition-transform duration-300">➡</span>
                </div>
            </a>
        @endforeach
    </div>

    {{-- EMPTY RESULT --}}
    <div id="dashEmpty"
         class="mt-10 text-center p-10 rounded-2xl border border-dashed border-slate-300 dark:border-slate-700 hidden">
        <p class="text-slate-500 dark:text-slate-400">
            Menu tidak ditemukan 😢
        </p>
    </div>

</div>

{{-- ✅ SCRIPT LANGSUNG (tanpa Alpine / tanpa @push) --}}
<script>
(function () {
    function $(id) { return document.getElementById(id); }

    function normalize(s) {
        return (s || '').toString().trim().toLowerCase();
    }

    function applyFilter(q) {
        const query = normalize(q);

        const cards = document.querySelectorAll('.dashboard-card');
        let visibleCount = 0;

        cards.forEach(card => {
            const title = normalize(card.getAttribute('data-title'));
            const show = query === '' ? true : title.includes(query);

            card.classList.toggle('hidden', !show);
            if (show) visibleCount++;
        });

        // Info filter
        const info = $('dashFilterInfo');
        const text = $('dashFilterText');
        if (query) {
            info && info.classList.remove('hidden');
            if (text) text.textContent = q;
        } else {
            info && info.classList.add('hidden');
            if (text) text.textContent = '';
        }

        // Empty state
        const empty = $('dashEmpty');
        if (empty) {
            empty.classList.toggle('hidden', visibleCount !== 0);
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const input = $('globalSearch');

        // Kalau input header belum ada, kasih warning biar ketahuan
        if (!input) {
            console.warn('globalSearch tidak ditemukan. Tambahkan id="globalSearch" di input search navbar.');
            return;
        }

        // filter awal (kalau input ada value)
        applyFilter(input.value);

        // setiap ketik -> filter
        input.addEventListener('input', function (e) {
            applyFilter(e.target.value);
        });
    });
})();
</script>
@endsection
