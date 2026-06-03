@extends('layouts.app')

@section('title', 'Status Pendaftaran')

@section('content')

<section class="biodata-page">
    <div class="container">
        <div class="biodata-card">

            @php
                $status = $biodata->status_pendaftaran ?? 'menunggu';
            @endphp

            <h2>Status Pendaftaran</h2>
            <p>Berikut adalah hasil seleksi pendaftaran Anda.</p>

            <p>
                Email login:
                <strong>{{ auth()->user()->email }}</strong>
            </p>

            <p>
                Status dari database:
                <strong>{{ strtoupper($status) }}</strong>
            </p>

            @if($status == 'diterima')

                <div style="background:#d1e7dd; color:#0f5132; padding:15px; border-radius:8px; margin-top:20px;">
                    🎉 Selamat! Anda dinyatakan <strong>DITERIMA</strong>.
                </div>

            @elseif($status == 'tidak_diterima')

                <div style="background:#f8d7da; color:#842029; padding:15px; border-radius:8px; margin-top:20px;">
                    Mohon maaf, Anda dinyatakan <strong>TIDAK DITERIMA</strong>.
                </div>

            @else

                <div style="background:#fff3cd; color:#664d03; padding:15px; border-radius:8px; margin-top:20px;">
                    Status seleksi Anda masih <strong>MENUNGGU</strong>.
                </div>

            @endif

        </div>
    </div>
</section>

@endsection