@extends('layouts.app')

@section('content')

{{-- HERO --}}
<section class="hero">

    <div class="overlay"></div>

    {{-- LOGO --}}
    <div class="hero-logo-top">
        <img src="{{ asset('images/logo-smk.jpg') }}"
             alt="Logo Sekolah">
    </div>

    <div class="container">

        <div class="hero-content">

            <h1 class="hero-title">

                <span class="title-main">
                    TAQWA,
                </span>

                <span class="title-outline">
                    KREATIF, UNGGUL, BERPRESTASI
                </span>

                <span class="title-highlight">
                    SERTA BERKEMAJUAN
                </span>

            </h1>

        </div>

    </div>

</section>

{{-- JADWAL SPMB --}}
<section class="jadwal-section">

    <div class="container">

        <h2 class="jadwal-title">
            Jadwal SPMB Tahun Ajaran
            {{ $tahunAjaranAktif->tahun_ajaran ?? '-' }}
        </h2>

        <div class="jadwal-table-wrapper">

            <table class="jadwal-table">

                <tbody>

                    @forelse($jadwal as $item)

                        <tr>
                            <td class="kegiatan">
                                {{ $item->nama_kegiatan }}
                            </td>

                            <td class="tanggal">
                                {{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d F Y') }}

                                @if($item->tanggal_selesai)
                                    s/d {{ \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d F Y') }}
                                @endif
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td class="text-center">
                                Belum ada jadwal.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</section>

{{-- GELOMBANG SPMB --}}
<section class="gelombang-section">

    <div class="container">

        <h2 class="gelombang-title">
            Gelombang Pendaftaran Tahun Ajaran
            {{ $tahunAjaranAktif->tahun_ajaran ?? '-' }}
        </h2>

        <div class="gelombang-table-wrapper">

            <table class="gelombang-table">

                <tbody>

                    @forelse($gelombang as $item)

                        <tr>
                            <td class="kegiatan">
                                {{ $item->nama_gelombang }}
                            </td>

                            <td class="tanggal">
                                {{ \Carbon\Carbon::parse($item->tanggal_mulai)->translatedFormat('d F Y') }} 
                                s/d {{ \Carbon\Carbon::parse($item->tanggal_selesai)->translatedFormat('d F Y') }}
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td class="text-center">
                                Belum ada gelombang.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</section>

{{-- ALUR PENDAFTARAN --}}
<<section class="alur-section">

    <div class="container">

        <div class="section-heading">

            <h2>Alur Pendaftaran SPMB</h2>

            <p>
                Berikut tahapan pendaftaran calon siswa baru
                SMK Muhammadiyah 2 Banjarmasin.
            </p>

        </div>

        <div class="alur-grid">

            <div class="alur-card">
                <div class="alur-number">1</div>
                <h3>Daftar Akun</h3>
                <p>Calon siswa membuat akun menggunakan nama dan email aktif.</p>
            </div>

            <div class="alur-card">
                <div class="alur-number">2</div>
                <h3>Login Sistem</h3>
                <p>Login menggunakan nomor pendaftaran dan password dari sistem.</p>
            </div>

            <div class="alur-card">
                <div class="alur-number">3</div>
                <h3>Pembayaran</h3>
                <p>Calon siswa melakukan pembayaran dan upload bukti pembayaran.</p>
            </div>

            <div class="alur-card">
                <div class="alur-number">4</div>
                <h3>Verifikasi Admin</h3>
                <p>Admin memverifikasi pembayaran sebelum siswa melanjutkan pendaftaran.</p>
            </div>

            <div class="alur-card">
                <div class="alur-number">5</div>
                <h3>Isi Formulir</h3>
                <p>Calon siswa melengkapi biodata, data orang tua, prestasi, dan berkas.</p>
            </div>

            <div class="alur-card">
                <div class="alur-number">6</div>
                <h3>Review Data</h3>
                <p>Calon siswa memeriksa kembali data sebelum dikirim final.</p>
            </div>

            <div class="alur-card">
                <div class="alur-number">7</div>
                <h3>Seleksi Panitia</h3>
                <p>Panitia melakukan seleksi berdasarkan data pendaftaran siswa.</p>
            </div>

            <div class="alur-card">
                <div class="alur-number">8</div>
                <h3>Pengumuman</h3>
                <p>Calon siswa melihat hasil seleksi melalui dashboard SPMB.</p>
            </div>

        </div>

    </div>

{{-- HUBUNGI KAMI --}}
<section class="kontak-section">

    <div class="container">

        <div class="section-heading">
            <h2>Hubungi Kami</h2>
            <p>Informasi kontak SMK Muhammadiyah 2 Banjarmasin</p>
        </div>

        <div class="kontak-item">
    <h4>📞 Kontak Person</h4>

    <p><strong>Panitia SPMB</strong></p>

    <p>
        Bapak Yahya : 088804391179
    </p>

    <p>
        Ibu Muth : 081277754447
    </p>

    <p>
        Website :
        <a href="https://www.smkm2bjm.com" target="_blank">
            www.smkm2bjm.com
        </a>
    </p>
</div>

        <div class="kontak-item">
            <h4>📍 Alamat Sekolah</h4>
            <p>
                Jl. Cempaka Besar No. 29<br>
                Banjarmasin Tengah<br>
                Kalimantan Selatan
            </p>
        </div>

        <div class="kontak-item">
            <h4>🌐 Media Sosial</h4>
            <p>Instagram : @smkmuh2bjm</p>
            <p>Facebook : SMK Muhammadiyah 2 Banjarmasin</p>
            <p>YouTube : SMK Muhammadiyah 2 Banjarmasin</p>
        </div>

    </div>

</section>

@endsection