<?php

use App\Http\Controllers\admin\AparatController;
use App\Http\Controllers\admin\InformasiController;
use App\Http\Controllers\admin\JenisSuratController;
use App\Http\Controllers\admin\PengaduanController;
use App\Http\Controllers\admin\RtController;
use App\Http\Controllers\admin\RtrwController;
use App\Http\Controllers\admin\RwController;
use App\Http\Controllers\admin\SuratController;
use App\Http\Controllers\admin\WargaController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MiscellaneousController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\kades\AparatController as KadesAparatController;
use App\Http\Controllers\kades\JenisSuratController as KadesJenisSuratController;
use App\Http\Controllers\kades\KadesController as KadesKadesController;
use App\Http\Controllers\kades\RtController as KadesRtController;
use App\Http\Controllers\kades\RtrwController as KadesRtrwController;
use App\Http\Controllers\kades\RwController as KadesRwController;
use App\Http\Controllers\kades\SuratController as KadesSuratController;
use App\Http\Controllers\kades\WargaController as KadesWargaController;
use App\Http\Controllers\KadesController;
use App\Http\Controllers\PelamarController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\warga\PengaduanController2;
use App\Http\Controllers\warga\SuratController2;
use App\Http\Controllers\warga\WargaController2;

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


// Main Page Route
Route::get('/', [Controller::class, 'dashboard'])->name('dashboard-home');
Route::get('/log', [Controller::class, 'home'])->name('dashboard-login');
Route::get('/reg', [Controller::class, 'register'])->name('dashboard-register');
Route::get('/informasi', [Controller::class, 'info'])->name('dashboard-informasi');
Route::get('/email', [SuratController2::class, 'test'])->name('email');


/* Route Pages */
Route::get('/error', [MiscellaneousController::class, 'error'])->name('error');

Route::get('redirect', [Controller::class, 'redirect'])->name('redirect');

