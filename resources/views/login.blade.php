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

    <div class="password-wrapper">
        <input type="password"
               id="password"
               name="password"
               placeholder="Ketik password"
               required>

        <i class="fas fa-eye toggle-password"
           id="togglePassword"></i>
    </div>
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

<script>
document.addEventListener('DOMContentLoaded', function () {

    const password = document.getElementById('password');
    const toggle = document.getElementById('togglePassword');

    toggle.addEventListener('click', function () {

        if (password.type === 'password') {
            password.type = 'text';

            toggle.classList.remove('fa-eye');
            toggle.classList.add('fa-eye-slash');
        } else {
            password.type = 'password';

            toggle.classList.remove('fa-eye-slash');
            toggle.classList.add('fa-eye');
        }

    });

});
</script>
@endsection