<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\BiodataCalonSiswa;
use App\Models\PengumumanPpdb;
use App\Models\GelombangPpdb;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function store(Request $request)
{
    $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
    ], [
        'name.required'  => 'Nama wajib diisi.',
        'email.required' => 'Email wajib diisi.',
        'email.email'    => 'Format email tidak valid.',
        'email.unique'   => 'Email sudah terdaftar.',
    ]);

    $tahunAjaran = TahunAjaran::where('is_active', 1)->first();

    if (!$tahunAjaran) {
        return back()->with('error', 'Tahun ajaran aktif belum diatur.');
    }

    $tahunAwal = substr($tahunAjaran->tahun_ajaran, 0, 4);

    $gelombang = GelombangPpdb::where('tahun_ajaran_id', $tahunAjaran->id)
        ->where('status', 'aktif')
        ->first();

    if (!$gelombang) {
        return back()->with('error', 'Gelombang aktif untuk tahun ajaran ini belum diatur.');
    }

    $nomorTerakhir = User::where('nomor_pendaftaran', 'like', 'PPDB' . $tahunAwal . '%')
        ->orderBy('nomor_pendaftaran', 'desc')
        ->value('nomor_pendaftaran');

    if ($nomorTerakhir) {
        $angkaTerakhir = (int) substr($nomorTerakhir, -3);
        $nomorUrut = $angkaTerakhir + 1;
    } else {
        $nomorUrut = 1;
    }

    $nomorPendaftaran = 'PPDB' . $tahunAwal . str_pad($nomorUrut, 3, '0', STR_PAD_LEFT);

    $passwordPlain = strtoupper(Str::random(8));

    $user = User::create([
        'nomor_pendaftaran' => $nomorPendaftaran,
        'name'              => $request->name,
        'email'             => $request->email,
        'password'          => Hash::make($passwordPlain),
        'role'              => 'user',
    ]);

    BiodataCalonSiswa::create([
        'user_id'             => $user->id,
        'tahun_ajaran_id'     => $tahunAjaran->id,
        'gelombang_ppdb_id'   => $gelombang->id,

        'nama_lengkap'        => $request->name,
        'nisn'                => '-',
        'jenis_kelamin'       => '',
        'agama'               => '',
        'tempat_lahir'        => '-',
        'tanggal_lahir'       => '2000-01-01',
        'golongan_darah'      => '',
        'hobi_kegemaran'      => '-',
        'alamat'              => '-',
        'rumah_tinggal'       => '',
        'no_hp'               => '-',
        'asal_sekolah'        => '-',
        'alamat_asal_sekolah' => '-',

        'status_pembayaran'   => 'belum_bayar',
        'status_pendaftaran'  => 'menunggu',
        'status_seleksi'      => 'menunggu',
        'status_final'        => 0,
        'is_final'            => 0,
    ]);

    return redirect()->route('register')->with('account_success', [
        'nomor_pendaftaran' => $nomorPendaftaran,
        'password'          => $passwordPlain,
        'email'             => $request->email,
    ]);
}

    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'nomor_pendaftaran' => 'required',
            'password'          => 'required',
        ], [
            'nomor_pendaftaran.required' => 'Nomor pendaftaran wajib diisi.',
            'password.required'          => 'Password wajib diisi.',
        ]);

        $user = User::where('nomor_pendaftaran', trim($request->nomor_pendaftaran))->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Nomor pendaftaran atau password salah.');
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('ppdb')
            ->with('success', 'Berhasil login.');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $biodata = BiodataCalonSiswa::where('user_id', $user->id)->first();
        $pengumuman = PengumumanPpdb::latest()->get();

        return view('ppdb.masuk-siswa', compact('user', 'biodata', 'pengumuman'));
    }

    public function lupaPassword()
    {
        return view('auth.lupa-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'nomor_pendaftaran' => 'required',
            'email'             => 'required|email',
        ]);

        $user = User::where('nomor_pendaftaran', trim($request->nomor_pendaftaran))
            ->where('email', $request->email)
            ->first();

        if (!$user) {
            return back()->with('error', 'Nomor pendaftaran atau email tidak cocok.');
        }

        $passwordBaru = strtoupper(Str::random(8));

        $user->password = Hash::make($passwordBaru);
        $user->save();

        return back()->with('success', 'Password baru Anda: ' . $passwordBaru);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}