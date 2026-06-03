<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BiodataCalonSiswa;
use App\Models\DataOrangTua;
use App\Models\Prestasi;

class SeleksiController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->filter;
        $search = $request->search;

        $users = User::with('biodata')
            ->where('role', 'user')
            ->whereHas('biodata', function ($query) {
                $query->where('status_pembayaran', 'lunas');
            });

        if ($filter == 'menunggu') {
            $users->whereHas('biodata', function ($query) {
                $query->where('status_pendaftaran', 'menunggu');
            });
        }

        if ($filter == 'diterima') {
            $users->whereHas('biodata', function ($query) {
                $query->where('status_pendaftaran', 'diterima');
            });
        }

        if ($filter == 'tidak_diterima') {
            $users->whereHas('biodata', function ($query) {
                $query->where('status_pendaftaran', 'tidak_diterima');
            });
        }

        if ($search) {
            $users->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('nomor_pendaftaran', 'like', '%' . $search . '%');
            });
        }

        $users = $users->latest()->get();

        return view('admin.seleksi.index', compact('users', 'filter', 'search'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status_pendaftaran' => 'required|in:menunggu,diterima,tidak_diterima',
        ]);

        $biodata = BiodataCalonSiswa::where('user_id', $id)->firstOrFail();

        $biodata->status_pendaftaran = $request->status_pendaftaran;
        $biodata->status_seleksi = $request->status_pendaftaran;

        if ($request->status_pendaftaran == 'menunggu') {
            $biodata->status_final = 0;
            $biodata->is_final = 0;
        } else {
            $biodata->status_final = 1;
            $biodata->is_final = 1;
        }

        $biodata->save();

        return redirect()
            ->route('admin.seleksi.index')
            ->with('success', 'Status seleksi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        BiodataCalonSiswa::where('user_id', $user->id)->delete();
        DataOrangTua::where('user_id', $user->id)->delete();
        Prestasi::where('user_id', $user->id)->delete();

        $user->delete();

        return redirect()
            ->route('admin.seleksi.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }

    public function daftarUlangLunas($id)
    {
        $biodata = BiodataCalonSiswa::where('user_id', $id)->firstOrFail();

        $biodata->status_daftar_ulang = 'lunas';
        $biodata->save();

        return back()->with('success', 'Status daftar ulang berhasil diubah menjadi lunas.');
    }

    public function daftarUlangBelumLunas($id)
    {
        $biodata = BiodataCalonSiswa::where('user_id', $id)->firstOrFail();

        $biodata->status_daftar_ulang = 'belum_bayar';
        $biodata->save();

        return back()->with('success', 'Status daftar ulang berhasil dibatalkan.');
    }

    public function show($id)
{
    $user = User::with([
        'biodata.programKeahlian',
        'biodata.tahunAjaran',
        'biodata.gelombangPpdb'
    ])->findOrFail($id);

    $biodata = BiodataCalonSiswa::where('user_id', $user->id)->first();
    $orangtua = DataOrangTua::where('user_id', $user->id)->first();
    $prestasis = Prestasi::where('user_id', $user->id)->get();

    return view('admin.seleksi.show', compact('user', 'biodata', 'orangtua', 'prestasis'));
}
}