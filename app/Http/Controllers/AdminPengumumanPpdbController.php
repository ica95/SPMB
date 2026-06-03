<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengumumanPpdb;

class AdminPengumumanPpdbController extends Controller
{
    public function index()
    {
        $pengumuman = PengumumanPpdb::latest()->get();

        return view('admin.pengumuman-ppdb.index', compact('pengumuman'));
    }

    public function create()
    {
        return view('admin.pengumuman-ppdb.create');
    }

    public function store(Request $request)
    {
        PengumumanPpdb::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.pengumuman-ppdb.index');
    }

    public function edit($id)
    {
        $pengumuman = PengumumanPpdb::findOrFail($id);

        return view('admin.pengumuman-ppdb.edit', compact('pengumuman'));
    }

    public function update(Request $request, $id)
    {
        $pengumuman = PengumumanPpdb::findOrFail($id);

        $pengumuman->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.pengumuman-ppdb.index');
    }

    public function destroy($id)
    {
        $pengumuman = PengumumanPpdb::findOrFail($id);

        $pengumuman->delete();

        return redirect()->route('admin.pengumuman-ppdb.index');
    }
}