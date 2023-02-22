<?php

use App\Http\Controllers\ArchiveController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecycleController;
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
        Route::put('password', 'updatePassword');
    });

    Route::group(['middleware' => ['cekUserLogin:mahasiswa']], function(){
        
    });

    Route::group(['middleware' => ['cekUserLogin:dosen']], function(){
        
    });

    Route::group(['middleware' => ['cekUserLogin:superadmin']], function(){
        Route::controller(MasterController::class)->group(function () {
            /* mahasiswa master resource */
            Route::get('mahasiswa', 'mahasiswa_index');
            Route::get('mahasiswa/add', 'mahasiswa_create');
            Route::post('mahasiswa', 'mahasiswa_store');
            Route::get('mahasiswa/{mahasiswa}', 'mahasiswa_show');
            Route::get('mahasiswa/{mahasiswa}/edit', 'mahasiswa_edit');
            Route::put('mahasiswa/{mahasiswa}', 'mahasiswa_update');
            Route::delete('mahasiswa/{mahasiswa}', 'mahasiswa_destroy');

            /* dosen master resource */
            Route::get('dosen', 'dosen_index');
            Route::get('dosen/add', 'dosen_create');
            Route::post('dosen', 'dosen_store');
            Route::get('dosen/{dosen}', 'dosen_show');
            Route::get('dosen/{dosen}/edit', 'dosen_edit');
            Route::put('dosen/{dosen}', 'dosen_update');
            Route::delete('dosen/{dosen}', 'dosen_destroy');

            /* surat master resource */
            Route::get('surat', 'surat_index');
            Route::get('surat/add', 'surat_create');
            Route::post('surat', 'surat_store');
            Route::get('surat/{surat}', 'surat_show');
            Route::get('surat/{surat}/edit', 'surat_edit');
            Route::put('surat/{surat}', 'surat_update');
            Route::delete('surat/{surat}', 'surat_destroy');

            /* role master resource */
            Route::get('role', 'role_index');
            Route::get('role/add', 'role_create');
            Route::post('role', 'role_store');
            Route::get('role/{role}', 'role_show');
            Route::get('role/{role}/edit', 'role_edit');
            Route::put('role/{role}', 'role_update');
            Route::delete('role/{role}', 'role_destroy');

            Route::get('/dataMahasiswa', [MasterController::class, 'dataMahasiswa'])->name('dataMahasiswa');
            Route::get('/dataDosen', [MasterController::class, 'dataDosen'])->name('dataDosen');
            Route::get('/dataJenisSurat', [MasterController::class, 'dataSurat'])->name('dataJenisSurat');
            Route::get('/dataRole', [MasterController::class, 'dataRole'])->name('dataRole');
        });

        Route::controller(RecycleController::class)->group(function () {
            Route::get('recycle', 'index');
            Route::delete('recycle/{slug}', 'destroy');
            Route::put('recycle/{slug}', 'update');
        });
    });
});