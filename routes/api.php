<?php

use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\FormulirController;
use App\Http\Controllers\Api\KegiatanController;
use App\Http\Controllers\Api\KehadiranController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



//UserController
Route::post('/auth/login',[UserController::class,  'login']);
Route::get('/auth/show/{id}',[UserController::class,  'showId']);
Route::post('/auth/edit/{id}',[UserController::class,  'edit']);
Route::get('/auth/logout',[UserController::class,  'logout']);

//BannerController
Route::get('/banner/show',[BannerController::class,  'show']);

//KehadiranController
Route::get('/kehadiran/dashboard/{id}',[KehadiranController::class,  'dashboard']);
Route::get('/kehadiran/show/{id}',[KehadiranController::class,  'show']);
Route::post('/kehadiran/absensi',[KehadiranController::class,  'absensi']);
Route::get('/kehadiran/absensiValidasi',[KehadiranController::class,  'absensiValidasi']);
Route::post('/kehadiran/absensi/pulang',[KehadiranController::class,  'absensiPulang']);

//FormulirController
Route::post('/formulir/add',[FormulirController::class,'add']);
Route::get('/formulir/show/{id_siswa}',[FormulirController::class,'show']);
Route::get('/formulir/validasiAbsen',[FormulirController::class,'validasiAbsen']);

//KegiatanController
Route::get('/kegiatan/show/{id}',[KegiatanController::class,'show']);
Route::get('/kegiatan/showIdKegiatan/{id}',[KegiatanController::class,'showIdKegiatan']);
Route::post('/kegiatan/add',[KegiatanController::class,'add']);
Route::post('/kegiatan/edit/{id}',[KegiatanController::class,'edit']);
Route::get('/kegiatan/delete/{id}',[KegiatanController::class,'delete']);


