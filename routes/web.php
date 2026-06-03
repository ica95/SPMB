<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\DataOrangTuaController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\PembayaranController as AdminPembayaranController;
use App\Http\Controllers\Admin\SeleksiController;
use App\Http\Controllers\AdminPpdbController;
use App\Http\Controllers\AdminProgramKeahlianController;
use App\Http\Controllers\AdminGelombangPpdbController;
use App\Http\Controllers\AdminJadwalPpdbController;
use App\Http\Controllers\AdminPengumumanPpdbController;
use App\Http\Controllers\Admin\LaporanPendaftaranController;

/*
|--------------------------------------------------------------------------
| Halaman Publik
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/program-keahlian/tjkt', [ProgramController::class, 'tjkt'])->name('program.tjkt');
Route::get('/program-keahlian/teknik-elektronika', [ProgramController::class, 'te'])->name('program.te');
Route::get('/program-keahlian/teknik-kendaraan-ringan', [ProgramController::class, 'to'])->name('program.to');
Route::get('/program-keahlian/teknik-bisnis-sepeda-motor', [ProgramController::class, 'tbsm'])->name('program.tbsm');
Route::get('/program-keahlian/busana-fesyen', [ProgramController::class, 'bf'])->name('program.bf');

/*
|--------------------------------------------------------------------------
| Auth User
|--------------------------------------------------------------------------
*/
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/lupa-password', [AuthController::class, 'lupaPassword'])->name('password.lupa');
Route::post('/lupa-password', [AuthController::class, 'resetPassword'])->name('password.reset');

Route::get('/dashboard-siswa', [AuthController::class, 'dashboard'])->name('dashboard.siswa')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');
        Route::resource('/program-keahlian', AdminProgramKeahlianController::class);
        Route::resource('/gelombang-ppdb', AdminGelombangPpdbController::class);
        Route::resource('/jadwal-ppdb', AdminJadwalPpdbController::class);
        Route::resource('/pengumuman-ppdb', AdminPengumumanPpdbController::class);
        Route::get('/laporan-pendaftaran', [LaporanPendaftaranController::class, 'index'])->name('laporan.index');
        Route::delete('/laporan-pendaftaran/{id}', [LaporanPendaftaranController::class, 'destroy'])->name('laporan.destroy');
        Route::resource('tahun-ajaran', App\Http\Controllers\Admin\TahunAjaranController::class);
        
        // Pembayaran
        Route::get('/pembayaran', [AdminPembayaranController::class, 'index'])->name('pembayaran');
        Route::post('/pembayaran/{id}/verifikasi', [AdminPembayaranController::class, 'verifikasi'])->name('pembayaran.verifikasi');
        Route::post('/pembayaran/{id}/tolak', [AdminPembayaranController::class, 'tolak'])->name('pembayaran.tolak');
        Route::post('/pembayaran/{id}/reset', [AdminPembayaranController::class, 'reset'])->name('pembayaran.reset');
        Route::delete('/pembayaran/{id}/delete', [AdminPembayaranController::class, 'delete'])->name('pembayaran.delete');

        // Seleksi
        Route::get('/seleksi-siswa',[SeleksiController::class, 'index'])->name('seleksi.index');
        Route::post('/seleksi-siswa/{id}',[SeleksiController::class, 'update'])->name('seleksi.update');
        Route::delete('/seleksi-siswa/{id}', [SeleksiController::class, 'destroy'])->name('seleksi.destroy');
        Route::get('/seleksi/{id}/detail', [SeleksiController::class, 'show'])->name('seleksi.show');
        Route::post('/seleksi/{id}/daftar-ulang-lunas', [SeleksiController::class, 'daftarUlangLunas'])->name('seleksi.daftar-ulang-lunas');
        Route::post('/seleksi/{id}/daftar-ulang-belum-lunas', [SeleksiController::class, 'daftarUlangBelumLunas'])->name('seleksi.daftar-ulang-belum-lunas');
        

        // CRUD PPDB Admin
        Route::get('/ppdb', [AdminPpdbController::class, 'index'])->name('ppdb.index');
        Route::get('/ppdb/create', [AdminPpdbController::class, 'create'])->name('ppdb.create');
        Route::post('/ppdb/store', [AdminPpdbController::class, 'store'])->name('ppdb.store');
        Route::get('/ppdb/{id}', [AdminPpdbController::class, 'show'])->name('ppdb.show');
        Route::get('/ppdb/{id}/edit', [AdminPpdbController::class, 'edit'])->name('ppdb.edit');
        Route::put('/ppdb/{id}/update', [AdminPpdbController::class, 'update'])->name('ppdb.update');
        Route::delete('/ppdb/{id}/delete', [AdminPpdbController::class, 'destroy'])->name('ppdb.destroy');
        Route::post('/admin/siswa/{id}/daftar-ulang',[AdminPpdbController::class, 'updateDaftarUlang'])->name('admin.siswa.daftar-ulang');
        Route::post('/ppdb/{id}/terima', [AdminPpdbController::class, 'terima'])->name('admin.ppdb.terima');
        Route::post('/ppdb/{id}/tolak', [AdminPpdbController::class, 'tolak'])->name('admin.ppdb.tolak');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    });
});

/*
|--------------------------------------------------------------------------
| PPDB - hanya untuk user login
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/ppdb', [PpdbController::class, 'index'])->name('ppdb');

    Route::get('/biodata', [BiodataController::class, 'create'])->name('biodata.create');
    Route::post('/biodata', [BiodataController::class, 'store'])->name('biodata.store');
    Route::get('/biodata/edit',[BiodataController::class, 'create'])->name('biodata.edit');

    Route::get('/data-orangtua',[DataOrangTuaController::class, 'create'])->name('orangtua.create');
    Route::post('/data-orangtua',[DataOrangTuaController::class, 'store'])->name('orangtua.store');
    Route::get('/data-orangtua/edit',[DataOrangTuaController::class, 'create'])->name('orangtua.edit');

    Route::get('/prestasi', [PrestasiController::class, 'index'])->name('prestasi.index');
    Route::post('/prestasi', [PrestasiController::class, 'store'])->name('prestasi.store');
    Route::delete('/prestasi/{id}', [PrestasiController::class, 'destroy'])->name('prestasi.destroy');
    Route::post('/prestasi/skip', [PrestasiController::class, 'skip'])->name('prestasi.skip');
    Route::get('/prestasi/edit', [PrestasiController::class, 'index'])->name('prestasi.edit');

    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayaran.store');
    Route::get('/pembayaran/edit', [PembayaranController::class, 'create'])->name('pembayaran.edit');

    Route::get('/berkas', [BerkasController::class, 'create'])->name('berkas.create');
    Route::post('/berkas', [BerkasController::class, 'store'])->name('berkas.store');
    Route::get('/berkas/edit', [BerkasController::class, 'create'])->name('berkas.edit');

    Route::get('/review', [PpdbController::class, 'review'])->name('review.index');
    Route::post('/ppdb/submit-final', [PpdbController::class, 'submitFinal'])->name('ppdb.submitFinal');
    
    
    Route::get('/pendaftaran/cetak-bukti', [PpdbController::class, 'cetakBukti'])->name('pendaftaran.cetakBukti');

    Route::get('/status-pendaftaran', [PpdbController::class, 'status'])->name('pendaftaran.status');
    Route::get('/masuk-siswa', [PpdbController::class, 'masukSiswa'])->name('siswa.masuk');
    Route::get('/kwitansi', [PembayaranController::class, 'kwitansi'])->name('kwitansi');
});
