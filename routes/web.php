<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParpolsController;
use App\Http\Controllers\JenisPelanggaranController;
use App\Http\Controllers\SuratKerjaController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PDFController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::resource('dashboard', DashboardController::class)->middleware(['auth','verified','role:bawaslu-provinsi|bawaslu-kota|panwascam']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
    ROUTE UNTUK PARPOLS 
*/
Route::resource('parpols', ParpolsController::class)->middleware(['auth','verified', 'role:bawaslu-provinsi']);
Route::get('/parpols/{id}/pelanggaran', [ParpolsController::class, 'pelanggaran'])->middleware(['auth','verified', 'role:bawaslu-provinsi'])->name('parpols.pelanggaran');
Route::get('/cetakParpols', [PDFController::class, 'cetakParpols'])->middleware(['auth','verified', 'role:bawaslu-provinsi|bawaslu-kota|panwascam'])->name('cetakParpols');
Route::get('/cetakParpolsById/{id}', [PDFController::class, 'cetakParpolsById'])->name('cetakParpolsById');

/*
    ROUTE UNTUK JENIS PELANGARAN
*/
Route::resource('jenispelanggaran', JenisPelanggaranController::class)->middleware(['auth','verified', 'role:bawaslu-provinsi']);
Route::get('/jenispelanggaran/{id}/pelanggaran', [JenisPelanggaranController::class, 'pelanggaran'])->middleware(['auth','verified', 'role:bawaslu-provinsi'])->name('jenispelanggaran.pelanggaran');
Route::get('/cetakJenisPelanggaran', [PDFController::class, 'cetakJenisPelanggaran'])->middleware(['auth','verified', 'role:bawaslu-provinsi|bawaslu-kota|panwascam'])->name('cetakJenisPelanggaran');
Route::get('/cetakJenisPelanggaranById/{id}', [PDFController::class, 'cetakJenisPelanggaranById'])->name('cetakJenisPelanggaranById');

/*
    ROUTE UNTUK SURAT KERJA
*/
Route::resource('suratkerja', SuratKerjaController::class)->middleware(['auth','verified', 'role:bawaslu-provinsi|bawaslu-kota|panwascam']);
Route::get('/cetakSuratKerja', [PDFController::class, 'cetakSuratKerja'])->middleware(['auth','verified', 'role:bawaslu-provinsi|bawaslu-kota|panwascam'])->name('cetakSuratKerja');
Route::get('/cetakSuratKerjaById/{id}', [PDFController::class, 'cetakSuratKerjaById'])->middleware(['auth','verified', 'role:bawaslu-provinsi|bawaslu-kota|panwascam'])->name('cetakSuratKerjaById');

/*
    ROUTE UNTUK PELANGGARAN
*/
Route::resource('pelanggaran', PelanggaranController::class)->middleware(['auth','verified', 'role:bawaslu-provinsi|bawaslu-kota|panwascam']);
Route::get('/cetakPelanggaran', [PDFController::class, 'cetakPelanggaran'])->middleware(['auth','verified', 'role:bawaslu-provinsi|bawaslu-kota|panwascam'])->name('cetakPelanggaran');
Route::get('/cetakPelanggaranById/{id}', [PDFController::class, 'cetakPelanggaranById'])->middleware(['auth','verified', 'role:bawaslu-provinsi|bawaslu-kota|panwascam'])->name('cetakPelanggaranById');

/*
    ROUTE UNTUK LAPORAN
*/
Route::resource('laporan', LaporanController::class)->middleware(['auth','verified', 'role:bawaslu-provinsi|bawaslu-kota|panwascam']);
Route::post('/laporan/{id}/verify', [LaporanController::class, 'verify'])
    ->name('laporan.verify')
    ->middleware(['auth', 'verified', 'role:bawaslu-kota']);
Route::post('/laporan/{id}/reject', [LaporanController::class, 'reject'])
    ->name('laporan.reject')
    ->middleware(['auth', 'verified', 'role:bawaslu-kota']);
Route::get('/cetakLaporanPelanggaran', [PDFController::class, 'cetakLaporanPelanggaran'])->middleware(['auth','verified', 'role:bawaslu-provinsi|bawaslu-kota|panwascam'])->name('cetakLaporanPelanggaran');
Route::get('/cetakLaporanPelanggaranById/{id}', [PDFController::class, 'cetakLaporanPelanggaranById'])->middleware(['auth','verified', 'role:bawaslu-provinsi|bawaslu-kota|panwascam'])->name('cetakLaporanPelanggaranById');

/*
    ROUTE UNTUK USER
*/
Route::get('/users', [UsersController::class, 'index'])
    ->name('users.index')
    ->middleware(['auth', 'role:bawaslu-provinsi']);
Route::patch('/users/{id}/makeProvinsi', [UsersController::class, 'makeProvinsi'])
    ->name('users.makeProvinsi')
    ->middleware(['auth', 'role:bawaslu-provinsi']);
Route::patch('/users/{id}/makeKota', [UsersController::class, 'makeKota'])
    ->name('users.makeKota')
    ->middleware(['auth', 'role:bawaslu-provinsi']);
Route::patch('/users/{id}/makePanwascam', [UsersController::class, 'makePanwascam'])
    ->name('users.makePanwascam')
    ->middleware(['auth', 'role:bawaslu-provinsi']);

require __DIR__.'/auth.php';
