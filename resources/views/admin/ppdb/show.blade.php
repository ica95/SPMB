@extends('layouts.adminlte')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Detail Berkas Pendaftar</h3>
    </div>

    <div class="card-body">

        <p><strong>Nama:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Status Pembayaran:</strong> {{ $biodata->status_pembayaran ?? '-' }}</p>
        <p><strong>Status Pendaftaran:</strong> {{ $biodata->status_pendaftaran ?? '-' }}</p>
        <p><strong>No. Pendaftaran:</strong> {{ $user->nomor_pendaftaran }}</p>

        <hr>

        <h4>Berkas Upload</h4>

        <table class="table table-bordered">
            <tr>
                <th>Jenis Berkas</th>
                <th>File</th>
            </tr>

            <tr>
                <td>Kartu Keluarga</td>
                <td>
                    @if(isset($biodata) && $biodata->file_kk)
                    <a href="{{ asset('storage/' . $biodata->file_kk) }}" target="_blank" class="btn btn-info btn-sm">
                            Lihat KK
                        </a>
                    @else
                        -
                    @endif
                </td>
            </tr>

            <tr>
                <td>Akta Kelahiran</td>
                <td>
                    @if(isset($biodata) && $biodata->file_akta)
                        <a href="{{ asset('storage/' . $biodata->file_akta) }}" target="_blank" class="btn btn-info btn-sm">
                            Lihat Akta
                        </a>
                    @else
                        -
                    @endif
                </td>
            </tr>

            <tr>
                <td>SKL / Ijazah</td>
                <td>
                    @if(isset($biodata) && $biodata->file_skl)
                        <a href="{{ asset('storage/' . $biodata->file_skl) }}" target="_blank" class="btn btn-info btn-sm">
                            Lihat SKL
                        </a>
                    @else
                        -
                    @endif
                </td>
            </tr>

            <tr>
                <td>Pas Foto</td>
                <td>
                    @if(isset($biodata) && $biodata->file_foto)
                        <img src="{{ asset('storage/' . $biodata->file_foto) }}" width="120" style="border-radius:8px;">
                    @else
                        -
                    @endif
                </td>
            </tr>

            <tr>
                <td>Surat Sehat</td>
                <td>
                    @if(isset($biodata) && $biodata->file_surat_sehat)
                        <a href="{{ asset('storage/' . $biodata->file_surat_sehat) }}" target="_blank" class="btn btn-info btn-sm">
                            Lihat Surat Sehat
                        </a>
                    @else
                        -
                    @endif
                </td>
            </tr>

            <tr>
                <td>Surat Buta Warna</td>
                <td>
                    @if(isset($biodata) && $biodata->file_surat_warna)
                        <a href="{{ asset('storage/' . $biodata->file_surat_warna) }}" target="_blank" class="btn btn-info btn-sm">
                            Lihat Surat Buta Warna
                        </a>
                    @else
                        -
                    @endif
                </td>
            </tr>
        </table>

        <a href="{{ route('admin.seleksi.index') }}"
   class="btn btn-secondary">

    Kembali ke Seleksi Siswa

</a>

    </div>
</div>

@endsection