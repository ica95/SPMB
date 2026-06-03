<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    public function index()
    {
        if (auth()->user()->is_final) {
            return redirect()->route('pendaftaran.status')
                ->with('error', 'Data sudah final dan tidak dapat diubah.');
        }

        $prestasis = Prestasi::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('ppdb.prestasi', compact('prestasis'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->is_final) {
            return redirect()->route('pendaftaran.status')
                ->with('error', 'Data sudah final dan tidak dapat diubah.');
        }

        $request->validate([
            'judul' => 'required|string|max:255',
            'tahun' => 'required|digits:4|integer|min:2000|max:' . date('Y'),
            'deskripsi' => 'nullable|string',
            'tingkat' => 'required|in:Kabupaten/Kota,Provinsi,Nasional,Internasional',
            'kategori' => 'required|in:Akademik,Non Akademik,Olahraga,Seni,Keagamaan,Organisasi,Teknologi,Bahasa,Lainnya',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $pathGambar = null;

        if ($request->hasFile('gambar')) {
            $pathGambar = $request->file('gambar')->store('prestasi', 'public');
        }

        Prestasi::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'tahun' => $request->tahun,
            'deskripsi' => $request->deskripsi,
            'tingkat' => $request->tingkat,
            'kategori' => $request->kategori,
            'gambar' => $pathGambar,
        ]);

        return redirect()->route('berkas.create')
            ->with('success', 'Prestasi berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        if (auth()->user()->is_final) {
            return redirect()->route('pendaftaran.status')
                ->with('error', 'Data sudah final dan tidak dapat diubah.');
        }

        $prestasi = Prestasi::where('user_id', Auth::id())
            ->findOrFail($id);

        if ($prestasi->gambar && Storage::disk('public')->exists($prestasi->gambar)) {
            Storage::disk('public')->delete($prestasi->gambar);
        }

        $prestasi->delete();

        return redirect()->route('prestasi.index')
            ->with('success', 'Prestasi berhasil dihapus.');
    }

    public function skip()
    {
        if (auth()->user()->is_final) {
            return redirect()->route('pendaftaran.status')
                ->with('error', 'Data sudah final dan tidak dapat diubah.');
        }

        return redirect()->route('berkas.create')
            ->with('info', 'Anda melewati pengisian prestasi.');
    }
}