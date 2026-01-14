<!doctype html>
<html lang="en" dir="ltr" data-pc-theme="light">
<head>
    @include('partials.head')
</head>

<body>
    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
</body>
</html>
