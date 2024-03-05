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
    route::get('dashboard',[DashboardController::class,'show']);

    //industri
    route::get('industri',[IndustriController::class,'show']);
    route::post('industri/create',[IndustriController::class,'create']);
    route::get('industri/delete/{id}',[IndustriController::class,'delete']);
    route::post('industri/edit/{id}',[IndustriController::class,'edit']);

    //industri
    route::get('monitoring',[MonitoringController::class,'show']);
    route::post('monitoring/create',[MonitoringController::class,'create']);
    route::get('monitoring/delete/{id}',[MonitoringController::class,'delete']);
    route::post('monitoring/edit/{id}',[MonitoringController::class,'edit']);

    //kelas
    route::get('kelas',[KelasController::class,'show']);
    route::post('kelas/create',[KelasController::class,'create']);
    route::get('kelas/delete/{id}',[KelasController::class,'delete']);
    route::post('kelas/edit/{id}',[KelasController::class,'edit']);

    //administrator
    route::get('users/administrator',[AdministratorController::class,'show']);
    route::post('users/administrator/create',[AdministratorController::class,'create']);
    route::get('users/administrator/delete/{id}',[AdministratorController::class,'delete']);
    route::post('users/administrator/edit/{id}',[AdministratorController::class,'edit']);

    //siswa
    route::get('users/siswa',[SiswaController::class,'show']);
    route::post('users/siswa/create',[SiswaController::class,'create']);
    route::get('users/siswa/delete/{id}',[SiswaController::class,'delete']);
    route::post('users/siswa/edit/{id}',[SiswaController::class,'edit']);
    Route::get('/getSiswa/{id_kelas}', [SiswaController::class, 'getSiswa']);

    //pemonitoring
    route::get('users/pemonitoring',[PemonitoringController::class,'show']);
    route::post('users/pemonitoring/create',[PemonitoringController::class,'create']);
    route::get('users/pemonitoring/delete/{id}',[PemonitoringController::class,'delete']);
    route::post('users/pemonitoring/edit/{id}',[PemonitoringController::class,'edit']);

    //Banner
    route::get('banner',[BannerController::class,'show']);
    route::post('banner/create',[BannerController::class,'create']);
    route::get('banner/delete/{id}',[BannerController::class,'delete']);
    route::post('banner/edit/{id}',[BannerController::class,'edit']);

    //absensi
    route::get('absensi',[AbsensiController::class,'show']);

    //laporanKehadiran
    route::get('report/kehadiran',[LaporanController::class,'show']);
    route::get('report/kehadiran/action',[LaporanController::class,'actionKehadiran']);


    //laporanKegiatan
    route::get('report/kegiatan',[LaporanController::class,'showKegiatan']);
    route::get('report/kegiatan/action',[LaporanController::class,'actionKegiatan']);
});
