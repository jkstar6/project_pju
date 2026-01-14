@section('title', 'daftar-aduan')

<!doctype html>
<html lang="en" class="preset-hrm" class="preset-ai" data-pc-direction="ltr" dir="ltr" data-pc-theme="light">
  <!-- [Head] start -->
  <head>
    <title>Daftar Aduan</title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Ready-to-use HRM landing page template to help you launch your project faster and smarter." />
    <meta name="keywords" content="Tailwind Templates, Tailwind Theme, SaaS UI Kit, SaaS Template"/>
    <meta name="author" content="Phoenixcoded" />
   
    <!-- [Favicon] icon -->
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon" />
    
    <link rel="stylesheet" href="../assets/fonts/satoshi/Satoshi.css">
    <link rel="stylesheet" href="../assets/fonts/uncut-sans/Uncut-Sans.css">
    <!-- [Font] Family -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap" rel="stylesheet">

    <!-- [phosphor Icons] https://phosphoricons.com/ -->
    <link rel="stylesheet" href="../assets/fonts/phosphor/duotone/style.css" />
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="../assets/fonts/tabler-icons.min.css" />
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="../assets/fonts/fontawesome.css" />
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="../assets/fonts/material.css" />
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="../assets/css/style.css" id="main-style-link" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            // 1. Set ke 'class' agar tidak otomatis ikut mode gelap laptop (biar tetap putih sesuai tema)
            darkMode: 'class', 
            corePlugins: {
                // 2. Matikan preflight agar Navbar & Font bawaan TIDAK BERUBAH
                preflight: false, 
            }
        }
    </script>
  </head>
  <!-- [Head] end -->

  <body>
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

    {{-- isi konten dibawah ini --}}
    <section class="py-12 bg-white dark:bg-themedark-bodybg">
        <div class="container mx-auto px-4"> <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-neutral-900 dark:text-white mb-2">Daftar Laporan Warga</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="group relative bg-white dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-700 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all">
                    <div class="relative h-48 w-full overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1515162816999-a0c47dc192f7?q=80&w=2070&auto=format&fit=crop" 
                             alt="Jalan Rusak" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        <span class="absolute top-3 right-3 bg-blue-600 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                            Menunggu
                        </span>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-2 text-neutral-500 text-xs mb-2">
                            <i class="ti ti-clock"></i> <span>2 days ago</span>
                        </div>
                        <h3 class="text-lg font-bold text-neutral-900 dark:text-white mb-1 group-hover:text-blue-600">
                            Jalan Bocor
                        </h3>
                        <p class="text-neutral-600 dark:text-neutral-400 text-sm line-clamp-2 mb-4">
                            Sepanjang jalan bantul banyak yang berlubang pak.
                        </p>
                        <div class="flex items-center gap-2 text-neutral-500 text-xs">
                            <i class="ti ti-map-pin text-red-500"></i> Bantul
                        </div>
                    </div>
                </div>

                <div class="group relative bg-white dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-700 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all">
                    <div class="relative h-48 w-full overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1540932296774-74452326c759?q=80&w=2089&auto=format&fit=crop" 
                             alt="Lampu" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        <span class="absolute top-3 right-3 bg-blue-600 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                            Menunggu
                        </span>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-2 text-neutral-500 text-xs mb-2">
                            <i class="ti ti-clock"></i> <span>3 days ago</span>
                        </div>
                        <h3 class="text-lg font-bold text-neutral-900 dark:text-white mb-1 group-hover:text-blue-600">
                            Lampu Mati
                        </h3>
                        <p class="text-neutral-600 dark:text-neutral-400 text-sm line-clamp-2 mb-4">
                            Lampunya mati total di perempatan jalan.
                        </p>
                        <div class="flex items-center gap-2 text-neutral-500 text-xs">
                            <i class="ti ti-map-pin text-red-500"></i> Kominfo
                        </div>
                    </div>
                </div>

                <div class="group relative bg-white dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-700 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all">
                    <div class="relative h-48 w-full overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1530587191325-3db32d826c18?q=80&w=2069&auto=format&fit=crop" 
                             alt="Sampah" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        <span class="absolute top-3 right-3 bg-green-600 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wide">
                            Selesai
                        </span>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-2 text-neutral-500 text-xs mb-2">
                            <i class="ti ti-clock"></i> <span>5 days ago</span>
                        </div>
                        <h3 class="text-lg font-bold text-neutral-900 dark:text-white mb-1 group-hover:text-blue-600">
                            Sampah Numpuk
                        </h3>
                        <p class="text-neutral-600 dark:text-neutral-400 text-sm line-clamp-2 mb-4">
                            Bau menyengat di sekitar pasar karena sampah.
                        </p>
                        <div class="flex items-center gap-2 text-neutral-500 text-xs">
                            <i class="ti ti-map-pin text-red-500"></i> Pasar Seni
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    
    ```
    


  </body>
</html>