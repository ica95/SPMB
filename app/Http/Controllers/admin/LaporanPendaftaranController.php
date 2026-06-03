<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\TahunAjaran;
use App\Models\BiodataCalonSiswa;
use App\Models\GelombangPpdb;
use App\Models\ProgramKeahlian;
use Illuminate\Http\Request;

class LaporanPendaftaranController extends Controller
{
    public function index(Request $request)
    {
        $tahunAjarans = TahunAjaran::latest()->get();
        $gelombangs = GelombangPpdb::latest()->get();
        $jurusans = ProgramKeahlian::orderBy('nama_program')->get();

        $tahunAjaranId = $request->tahun_ajaran_id;
        $gelombangId = $request->gelombang_ppdb_id;
        $jurusan = $request->jurusan;
        $status = $request->status_pendaftaran;

        $users = User::with(['biodata.programKeahlian'])
            ->where('role', 'user');

        if ($tahunAjaranId) {
            $users->whereHas('biodata', function ($query) use ($tahunAjaranId) {
                $query->where('tahun_ajaran_id', $tahunAjaranId);
            });
        }

        if ($gelombangId) {
            $users->whereHas('biodata', function ($query) use ($gelombangId) {
                $query->where('gelombang_ppdb_id', $gelombangId);
            });
        }

        if ($status) {
            $users->whereHas('biodata', function ($query) use ($status) {
                $query->where('status_pendaftaran', $status);
            });
        }

        if ($jurusan) {
            $users->whereHas('biodata', function ($query) use ($jurusan) {
                $query->where('program_keahlian_id', $jurusan);
            });
        }

        $pendaftar = $users->latest()->get();

        $totalPendaftar = $pendaftar->count();

        $diterima = $pendaftar->filter(function ($user) {
            return optional($user->biodata)->status_pendaftaran == 'diterima';
        })->count();

        $ditolak = $pendaftar->filter(function ($user) {
            return optional($user->biodata)->status_pendaftaran == 'tidak_diterima';
        })->count();

        $menunggu = $pendaftar->filter(function ($user) {
            return optional($user->biodata)->status_pendaftaran == 'menunggu';
        })->count();

        $perJurusan = BiodataCalonSiswa::with('programKeahlian')
            ->selectRaw('program_keahlian_id, COUNT(*) as total')
            ->whereIn('user_id', $pendaftar->pluck('id'))
            ->whereNotNull('program_keahlian_id')
            ->groupBy('program_keahlian_id')
            ->get();

        return view('admin.laporan.index', compact(
            'tahunAjarans',
            'gelombangs',
            'jurusans',
            'tahunAjaranId',
            'gelombangId',
            'jurusan',
            'status',
            'totalPendaftar',
            'diterima',
            'ditolak',
            'menunggu',
            'perJurusan',
            'pendaftar'
        ));
    }

    public function destroy($id)
{
    $user = \App\Models\User::findOrFail($id);

    if ($user->role === 'admin') {
        return redirect()
            ->route('admin.laporan.index')
            ->with('error', 'Data admin tidak boleh dihapus.');
    }

    \App\Models\BiodataCalonSiswa::where('user_id', $user->id)->delete();
    \App\Models\DataOrangTua::where('user_id', $user->id)->delete();
    \App\Models\Prestasi::where('user_id', $user->id)->delete();

    $user->delete();

    return redirect()
        ->route('admin.laporan.index')
        ->with('success', 'Data pendaftar berhasil dihapus.');
}
}