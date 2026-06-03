@extends('layouts.app')

@section('title', 'Pembayaran Pendaftaran')

@section('content')
<section class="biodata-page">
    <div class="container">
        <div class="biodata-card">

            @php
                $status = $biodata->status_pembayaran ?? 'belum_bayar';
            @endphp

            @if(session('success'))
                <div class="alert-success-custom">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert-error-custom">
                    {{ session('error') }}
                </div>
            @endif

            @if($status === 'belum_bayar')

                <h2>Pembayaran Pendaftaran</h2>

                <p>
                    Untuk melanjutkan proses pendaftaran SPMB, calon peserta diwajibkan melakukan
                    pembayaran biaya pendaftaran terlebih dahulu.
                </p>

                <div class="payment-box">
                    <h3>Informasi Pembayaran</h3>
                    <p><strong>Biaya Pendaftaran:</strong> Rp50.000</p>
                    <p><strong>Metode:</strong> Transfer Bank</p>
                    <p><strong>Bank:</strong> BSI</p>
                    <p><strong>No Rekening:</strong> 1234567890</p>
                    <p><strong>Atas Nama:</strong> SMK Muhammadiyah 2</p>
                    <p style="margin-top:10px;">
                        Setelah melakukan pembayaran, silakan upload bukti pembayaran di bawah ini.
                    </p>
                </div>

                <form action="{{ route('pembayaran.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>Upload Bukti Pembayaran</label>
                        <input type="file" name="bukti_pembayaran" accept=".jpg,.jpeg,.png" required>
                    </div>

                    <button type="submit" class="btn-submit-biodata">
                        Kirim Bukti Pembayaran
                    </button>
                </form>

            @elseif($status === 'menunggu_verifikasi')

                <h2>Status Pembayaran</h2>

                <div class="alert-info">
                    Bukti pembayaran Anda berhasil dikirim dan sedang menunggu verifikasi admin.
                </div>

                @if($biodata->bukti_pembayaran)
                    <p>
                        <strong>Bukti Pembayaran:</strong>
                        <a href="{{ asset('storage/' . $biodata->bukti_pembayaran) }}" target="_blank">
                            Lihat Bukti
                        </a>
                    </p>
                @endif

                <div class="payment-box">
                    <h3>Detail Pembayaran</h3>
                    <p><strong>Status:</strong> Menunggu Verifikasi</p>
                    <p><strong>Biaya Pendaftaran:</strong> Rp50.000</p>
                    <p><strong>Metode:</strong> Transfer Bank</p>
                    <p><strong>Bank:</strong> BSI</p>
                    <p><strong>No Rekening:</strong> 1234567890</p>
                    <p><strong>Atas Nama:</strong> SMK Muhammadiyah 2</p>
                </div>

            @elseif($status === 'lunas')

                <h2>Pembayaran Lunas</h2>

                <div class="alert-success-custom">
                    Pembayaran Anda telah diverifikasi admin.
                </div>

                <a href="{{ route('biodata.create') }}" class="btn-next" style="text-decoration:none; display:inline-block;">
                    Lanjut Isi Biodata →
                </a>

            @endif

        </div>
    </div>
</section>
@endsection