<!DOCTYPE html>
<html>
<head>
    <title>Kwitansi Daftar Ulang</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            font-size: 12px;
            color:#000;
        }

        .header{
            text-align:center;
            margin-bottom:20px;
        }

        .header h2{
            margin:0;
            font-size:22px;
        }

        .header h3{
            margin:5px 0;
            font-size:18px;
        }

        .header p{
            margin:0;
            font-size:13px;
        }

        hr{
            margin-top:10px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:10px;
        }

        td, th{
            border:1px solid #000;
            padding:8px;
        }

        .table-no-border td{
            border:none;
        }

        .status-box{
            border:1px solid #000;
            text-align:center;
            padding:10px;
            margin-top:15px;
        }

        .status-text{
            color:green;
            font-size:22px;
            margin:0;
        }

        .keterangan{
            border:1px solid #000;
            padding:10px;
            margin-top:15px;
        }
    </style>
</head>

<body>

    @php
        // [DIUBAH] Tahun ajaran diambil dari data siswa, bukan ditulis manual.
        $tahunAjaran = $biodata->tahunAjaran->tahun_ajaran ?? '-';

        $jurusan = $biodata->programKeahlian->nama_program ?? '';

        if (
            $jurusan == 'Teknik Jaringan Komputer dan Telekomunikasi' ||
            $jurusan == 'Teknik Kendaraan Ringan' ||
            $jurusan == 'Teknik Bisnis Sepeda Motor'
        ) {
            $biayaDaftarUlang = 3500000;
        } else {
            $biayaDaftarUlang = 3000000;
        }
    @endphp

    {{-- HEADER --}}
    <div class="header">
        <h2>KWITANSI DAFTAR ULANG</h2>

        <h3>SMK MUHAMMADIYAH 2 BANJARMASIN</h3>

        {{-- [DIUBAH] Sebelumnya: Tahun Pelajaran 2026/2027 --}}
        <p>Tahun Pelajaran {{ $tahunAjaran }}</p>
    </div>

    <hr>

    {{-- IDENTITAS --}}
    <table>
        <tr>
            <td width="35%">
                <strong>No. Pendaftaran</strong>
            </td>

            <td>
                {{ $user->nomor_pendaftaran ?? '-' }}
            </td>
        </tr>

        <tr>
            <td>
                <strong>Nama Siswa</strong>
            </td>

            <td>
                {{ $biodata->nama_lengkap ?? $user->name }}
            </td>
        </tr>

        <tr>
            <td>
                <strong>Program Keahlian</strong>
            </td>

            <td>
                {{ $biodata->programKeahlian->nama_program ?? '-' }}
            </td>
        </tr>

        {{-- [DITAMBAH] Tahun ajaran juga muncul di identitas --}}
        <tr>
            <td>
                <strong>Tahun Ajaran</strong>
            </td>

            <td>
                {{ $tahunAjaran }}
            </td>
        </tr>

        <tr>
            <td>
                <strong>Tanggal Cetak</strong>
            </td>

            <td>
                {{ date('d-m-Y') }}
            </td>
        </tr>

        <tr>
            <td>
                <strong>Status Pembayaran</strong>
            </td>

            <td>
                BELUM DIVALIDASI PANITIA
            </td>
        </tr>
    </table>

    {{-- RINCIAN --}}
    <h3 style="margin-top:20px;">
        Rincian Pembayaran
    </h3>

    <table>
        <tr style="background:#f2f2f2;">
            <th width="10%">No</th>
            <th>Keterangan</th>
            <th width="30%">Nominal</th>
        </tr>

        <tr>
            <td align="center">1</td>

            <td>
                Biaya Daftar Ulang SPMB Tahun Ajaran {{ $tahunAjaran }}
            </td>

            <td>
                Rp {{ number_format($biayaDaftarUlang, 0, ',', '.') }}
            </td>
        </tr>

        <tr>
            <td colspan="2" align="right">
                <strong>Total Pembayaran</strong>
            </td>

            <td>
                <strong>Rp {{ number_format($biayaDaftarUlang, 0, ',', '.') }}</strong>
            </td>
        </tr>
    </table>

    {{-- STATUS --}}
    <div class="status-box">
        <h2 class="status-text">
            &nbsp;
        </h2>
    </div>

    {{-- KETERANGAN --}}
    <div class="keterangan">
        <strong>Keterangan:</strong>

        <p>
            Kwitansi ini merupakan bukti pembayaran resmi
            daftar ulang SPMB SMK Muhammadiyah 2 Banjarmasin
            Tahun Ajaran {{ $tahunAjaran }}.
        </p>
    </div>

    {{-- VERIFIKASI --}}
    <table class="table-no-border" style="margin-top:30px;">
        <tr>
            <td width="60%"></td>

            <td style="text-align:center;">
                Banjarmasin, {{ date('d-m-Y') }}

                <br>
                {{-- [DITAMBAH] Tahun ajaran ikut data siswa --}}
                Tahun Ajaran {{ $tahunAjaran }}

                <br><br>

                Panitia SPMB

                <br><br><br><br>

                <strong>
                    SMK Muhammadiyah 2 Banjarmasin
                </strong>

                <br><br>

                <small>
                    Kode Verifikasi:
                    <strong>
                        {{ $user->nomor_pendaftaran ?? '-' }}
                    </strong>
                </small>
            </td>
        </tr>
    </table>

</body>
</html>