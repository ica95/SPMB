<header class="navbar">
    <div class="container navbar-wrap">
        <nav class="menu">
            <a href="{{ route('home') }}" class="active">Beranda</a>

            {{-- SPMB DROPDOWN --}}
            <div class="dropdown">
                <a href="javascript:void(0)" class="dropdown-toggle 
                    {{ request()->routeIs('ppdb') || request()->routeIs('siswa.masuk') ? 'active' : '' }}">
                    SPMB
                </a>

                <div class="dropdown-menu">
                    <a href="{{ route('register') }}">Daftar SPMB</a>
                    <a href="{{ route('siswa.masuk') }}">Masuk Siswa</a>
                </div>
            </div>

        </nav>

    </div>
</header>