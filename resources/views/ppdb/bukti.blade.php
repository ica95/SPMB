@extends('layouts.app')

@section('title', 'Bukti Pendaftaran PPDB')

@section('content')
<section class="biodata-page">

    @php $activeStep = 7; @endphp
    @include('ppdb.partials.stepbar')

    <div class="container">
        <div class="biodata-card" style="color:black;">

            {{-- HEADER --}}
            <div style="text-align:center;">
                <h3>BUKTI PENDAFTARAN SPMB</h3>
                <h4>SMK MUHAMMADIYAH 2 BANJARMASIN</h4>
                <p>Tahun Pelajaran 2026/2027</p>
                <hr>
            </div>

            <h3 style="text-align:center; color:black;">
                IDENTITAS PENDAFTAR
            </h3>

            <table border="1" cellpadding="8" cellspacing="0" width="100%" style="color:black; border-collapse:collapse;">
                <tr>
                    <td width="30%"><strong>No. Pendaftaran</strong></td>
                    <td>{{ $user->nomor_pendaftaran ?? '-' }}</td>

                    <td rowspan="7" width="25%" style="text-align:center; vertical-align:middle;">
                        <strong>Pas Foto</strong><br><br>

                        @if($biodata && $biodata->file_foto)
                            <img src="{{ asset('storage/' . $biodata->file_foto) }}"
                                 style="width:120px; height:160px; object-fit:cover; border:1px solid #333;">
                        @else
                            Belum upload foto
                        @endif
                    </td>
                </tr>

                <tr>
                    <td><strong>Nama Siswa</strong></td>
                    <td>{{ $biodata->nama_lengkap ?? $user->name }}</td>
                </tr>

                <tr>
                    <td><strong>Email</strong></td>
                    <td>{{ $user->email }}</td>
                </tr>

                <tr>
                    <td><strong>NISN</strong></td>
                    <td>{{ $biodata->nisn ?? '-' }}</td>
                </tr>

                <tr>
                    <td><strong>Asal Sekolah</strong></td>
                    <td>{{ $biodata->asal_sekolah ?? '-' }}</td>
                </tr>

                <tr>
                    <td><strong>Program Keahlian</strong></td>
                    <td>{{ $biodata->programKeahlian->nama_program ?? '-' }}</td>
                </tr>

                <tr>
                    <td><strong>No HP</strong></td>
                    <td>{{ $biodata->no_hp ?? '-' }}</td>
                </tr>
            </table>

            <br>

            <h3 style="text-align:center; color:black;">
                STATUS PENDAFTARAN
            </h3>

            <table border="1" cellpadding="8" cellspacing="0" width="100%" style="border-collapse:collapse; color:black;">
                <tr>
                    <td width="30%"><strong>Status Pembayaran</strong></td>
                    <td>{{ $biodata->status_pembayaran ?? 'belum_bayar' }}</td>
                </tr>

                <tr>
                    <td><strong>Status Seleksi</strong></td>
                    <td>{{ $biodata->status_pendaftaran ?? 'Menunggu' }}</td>
                </tr>

                <tr>
                    <td><strong>Status Final</strong></td>
                    <td>
                        @if($biodata && ($biodata->status_final ?? 0))
                            Sudah Dikirim Final
                        @else
                            Belum Final
                        @endif
                    </td>
                </tr>
            </table>

            <br>

            <h3 style="text-align:center; color:black;">
                DATA TAMBAHAN
            </h3>

            <table border="1" cellpadding="8" cellspacing="0" width="100%" style="border-collapse:collapse; color:black;">
                <tr>
                    <td width="30%"><strong>Jenis Kelamin</strong></td>
                    <td>{{ $biodata->jenis_kelamin ?? '-' }}</td>
                </tr>

                <tr>
                    <td><strong>Tempat, Tanggal Lahir</strong></td>
                    <td>
                        {{ $biodata->tempat_lahir ?? '-' }},
                        {{ $biodata->tanggal_lahir ?? '-' }}
                    </td>
                </tr>

                <tr>
                    <td><strong>Agama</strong></td>
                    <td>{{ $biodata->agama ?? '-' }}</td>
                </tr>

                <tr>
                    <td><strong>Alamat</strong></td>
                    <td>{{ $biodata->alamat ?? '-' }}</td>
                </tr>
            </table>

            <br>

            <h3 style="text-align:center; color:black;">
                DATA ORANG TUA / WALI
            </h3>

            <table border="1" cellpadding="8" cellspacing="0" width="100%" style="border-collapse:collapse; color:black;">
                <tr>
                    <td width="30%"><strong>Nama Ayah</strong></td>
                    <td>{{ $orangtua->nama_ayah ?? '-' }}</td>
                </tr>

                <tr>
                    <td><strong>Pekerjaan Ayah</strong></td>
                    <td>{{ $orangtua->pekerjaan_ayah ?? '-' }}</td>
                </tr>

                <tr>
                    <td><strong>Nama Ibu</strong></td>
                    <td>{{ $orangtua->nama_ibu ?? '-' }}</td>
                </tr>

                <tr>
                    <td><strong>Pekerjaan Ibu</strong></td>
                    <td>{{ $orangtua->pekerjaan_ibu ?? '-' }}</td>
                </tr>

                <tr>
                    <td><strong>Nama Wali</strong></td>
                    <td>{{ $orangtua->nama_wali ?? '-' }}</td>
                </tr>

                <tr>
                    <td><strong>No HP Orang Tua / Wali</strong></td>
                    <td>{{ $orangtua->no_hp_orangtua_wali ?? '-' }}</td>
                </tr>
            </table>

            <br>

            <div style="border:1px solid #333; padding:12px; color:black;">
                <strong>Catatan:</strong>
                <p style="margin:5px 0 0;">
                    Bukti pendaftaran ini wajib dibawa atau ditunjukkan kepada panitia
                    saat proses verifikasi dan daftar ulang.
                </p>
            </div>

            <br><br>

            <table width="100%" style="margin-top:30px; color:black;">
                <tr>
                    <td width="55%"></td>

                    <td style="text-align:center;">
                        Banjarmasin, {{ date('d-m-Y') }}<br>
                        Panitia SPMB

                        <br><br><br>

                        <strong>SMK Muhammadiyah 2 Banjarmasin</strong>

                        <br><br>

                        <small>
                            Kode Verifikasi:
                            <strong>{{ $user->nomor_pendaftaran ?? '-' }}</strong>
                        </small>
                    </td>
                </tr>
            </table>

            <div style="border:1px solid #333; padding:12px; margin-top:20px; color:black;">
                <strong>Keterangan:</strong>

                <p style="margin:5px 0 0;">
                    Dokumen ini sah sebagai bukti pendaftaran apabila nomor pendaftaran
                    sesuai dengan data pada sistem SPMB
                    SMK Muhammadiyah 2 Banjarmasin.
                </p>
            </div>

            <div class="form-navigation" style="margin-top:25px;">
                <a href="{{ route('review.index') }}" class="btn-back">
                    ← Kembali
                </a>

                <a href="{{ route('pendaftaran.cetakBukti') }}"
                   class="btn-submit"
                   target="_blank">
                    Cetak PDF
                </a>
            </div>

        </div>
    </div>

</section>
@endsection