@extends('layouts.adminlte')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Detail Data Calon Siswa</h3>
    </div>

    <div class="card-body">

        <h4>Identitas Akun</h4>
        <table class="table table-bordered">
            <tr>
                <th width="30%">No. Pendaftaran</th>
                <td>{{ $user->nomor_pendaftaran ?? '-' }}</td>
            </tr>
            <tr>
                <th>Nama Akun</th>
                <td>{{ $user->name ?? '-' }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $user->email ?? '-' }}</td>
            </tr>
        </table>

        <h4 class="mt-4">Biodata Calon Siswa</h4>
        <table class="table table-bordered">
            <tr><th width="30%">Nama Lengkap</th><td>{{ $biodata->nama_lengkap ?? '-' }}</td></tr>
            <tr><th>NISN</th><td>{{ $biodata->nisn ?? '-' }}</td></tr>
            <tr><th>Jenis Kelamin</th><td>{{ $biodata->jenis_kelamin ?? '-' }}</td></tr>
            <tr><th>Agama</th><td>{{ $biodata->agama ?? '-' }}</td></tr>
            <tr><th>Tempat, Tanggal Lahir</th><td>{{ $biodata->tempat_lahir ?? '-' }}, {{ $biodata->tanggal_lahir ?? '-' }}</td></tr>
            <tr><th>Golongan Darah</th><td>{{ $biodata->golongan_darah ?? '-' }}</td></tr>
            <tr><th>Hobi / Kegemaran</th><td>{{ $biodata->hobi_kegemaran ?? '-' }}</td></tr>
            <tr><th>Alamat</th><td>{{ $biodata->alamat ?? '-' }}</td></tr>
            <tr><th>Rumah Tinggal</th><td>{{ $biodata->rumah_tinggal ?? '-' }}</td></tr>
            <tr><th>No HP</th><td>{{ $biodata->no_hp ?? '-' }}</td></tr>
            <tr><th>Asal Sekolah</th><td>{{ $biodata->asal_sekolah ?? '-' }}</td></tr>
            <tr><th>Alamat Asal Sekolah</th><td>{{ $biodata->alamat_asal_sekolah ?? '-' }}</td></tr>
            <tr><th>Program Keahlian</th><td>{{ $biodata->programKeahlian->nama_program ?? '-' }}</td></tr>
            <tr><th>Tahun Ajaran</th><td>{{ $biodata->tahunAjaran->tahun_ajaran ?? '-' }}</td></tr>
            <tr><th>Gelombang</th><td>{{ $biodata->gelombangPpdb->nama_gelombang ?? '-' }}</td></tr>
        </table>

        <h4 class="mt-4">Data Orang Tua / Wali</h4>
        <table class="table table-bordered">
            <tr><th width="30%">Nama Ayah</th><td>{{ $orangtua->nama_ayah ?? '-' }}</td></tr>
            <tr><th>Pendidikan Ayah</th><td>{{ $orangtua->pendidikan_ayah ?? '-' }}</td></tr>
            <tr><th>Pekerjaan Ayah</th><td>{{ $orangtua->pekerjaan_ayah ?? '-' }}</td></tr>
            <tr><th>Penghasilan Ayah</th><td>{{ $orangtua->penghasilan_ayah ?? '-' }}</td></tr>
            <tr><th>No HP Ayah</th><td>{{ $orangtua->no_hp_ayah ?? '-' }}</td></tr>

            <tr><th>Nama Ibu</th><td>{{ $orangtua->nama_ibu ?? '-' }}</td></tr>
            <tr><th>Pendidikan Ibu</th><td>{{ $orangtua->pendidikan_ibu ?? '-' }}</td></tr>
            <tr><th>Pekerjaan Ibu</th><td>{{ $orangtua->pekerjaan_ibu ?? '-' }}</td></tr>
            <tr><th>Penghasilan Ibu</th><td>{{ $orangtua->penghasilan_ibu ?? '-' }}</td></tr>
            <tr><th>No HP Ibu</th><td>{{ $orangtua->no_hp_ibu ?? '-' }}</td></tr>

            <tr><th>Nama Wali</th><td>{{ $orangtua->nama_wali ?? '-' }}</td></tr>
            <tr><th>Pekerjaan Wali</th><td>{{ $orangtua->pekerjaan_wali ?? '-' }}</td></tr>
            <tr><th>No HP Orang Tua / Wali</th><td>{{ $orangtua->no_hp_orangtua_wali ?? '-' }}</td></tr>
            <tr><th>Alamat Wali</th><td>{{ $orangtua->alamat_wali ?? '-' }}</td></tr>
        </table>

        <h4 class="mt-4">Prestasi</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Tahun</th>
                    <th>Tingkat</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($prestasis as $prestasi)
                    <tr>
                        <td>{{ $prestasi->judul ?? '-' }}</td>
                        <td>{{ $prestasi->tahun ?? '-' }}</td>
                        <td>{{ $prestasi->tingkat ?? '-' }}</td>
                        <td>{{ $prestasi->kategori ?? '-' }}</td>
                        <td>{{ $prestasi->deskripsi ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada prestasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <h4 class="mt-4">Status Pendaftaran</h4>
        <table class="table table-bordered">
            <tr><th width="30%">Status Pembayaran</th><td>{{ $biodata->status_pembayaran ?? '-' }}</td></tr>
            <tr><th>Status Seleksi</th><td>{{ $biodata->status_pendaftaran ?? '-' }}</td></tr>
            <tr><th>Status Final</th><td>{{ ($biodata->is_final ?? 0) ? 'Sudah Final' : 'Belum Final' }}</td></tr>
            <tr><th>Status Daftar Ulang</th><td>{{ $biodata->status_daftar_ulang ?? 'belum_lunas' }}</td></tr>
        </table>

        <h4 class="mt-4">Berkas Upload</h4>
        <table class="table table-bordered">
            <tr>
                <th width="30%">Kartu Keluarga</th>
                <td>
                    @if($biodata && $biodata->file_kk)
                        <a href="{{ asset('storage/' . $biodata->file_kk) }}" target="_blank" class="btn btn-info btn-sm">Lihat KK</a>
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr>
                <th>Akta Kelahiran</th>
                <td>
                    @if($biodata && $biodata->file_akta)
                        <a href="{{ asset('storage/' . $biodata->file_akta) }}" target="_blank" class="btn btn-info btn-sm">Lihat Akta</a>
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr>
                <th>SKL / Ijazah</th>
                <td>
                    @if($biodata && $biodata->file_skl)
                        <a href="{{ asset('storage/' . $biodata->file_skl) }}" target="_blank" class="btn btn-info btn-sm">Lihat SKL</a>
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr>
                <th>Pas Foto</th>
                <td>
                    @if($biodata && $biodata->file_foto)
                        <img src="{{ asset('storage/' . $biodata->file_foto) }}" width="120" style="border-radius:8px;">
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr>
                <th>Surat Sehat</th>
                <td>
                    @if($biodata && $biodata->file_surat_sehat)
                        <a href="{{ asset('storage/' . $biodata->file_surat_sehat) }}" target="_blank" class="btn btn-info btn-sm">Lihat Surat Sehat</a>
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr>
                <th>Surat Buta Warna</th>
                <td>
                    @if($biodata && $biodata->file_surat_warna)
                        <a href="{{ asset('storage/' . $biodata->file_surat_warna) }}" target="_blank" class="btn btn-info btn-sm">Lihat Surat Buta Warna</a>
                    @else
                        -
                    @endif
                </td>
            </tr>
        </table>

        <a href="{{ route('admin.seleksi.index') }}" class="btn btn-secondary mt-3">
            Kembali ke Seleksi Siswa
        </a>

    </div>
</div>

@endsection