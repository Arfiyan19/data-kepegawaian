<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('user')
->namespace('App\Http\Controllers\Api\User') 
->group(function(){
    Route::get('dashboard' , [App\Http\Controllers\Admin\DashboardAdminController::class,'index']);
    Route::resources([
        
        'informasi-pegawai' => InformasiPegawaiController::class,
        'riwayat-organisasi' => OrganisasiConroller::class,
        'riwayat-gaji-berkala' => GajiController::class,
        'riwayat-asesmen-kompetensi' => AsesmenController::class,
        'riwayat-cuti' => CutiController::class,
        'riwayat-pendidikan-dinas' => PendidikanDinasController::class,
        'riwayat-keluarga' => KeluargaController::class,
        'riwayat-pendidikan-formal' => PendidikanFormalConroller::class,
        'riwayat-pendidikan-non-formal' => PendidikanNonFormalConroller::class,
        'riwayat-penghargaan' => PenghargaanController::class,
        'riwayat-tempat-tinggal' => TempatTinggalController::class,
        'riwayat-asuransi' => AuransiController::class, 
        'riwayat-kepangkatan' => KepangkatanController::class, 
        'riwayat-jabatan' => RiwayatJabatanController::class,
        'riwayat-skp' => RiwayatSkpController::class,
        
        ]);
});

Route::post('login',[App\Http\Controllers\AuthApiController::class,'login'])->name('api-login');
Route::post('logout',[App\Http\Controllers\AuthController::class,'logout'])->name('logout');
