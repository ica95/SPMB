<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    public function index()
    {
        $tahunAjarans = TahunAjaran::latest()->get();

        return view('admin.tahun-ajaran.index', compact('tahunAjarans'));
    }

    public function create()
    {
        return view('admin.tahun-ajaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun_ajaran' => 'required|unique:tahun_ajarans,tahun_ajaran',
        ]);

        $isActive = $request->has('is_active') ? 1 : 0;

        if ($isActive) {
            TahunAjaran::query()->update([
                'is_active' => 0,
                'status' => 'nonaktif',
            ]);
        }

        TahunAjaran::create([
            'tahun_ajaran' => $request->tahun_ajaran,
            'is_active' => $isActive,
            'status' => $isActive ? 'aktif' : 'nonaktif',
        ]);

        return redirect()
            ->route('admin.tahun-ajaran.index')
            ->with('success', 'Tahun ajaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $tahunAjaran = TahunAjaran::findOrFail($id);

        return view('admin.tahun-ajaran.edit', compact('tahunAjaran'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tahun_ajaran' => 'required',
        ]);

        $tahunAjaran = TahunAjaran::findOrFail($id);

        $isActive = $request->is_active == 1 ? 1 : 0;

        if ($isActive) {
            TahunAjaran::where('id', '!=', $tahunAjaran->id)->update([
                'is_active' => 0,
                'status' => 'nonaktif',
            ]);
        }

        $tahunAjaran->update([
            'tahun_ajaran' => $request->tahun_ajaran,
            'is_active' => $isActive,
            'status' => $isActive ? 'aktif' : 'nonaktif',
        ]);

        return redirect()
            ->route('admin.tahun-ajaran.index')
            ->with('success', 'Tahun ajaran berhasil diupdate.');
    }

    public function destroy($id)
{
    $tahunAjaran = TahunAjaran::findOrFail($id);

    $tahunAjaran->delete();

    return redirect()
        ->route('admin.tahun-ajaran.index')
        ->with('success', 'Tahun ajaran berhasil dihapus.');
}
}