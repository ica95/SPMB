@extends('layouts.adminlte')

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3>Program Keahlian</h3>

        <a href="{{ route('admin.program-keahlian.create') }}"
           class="btn btn-primary">

            Tambah Jurusan
        </a>
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th>No</th>
                <th>Nama Program</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>

            @foreach($jurusan as $item)

            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_program }}</td>
                <td>{{ $item->status }}</td>

                <td>

                    <a href="{{ route('admin.program-keahlian.edit', $item->id) }}"
                       class="btn btn-warning btn-sm">

                        Edit
                    </a>

                    <form action="{{ route('admin.program-keahlian.destroy', $item->id) }}"
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

            @endforeach

        </table>

    </div>
</div>

@endsection