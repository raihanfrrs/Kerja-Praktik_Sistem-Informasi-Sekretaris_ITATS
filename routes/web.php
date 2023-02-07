<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;

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

Route::middleware('guest')->group(function () {
    Route::controller(LoginController::class)->group(function(){
        Route::get('login', 'index')->name('login');
        Route::post('login/proses', 'proses');
    });

    Route::controller(RegisterController::class)->group(function(){
        Route::get('register', 'index');
        Route::post('register', 'store');
    });
});

Route::middleware('auth')->group(function () {
    Route::controller(LogoutController::class)->group(function () {
        Route::get('logout', 'index');
    });

    Route::controller(LayoutController::class)->group(function () {
        Route::get('/', 'index');
    });

    Route::controller(ProfileController::class)->group(function(){
        Route::get('profile', 'index');
        Route::put('mahasiswa/profile/{mahasiswa}', 'update');
        Route::put('dosen/profile/{dosen}', 'update');
        Route::put('superadmin/profile/{superadmin}', 'update');
        Route::put('password', 'updatePassword');
    });

    Route::group(['middleware' => ['cekUserLogin:mahasiswa']], function(){
    });

    Route::group(['middleware' => ['cekUserLogin:dosen']], function(){
        
    });

    Route::group(['middleware' => ['cekUserLogin:superadmin']], function(){
        Route::controller(MasterController::class)->group(function () {
            Route::get('mahasiswa', 'mahasiswa_index');
            Route::get('dosen', 'dosen_index');
            Route::get('surat', 'surat_index');
        });
    });
});