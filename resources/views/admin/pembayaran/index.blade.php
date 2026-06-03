@extends('layouts.adminlte')

@section('content')

<h2 class="mb-4">Verifikasi Pembayaran Admin</h2>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="mb-4">
    <a href="{{ route('admin.pembayaran', ['status' => 'menunggu_verifikasi']) }}"
       class="btn {{ $status == 'menunggu_verifikasi' ? 'btn-success' : 'btn-secondary' }}">
        Menunggu Verifikasi
    </a>

    <a href="{{ route('admin.pembayaran', ['status' => 'lunas']) }}"
       class="btn {{ $status == 'lunas' ? 'btn-success' : 'btn-secondary' }}">
        Sudah Lunas
    </a>

    <a href="{{ route('admin.pembayaran', ['status' => 'belum_bayar']) }}"
       class="btn {{ $status == 'belum_bayar' ? 'btn-success' : 'btn-secondary' }}">
        Belum Bayar
    </a>
</div>

@forelse($users as $user)
    <div class="card mb-4">
        <div class="card-body">

        @php
    $biodata = $user->biodata;
@endphp

            <p><strong>Nama:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>

            <p>
    <strong>Status:</strong>
    @if(($biodata->status_pembayaran ?? 'belum_bayar') == 'lunas')
        <span class="badge bg-success">Lunas</span>
    @elseif(($biodata->status_pembayaran ?? 'belum_bayar') == 'menunggu_verifikasi')
        <span class="badge bg-warning text-dark">Menunggu Verifikasi</span>
    @else
        <span class="badge bg-secondary">Belum Bayar</span>
    @endif
</p>

@if($biodata && $biodata->bukti_pembayaran)
    <div class="mb-3">
        <img src="{{ asset('storage/' . $biodata->bukti_pembayaran) }}"
             alt="Bukti Pembayaran"
             style="width:260px; border-radius:10px; border:1px solid #ddd;">
    </div>
@endif

            <div class="d-flex gap-2 flex-wrap">

    {{-- STATUS MENUNGGU VERIFIKASI --}}
   @if(($biodata->status_pembayaran ?? 'belum_bayar') == 'menunggu_verifikasi')

        <form action="{{ route('admin.pembayaran.verifikasi', $user->id) }}" method="POST">
            @csrf

            <input type="hidden" name="status" value="{{ $status }}">

            <button type="submit" class="btn btn-success">
                Verifikasi
            </button>
        </form>

        <form action="{{ route('admin.pembayaran.reset', $user->id) }}"
              method="POST"
              onsubmit="return confirm('Yakin ingin reset upload ini?')">

            @csrf

            <input type="hidden" name="status" value="{{ $status }}">

            <button type="submit" class="btn btn-warning">
                Reset Upload
            </button>

        </form>

    {{-- STATUS LUNAS --}}
    @elseif(($biodata->status_pembayaran ?? 'belum_bayar') == 'lunas')

        <span class="badge bg-success p-2">
            Pembayaran Sudah Diverifikasi
        </span>

    {{-- STATUS BELUM BAYAR --}}
    @else

        <span class="badge bg-secondary p-2">
            Belum Upload Bukti
        </span>

    @endif

    {{-- DELETE SELALU MUNCUL --}}
    <form action="{{ route('admin.pembayaran.delete', $user->id) }}"
          method="POST"
          onsubmit="return confirm('Yakin mau hapus user ini?')">

        @csrf
        @method('DELETE')

        <input type="hidden" name="status" value="{{ $status }}">

        <button type="submit" class="btn btn-outline-danger">
            Delete
        </button>

    </form>

</div>

        </div>
    </div>
@empty
    <div class="card">
        <div class="card-body">
            @if($status == 'menunggu_verifikasi')
                Tidak ada pembayaran yang perlu diverifikasi.
            @elseif($status == 'lunas')
                Belum ada data pembayaran yang sudah lunas.
            @elseif($status == 'belum_bayar')
                Belum ada data user yang belum membayar.
            @endif
        </div>
    </div>
@endforelse

@endsection