<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\BiodataCalonSiswa;

class PembayaranController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $biodata = BiodataCalonSiswa::where('user_id', $user->id)->first();

        if (!$biodata) {
            $biodata = BiodataCalonSiswa::create([
                'user_id' => $user->id,

                'nama_lengkap' => $user->name,
                'nisn' => '-',
                'jenis_kelamin' => 'Laki-Laki',
                'agama' => 'Islam',
                'tempat_lahir' => '-',
                'tanggal_lahir' => now()->format('Y-m-d'),
                'golongan_darah' => 'A',
                'hobi_kegemaran' => '-',
                'alamat' => '-',
                'rumah_tinggal' => 'Orang Tua',
                'no_hp' => '-',
                'asal_sekolah' => '-',
                'alamat_asal_sekolah' => '-',

                'status_pembayaran' => 'belum_bayar',
                'status_pendaftaran' => 'menunggu',
                'status_seleksi' => 'menunggu',
                'status_final' => 0,
                'is_final' => 0,
            ]);
        }

        return view('ppdb.pembayaran', compact('user', 'biodata'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $biodata = BiodataCalonSiswa::where('user_id', $user->id)->first();

        if (!$biodata) {
            $biodata = BiodataCalonSiswa::create([
                'user_id' => $user->id,

                'nama_lengkap' => $user->name,
                'nisn' => '-',
                'jenis_kelamin' => 'Laki-Laki',
                'agama' => 'Islam',
                'tempat_lahir' => '-',
                'tanggal_lahir' => now()->format('Y-m-d'),
                'golongan_darah' => 'A',
                'hobi_kegemaran' => '-',
                'alamat' => '-',
                'rumah_tinggal' => 'Orang Tua',
                'no_hp' => '-',
                'asal_sekolah' => '-',
                'alamat_asal_sekolah' => '-',

                'status_pembayaran' => 'belum_bayar',
                'status_pendaftaran' => 'menunggu',
                'status_seleksi' => 'menunggu',
                'status_final' => 0,
                'is_final' => 0,
            ]);
        }

        if ($biodata->is_final) {
            return redirect()->route('review.index')
                ->with('error', 'Data sudah dikirim final dan tidak dapat diubah.');
        }

        if ($biodata->status_pembayaran == 'lunas') {
            return redirect()->route('biodata.create')
                ->with('success', 'Pembayaran sudah diverifikasi. Silakan lanjut isi biodata.');
        }

        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('bukti_pembayaran')->store('bukti-pembayaran', 'public');

        $biodata->update([
            'bukti_pembayaran' => $path,
            'status_pembayaran' => 'menunggu_verifikasi',
            'tanggal_pembayaran' => now(),
        ]);

        return redirect()->route('pembayaran.index')
            ->with('success', 'Bukti pembayaran berhasil dikirim. Silakan tunggu verifikasi admin.');
    }

    public function kwitansi()
    {
        $user = Auth::user();

        $biodata = BiodataCalonSiswa::with(['programKeahlian', 'tahunAjaran'])
            ->where('user_id', $user->id)
            ->firstOrFail();

        return Pdf::loadView('ppdb.kwitansi', compact('user', 'biodata'))
            ->setPaper('A4', 'portrait')
            ->stream('kwitansi-pembayaran.pdf');
    }
}