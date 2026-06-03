<?php

namespace App\Http\Controllers;

use App\Models\BiodataCalonSiswa;
use App\Models\DataOrangTua;
use App\Models\Prestasi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PpdbController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $biodata = BiodataCalonSiswa::where('user_id', $user->id)->first();

        if (!$biodata) {
            return redirect()->route('pembayaran.index');
        }

        if (($biodata->status_pembayaran ?? 'belum_bayar') != 'lunas') {
            return redirect()->route('pembayaran.index');
        }

        if (!$biodata->is_final) {
            return redirect()->route('biodata.create');
        }

        return redirect()->route('siswa.masuk');
    }

    public function masukSiswa()
    {
        $user = Auth::user();

        $biodata = BiodataCalonSiswa::where('user_id', $user->id)->first();

        return view('ppdb.masuk-siswa', compact('user', 'biodata'));
    }

    public function review()
    {
        $user = Auth::user();

        $biodata = BiodataCalonSiswa::where('user_id', $user->id)->first();

        if (!$biodata) {
            return redirect()->route('biodata.create')
                ->with('error', 'Silakan isi biodata terlebih dahulu.');
        }

        if ($biodata->is_final) {
            return redirect()->route('siswa.masuk');
        }

        $orangtua = DataOrangTua::where('user_id', $user->id)->first();
        $prestasis = Prestasi::where('user_id', $user->id)->get();

        return view('ppdb.review', compact('user', 'biodata', 'orangtua', 'prestasis'));
    }

    public function submitFinal()
    {
        $user = Auth::user();

        $biodata = BiodataCalonSiswa::where('user_id', $user->id)->firstOrFail();

        $biodata->is_final = 1;
        $biodata->status_final = 1;
        $biodata->save();

        return redirect()->route('siswa.masuk')
            ->with('success', 'Pendaftaran berhasil difinalisasi.');
    }

    public function cetakBukti()
{
    $user = Auth::user();

    $biodata = BiodataCalonSiswa::with(['programKeahlian', 'tahunAjaran'])
    ->where('user_id', $user->id)
    ->firstOrFail();

    $orangtua = DataOrangTua::where('user_id', $user->id)->first();

    $pdf = Pdf::loadView('ppdb.cetak-bukti', compact('user', 'biodata', 'orangtua'))
        ->setPaper('A4', 'portrait');

    return $pdf->stream('Bukti-Pendaftaran-SPMB.pdf');
}

    public function status()
    {
        $user = Auth::user();

        $biodata = BiodataCalonSiswa::where('user_id', $user->id)->first();

        return view('ppdb.status', compact('user', 'biodata'));
    }
}