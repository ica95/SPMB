@extends('layouts.adminlte')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h3 class="card-title">
            Data SPMB
        </h3>

    </div>

    <div class="card-body">

        <table class="table table-bordered table-hover">

            <thead class="table-light">

                <tr>
                    <th width="5%">No</th>
                    <th>Nama</th>
                    <th>Program Keahlian</th>
                    <th>Status Pendaftaran</th>
                    <th>Status Daftar Ulang</th>
                    <th width="35%">Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse($ppdb as $item)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $item->nama_lengkap }}
                        </td>

                        <td>
                            {{ $item->program_keahlian }}
                        </td>

                        <td>

                            @if($item->status_pendaftaran == 'diterima')

                                <span class="badge bg-success">
                                    Diterima
                                </span>

                            @elseif($item->status_pendaftaran == 'tidak_diterima')

                                <span class="badge bg-danger">
                                    Ditolak
                                </span>

                            @else

                                <span class="badge bg-warning">
                                    Menunggu
                                </span>

                            @endif

                        </td>

                        <td>

                        <td>

    @if($item->status_daftar_ulang == 'lunas')

        <span class="badge bg-success">
            Lunas
        </span>

    @else

        <span class="badge bg-warning">
            Belum Bayar
        </span>

    @endif

    <form action="{{ route('admin.siswa.daftar-ulang', $item->id) }}"
          method="POST"
          class="mt-2">

        @csrf

        <select name="status_daftar_ulang"
                class="form-control form-control-sm">

            <option value="belum_bayar"
                {{ $item->status_daftar_ulang == 'belum_bayar' ? 'selected' : '' }}>

                Belum Bayar

            </option>

            <option value="lunas"
                {{ $item->status_daftar_ulang == 'lunas' ? 'selected' : '' }}>

                Lunas

            </option>

        </select>

        <button type="submit"
                class="btn btn-success btn-sm mt-2">

            Simpan

        </button>

    </form>

</td>

                            {{-- DETAIL --}}
                            <a href="{{ route('admin.ppdb.show', $item->id) }}"
                               class="btn btn-info btn-sm">

                                Detail Berkas
                            </a>

                            {{-- EDIT --}}
                            <a href="{{ route('admin.ppdb.edit', $item->id) }}"
                               class="btn btn-warning btn-sm">

                                Edit
                            </a>

                            {{-- TERIMA --}}
                            <form action="{{ route('admin.ppdb.terima', $item->id) }}"
                                  method="POST"
                                  style="display:inline-block;">

                                @csrf

                                <button type="submit"
                                        class="btn btn-success btn-sm"
                                        onclick="return confirm('Terima calon siswa ini?')">

                                    Terima
                                </button>

                            </form>

                            {{-- TOLAK --}}
                            <form action="{{ route('admin.ppdb.tolak', $item->id) }}"
                                  method="POST"
                                  style="display:inline-block;">

                                @csrf

                                <button type="submit"
                                        class="btn btn-secondary btn-sm"
                                        onclick="return confirm('Tolak calon siswa ini?')">

                                    Tolak
                                </button>

                            </form>

                            {{-- HAPUS --}}
                            <form action="{{ route('admin.ppdb.destroy', $item->id) }}"
                                  method="POST"
                                  style="display:inline-block;">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')">

                                    Hapus
                                </button>

                            </form>
                            

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5" class="text-center">
                            Belum ada data SPMB.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection