<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta charset="UTF-8">
    <title>Dashboard SPMB</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.css') }}">
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

<div class="app-wrapper">

    <!-- NAVBAR -->
    <nav class="app-header navbar navbar-expand bg-body">
        <div class="container-fluid">
            <a href="{{ route('admin.dashboard') }}" class="navbar-brand">SPMB</a>
        </div>
    </nav>

    <!-- SIDEBAR -->
    <aside class="app-sidebar bg-body-secondary shadow">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}" class="brand-link">
                <span class="brand-text fw-light">Admin SPMB</span>
            </a>
        </div>

        <div class="sidebar-wrapper">
            <nav class="mt-2">
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu">

                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.program-keahlian.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-graduation-cap"></i>
                            <p>Program Keahlian</p>
                        </a>
                    </li>

                    <li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-money-bill"></i>
        <p>
            Verifikasi Pembayaran
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>

    <ul class="nav nav-treeview">

        <li class="nav-item">
            <a href="{{ route('admin.pembayaran', ['status' => 'menunggu_verifikasi']) }}" class="nav-link">
                <i class="far fa-clock nav-icon"></i>
                <p>Menunggu Verifikasi</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.pembayaran', ['status' => 'lunas']) }}" class="nav-link">
                <i class="far fa-check-circle nav-icon"></i>
                <p>Sudah Lunas</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.pembayaran', ['status' => 'belum_bayar']) }}" class="nav-link">
                <i class="far fa-times-circle nav-icon"></i>
                <p>Belum Bayar</p>
            </a>
        </li>

    </ul>
</li>

                    <li class="nav-item mt-3">
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link border-0 bg-transparent text-start w-100">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </button>
                        </form>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.seleksi.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-user-check"></i>
                            <p>Seleksi Siswa</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.gelombang-ppdb.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>Gelombang SPMB</p>
                        </a>
                    </li>

                    <li class="nav-item">
                    <a href="{{ route('admin.tahun-ajaran.index') }}"
                    class="nav-link">

                        <i class="nav-icon fas fa-calendar-alt"></i>

                        <p>Tahun Ajaran</p>
                    </a>
                </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.jadwal-ppdb.index') }}"
                        class="nav-link">

                            <i class="nav-icon fas fa-calendar"></i>

                            <p>Jadwal SPMB</p>
                        </a>
                    </li>

                    <li class="nav-item">
                    <a href="{{ route('admin.pengumuman-ppdb.index') }}"
                    class="nav-link">

                        <i class="nav-icon fas fa-bullhorn"></i>

                        <p>Pengumuman SPMB</p>
                    </a>
                </li>

                <a href="{{ route('admin.laporan.index') }}" class="nav-link">
    <i class="fas fa-file-alt nav-icon"></i>
    <p>Laporan Pendaftaran</p>
</a>

                </ul>
            </nav>
        </div>
    </aside>

    <!-- CONTENT -->
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <h3>Dashboard SPMB</h3>
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