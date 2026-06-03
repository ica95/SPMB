<?php

namespace App\Http\Controllers;
use App\Models\JadwalPpdb;
use App\Models\GelombangPpdb;
use App\Models\TahunAjaran;

class HomeController extends Controller
{

public function index()
{
    $jadwal = JadwalPpdb::where('status', 'aktif')->get();

    $gelombang = GelombangPpdb::where('status', 'aktif')->get();

    $tahunAjaranAktif = TahunAjaran::where('is_active', 1)->first();

    return view('pages.home', compact(
        'jadwal',
        'gelombang',
        'tahunAjaranAktif'
    ));
}

    
}