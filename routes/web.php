<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParpolsController;
use App\Http\Controllers\JenisPelanggaranController;
use App\Http\Controllers\SuratKerjaController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\LaporanController;

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

/*
    ROUTE UNTUK JENIS PELANGARAN
*/
Route::resource('jenispelanggaran', JenisPelanggaranController::class)->middleware(['auth','verified', 'role:bawaslu-provinsi']);
Route::get('/jenispelanggaran/{id}/pelanggaran', [JenisPelanggaranController::class, 'pelanggaran'])->middleware(['auth','verified', 'role:bawaslu-provinsi'])->name('jenispelanggaran.pelanggaran');
  
/*
    ROUTE UNTUK SURAT KERJA
*/
Route::resource('suratkerja', SuratKerjaController::class)->middleware(['auth','verified', 'role:bawaslu-provinsi|bawaslu-kota|panwascam']);

/*
    ROUTE UNTUK PELANGGARAN
*/
Route::resource('pelanggaran', PelanggaranController::class)->middleware(['auth','verified', 'role:bawaslu-provinsi|bawaslu-kota|panwascam']);

/*
    ROUTE UNTUK LAPORAN
*/
Route::resource('laporan', LaporanController::class)->middleware(['auth','verified', 'role:bawaslu-provinsi|bawaslu-kota|panwascam']);
Route::post('/laporan/{id}/verify', [LaporanController::class, 'verify'])
    ->name('laporan.verify')
    ->middleware(['auth', 'role:bawaslu-kota']);
Route::post('/laporan/{id}/reject', [LaporanController::class, 'reject'])
    ->name('laporan.reject')
    ->middleware(['auth', 'role:bawaslu-kota']);

require __DIR__.'/auth.php';
