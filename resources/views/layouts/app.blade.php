<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SMK Muhammadiyah 2</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
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