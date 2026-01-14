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

  </body>
</html>