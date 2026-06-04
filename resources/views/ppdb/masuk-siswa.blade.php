@extends('layouts.siswa')

@section('title', 'Dashboard Siswa')

@section('content')

@php
    $biodata = $biodata ?? $user->biodata;
@endphp

<div class="row">

    {{-- IDENTITAS SISWA --}}
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h3 class="card-title">
                    <i class="fas fa-user"></i>
                    Identitas Akun
                </h3>
            </div>

            <div class="card-body">
                <p><strong>Nama:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>No. Pendaftaran:</strong> {{ $user->nomor_pendaftaran ?? '-' }}</p>
            </div>
        </div>
    </div>

    {{-- INFO PENGUMUMAN DARI ADMIN --}}
<div class="col-12">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h3 class="card-title">
                <i class="fas fa-bullhorn"></i>
                Info Pengumuman
            </h3>
        </div>

        <div class="card-body">
            @if(isset($pengumuman) && $pengumuman->count() > 0)
                @foreach($pengumuman as $item)
                    <div class="mb-3 border-bottom pb-2">
                        <h5>{{ $item->judul }}</h5>

                        @if($item->tanggal)
                            <small>{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</small>
                        @endif

                        <p class="mb-0">{{ $item->isi }}</p>
                    </div>
                @endforeach
            @else
                <p class="mb-0">Belum ada pengumuman yang dipublikasikan.</p>
            @endif
        </div>
    </div>
</div>


    {{-- STATUS PEMBAYARAN --}}
    <div class="col-md-6">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5>Status Pembayaran</h5>

                <h3>
                    @if(($biodata->status_pembayaran ?? 'belum_bayar') == 'lunas')
                        <span class="badge bg-success">LUNAS</span>

                    @elseif(($biodata->status_pembayaran ?? 'belum_bayar') == 'menunggu_verifikasi')
                        <span class="badge bg-warning">MENUNGGU VERIFIKASI</span>

                    @else
                        <span class="badge bg-danger">MENUNGGU PEMBAYARAN</span>
                    @endif
                </h3>
            </div>
        </div>
    </div>

    {{-- STATUS SELEKSI --}}
    <div class="col-md-6">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <h5>Status Seleksi</h5>

                <h3>
                    @if(($biodata->status_pendaftaran ?? 'menunggu') == 'diterima')
                        Diterima
                    @elseif(($biodata->status_pendaftaran ?? 'menunggu') == 'tidak_diterima')
                        Tidak Diterima
                    @else
                        Menunggu Seleksi
                    @endif
                </h3>
            </div>
        </div>
    </div>

    {{-- AKSI SISWA --}}
    @if(($biodata->status_pembayaran ?? 'belum_bayar') == 'belum_bayar')

        <div class="col-md-6">
            <a href="{{ route('pembayaran.index') }}" class="text-decoration-none">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-money-bill-wave fa-3x mb-3"></i>
                        <h4>Bayar Pendaftaran</h4>
                    </div>
                </div>
            </a>
        </div>

    @elseif(($biodata->status_pembayaran ?? 'belum_bayar') == 'menunggu_verifikasi')

        <div class="col-12">
            <div class="alert alert-warning">
                Pembayaran Anda sedang menunggu verifikasi admin.
            </div>
        </div>

    @elseif(($biodata->status_pembayaran ?? 'belum_bayar') == 'lunas' && !($biodata->is_final ?? 0))

        <div class="col-md-6">
            <a href="{{ route('biodata.create') }}" class="text-decoration-none">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-user-edit fa-3x mb-3"></i>
                        <h4>Isi Formulir Pendaftaran</h4>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6">
            <a href="{{ route('review.index') }}" class="text-decoration-none">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-file-alt fa-3x mb-3"></i>
                        <h4>Review Data Pendaftaran</h4>
                    </div>
                </div>
            </a>
        </div>

    @endif

    @if($biodata && $biodata->is_final)

        {{-- CETAK BUKTI --}}
        <div class="col-md-4">
            <a href="{{ route('pendaftaran.cetakBukti') }}" class="text-decoration-none">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-print fa-3x mb-3"></i>
                        <h4>Cetak Bukti Pendaftaran</h4>
                    </div>
                </div>
            </a>
        </div>

        {{-- KWITANSI --}}
        <div class="col-md-4">
            <a href="{{ route('kwitansi') }}" class="text-decoration-none">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-receipt fa-3x mb-3"></i>
                        <h4>Kwitansi Pembayaran</h4>
                    </div>
                </div>
            </a>
        </div>

        {{-- STATUS --}}
        <div class="col-md-4">
            <a href="{{ route('pendaftaran.status') }}" class="text-decoration-none">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fas fa-check-circle fa-3x mb-3"></i>
                        <h4>Cek Status Pendaftaran</h4>
                    </div>
                </div>
            </a>
        </div>

    @endif

</div>

@endsection