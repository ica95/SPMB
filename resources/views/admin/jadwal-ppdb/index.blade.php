@extends('layouts.adminlte')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between">

        <h3>Jadwal SPMB</h3>

        <a href="{{ route('admin.jadwal-ppdb.create') }}"
           class="btn btn-primary">

            Tambah Jadwal
        </a>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th>No</th>
                <th>Nama Kegiatan</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>

            @forelse($jadwal as $item)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $item->nama_kegiatan }}</td>

                <td>{{ $item->tanggal_mulai }}</td>

                <td>{{ $item->tanggal_selesai }}</td>

                <td>{{ $item->status }}</td>

                <td>

                    <a href="{{ route('admin.jadwal-ppdb.edit', $item->id) }}"
                       class="btn btn-warning btn-sm">

                        Edit
                    </a>

                    <form action="{{ route('admin.jadwal-ppdb.destroy', $item->id) }}"
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
                <td colspan="6" class="text-center">
                    Belum ada jadwal SPMB
                </td>
            </tr>

            @endforelse

        </table>

    </div>

</div>

@endsection