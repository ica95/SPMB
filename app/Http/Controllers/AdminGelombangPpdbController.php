<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GelombangPpdb;
use App\Models\TahunAjaran;

class AdminGelombangPpdbController extends Controller
{
    public function index()
    {
        $gelombang = GelombangPpdb::with('tahunAjaran')->latest()->get();

        return view('admin.gelombang-ppdb.index', compact('gelombang'));
    }

    public function create()
    {
        $tahunAjarans = TahunAjaran::orderBy('tahun_ajaran', 'desc')->get();

        return view('admin.gelombang-ppdb.create', compact('tahunAjarans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_gelombang' => 'required|string|max:255',
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'kuota' => 'nullable|integer',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        if ($request->status == 'aktif') {
            GelombangPpdb::where('tahun_ajaran_id', $request->tahun_ajaran_id)
                ->update(['status' => 'nonaktif']);
        }

        GelombangPpdb::create([
            'nama_gelombang' => $request->nama_gelombang,
            'tahun_ajaran_id' => $request->tahun_ajaran_id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'kuota' => $request->kuota,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.gelombang-ppdb.index')
            ->with('success', 'Gelombang SPMB berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $gelombang = GelombangPpdb::findOrFail($id);
        $tahunAjarans = TahunAjaran::orderBy('tahun_ajaran', 'desc')->get();

        return view('admin.gelombang-ppdb.edit', compact('gelombang', 'tahunAjarans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_gelombang' => 'required|string|max:255',
            'tahun_ajaran_id' => 'required|exists:tahun_ajarans,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'kuota' => 'nullable|integer',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $gelombang = GelombangPpdb::findOrFail($id);

        if ($request->status == 'aktif') {
            GelombangPpdb::where('tahun_ajaran_id', $request->tahun_ajaran_id)
                ->where('id', '!=', $gelombang->id)
                ->update(['status' => 'nonaktif']);
        }

        $gelombang->update([
            'nama_gelombang' => $request->nama_gelombang,
            'tahun_ajaran_id' => $request->tahun_ajaran_id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'kuota' => $request->kuota,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.gelombang-ppdb.index')
            ->with('success', 'Gelombang SPMB berhasil diupdate.');
    }

    public function destroy($id)
    {
        $gelombang = GelombangPpdb::findOrFail($id);

        $dipakai = \App\Models\BiodataCalonSiswa::where('gelombang_ppdb_id', $gelombang->id)->exists();

        if ($dipakai) {
            return redirect()->route('admin.gelombang-ppdb.index')
                ->with('error', 'Gelombang tidak bisa dihapus karena sudah dipakai oleh data pendaftar.');
        }

        $gelombang->delete();

        return redirect()->route('admin.gelombang-ppdb.index')
            ->with('success', 'Gelombang SPMB berhasil dihapus.');
    }
}