<?php

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
    return view('auth.login');
})->name('index');

// auth
Route::post('auth/login',[App\Http\Controllers\AuthController::class,'login'])->name('login');
Route::post('logout',[App\Http\Controllers\AuthController::class,'logout'])->name('logout');

Route::prefix('admin')
        ->namespace('App\Http\Controllers\Admin')
        ->middleware(['auth','chechkRole:admin' ])
        ->group(function(){
            Route::get('dashboard' , [App\Http\Controllers\Admin\DashboardAdminController::class,'index']);
            Route::resources([
                'dashboard' => DashboardAdminController::class,
                'user' => UserController::class,
                'import-user' => UserImportController::class,
                'informasi-pegawai' => InformasiPegawaiController::class,
                'import-user' => UserImportController::class,
                'data-asuransi' => DataAusransiController::class,
                'data-asesmen-kompetensi' => DataAsesmenKompetensiContrller::class,
                'data-cuti' => DataCutiController::class,
                'data-pendidikan-dinas' => DataPendidikanDinasController::class,
                'data-pendidikan-formal' => PendidikanFormalController::class,
                'data-pendidikan-non-formal' => PendidikanNonFormalController::class,
                'data-kepangkatan' => DataKepangkatanControler::class,
                'data-penghargaan' => DataPenghargaanController::class,
                'data-organisasi' => DataOrganisasiController::class,
                'data-gaji-berkala' => DataGajiBerkalaController::class,
                'data-keluarga' => DataKeluargaController::class,
                'data-tempat-tinggal' => DataTempatTinggalController::class,
                'data-jabatan' => DataJabatanController::class,
                'data-skp' => DataSkpController::class,
                'admin-profile' => AdminController::class,
                ]);
        });

// kusus user
Route::prefix('user')
        ->namespace('App\Http\Controllers\User')
        ->middleware(['auth','chechkRole:user' ])
        ->group(function(){
            Route::get('getkabupaten/{id}' ,[App\Http\Controllers\User\RiwayatTempatTinggal::class,'getKabupaten']);
            Route::get('getkecamatan/{id}' , [App\Http\Controllers\User\RiwayatTempatTinggal::class,'getKecamatan']);
            Route::get('getkelurahan/{id}' , [App\Http\Controllers\User\RiwayatTempatTinggal::class,'getKelurahan']);


            Route::resources([
                'dashboard' => DashboardUserController::class,
                'riwayat-organisasi' => RiwayatOrganisasiController::class,
                'informasi-pegawai' => InformasiPegawaiController::class,
                'riwayat-gaji-berkala' => RiwayatGajiBerkalaController::class,
                'riwayat-asesmen-kompetensi' => RiwayatAsemenKompetensiPegawaiController::class,
                'riwayat-cuti' => RiwayatCutiController::class,
                'riwayat-pendidikan-dinas' => RiwayatPendidikanDinas::class,
                'riwayat-keluarga' => RiwayatKeluargaController::class,
                'riwayat-pendidikan-formal' => RiwayatPendidikanformalController::class,
                'riwayat-pendidikan-non-formal' => RiwayatPendidikanNonFormalController::class,
                'riwayat-penghargaan' => RiwayatPenghargaanController::class,
                'riwayat-tempat-tinggal' => RiwayatTempatTinggal::class,
                'riwayat-asuransi' => RiwayatAuranasiController::class,
                'riwayat-jabatan' => RiwayatJabatanController::class,
                'riwayat-kepangkatan' => RiwayatKepangkatanController::class,
                'riwayat-skp' => RiwayatSkpController::class,
                'user-profile' => UserController::class,
                ]);
        });

Route::prefix('notifikasi')
->namespace('App\Http\Controllers')
->middleware(['auth','chechkRole:user,admin' ])
->group(function(){
 
    Route::resources([
        'home' => NotifikasiController::class,
        ]);
});
