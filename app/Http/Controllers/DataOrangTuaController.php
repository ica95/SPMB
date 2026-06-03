<?php

namespace App\Http\Controllers;

use App\Models\DataOrangTua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataOrangTuaController extends Controller
{
    public function create()
    {
        if (auth()->user()->is_final) {
            return redirect()->route('pendaftaran.status')
                ->with('error', 'Data sudah final dan tidak dapat diubah.');
        }

        $dataOrangTua = DataOrangTua::where('user_id', Auth::id())->first();

        return view('ppdb.orangtua', compact('dataOrangTua'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->is_final) {
            return redirect()->route('pendaftaran.status')
                ->with('error', 'Data sudah final dan tidak dapat diubah.');
        }

        $request->validate([
            'nama_ayah' => 'nullable|string|max:255',
            'pekerjaan_ayah' => 'nullable|string|max:255',
            'nama_ibu' => 'nullable|string|max:255',
            'pekerjaan_ibu' => 'nullable|string|max:255',
            'nama_wali' => 'nullable|string|max:255',
            'pekerjaan_wali' => 'nullable|string|max:255',
            'no_hp_orangtua_wali' => 'required|string|max:20',
            'alamat_wali' => 'nullable|string',
        ]);

        DataOrangTua::updateOrCreate(
            [
                'user_id' => Auth::id(),
            ],
            [
                'nama_ayah' => $request->nama_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'nama_ibu' => $request->nama_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'nama_wali' => $request->nama_wali,
                'pekerjaan_wali' => $request->pekerjaan_wali,
                'no_hp_orangtua_wali' => $request->no_hp_orangtua_wali,
                'alamat_wali' => $request->alamat_wali,
            ]
        );

        return redirect()->route('prestasi.index')
            ->with('success', 'Data orang tua / wali berhasil disimpan. Silakan lanjut isi data prestasi.');
    }
}