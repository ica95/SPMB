<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role !== 'admin') {
                Auth::logout();

                return back()->withErrors([
                    'email' => 'Akun ini bukan admin.',
                ]);
            }

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

            public function logout(Request $request)
        {
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()->route('admin.login');
        }

    public function dashboard()
{
    $totalPendaftar = \App\Models\User::where('role', 'user')->count();

    $diterima = \App\Models\BiodataCalonSiswa::where('status_pendaftaran', 'diterima')->count();

    $ditolak = \App\Models\BiodataCalonSiswa::where('status_pendaftaran', 'tidak_diterima')->count();

    $menunggu = \App\Models\BiodataCalonSiswa::where(function ($query) {
        $query->where('status_pendaftaran', 'menunggu')
              ->orWhereNull('status_pendaftaran');
    })->count();

    $totalJurusan = \App\Models\ProgramKeahlian::count();

    return view('admin.dashboard', compact(
        'totalPendaftar',
        'diterima',
        'ditolak',
        'menunggu',
        'totalJurusan'
    ));
}
}