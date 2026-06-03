@extends('layouts.adminlte')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            Seleksi Siswa
        </h3>
    </div>

    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- FILTER --}}
        <div class="mb-3">

            <a href="{{ route('admin.seleksi.index') }}"
               class="btn btn-secondary btn-sm">
                Semua
            </a>

            <a href="{{ route('admin.seleksi.index', ['filter' => 'menunggu']) }}"
               class="btn btn-warning btn-sm">
                Menunggu
            </a>

            <a href="{{ route('admin.seleksi.index', ['filter' => 'diterima']) }}"
               class="btn btn-success btn-sm">
                Diterima
            </a>

            <a href="{{ route('admin.seleksi.index', ['filter' => 'tidak_diterima']) }}"
               class="btn btn-danger btn-sm">
                Tidak Diterima
            </a>

        </div>

        {{-- SEARCH --}}
        <form action="{{ route('admin.seleksi.index') }}"
              method="GET"
              class="mb-3">

            <div class="input-group">

                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="Cari nama, email, atau nomor pendaftaran..."
                       value="{{ request('search') }}">

                <input type="hidden"
                       name="filter"
                       value="{{ request('filter') }}">

                <button type="submit"
                        class="btn btn-primary">

                    Cari

                </button>

                <a href="{{ route('admin.seleksi.index') }}"
                   class="btn btn-secondary">

                    Reset

                </a>

            </div>

        </form>

        <table class="table table-bordered table-hover">

            <thead class="table-light">

                <tr>
                    <th width="5%">No</th>
                    <th>No. Pendaftaran</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Status Pembayaran</th>
                    <th>Status Seleksi</th>
                    <th width="30%">Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse($users as $user)

    @php
        $biodata = $user->biodata;
    @endphp

    <tr>
        <td>{{ $loop->iteration }}</td>

        <td>{{ $user->nomor_pendaftaran ?? '-' }}</td>

        <td>{{ $user->name }}</td>

        <td>{{ $user->email }}</td>

        {{-- STATUS PEMBAYARAN --}}
        <td>
            @if(($biodata->status_pembayaran ?? 'belum_bayar') == 'lunas')
                <span class="badge bg-success">Lunas</span>
            @elseif(($biodata->status_pembayaran ?? 'belum_bayar') == 'menunggu_verifikasi')
                <span class="badge bg-warning">Menunggu Verifikasi</span>
            @else
                <span class="badge bg-danger">Belum Bayar</span>
            @endif
        </td>

        {{-- STATUS SELEKSI --}}
        <td>
            @if(($biodata->status_pendaftaran ?? 'menunggu') == 'diterima')
                <span class="badge bg-success">Diterima</span>
            @elseif(($biodata->status_pendaftaran ?? 'menunggu') == 'tidak_diterima')
                <span class="badge bg-danger">Tidak Diterima</span>
            @else
                <span class="badge bg-warning text-dark">Menunggu</span>
            @endif
        </td>

        {{-- AKSI --}}
        <td>
            <a href="{{ route('admin.seleksi.show', $user->id) }}" class="btn btn-info btn-sm">
                Lihat Detail
            </a>

            @if(($biodata->status_pembayaran ?? 'belum_bayar') == 'lunas')

                <form action="{{ route('admin.seleksi.update', $user->id) }}"
                      method="POST">
                    @csrf

                    <select name="status_pendaftaran"
                            class="form-control mb-2">

                        <option value="menunggu"
                            {{ ($biodata->status_pendaftaran ?? 'menunggu') == 'menunggu' ? 'selected' : '' }}>
                            Menunggu
                        </option>

                        <option value="diterima"
                            {{ ($biodata->status_pendaftaran ?? 'menunggu') == 'diterima' ? 'selected' : '' }}>
                            Diterima
                        </option>

                        <option value="tidak_diterima"
                            {{ ($biodata->status_pendaftaran ?? 'menunggu') == 'tidak_diterima' ? 'selected' : '' }}>
                            Tidak Diterima
                        </option>

                    </select>

                    <button type="submit" class="btn btn-primary btn-sm mb-2">
                        Simpan
                    </button>
                </form>

                <form action="{{ route('admin.seleksi.destroy', $user->id) }}"
                      method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus data siswa ini?')">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger btn-sm mb-2">
                        Hapus
                    </button>
                </form>

                {{-- STATUS DAFTAR ULANG --}}
                @if(($biodata->status_pendaftaran ?? 'menunggu') == 'diterima')

                    @if(($biodata->status_daftar_ulang ?? 'belum_bayar') == 'lunas')

                        <div class="alert alert-success text-center py-1 mb-2">
                            Daftar Ulang Lunas
                        </div>

                        <form action="{{ url('/admin/seleksi/' . $user->id . '/daftar-ulang-belum-lunas') }}"
                              method="POST">
                            @csrf

                            <button type="submit" class="btn btn-warning btn-sm w-100">
                                Batalkan Lunas
                            </button>
                        </form>

                    @else

                        <div class="alert alert-secondary text-center py-1 mb-2">
                            Belum Daftar Ulang
                        </div>

                        <form action="{{ url('/admin/seleksi/' . $user->id . '/daftar-ulang-lunas') }}"
                              method="POST">
                            @csrf

                            <button type="submit" class="btn btn-success btn-sm w-100">
                                Lunas Daftar Ulang
                            </button>
                        </form>

                    @endif

                @endif

            @else

                <select class="form-control mb-2" disabled>
                    <option>Belum bisa diseleksi</option>
                </select>

                <button class="btn btn-secondary btn-sm" disabled>
                    Menunggu Pembayaran
                </button>

            @endif
        </td>
    </tr>

@empty

    <tr>
        <td colspan="7" class="text-center">
            Belum ada data seleksi siswa.
        </td>
    </tr>

@endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection