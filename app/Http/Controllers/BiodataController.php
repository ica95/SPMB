<?php

namespace App\Http\Controllers;

use App\Models\BiodataCalonSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProgramKeahlian;
use App\Models\TahunAjaran;
use App\Models\GelombangPpdb;

class BiodataController extends Controller
{
    public function create()
    {
        $biodata = BiodataCalonSiswa::where('user_id', Auth::id())->first();

        if (!$biodata || $biodata->status_pembayaran != 'lunas') {
            return redirect()->route('pembayaran.index')
                ->with('error', 'Pembayaran pendaftaran belum diverifikasi oleh admin.');
        }

        if ($biodata->is_final) {
            return redirect()->route('pendaftaran.status')
                ->with('error', 'Data sudah final dan tidak dapat diubah.');
        }

        $programKeahlian = ProgramKeahlian::where('status', 'aktif')->get();

        return view('ppdb.biodata', compact('biodata', 'programKeahlian'));
    }

    public function store(Request $request)
    {
        $biodata = BiodataCalonSiswa::where('user_id', Auth::id())->first();

        if (!$biodata || $biodata->status_pembayaran != 'lunas') {
            return redirect()->route('pembayaran.index')
                ->with('error', 'Pembayaran pendaftaran belum diverifikasi oleh admin.');
        }

        if ($biodata->is_final) {
            return redirect()->route('pendaftaran.status')
                ->with('error', 'Data sudah final dan tidak dapat diubah.');
        }

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nisn' => 'required|string|max:20',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Budha,Konghucu',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'golongan_darah' => 'required|in:A,B,AB,O',
            'hobi_kegemaran' => 'required|string|max:255',
            'alamat' => 'required|string',
            'rumah_tinggal' => 'required|in:Orang Tua,Wali,Kost,Panti Asuhan',
            'no_hp' => 'required|string|max:20',
            'asal_sekolah' => 'required|string|max:255',
            'alamat_asal_sekolah' => 'required|string',
            'program_keahlian_id' => 'required|exists:program_keahlians,id',
        ]);

        $tahunAjaran = TahunAjaran::where('is_active', true)->first();
        $gelombang = GelombangPpdb::where('status', 'aktif')->first();

        $biodata->update([
            'tahun_ajaran_id' => $tahunAjaran?->id,
            'gelombang_ppdb_id' => $gelombang?->id,
            'program_keahlian_id' => $request->program_keahlian_id,

            'nama_lengkap' => $request->nama_lengkap,
            'nisn' => $request->nisn,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'golongan_darah' => $request->golongan_darah,
            'hobi_kegemaran' => $request->hobi_kegemaran,
            'alamat' => $request->alamat,
            'rumah_tinggal' => $request->rumah_tinggal,
            'no_hp' => $request->no_hp,
            'asal_sekolah' => $request->asal_sekolah,
            'alamat_asal_sekolah' => $request->alamat_asal_sekolah,
        ]);

        return redirect()->route('orangtua.create')
            ->with('success', 'Biodata berhasil disimpan. Silakan lanjut isi data orang tua / wali.');
    }
}