<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndustriController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\PemonitoringController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\TokenKeluar;
use App\Http\Controllers\TokenKeluarController;
use Illuminate\Support\Facades\Route;

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
    return view('pages.login');
});

Route::post('login',[LoginController::class,'login']);
Route::get('logout',[LoginController::class,'logout']);

Route::middleware(['statuslogin'])->group(function(){
    //dashboard
    Route::get('dashboard',[DashboardController::class,'show']);

    //industri
    Route::get('industri',[IndustriController::class,'show']);
    Route::post('industri/create',[IndustriController::class,'create']);
    Route::get('industri/delete/{id}',[IndustriController::class,'delete']);
    Route::post('industri/edit/{id}',[IndustriController::class,'edit']);

    //industri
    Route::get('monitoring',[MonitoringController::class,'show']);
    Route::post('monitoring/create',[MonitoringController::class,'create']);
    Route::get('monitoring/delete/{id}',[MonitoringController::class,'delete']);
    Route::post('monitoring/edit/{id}',[MonitoringController::class,'edit']);

    //kelas
    Route::get('kelas',[KelasController::class,'show']);
    Route::post('kelas/create',[KelasController::class,'create']);
    Route::get('kelas/delete/{id}',[KelasController::class,'delete']);
    Route::post('kelas/edit/{id}',[KelasController::class,'edit']);

    //administrator
    Route::get('users/administrator',[AdministratorController::class,'show']);
    Route::post('users/administrator/create',[AdministratorController::class,'create']);
    Route::get('users/administrator/delete/{id}',[AdministratorController::class,'delete']);
    Route::post('users/administrator/edit/{id}',[AdministratorController::class,'edit']);

    //siswa
    Route::get('users/siswa',[SiswaController::class,'show']);
    Route::post('users/siswa/create',[SiswaController::class,'create']);
    Route::get('users/siswa/delete/{id}',[SiswaController::class,'delete']);
    Route::post('users/siswa/edit/{id}',[SiswaController::class,'edit']);
    Route::get('/getSiswa/{id_kelas}', [SiswaController::class, 'getSiswa']);

    //pemonitoring
    Route::get('users/pemonitoring',[PemonitoringController::class,'show']);
    Route::post('users/pemonitoring/create',[PemonitoringController::class,'create']);
    Route::get('users/pemonitoring/delete/{id}',[PemonitoringController::class,'delete']);
    Route::post('users/pemonitoring/edit/{id}',[PemonitoringController::class,'edit']);

    //Banner
    Route::get('banner',[BannerController::class,'show']);
    Route::post('banner/create',[BannerController::class,'create']);
    Route::get('banner/delete/{id}',[BannerController::class,'delete']);
    Route::post('banner/edit/{id}',[BannerController::class,'edit']);

    //absensi
    Route::get('absensi',[AbsensiController::class,'show']);

    //laporanKehadiran
    Route::get('report/kehadiran',[LaporanController::class,'show']);
    Route::get('report/kehadiran/action',[LaporanController::class,'actionKehadiran']);


    //laporanKegiatan
    Route::get('report/kegiatan',[LaporanController::class,'showKegiatan']);
    Route::get('report/kegiatan/action',[LaporanController::class,'actionKegiatan']);

    //tokenMasuk
    Route::get('token/tokenMasuk',[TokenController::class,'showToken']);
    Route::post('/save-token-masuk', [TokenController::class, 'saveToken']);

    //tokenKeluar
    Route::get('token/tokenKeluar',[TokenKeluarController::class,'showToken']);
    Route::post('/save-token', [TokenKeluarController::class, 'saveToken']);


});
