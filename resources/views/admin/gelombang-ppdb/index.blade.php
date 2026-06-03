@extends('layouts.adminlte')

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3>Gelombang SPMB</h3>

        <a href="{{ route('admin.gelombang-ppdb.create') }}"
           class="btn btn-primary">

            Tambah Gelombang
        </a>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th>No</th>
                <th>Gelombang</th>
                <th>Tahun Ajaran</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>

           @forelse($gelombang as $item)

<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $item->nama_gelombang }}</td>
    <td>{{ $item->tahunAjaran->tahun_ajaran ?? '-' }}</td>
    <td>{{ $item->tanggal_mulai }}</td>
    <td>{{ $item->tanggal_selesai }}</td>
    <td>{{ $item->status }}</td>

    <td>

        <a href="{{ route('admin.gelombang-ppdb.edit', $item->id) }}"
           class="btn btn-warning btn-sm">

            Edit
        </a>

        <form action="{{ route('admin.gelombang-ppdb.destroy', $item->id) }}"
              method="POST"
              style="display:inline-block">

            @csrf
            @method('DELETE')

            <button class="btn btn-danger btn-sm">
                Hapus
            </button>

                </form>

            </td>

        </tr>

        @empty

        <tr>
            <td colspan="7" class="text-center">
                Belum ada data gelombang SPMB
            </td>
        </tr>

    @endforelse

        </table>

    </div>
</div>

@endsection