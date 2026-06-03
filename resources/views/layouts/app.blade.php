<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SMK Muhammadiyah 2</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    @include('partials.navbar')
@if(!request()->routeIs('home'))
    <button onclick="history.back()" class="btn-back-icon">
        ←
    </button>
@endif

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

</body>
</html>