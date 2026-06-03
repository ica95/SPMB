<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BiodataCalonSiswa; 
class BerkasController extends Controller
{
        public function create()
    {
        $biodata = \App\Models\BiodataCalonSiswa::where('user_id', Auth::id())->first();

        if ($biodata && $biodata->is_final) {
            return redirect()->route('pendaftaran.status')
                ->with('error', 'Data sudah final dan tidak dapat diubah.');
        }

        return view('ppdb.berkas', compact('biodata'));
    }


    public function store(Request $request)
    {
        $biodata = BiodataCalonSiswa::where('user_id', Auth::id())->first();

        
        if (!$biodata) {
            return redirect()->route('biodata.create') 
                ->with('error', 'Silakan isi biodata terlebih dahulu sebelum mengupload berkas.');
        }

        if ($biodata->is_final) {
            return redirect()->route('pendaftaran.status')
                ->with('error', 'Data sudah final dan tidak dapat diubah.');
        }

        $request->validate([
           'file_kk' => ($biodata->file_kk ? 'nullable' : 'required') . '|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_akta' => ($biodata->file_akta ? 'nullable' : 'required') . '|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_skl' => ($biodata->file_skl ? 'nullable' : 'required') . '|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_foto' => ($biodata->file_foto ? 'nullable' : 'required') . '|mimes:jpg,jpeg,png|max:2048',
            'file_surat_sehat' => ($biodata->file_surat_sehat ? 'nullable' : 'required') . '|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_surat_warna' => ($biodata->file_surat_warna ? 'nullable' : 'required') . '|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);


        if ($request->hasFile('file_kk')) {
            $biodata->file_kk = $request->file('file_kk')->store('berkas', 'public');
        }

        if ($request->hasFile('file_akta')) {
            $biodata->file_akta = $request->file('file_akta')->store('berkas', 'public');
        }

        if ($request->hasFile('file_skl')) {
            $biodata->file_skl = $request->file('file_skl')->store('berkas', 'public');
        }

        if ($request->hasFile('file_foto')) {
            $biodata->file_foto = $request->file('file_foto')->store('berkas', 'public');
        }

        if ($request->hasFile('file_surat_sehat')) {
            $biodata->file_surat_sehat = $request->file('file_surat_sehat')->store('berkas', 'public');
        }

        if ($request->hasFile('file_surat_warna')) {
            $biodata->file_surat_warna = $request->file('file_surat_warna')->store('berkas', 'public');
        }

        
        $biodata->save();

        return redirect()->route('review.index')
            ->with('success', 'Berkas berhasil diupload.');
    }
}
