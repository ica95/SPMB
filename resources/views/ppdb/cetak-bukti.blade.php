<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tanda Bukti Pendaftaran</title>
    <style>
        @page { margin: 20px 35px; }
        body { font-family: "Times New Roman", serif; font-size: 12px; color: #000; }
        .header { text-align: center; line-height: 1.2; border-bottom: 2px solid #000; padding-bottom: 6px; margin-bottom: 8px; position: relative; }
        .school { font-size: 14px; font-weight: bold; }
        .title { text-align: center; font-weight: bold; text-decoration: underline; margin: 10px 0 15px; font-size: 13px; }
        .content { line-height: 1.5; }
        table.data { margin-left: 35px; margin-top: 5px; margin-bottom: 8px; }
        table.data td { padding: 1px 4px; }
        .label { width: 140px; }
        .jurusan-list { margin-left: 45px; margin-top: 5px; }
        .foto-img { width: 80px; height: 110px; object-fit: cover; border: 1px solid #000; }
        .foto-box { width: 80px; height: 110px; border: 1px solid #000; text-align: center; font-size: 12px; padding-top: 20px;}
        .catatan { margin-top: 15px; font-size: 11px; }
    </style>
</head>
<body>

    @php
        // [DIUBAH] Ambil tahun ajaran dari data siswa, bukan ditulis manual.
        $tahunAjaran = $biodata->tahunAjaran->tahun_ajaran ?? '-';
    @endphp

    <div class="header">
        <div style="font-weight: bold;">MAJELIS PENDIDIKAN DASAR MENENGAH DAN PENDIDIKAN NONFORMAL</div>
        <div style="font-weight: bold;">PIMPINAN CABANG MUHAMMADIYAH BANJARMASIN 4</div>
        <div class="school">SMK MUHAMMADIYAH 2 BANJARMASIN</div>
        <div>Jl. Cempaka II No.10 & XIII No.20 Banjarmasin | Telp: (0511) 3363968</div>
        <div>Email : smkmuh2bjm@gmail.com &nbsp;&nbsp; NSS : 322156002010 &nbsp;&nbsp; NPSN : 30304266</div>
    </div>

    {{-- [DIUBAH] Sebelumnya: TAHUN AJARAN 2026/2027 --}}
    <div class="title">TANDA BUKTI PENDAFTARAN TAHUN AJARAN {{ $tahunAjaran }}</div>

    <div class="content">
        Panitia Pelaksana Penerimaan Murid Baru SMK Muhammadiyah 2 Banjarmasin menyatakan bahwa:

        <table class="data">
            <tr>
                <td class="label">Nomor Pendaftaran</td>
                <td>:</td>
                <td><strong>{{ $user->nomor_pendaftaran ?? '-' }}</strong></td>
            </tr>
            <tr>
                <td class="label">Nama</td>
                <td>:</td>
                <td>{{ $biodata->nama_lengkap ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Asal Sekolah</td>
                <td>:</td>
                <td>{{ $biodata->asal_sekolah ?? '-' }}</td>
            </tr>
        </table>

        Telah mendaftarkan diri sebagai calon siswa baru pada program keahlian:
        <div class="jurusan-list">
            <strong>- {{ $biodata->programKeahlian->nama_program ?? '-' }}</strong>
        </div>
    </div>

    <table style="width: 100%; margin-top: 20px;">
        <tr>
            <td width="30%" style="vertical-align: top;">
                @if($biodata->file_foto)
                    <img src="{{ public_path('storage/' . $biodata->file_foto) }}" class="foto-img">
                @else
                    <div class="foto-box">Pas Photo<br>3x4</div>
                @endif
            </td>
            <td width="70%" style="vertical-align: top; text-align: center;">
                Banjarmasin, {{ date('d-m-Y') }}<br>
                {{-- [DITAMBAH] Tahun ajaran ikut data siswa --}}
                Tahun Ajaran {{ $tahunAjaran }}<br>
                Panitia SPMB<br><br><br><br>
                <strong>SMK Muhammadiyah 2 Banjarmasin</strong>
                <br><br>
                <small>Kode Verifikasi: <strong>{{ $user->nomor_pendaftaran ?? '-' }}</strong></small>
            </td>
        </tr>
    </table>

    <div class="catatan">
        <strong>Catatan:</strong><br>
        Bukti pendaftaran ini wajib dibawa atau ditunjukkan kepada panitia saat proses verifikasi dan daftar ulang.
    </div>

    <div class="catatan">
        <strong>Keterangan:</strong><br>
        Dokumen ini sah sebagai bukti pendaftaran apabila nomor pendaftaran sesuai dengan data pada sistem SPMB SMK Muhammadiyah 2 Banjarmasin.
    </div>

</body>
</html>