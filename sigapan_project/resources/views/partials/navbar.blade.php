<!-- [ Nav ] start -->
    <nav class="z-50 w-full relative bg-neutral-200">
      <div class="container">
        <div class="static flex py-4 items-center justify-between">
          <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-between">
            <div class="flex flex-1 flex-shrink-0 items-center justify-between text-primary-500">
              <a href="#">
                <!-- [ Logo main ] start -->
                  <h3 class="">LOGO</h3>
              </a>
            </div>
            <div class="nav-collapse grow hidden w-full lg:flex lg:w-full flex-auto justify-center"
              id="main-navbar-collapse">
              <div class="justify-center flex flex-col lg:flex-row p-0 lg:bg-neutral-200 lg:rounded-full">
                <a class="inline-block text-neutral-900 hover:bg-primary-500/[.04] dark:text-themedark-bodycolor rounded-full px-[18px] lg:px-6 py-3 text-[14px] font-medium transition-all leading-[1.429] open:text-primary-500 open:font-semibold"
                  href="../">
                  Home
                </a>
                <a href="../map"
                  class="inline-block text-neutral-900 hover:bg-primary-500/[.04] dark:text-themedark-bodycolor rounded-full px-[18px] lg:px-6 py-3 text-[14px] font-medium transition-all leading-[1.429] open:text-primary-500 open:font-semibold">
                  Map
                </a>
                <a href="../aduan"
                  class="inline-block text-neutral-900 hover:bg-primary-500/[.04] dark:text-themedark-bodycolor rounded-full px-[18px] lg:px-6 py-3 text-[14px] font-medium transition-all leading-[1.429] open:text-primary-500 open:font-semibold">
                  Aduan
                </a>
              </div>
            </div>
          </div>
          <div class="flex items-center gap-3">
            @if (Route::has('login'))
                <a
                    href="{{ route('login') }}"
                    class="btn btn-primary px-4 py-2.5 shrink-0"
                >
                    Login
                </a>
            @endif
          </div>

        </div>
      </div>
    </nav>
    <!-- [ Nav ] end -->