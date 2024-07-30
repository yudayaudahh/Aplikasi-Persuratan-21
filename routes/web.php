<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'guest'], function() {
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate'])->name('proses.login');
});

Route::group(['middleware' => 'auth'], function() {
    // Dashboard
    Route::redirect('/', 'dashboard');
    Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('import-templates/{filename}', [\App\Http\Controllers\DashboardController::class, 'templateImport'])->name('import_templates');
    Route::get('logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

    // User Action
    Route::prefix('user')->group(function () {
        Route::get('', [\App\Http\Controllers\UserController::class, 'index'])->name('user');
        Route::get('create', [\App\Http\Controllers\UserController::class, 'create'])->name('user.create');
        Route::post('store', [\App\Http\Controllers\UserController::class, 'store'])->name('user.store');
        Route::get('/{user}/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
        Route::put('/{user}/update', [\App\Http\Controllers\UserController::class, 'update'])->name('user.update');
        Route::delete('/{user}/destroy', [\App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');
    });

    // Surat Keluar
    Route::prefix('surat-masuk')->group(function () {
        Route::get('', [\App\Http\Controllers\SuratMasukController::class, 'index'])->name('surat-masuk');
        Route::get('create', [\App\Http\Controllers\SuratMasukController::class, 'create'])->name('surat-masuk.create');
        Route::post('store', [\App\Http\Controllers\SuratMasukController::class, 'store'])->name('surat-masuk.store');
        Route::get('/{suratMasuk}/edit', [\App\Http\Controllers\SuratMasukController::class, 'edit'])->name('surat-masuk.edit');
        Route::put('/{suratMasuk}/update', [\App\Http\Controllers\SuratMasukController::class, 'update'])->name('surat-masuk.update');
        Route::get('/{suratMasuk}/destroy', [\App\Http\Controllers\SuratMasukController::class, 'destroy'])->name('surat-masuk.destroy');
        Route::get('{suratMasuk}/export', [\App\Http\Controllers\SuratMasukController::class, 'export'])->name('surat-masuk.export');
    });

    // Surat Masuk
    Route::prefix('surat-keluar')->group(function () {
        Route::get('', [\App\Http\Controllers\SuratKeluarController::class, 'index'])->name('surat-keluar');
        Route::get('create', [\App\Http\Controllers\SuratKeluarController::class, 'create'])->name('surat-keluar.create');
        Route::post('store', [\App\Http\Controllers\SuratKeluarController::class, 'store'])->name('surat-keluar.store');
        Route::get('/{suratKeluar}/edit', [\App\Http\Controllers\SuratKeluarController::class, 'edit'])->name('surat-keluar.edit');
        Route::put('/{suratKeluar}/update', [\App\Http\Controllers\SuratKeluarController::class, 'update'])->name('surat-keluar.update');
        Route::get('/{suratKeluar}/destroy', [\App\Http\Controllers\SuratKeluarController::class, 'destroy'])->name('surat-keluar.destroy');
        Route::get('/{suratKeluar}/export', [\App\Http\Controllers\SuratKeluarController::class, 'export'])->name('surat-keluar.export');
    });

    // Kategori Surat
    Route::prefix('kategori')->group(function () {
        Route::get('', [\App\Http\Controllers\KategoriController::class, 'index'])->name('kategori');
        Route::get('create', [\App\Http\Controllers\KategoriController::class, 'create'])->name('kategori.create');
        Route::post('store', [\App\Http\Controllers\KategoriController::class, 'store'])->name('kategori.store');
        Route::get('/{kategori}/edit', [\App\Http\Controllers\KategoriController::class, 'edit'])->name('kategori.edit');
        Route::put('/{kategori}/update', [\App\Http\Controllers\KategoriController::class, 'update'])->name('kategori.update');
        Route::get('/{kategori}/destroy', [\App\Http\Controllers\KategoriController::class, 'destroy'])->name('kategori.destroy');
    });

    // Instasi / Perusahaan Penerima surat
    Route::prefix('instasi')->group(function () {
        Route::get('', [\App\Http\Controllers\InstasiController::class, 'index'])->name('instasi');
        Route::get('create', [\App\Http\Controllers\InstasiController::class, 'create'])->name('instasi.create');
        Route::post('store', [\App\Http\Controllers\InstasiController::class, 'store'])->name('instasi.store');
        Route::get('/{instasi}/edit', [\App\Http\Controllers\InstasiController::class, 'edit'])->name('instasi.edit');
        Route::put('/{instasi}/update', [\App\Http\Controllers\InstasiController::class, 'update'])->name('instasi.update');
        Route::get('/{instasi}/destroy', [\App\Http\Controllers\InstasiController::class, 'destroy'])->name('instasi.destroy');
    });

    // Instasi
    Route::prefix('pegawai')->group(function () {
        Route::get('', [\App\Http\Controllers\PegawaiController::class, 'index'])->name('pegawai');
        Route::get('create', [\App\Http\Controllers\PegawaiController::class, 'create'])->name('pegawai.create');
        Route::post('store', [\App\Http\Controllers\PegawaiController::class, 'store'])->name('pegawai.store');
        Route::get('/{pegawai}/edit', [\App\Http\Controllers\PegawaiController::class, 'edit'])->name('pegawai.edit');
        Route::put('/{pegawai}/update', [\App\Http\Controllers\PegawaiController::class, 'update'])->name('pegawai.update');
        Route::get('/{pegawai}/destroy', [\App\Http\Controllers\PegawaiController::class, 'destroy'])->name('pegawai.destroy');
    });

});