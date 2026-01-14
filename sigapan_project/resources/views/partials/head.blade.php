<title>@yield('title', 'HRM')</title>

<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<link rel="icon" href="{{ asset('assets/images/favicon.ico') }}">

<link rel="stylesheet" href="{{ asset('assets/fonts/satoshi/Satoshi.css') }}">
<link rel="stylesheet" href="{{ asset('assets/fonts/uncut-sans/Uncut-Sans.css') }}">

<link rel="stylesheet" href="{{ asset('assets/fonts/phosphor/duotone/style.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}" />

<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

{{-- Leaflet --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<style>
#map-hero {
  width: 100%;
  height: 400px;
  border: 5px solid #E6E8EE;
  border-radius: 1rem;
}
@media (min-width: 1024px) {
  #map-hero { height: 550px; }
}
</style>
