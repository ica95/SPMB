<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\BiodataCalonSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'menunggu_verifikasi');

        $allowedStatus = ['menunggu_verifikasi', 'lunas', 'belum_bayar'];

        if (!in_array($status, $allowedStatus)) {
            $status = 'menunggu_verifikasi';
        }

        $users = User::whereHas('biodata', function ($query) use ($status) {
            $query->where('status_pembayaran', $status);
        })->with('biodata')->get();

        return view('admin.pembayaran.index', compact('users', 'status'));
    }

    public function verifikasi(Request $request, $id)
{
    $biodata = BiodataCalonSiswa::where('user_id', $id)->firstOrFail();

    $biodata->status_pembayaran = 'lunas';
    $biodata->save();

    return redirect()
        ->route('admin.pembayaran', ['status' => $request->get('status', 'menunggu_verifikasi')])
        ->with('success', 'Pembayaran berhasil diverifikasi.');
}

    public function reset(Request $request, $id)
    {
        $biodata = BiodataCalonSiswa::where('user_id', $id)->firstOrFail();

        if ($biodata->bukti_pembayaran && Storage::disk('public')->exists($biodata->bukti_pembayaran)) {
            Storage::disk('public')->delete($biodata->bukti_pembayaran);
        }

        $biodata->bukti_pembayaran = null;
        $biodata->status_pembayaran = 'belum_bayar';
        $biodata->save();

        return redirect()
            ->route('admin.pembayaran', ['status' => $request->get('status', 'menunggu_verifikasi')])
            ->with('success', 'Upload bukti pembayaran berhasil direset.');
    }

    public function delete(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->role === 'admin') {
            return redirect()
                ->route('admin.pembayaran', ['status' => $request->get('status', 'menunggu_verifikasi')])
                ->with('error', 'Admin tidak boleh dihapus.');
        }

        $biodata = BiodataCalonSiswa::where('user_id', $id)->first();

        if ($biodata && $biodata->bukti_pembayaran && Storage::disk('public')->exists($biodata->bukti_pembayaran)) {
            Storage::disk('public')->delete($biodata->bukti_pembayaran);
        }

        $user->delete();

        return redirect()
            ->route('admin.pembayaran', ['status' => $request->get('status', 'menunggu_verifikasi')])
            ->with('success', 'User berhasil dihapus.');
    }
}