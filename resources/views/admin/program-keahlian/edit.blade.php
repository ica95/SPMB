@extends('layouts.adminlte')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Edit Program Keahlian</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.program-keahlian.update', $jurusan->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Program</label>

                <input type="text"
                       name="nama_program"
                       class="form-control"
                       value="{{ $jurusan->nama_program }}">
            </div>

            <div class="mb-3">
                <label>Kuota</label>

                <input type="number"
                       name="kuota"
                       class="form-control"
                       value="{{ $jurusan->kuota }}">
            </div>

            <div class="mb-3">
                <label>Status</label>

                <select name="status" class="form-control">

                    <option value="aktif"
                        {{ $jurusan->status == 'aktif' ? 'selected' : '' }}>
                        Aktif
                    </option>

                    <option value="nonaktif"
                        {{ $jurusan->status == 'nonaktif' ? 'selected' : '' }}>
                        Nonaktif
                    </option>

                </select>
            </div>

            <button type="submit"
                    class="btn btn-primary">

                Update
            </button>

        </form>

    </div>
</div>

@endsection