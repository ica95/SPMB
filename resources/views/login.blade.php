@extends('layouts.app')

@section('title', 'Login SPMB')

@section('body_class', 'inner-page auth-page')

@section('content')
<section class="auth-section">
    <div class="auth-overlay"></div>

    <div class="container auth-wrapper">
        <div class="auth-card">
            <div class="auth-header">
                <img src="{{ asset('images/logo-smk.jpg') }}" alt="Logo Sekolah" class="auth-logo">
                <h1>Masuk ke Akun</h1>
                <p>Gunakan nomor pendaftaran dan password yang sudah dibuat sistem</p>
            </div>

            @if(session('error'))
                <div class="auth-alert error">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('login.auth') }}" method="POST" class="auth-form">
                @csrf

                <div class="auth-group">
                    <label for="nomor_pendaftaran">Nomor Pendaftaran</label>
                    <input type="text" id="nomor_pendaftaran" name="nomor_pendaftaran" placeholder="Ketik nomor pendaftaran" required>
                </div>

                <div class="auth-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Ketik password" required>
                </div>

                <button type="submit" class="auth-btn">Masuk</button>
            </form>

            <div class="auth-links">
                <a href="{{ route('password.lupa') }}"
                    class="forgot-link">Lupa Password?</a>

                <p>Belum punya akun? <a href="{{ route('register') }}">Daftar Sekarang</a></p>
            </div>
        </div>
    </div>
</section>
@endsection