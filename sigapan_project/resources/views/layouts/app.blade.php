<!doctype html>
<html lang="en" class="preset-hrm preset-ai" data-pc-direction="ltr" dir="ltr" data-pc-theme="light">
<head>
    @include('partials.head')
</head>

<body>
    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
    @stack('scripts')
</body>
</html>
