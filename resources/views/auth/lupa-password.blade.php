@extends('layouts.app')

@section('title', 'Lupa Password')

@section('content')

<div class="auth-section">
    <div class="auth-overlay"></div>

    <div class="auth-wrapper">

        <div class="auth-card">

            <div class="auth-header">
               <img src="{{ asset('images/logo-smk.jpg') }}" alt="Logo Sekolah" class="auth-logo">
                     class="auth-logo">

                <h1>Lupa Password</h1>

                <p>
                    Masukkan nomor pendaftaran dan email
                    untuk mendapatkan password baru.
                </p>
            </div>

            {{-- ALERT SUCCESS --}}
            @if(session('success'))
                <div class="auth-alert success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- ALERT ERROR --}}
            @if(session('error'))
                <div class="auth-alert error">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('password.reset') }}"
                  method="POST"
                  class="auth-form">

                @csrf

                <div class="auth-group">
                    <label>Nomor Pendaftaran</label>

                    <input type="text"
                           name="nomor_pendaftaran"
                           required>
                </div>

                <div class="auth-group">
                    <label>Email</label>

                    <input type="email"
                           name="email"
                           required>
                </div>

                <button type="submit"
                        class="auth-btn">

                    Reset Password

                </button>

            </form>

            <div class="auth-links">
                <a href="{{ route('login') }}">
                    Kembali ke Login
                </a>
            </div>

        </div>

    </div>
</div>

@endsection