<nav class="z-50 w-full relative bg-neutral-200">
  <div class="container mx-auto px-4">
    <div class="flex h-16 items-center">

      <div class="flex flex-1 justify-start">
        <a href="{{ url('/') }}" class="flex items-center gap-3">
          <img
            src="{{ asset('assets/images/logo.png') }}"
            alt="Logo SIGAPAN"
            class="h-10 lg:h-12 w-auto"
          >
          <span class="text-lg lg:text-xl font-bold text-gray-800 tracking-tight leading-none whitespace-nowrap">
            PJUBANTUL
          </span>
        </a>
      </div>

      <div class="hidden lg:flex flex-1 justify-center gap-2">
        <a href="{{ url('/') }}"
          class="px-6 py-2.5 text-sm font-medium text-neutral-900 rounded-full hover:bg-primary-500/[.04] transition whitespace-nowrap">
          Home
        </a>
        <a href="{{ url('/map') }}"
          class="px-6 py-2.5 text-sm font-medium text-neutral-900 rounded-full hover:bg-primary-500/[.04] transition whitespace-nowrap">
          Map
        </a>
        <a href="{{ url('/aduan') }}"
          class="px-6 py-2.5 text-sm font-medium text-neutral-900 rounded-full hover:bg-primary-500/[.04] transition whitespace-nowrap">
          Aduan
        </a>
      </div>

      <div class="flex flex-1 justify-end">
        @if (Route::has('login'))
          <a
            href="{{ route('login') }}"
            class="bg-primary-500 text-white px-5 py-2.5 rounded-full text-sm font-medium hover:bg-primary-600 transition"
          >
            Login
          </a>
        @endif
      </div>

    </div>
  </div>
</nav>