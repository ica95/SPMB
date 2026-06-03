@extends('layouts.adminlte')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between">

        <h3>Pengumuman SPMB</h3>

        <a href="{{ route('admin.pengumuman-ppdb.create') }}"
           class="btn btn-primary">

            Tambah Pengumuman
        </a>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>

            @forelse($pengumuman as $item)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $item->judul }}</td>

                <td>{{ $item->tanggal }}</td>

                <td>{{ $item->status }}</td>

                <td>

                    <a href="{{ route('admin.pengumuman-ppdb.edit', $item->id) }}"
                       class="btn btn-warning btn-sm">

                        Edit
                    </a>

                    <form action="{{ route('admin.pengumuman-ppdb.destroy', $item->id) }}"
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
                <td colspan="5" class="text-center">
                    Belum ada pengumuman SPMB
                </td>
            </tr>

            @endforelse

        </table>

    </div>

</div>

@endsection