Route::group(['middleware' => ['auth']], function() {
    // your routes
    Route::group(['prefix' => 'admin'], function () {
        Route::get('info', [InformasiController::class, 'index'])->name('info-admin');
        Route::post('info_add', [InformasiController::class, 'info_add'])->name('info-add-admin');

        Route::group(['prefix' => 'd'], function () {
            Route::get('warga', [WargaController::class, 'warga'])->name('warga-admin');
            Route::post('warga_add', [WargaController::class, 'warga_add'])->name('warga-add-admin');
            Route::get('warga_data', [WargaController::class, 'warga_data'])->name('warga-data-admin');
            Route::get('warga_data_single/{id}', [WargaController::class, 'warga_data_single'])->name('warga-data-single-admin');
            Route::get('warga_delete/{id}', [WargaController::class, 'warga_delete'])->name('warga-delete-admin');

            Route::get('rt', [RtController::class, 'rt'])->name('rt-admin');
            Route::post('rt_add', [RtController::class, 'rt_add'])->name('rt-add-admin');
            Route::get('rt_data', [RtController::class, 'rt_data'])->name('rt-data-admin');
            Route::get('rt_data_single/{id}', [RtController::class, 'rt_data_single'])->name('rt-data-single-admin');
            Route::get('rt_delete/{id}', [RtController::class, 'rt_delete'])->name('rt-delete-admin');

            Route::get('rw', [RwController::class, 'rw'])->name('rw-admin');
            Route::post('rw_add', [RwController::class, 'rw_add'])->name('rw-add-admin');
            Route::get('rw_data', [RwController::class, 'rw_data'])->name('rw-data-admin');
            Route::get('rw_data_single/{id}', [RwController::class, 'rw_data_single'])->name('rw-data-single-admin');
            Route::get('rw_delete/{id}', [RwController::class, 'rw_delete'])->name('rw-delete-admin');

        });
        Route::group(['prefix' => 'm'], function () {
            Route::get('aparat', [AparatController::class, 'aparat'])->name('aparat-admin');
            Route::post('aparat_add', [AparatController::class, 'aparat_add'])->name('aparat-add-admin');
            Route::get('aparat_data', [AparatController::class, 'aparat_data'])->name('aparat-data-admin');
            Route::get('aparat_data_single/{id}', [AparatController::class, 'aparat_data_single'])->name('aparat-data-single-admin');
            Route::get('aparat_delete/{id}', [AparatController::class, 'aparat_delete'])->name('aparat-delete-admin');
    
            Route::get('rtrw', [RtrwController::class, 'rtrw'])->name('rtrw-admin');
            Route::post('rtrw_add', [RtrwController::class, 'rtrw_add'])->name('rtrw-add-admin');
            Route::get('rtrw_data', [RtrwController::class, 'rtrw_data'])->name('rtrw-data-admin');
            Route::get('rtrw_data_single/{id}', [RtrwController::class, 'rtrw_data_single'])->name('rtrw-data-single-admin');
            Route::get('rtrw_delete/{id}', [RtrwController::class, 'rtrw_delete'])->name('rtrw-delete-admin');

            Route::get('jenissurat', [JenisSuratController::class, 'jenissurat'])->name('jenissurat-admin');
            Route::post('jenissurat_add', [JenisSuratController::class, 'jenissurat_add'])->name('jenissurat-add-admin');
            Route::get('jenissurat_data', [JenisSuratController::class, 'jenissurat_data'])->name('jenissurat-data-admin');
            Route::get('jenissurat_data_single/{id}', [JenisSuratController::class, 'jenissurat_data_single'])->name('jenissurat-data-single-admin');
            Route::get('jenissurat_delete/{id}', [JenisSuratController::class, 'jenissurat_delete'])->name('jenissurat-delete-admin');
            
        });
        Route::group(['prefix' => 'l'], function () {
            Route::get('surat', [SuratController::class, 'surat'])->name('surat-admin');
            Route::get('surat_update/{id}', [SuratController::class, 'update_admin'])->name('surat_update-admin');
            Route::get('surat_data', [SuratController::class, 'surat_data'])->name('surat-data-admin');
            Route::get('cetak/{id}', [SuratController::class, 'cetak'])->name('surat-cetak-admin');

            Route::get('pengaduan', [PengaduanController::class, 'index'])->name('pengaduan-admin');
            Route::get('pengaduan_data', [PengaduanController::class, 'pengaduan_data'])->name('pengaduan-data-admin');
        });
        Route::group(['prefix' => 'r'], function () {
            Route::get('lap_surat', [SuratController::class, 'lap_surat'])->name('lap_surat-admin');
            Route::get('lap_pengaduan', [PengaduanController::class, 'lap_pengaduan'])->name('lap_pengaduan-admin');
        });
    });
    Route::group(['prefix' => 'kades'], function () {
        Route::group(['prefix' => 'm'], function () {
            Route::get('aparat', [KadesAparatController::class, 'aparat'])->name('aparat-kades');
            Route::get('aparat_data', [KadesAparatController::class, 'aparat_data'])->name('aparat-data-kades');
    
            Route::get('rtrw', [KadesRtrwController::class, 'rtrw'])->name('rtrw-kades');
            Route::get('rtrw_data', [KadesRtrwController::class, 'rtrw_data'])->name('rtrw-data-kades');

            Route::get('jenissurat', [KadesJenisSuratController::class, 'jenissurat'])->name('jenissurat-kades');
            Route::get('jenissurat_data', [KadesJenisSuratController::class, 'jenissurat_data'])->name('jenissurat-data-kades');
        });
        Route::group(['prefix' => 'd'], function () {
            Route::get('warga', [KadesWargaController::class, 'warga'])->name('warga-kades');
            Route::get('warga_data', [KadesWargaController::class, 'warga_data'])->name('warga-data-kades');

            Route::get('rt', [KadesRtController::class, 'rt'])->name('rt-kades');
            Route::get('rt_data', [KadesRtController::class, 'rt_data'])->name('rt-data-kades');
            
            Route::get('rw', [KadesRwController::class, 'rw'])->name('rw-kades');
            Route::get('rw_data', [KadesRwController::class, 'rw_data'])->name('rw-data-kades');
            
        });
        Route::group(['prefix' => 'r'], function () {
            Route::get('lap_surat', [KadesSuratController::class, 'lap_surat'])->name('lap_surat-kades');
            Route::get('lap_surat_data', [KadesSuratController::class, 'rekap_data'])->name('lap_surat_data-kades');

            Route::get('lap_pengaduan', [PengaduanController::class, 'lap_pengaduan'])->name('lap_pengaduan-admin');
        });
    });
    Route::group(['prefix' => 'rtrw'], function () {
        Route::group(['prefix' => 'd'], function () {
            Route::get('warga', [KadesWargaController::class, 'warga'])->name('warga-rtrw');
        });
        Route::group(['prefix' => 'l'], function () {
            Route::get('surat', [SuratController::class, 'surat'])->name('surat-rtrw');
            Route::get('surat_update/{id}', [SuratController::class, 'update'])->name('surat_update-rtrw');

            Route::get('pengaduan', [PengaduanController::class, 'index'])->name('pengaduan-rtrw');
        });
    });
    Route::group(['prefix' => 'warga'], function () {
        Route::group(['prefix' => 'd'], function () {
            Route::get('warga', [WargaController2::class, 'warga'])->name('warga-warga');
            Route::post('warga_add', [WargaController2::class, 'warga_add'])->name('warga-add-warga');
            Route::get('warga_data', [WargaController2::class, 'warga_data'])->name('warga-data-warga');
            Route::get('warga_data_single/{id}', [WargaController2::class, 'warga_data_single'])->name('warga-data-single-warga');
            Route::get('warga_delete/{id}', [WargaController2::class, 'warga_delete'])->name('warga-delete-warga');
        });
        Route::group(['prefix' => 'l'], function () {
            Route::get('surat', [SuratController2::class, 'surat'])->name('surat-warga');
            Route::post('surat_add', [SuratController2::class, 'surat_add'])->name('surat-add-warga');
            Route::get('surat_data', [SuratController2::class, 'surat_data'])->name('surat-data-warga');
            Route::get('surat_data_single/{id}', [SuratController2::class, 'surat_data_single'])->name('surat-data-single-warga');
            Route::get('surat_delete/{id}', [SuratController2::class, 'surat_delete'])->name('surat-delete-warga');
            Route::get('cetak/{id}', [SuratController2::class, 'cetak'])->name('surat-cetak-warga');

            Route::get('pengaduan', [PengaduanController2::class, 'index'])->name('pengaduan-warga');
            Route::post('pengaduan_add', [PengaduanController2::class, 'pengaduan_add'])->name('pengaduan-add-warga');
        });
    });
    Route::group(['prefix' => 'admin'], function () {

    });
    //edit
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('dashboard-admin');
    Route::get('/kades', [KadesKadesController::class, 'dashboard'])->name('dashboard-kades');
    Route::get('/warga', [WargaController2::class, 'dashboard'])->name('dashboard-warga');
    Route::get('/rtrw', [WargaController2::class, 'dashboard'])->name('dashboard-rtrw');
    
});
