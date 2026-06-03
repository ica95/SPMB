<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ppdb;
use App\Models\User;
use App\Models\BiodataCalonSiswa;

class AdminPpdbController extends Controller
{
    public function index()
    {
        $ppdb = Ppdb::latest()->get();
        return view('admin.ppdb.index', compact('ppdb'));
    }

    public function create()
    {
        return view('admin.ppdb.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'program_keahlian' => 'required',
        ]);

        Ppdb::create($request->all());

        return redirect()->route('admin.ppdb.index')
            ->with('success', 'Data pendaftar berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = Ppdb::findOrFail($id);
        return view('admin.ppdb.edit', compact('data'));
    }

    public function show($id)
    {
    $user = User::findOrFail($id);
    $biodata = BiodataCalonSiswa::where('user_id', $user->id)->first();
    
    return view('admin.ppdb.show', compact('user', 'biodata'));
    }

    public function update(Request $request, $id)
    {
    $data = Ppdb::findOrFail($id);

    $data->update([
        'nama_lengkap' => $request->nama_lengkap,
        'no_hp' => $request->no_hp,
        'email' => $request->email,
        'alamat' => $request->alamat,
    ]);

    return redirect()->route('admin.ppdb.index')
        ->with('success', 'Data pendaftar berhasil diperbarui.');
    }


    public function terima($id)
{
    $user = User::findOrFail($id);

    $user->update([
        'status_pendaftaran' => 'diterima',
        'status_final' => 'sudah_final',
    ]);

    return redirect()->route('admin.ppdb.index')
        ->with('success', 'Calon siswa berhasil diterima.');
}

public function tolak($id)
{
    $user = User::findOrFail($id);

    $user->update([
        'status_pendaftaran' => 'tidak_diterima',
        'status_final' => 'sudah_final',
    ]);

    return redirect()->route('admin.ppdb.index')
        ->with('success', 'Calon siswa berhasil ditolak.');
}

    public function destroy($id)
    {
        $data = Ppdb::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.ppdb.index')
            ->with('success', 'Data pendaftar berhasil dihapus.');
    }

    public function daftarUlangBelumLunas($id)
{
    $biodata = BiodataCalonSiswa::where('user_id', $id)->firstOrFail();

    $biodata->status_daftar_ulang = 'belum_lunas';
    $biodata->save();

    return back()->with('success', 'Status daftar ulang berhasil diubah menjadi belum lunas.');
}
}