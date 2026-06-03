@extends('layouts.app')

@section('title', 'Daftar Akun SPMB')

@section('body_class', 'inner-page auth-page')

@section('content')
<section class="auth-section">
    <div class="auth-overlay"></div>

    <div class="container auth-wrapper">
        <div class="auth-card">
            <div class="auth-header">
                <img src="{{ asset('images/logo-smk.jpg') }}" alt="Logo Sekolah" class="auth-logo">
                <h1>Daftar Akun SPMB</h1>
                <p>Masukkan nama dan email. Sistem akan membuat nomor pendaftaran dan password otomatis.</p>
            </div>

            @if ($errors->any())
                <div class="auth-alert error">
                    <ul style="margin:0; padding-left:18px; text-align:left;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

                        @if(session('error'))
                <div class="auth-alert error">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('account_success'))
                <div class="auth-alert success">
                    <strong>Pendaftaran akun berhasil.</strong><br><br>
                    <strong>Email:</strong> {{ session('account_success.email') }}<br>
                    <strong>Nomor Pendaftaran:</strong> {{ session('account_success.nomor_pendaftaran') }}<br>
                    <strong>Password:</strong> {{ session('account_success.password') }}<br><br>
                    <span>Simpan data ini baik-baik untuk login ke sistem SPMB.</span>
                </div>
            @endif

            <form action="{{ route('register.store') }}" method="POST" class="auth-form">
                @csrf

                <div class="auth-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap" required>
                </div>

                <div class="auth-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Masukkan email aktif" required>
                </div>

                <button type="submit" class="auth-btn">Daftar Sekarang</button>
            </form>

            <div class="auth-links">
                <p>Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
            </div>
        </div>
    </div>
</section>
@endsection