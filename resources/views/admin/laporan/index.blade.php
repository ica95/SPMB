@extends('layouts.adminlte')

@section('content')

<h2>Laporan Pendaftaran SPMB</h2>

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

{{-- FILTER --}}
<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">Filter Laporan</h3>
    </div>

    <div class="card-body">
        <form method="GET" action="{{ route('admin.laporan.index') }}">

            <div class="row">

                <div class="col-md-3">
                    <label>Tahun Ajaran</label>
                    <select name="tahun_ajaran_id" class="form-control">
                        <option value="">-- Semua Tahun Ajaran --</option>
                        @foreach($tahunAjarans as $tahun)
                            <option value="{{ $tahun->id }}"
                                {{ request('tahun_ajaran_id') == $tahun->id ? 'selected' : '' }}>
                                {{ $tahun->tahun_ajaran }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Gelombang</label>
                    <select name="gelombang_ppdb_id" class="form-control">
                        <option value="">-- Semua Gelombang --</option>
                        @foreach($gelombangs as $gelombang)
                            <option value="{{ $gelombang->id }}"
                                {{ request('gelombang_ppdb_id') == $gelombang->id ? 'selected' : '' }}>
                                {{ $gelombang->nama_gelombang }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Program Keahlian</label>
                    <select name="jurusan" class="form-control">
                        <option value="">-- Semua Jurusan --</option>
                        @foreach($jurusans as $item)
                            <option value="{{ $item->id }}"
                                {{ request('jurusan') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_program }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Status Seleksi</label>
                    <select name="status_pendaftaran" class="form-control">
                        <option value="">-- Semua Status --</option>
                        <option value="menunggu" {{ request('status_pendaftaran') == 'menunggu' ? 'selected' : '' }}>
                            Menunggu
                        </option>
                        <option value="diterima" {{ request('status_pendaftaran') == 'diterima' ? 'selected' : '' }}>
                            Diterima
                        </option>
                        <option value="tidak_diterima" {{ request('status_pendaftaran') == 'tidak_diterima' ? 'selected' : '' }}>
                            Tidak Diterima
                        </option>
                    </select>
                </div>

            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Tampilkan</button>
                <a href="{{ route('admin.laporan.index') }}" class="btn btn-secondary">Reset</a>
            </div>

        </form>
    </div>
</div>

{{-- RINGKASAN --}}
<div class="row">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h4>{{ $totalPendaftar }}</h4>
                <p>Total Pendaftar</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h4>{{ $diterima }}</h4>
                <p>Diterima</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h4>{{ $ditolak }}</h4>
                <p>Tidak Diterima</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <h4>{{ $menunggu }}</h4>
                <p>Menunggu</p>
            </div>
        </div>
    </div>
</div>

{{-- JUMLAH PER JURUSAN --}}
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Jumlah Pendaftar Per Jurusan</h3>
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Jurusan</th>
                    <th>Total Pendaftar</th>
                </tr>
            </thead>

            <tbody>
                @forelse($perJurusan as $item)
                    <tr>
                        <td>{{ $item->programKeahlian->nama_program ?? '-' }}</td>
                        <td>{{ $item->total }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">Belum ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- DATA PENDAFTAR --}}
<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Daftar Nama Pendaftar</h3>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No. Pendaftaran</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Tahun Ajaran</th>
                    <th>Gelombang</th>
                    <th>Jurusan</th>
                    <th>Status Seleksi</th>
                    <th>Status Daftar Ulang</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pendaftar as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->nomor_pendaftaran ?? '-' }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->biodata->tahunAjaran->tahun_ajaran ?? '-' }}</td>
                        <td>{{ $user->biodata->gelombangPpdb->nama_gelombang ?? '-' }}</td>
                        <td>{{ $user->biodata->programKeahlian->nama_program ?? '-' }}</td>

                        <td>
                            @if(($user->biodata->status_pendaftaran ?? 'menunggu') == 'diterima')
                                <span class="badge bg-success">Diterima</span>
                            @elseif(($user->biodata->status_pendaftaran ?? 'menunggu') == 'tidak_diterima')
                                <span class="badge bg-danger">Tidak Diterima</span>
                            @else
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            @endif
                        </td>

                        <td>
                            @if($user->biodata && $user->biodata->status_daftar_ulang == 'lunas')
                                <span class="badge bg-success">Sudah Daftar Ulang</span>
                            @else
                                <span class="badge bg-secondary">Belum Daftar Ulang</span>
                            @endif
                        </td>

                        <td>
                            <form action="{{ route('admin.laporan.destroy', $user->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus data pendaftar ini? Semua data terkait siswa ini akan ikut dihapus.')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">Belum ada data pendaftar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection