@extends('layouts.app')

@section('title', 'PJU Kabupaten Bantul')

@section('content')

  <!-- [ Pre-loader ] start -->
    <div class="loader-bg fixed inset-0 bg-theme-bg-default z-[1034] flex items-center justify-center">
       <div class="w-[65px] h-[65px] rounded-full bg-primary-100 flex items-center justify-center absolute">
         <!-- [ Logo icon ] start -->
         <svg class="w-[20px] sm:w-[22px] md:w-[24px] h-auto text-primary-500" viewBox="0 0 37 40" fill="none" xmlns="http://www.w3.org/2000/svg">
           <path
             fillRule="evenodd"
             clipRule="evenodd"
             d="M29.0507 0.657088C32.9601 -1.47888 37.5881 1.90736 36.7407 6.28379L31.081 35.5123C31.0417 35.7758 30.9823 36.0375 30.9023 36.2952C30.7256 36.8969 30.4697 37.3981 30.1515 37.802L30.1236 37.8405C28.4079 40.1894 25.1144 40.7015 22.7675 38.9843C21.6036 38.1327 20.8911 36.8926 20.6777 35.5724L20.6789 35.5732C20.0277 33.124 20.9582 26.5495 25.8412 16.0258L27.7227 18.1367L30.214 7.96335C30.3258 7.50659 29.8291 7.14315 29.4282 7.3884L20.4986 12.8509L23.1853 14.0825C18.1195 19.426 11.0662 24.4251 6.06551 24.9519C4.81627 25.0835 3.32109 24.7555 2.15767 23.9042C-0.18924 22.187 -0.700904 18.8907 1.01484 16.5418L1.02814 16.5237L1.0433 16.5032C1.33101 16.0776 1.73015 15.6819 2.24875 15.3311C2.4702 15.1762 2.70184 15.0398 2.9413 14.9222L29.0507 0.657088ZM9.83615 35.6327C11.3428 36.7129 13.4456 36.3571 14.5329 34.8379C15.2554 33.8285 15.7862 30.5405 16.0612 28.4476C16.1668 27.6438 15.3569 27.0632 14.6305 27.4219C12.739 28.3558 9.79931 29.9167 9.07685 30.9261C7.98955 32.4453 8.3295 34.5525 9.83615 35.6327Z"
             fill="currentColor"
           />
         </svg>
       </div>
       <div class="inline-block border-8 border-dotted absolute border-primary-500 rounded-full size-[100px] animate-[dotAnimation_6s_linear_infinite]" role="status"><span class="sr-only">Loading...</span></div>
       <div class="inline-block border-8 border-primary-500 rounded-full size-[100px] animate-[rotateAnimation_35s_linear_infinite] border-t-transparent dark:border-t-transparent" role="status"><span class="sr-only">Loading...</span></div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ hero ] start -->
    <section class="bg-neutral-200 relative overflow-hidden">
        <div class="common-section relative z-20">
          <div class="container animation-ref">
            <div class="pb-5 sm:pb-11 lg:pb-12">
              <div class="flex flex-col items-center gap-3">

                <h1 class="animate-y max-w-[800px] text-center">        
                  Penerangan Jalan Umum Kabupaten Bantul
                </h1>

                <h6 class="animate-y max-w-[650px] text-center text-theme-text-secondary">Sistem pemetaan terpadu yang menampilkan informasi Lampu PJU, Tiang, dan KWH di seluruh wilayah Kabupaten Bantul. Akurat, terstruktur, dan dapat diakses publik.</h6>
              </div>
              <div class="flex flex-col items-center gap-4 mt-6 sm:mt-8 lg:mt-10">
                <div class="animate-y">
                  <button class="btn btn-primary btn-md capitalize" onclick="location.href='./map'">
                    <span class="flex items-center gap-2 ltr:-ml-1 rtl:-mr-1">
                      Lihat Peta
                    </span>
                  </button>
                  <button class="btn btn-primary btn-md capitalize" onclick="location.href='./aduan'">
                    <span class="flex items-center gap-2 ltr:-ml-1 rtl:-mr-1" >
                        Kirim Aduan
                    </span>
                  </button>
                  <button class="btn btn-primary btn-md capitalize" onclick="location.href='./daftar-aduan'">
                    <span class="flex items-center gap-2 ltr:-ml-1 rtl:-mr-1">
                        Daftar Aduan
                    </span>
                  </button>
                </div>

              </div>
            </div>
            <div class=" sticky top-0">
              <div class="img-hero-1">
                <div id="map-hero" class="shadow-2xl"></div>
              </div>
            </div>
          </div>
        </div>
    </section>
    <!-- [ hero ] end -->

    <!-- [ Feature ] start -->
    <section class="bg-neutral-200 common-section">
      <div class="container">
        <div class="flex flex-col gap-6 sm:gap-8">
          <div class="animate-y delay-reset flex flex-col items-center text-center gap-2 sm:gap-3">
            <h2>Platform Manajemen Aset PJU Kabupaten Bantul</h2>
            <h6 class="text-theme-textsecondary max-w-[476px] md:max-w-[614px]">
              Aplikasi WebGIS yang dirancang untuk membantu pemerintah dan masyarakat dalam memantau kondisi Penerangan Jalan Umum secara menyeluruh. Informasi disajikan secara visual, terpusat, dan mudah diakses.
            </h6>
          </div>
          <!-- <div class="flex flex-col-reverse sm:flex-row gap-3 items-stretch">
            <div class="basis-full sm:basis-1/2">
              <div class="animate-y rounded-3xl sm:rounded-[32px] md:rounded-[40px] bg-neutral-100 overflow-hidden flex flex-col h-full">
                <div class="p-6 sm:p-8 md:p-10 flex flex-col items-start gap-6 sm:gap-8 md:gap-10 h-full justify-between">
                  <div class="flex flex-col gap-2 sm:gap-3">
                    <h4>Empower your business with our HRM platform, streamlining sales</h4>
                    <p class="body1 text-theme-textsecondary">Empower your business with our HRM platform, streamlining sales, marketing, and service processes to drive growth and build stronger customer relationships.</p>
                  </div>
                  <button class="btn btn-lg btn-primary">Try Predictive Cost Analytics</button>
                </div>
              </div> 
            </div>
            <div class="basis-full sm:basis-1/2">
              <div class="animate-y-down rounded-3xl sm:rounded-[32px] md:rounded-[40px] bg-neutral-100 overflow-hidden flex flex-col items-center h-full min-h-[207px] sm:min-h-[368px] md:min-h-[336px] relative">
                <div class="-mb-2 lg:-mb-8 h-full min-h-[157px] sm:min-h-[241px] md:min-h-[372px] w-full scale-[1.12] origin-top bg-cover bg-top bg-no-repeat bg-[url('../images/graphics/hrm/graphics2-light.svg')] dark:bg-[url('../images/graphics/hrm/graphics2-dark.svg')]">
                  <div class="absolute inset-0 z-0 ltr:bg-[radial-gradient(71.13%_71.13%_at_50%_50.07%,_transparent_0%,_var(--neutral-100)_75%)] rtl:bg-[radial-gradient(71.13%_28.87%_at_50%_50.07%,_transparent_0%,_var(--neutral-100)_75%)]"></div>
                </div>
              </div>
            </div>
          </div> -->
        </div>
      </div>
    </section>
    <!-- [ Feature ] end -->

     @push('scripts')
     <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
     <script>
       document.addEventListener('DOMContentLoaded', () => {
         // Inisialisasi peta fokus ke Bantul (Zoom 12 cocok untuk highlight area)
         const map = L.map('map-hero', {
             scrollWheelZoom: false // Agar tidak mengganggu scrolling halaman
         }).setView([-7.89610, 110.33843], 12);
 
         L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
           attribution: '© OpenStreetMap'
         }).addTo(map);
 
         fetch('{{ asset("geojson/peta-bantul.geojson") }}')
         .then(res => res.json())
         .then(data => {
           console.log('GeoJSON loaded');
 
           const bantulLayer = L.geoJSON(data, {
             coordsToLatLng: function (coords) {
               return [coords[1], coords[0]]; // ⬅️ BUANG Z, BALIK LAT LNG
             },
             style: {
               color: '#b91c1c',
               weight: 4,
               fillColor: '#ef4444',
               fillOpacity: 0.3
             }
           }).addTo(map);
 
           map.fitBounds(bantulLayer.getBounds());
         })
         .catch(err => console.error(err));
 
         // Data 50 Lampu untuk memadati visual Hero
         const lights = [
             { id: 1, lat: -7.89610, lng: 110.33843, status: "on" },
             { id: 2, lat: -7.89582, lng: 110.33801, status: "off" },
             { id: 3, lat: -7.89645, lng: 110.33902, status: "fault" },
             { id: 4, lat: -7.89701, lng: 110.33789, status: "on" },
             { id: 5, lat: -7.89554, lng: 110.33745, status: "off" },
             { id: 6, lat: -7.89672, lng: 110.33888, status: "on" },
             { id: 7, lat: -7.89591, lng: 110.33931, status: "on" },
             { id: 8, lat: -7.89633, lng: 110.33771, status: "fault" },
             { id: 9, lat: -7.89724, lng: 110.33815, status: "off" },
             { id: 10, lat: -7.89566, lng: 110.33954, status: "on" },
             { id: 11, lat: -7.89681, lng: 110.33792, status: "on" },
             { id: 12, lat: -7.89538, lng: 110.33866, status: "off" },
             { id: 13, lat: -7.89659, lng: 110.33919, status: "fault" },
             { id: 14, lat: -7.89712, lng: 110.33764, status: "on" },
             { id: 15, lat: -7.89577, lng: 110.33894, status: "off" },
             { id: 16, lat: -7.89604, lng: 110.33973, status: "on" },
             { id: 17, lat: -7.89731, lng: 110.33841, status: "on" },
             { id: 18, lat: -7.89548, lng: 110.33783, status: "fault" },
             { id: 19, lat: -7.89668, lng: 110.33822, status: "off" },
             { id: 20, lat: -7.89593, lng: 110.33907, status: "on" },
             { id: 21, lat: -7.89621, lng: 110.33752, status: "on" },
             { id: 22, lat: -7.89708, lng: 110.33876, status: "off" },
             { id: 23, lat: -7.89562, lng: 110.33938, status: "fault" },
             { id: 24, lat: -7.89694, lng: 110.33791, status: "on" },
             { id: 25, lat: -7.89529, lng: 110.33853, status: "off" },
             { id: 26, lat: -7.89647, lng: 110.33962, status: "on" },
             { id: 27, lat: -7.89719, lng: 110.33805, status: "on" },
             { id: 28, lat: -7.89583, lng: 110.33766, status: "fault" },
             { id: 29, lat: -7.89656, lng: 110.33889, status: "off" },
             { id: 30, lat: -7.89597, lng: 110.33921, status: "on" },
             { id: 31, lat: -7.89612, lng: 110.33784, status: "on" },
             { id: 32, lat: -7.89703, lng: 110.33847, status: "off" },
             { id: 33, lat: -7.89571, lng: 110.33911, status: "fault" },
             { id: 34, lat: -7.89685, lng: 110.33758, status: "on" },
             { id: 35, lat: -7.89544, lng: 110.33892, status: "off" },
             { id: 36, lat: -7.89663, lng: 110.33948, status: "on" },
             { id: 37, lat: -7.89727, lng: 110.33819, status: "on" },
             { id: 38, lat: -7.89588, lng: 110.33774, status: "fault" },
             { id: 39, lat: -7.89654, lng: 110.33861, status: "off" },
             { id: 40, lat: -7.89599, lng: 110.33932, status: "on" },
             { id: 41, lat: -7.89618, lng: 110.33795, status: "on" },
             { id: 42, lat: -7.89706, lng: 110.33888, status: "off" },
             { id: 43, lat: -7.89569, lng: 110.33955, status: "fault" },
             { id: 44, lat: -7.89692, lng: 110.33771, status: "on" },
             { id: 45, lat: -7.89533, lng: 110.33834, status: "off" },
             { id: 46, lat: -7.89651, lng: 110.33966, status: "on" },
             { id: 47, lat: -7.89722, lng: 110.33827, status: "on" },
             { id: 48, lat: -7.89586, lng: 110.33782, status: "fault" },
             { id: 49, lat: -7.89661, lng: 110.33873, status: "off" },
             { id: 50, lat: -7.89595, lng: 110.33944, status: "on" },
         ];
 
         // Render marker kecil (radius 4) untuk tampilan landing page
         lights.forEach(light => {
           const color = light.status === 'on' ? '#10b981' : (light.status === 'fault' ? '#ef4444' : '#9ca3af');
           L.circleMarker([light.lat, light.lng], {
             radius: 5,
             fillColor: color,
             color: "#fff",
             weight: 1,
             fillOpacity: 0.9
           }).addTo(map);
         });
       });
     </script>

    <!-- Required Js -->
    <script src="../assets/js/plugins/popper.min.js"></script>
    <script src="../assets/js/icon/custom-font.js"></script>
    <script src="../assets/js/component.js"></script>
    <script src="../assets/js/script.js"></script>
    <script src="../assets/js/theme.js"></script>

    
    <script>
      layout_change('false');
    </script>
     
    
    <script>
      layout_rtl_change('false');
      </script>
    
    <script src="../assets/js/plugins/motion.js"></script>
    <script type="module">
      const { animate, inView, scroll } = Motion;
      window.addEventListener('load', function () {
        // main hero
        var element = document.querySelector('.img-hero-1');
        var ref = document.querySelector('.animation-ref');
        scroll(animate(element, { scale: [0.9, 0.92, 0.94, 0.96, 1] }), {
          target: ref,
          offset: ['start start', 'end start'],
        });
        
        // translate y 
        var anim = document.querySelectorAll('.animate-y');
        var sec = 0;
        inView(anim, (element) => {
          if(element.classList.contains("delay-reset")){
            sec = 0
          }else{
            sec += 0.1;
          }
          animate(
            element,
            { opacity: [0,1], y: [50, 0] },
            {
              duration: 1,
              delay: sec,
              ease: [0.215, 0.61, 0.355, 1]
            }
          )
        })

        var anim = document.querySelector('.animate-y-down');
        inView(anim, (element) => {
          if(element.classList.contains("delay-reset")){
            sec = 0
          }else{
            sec += 0.1;
          }
          animate(
            element,
            { opacity: [0,1], y: [-50, 0] },
            {
              duration: 1,
              delay: 0.4,
              ease: [0.215, 0.61, 0.355, 1]
            }
          )
        })
    
      });
    </script>
    @endpush
@endsection
