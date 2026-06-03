<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Siswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

<div class="app-wrapper">

    {{-- NAVBAR --}}
    <nav class="app-header navbar navbar-expand bg-body">
        <div class="container-fluid">
            <a href="{{ route('siswa.masuk') }}" class="navbar-brand">
                Dashboard Siswa
            </a>
        </div>
    </nav>

    {{-- SIDEBAR --}}
    <aside class="app-sidebar bg-body-secondary shadow">

        <div class="sidebar-brand">
            <a href="{{ route('siswa.masuk') }}" class="brand-link">
                <span class="brand-text fw-light">Siswa SPMB</span>
            </a>
        </div>

        <div class="sidebar-wrapper">
            <nav class="mt-2">
                <ul class="nav sidebar-menu flex-column">

                    <li class="nav-item">
                        <a href="{{ route('siswa.masuk') }}" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                                        <li class="nav-item">
                        <a href="{{ route('kwitansi') }}" class="nav-link">
                            <i class="nav-icon fas fa-receipt"></i>
                            <p>Cetak Kwitansi</p>
                        </a>
                    </li>

                    <li class="nav-item">

                        <a href="{{ route('pendaftaran.cetakBukti') }}" class="nav-link">

                            <i class="nav-icon fas fa-print"></i>

                            <p>Cetak Bukti</p>

                        </a>

                    </li>

                    <li class="nav-item">
                        <a href="{{ route('pendaftaran.status') }}" class="nav-link">
                            <i class="nav-icon fas fa-check-circle"></i>
                            <p>Status Pendaftaran</p>
                        </a>
                    </li>

                    <li class="nav-item mt-3">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf

                            <button type="submit" class="nav-link border-0 bg-transparent text-start w-100">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </button>
                        </form>
                    </li>

                </ul>
            </nav>
        </div>

    </aside>

    {{-- CONTENT --}}
    <main class="app-main">

        <div class="app-content-header">
            <div class="container-fluid">
                <h3>@yield('title', 'Dashboard Siswa')</h3>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>

    </main>

</div>

<script src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>

</body>

<footer class="footer-simple"
        style="
            text-align:center;
            padding:12px;
            margin-top:20px;
            background:#ffc107;
            border-top:1px solid #e0a800;
            color:#000;
            font-size:14px;
        ">

    <strong>
        © {{ date('Y') }} SMK Muhammadiyah 2 Banjarmasin
    </strong>

    <small style="
        display:block;
        margin-top:3px;
        font-size:12px;
        color:#333;
    ">
    </small>

</footer>

</html>