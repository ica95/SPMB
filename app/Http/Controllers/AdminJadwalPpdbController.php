<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalPpdb;

class AdminJadwalPpdbController extends Controller
{
    public function index()
    {
        $jadwal = JadwalPpdb::latest()->get();

        return view('admin.jadwal-ppdb.index', compact('jadwal'));
    }

    public function create()
    {
        return view('admin.jadwal-ppdb.create');
    }

    public function store(Request $request)
    {
        JadwalPpdb::create([
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.jadwal-ppdb.index');
    }

    public function edit($id)
    {
        $jadwal = JadwalPpdb::findOrFail($id);

        return view('admin.jadwal-ppdb.edit', compact('jadwal'));
    }

    public function update(Request $request, $id)
    {
        $jadwal = JadwalPpdb::findOrFail($id);

        $jadwal->update([
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.jadwal-ppdb.index');
    }

    public function destroy($id)
    {
        $jadwal = JadwalPpdb::findOrFail($id);

        $jadwal->delete();

        return redirect()->route('admin.jadwal-ppdb.index');
    }
}