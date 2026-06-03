@php
    $steps = [
        1 => ['label' => 'Pembayaran', 'route' => 'pembayaran.index'],
        2 => ['label' => 'Biodata', 'route' => 'biodata.create'],
        3 => ['label' => 'Orang Tua', 'route' => 'orangtua.create'],
        4 => ['label' => 'Prestasi', 'route' => 'prestasi.index'],
        5 => ['label' => 'Berkas', 'route' => 'berkas.create'],
        6 => ['label' => 'Review', 'route' => 'review.index'],
        7 => ['label' => 'Cetak Bukti', 'route' => 'pendaftaran.cetakBukti'],
        8 => ['label' => 'Status', 'route' => 'pendaftaran.status'],
    ];
@endphp

<div class="ppdb-stepbar">
    @foreach($steps as $number => $step)
        <a href="{{ route($step['route']) }}"
           class="ppdb-step {{ isset($activeStep) && $activeStep == $number ? 'active' : '' }}">
            <span>{{ $number }}</span>
            {{ $step['label'] }}
        </a>
    @endforeach
</div>

<style>
    .ppdb-stepbar {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        justify-content: center;
        margin: 25px 0;
    }

    .ppdb-step {
        min-width: 135px;
        padding: 14px 18px;
        border-radius: 30px;
        background: #ddd;
        color: #777;
        text-align: center;
        text-decoration: none;
        font-weight: bold;
        position: relative;
    }

    .ppdb-step span {
        display: block;
        width: 28px;
        height: 28px;
        line-height: 28px;
        border-radius: 50%;
        background: white;
        color: #333;
        margin: 0 auto 6px;
    }

    .ppdb-step.active {
        background: #2d3436;
        color: white;
    }

    .ppdb-step.active span {
        background: #2f5fa8;
        color: white;
    }
</style>