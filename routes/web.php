<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KeluargaController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Web\PembaruanController;
use App\Http\Controllers\Web\PemetaanController;
use App\Http\Controllers\Web\PengajuanController;
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

Route::get('/', function () {
    return view('public.home.index');
});
Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan');
Route::post('/pengajuan', [PengajuanController::class, 'create'])->name('pengajuan.create');
Route::get('/pembaruan', [PembaruanController::class, 'index'])->name('pembaruan');
Route::post('/pembaruan', [PembaruanController::class, 'create'])->name('pembaruan.create');
Route::get('/pemetaan', [PemetaanController::class, 'index'])->name('pemetaan');

Route::prefix('admin')->group(function(){
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login.do');

    Route::middleware(['auth'])->group(function(){
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::prefix('warga-miskin')->group(function(){
            Route::get('/', [KeluargaController::class, 'index'])->name('admin.warga-miskin');
        });
        Route::prefix('pengajuan')->group(function(){
            Route::get('/', [\App\Http\Controllers\Admin\PengajuanController::class, 'index'])->name('admin.pengajuan');
            Route::get('{id}', [\App\Http\Controllers\Admin\PengajuanController::class, 'show'])->name('admin.pengajuan.show');
            Route::post('{id}', [\App\Http\Controllers\Admin\PengajuanController::class, 'status'])->name('admin.pengajuan.status');
        });
        Route::prefix('pembaruan')->group(function(){
            Route::get('/', [\App\Http\Controllers\Admin\PembaruanController::class, 'index'])->name('admin.pembaruan');
            Route::get('/{id}', [\App\Http\Controllers\Admin\PembaruanController::class, 'show'])->name('admin.pembaruan.show');
            Route::post('/{id}', [\App\Http\Controllers\Admin\PembaruanController::class, 'verifikasi'])->name('admin.pembaruan.verifikasi');
        });

    });
});
