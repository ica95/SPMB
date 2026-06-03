@extends('layouts.adminlte')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Tambah Program Keahlian</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.program-keahlian.store') }}"
              method="POST">

            @csrf

            <div class="mb-3">
                <label>Nama Program</label>

                <input type="text"
                       name="nama_program"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label>Kuota</label>

                <input type="number"
                       name="kuota"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label>Status</label>

                <select name="status" class="form-control">
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                </select>
            </div>

            <button type="submit"
                    class="btn btn-primary">

                Simpan
            </button>

        </form>

    </div>
</div>

@endsection