<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RtController;
use App\Http\Controllers\RwController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IuranController;
use App\Http\Controllers\JenazahController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PemakamanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\BlokPemakamanController;
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
//LOGIN AUTH
Route::middleware('guest')->group(function () {
    Route::get('', [AuthController::class, 'login']);
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'authenticate']);
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'store'])->name('signup');
});
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth.user')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard.index');
    Route::get('', [DashboardController::class, 'dashboard']);

    // Role
    Route::get('role/getRole', [RoleController::class, 'getRole'])->name('role.getRole');

    Route::prefix('user')->group(function() {
        // Profile
        Route::get('profile', [UserProfileController::class, 'index']);
        Route::get('profile/edit', [UserProfileController::class, 'edit']);
        Route::post('profile/photo', [UserProfileController::class, 'updateAvatar'])->name('user.profile.updateAvatar');
        Route::put('profile/edit', [UserProfileController::class, 'update'])->name('user.profile.update');
        Route::delete('profile/photo/{id}', [UserProfileController::class, 'deleteAvatar']);
        Route::get('profile/password', [UserProfileController::class, 'password']);
        Route::post('profile/password', [UserProfileController::class, 'updatePassword']);
        Route::post('profile/email', [UserProfileController::class, 'updateEmail']);

    });

    Route::prefix('user-account')->group(function() {
        Route::get('print', [UserController::class, 'print'])->name('user.print');
        Route::get('changeStatus', [UserController::class, 'changeStatus'])->name('changeStatusUser');
        Route::get('data', [UserController::class, 'data'])->name('userAccount.dataTable');
        Route::get('', [UserController::class, 'index'])->name('userAccount.index');
        Route::post('', [UserController::class, 'store'])->name('userAccount.store');
        Route::get('/{admin}', [UserController::class, 'show']);
        Route::post('/{admin}', [UserController::class, 'update']);
        Route::delete('/{admin}', [UserController::class, 'destroy']);
        Route::post('changePassword/{admin}', [UserController::class, 'changePassword']);
    });

    Route::prefix('master-data')->group(function() {
        // RW
        Route::get('rw/getRw', [RwController::class, 'getRw'])->name('rw.getRw');
        Route::get('rw/data', [RwController::class, 'data'])->name('rw.dataTable');
        Route::get('rw', [RwController::class, 'index']);
        Route::post('rw', [RwController::class, 'store']);
        Route::get('rw/{rw}', [RwController::class, 'show']);
        Route::put('rw/{rw}', [RwController::class, 'update']);
        Route::delete('rw/{rw}', [RwController::class, 'destroy']);

        // RT
        Route::get('rt/getRw', [RtController::class, 'getRt'])->name('rt.getRt');
        Route::get('rt/data', [RtController::class, 'data'])->name('rt.dataTable');
        Route::get('rt', [RtController::class, 'index']);
        Route::post('rt', [RtController::class, 'store']);
        Route::get('rt/{rt}', [RtController::class, 'show']);
        Route::put('rt/{rt}', [RtController::class, 'update']);
        Route::delete('rt/{rt}', [RtController::class, 'destroy']);

        // Blok
        Route::get('blok/data', [BlokPemakamanController::class, 'data'])->name('blok.dataTable');
        Route::get('blok', [BlokPemakamanController::class, 'index']);
        Route::post('blok', [BlokPemakamanController::class, 'store']);
        Route::get('blok/{blok}', [BlokPemakamanController::class, 'show']);
        Route::put('blok/{blok}', [BlokPemakamanController::class, 'update']);
        Route::delete('blok/{blok}', [BlokPemakamanController::class, 'destroy']);
    });

    // Jenazah
    Route::get('jenazah/data', [JenazahController::class, 'data'])->name('jenazah.dataTable');
    Route::get('jenazah/get_data', [JenazahController::class, 'getJenazah'])->name('jenazah.getJenazah');
    Route::resource('jenazah', JenazahController::class);

     //Iuran & Pembayaran
     Route::prefix('iuran')->group(function(){

        //Iuran
        Route::controller(IuranController::class)->group(function(){
            Route::get('/', 'index')->name('iuran.index');
            Route::get('create', 'create')->name('iuran.create');
            Route::post('create', 'store')->name('iuran.store');
            Route::get('data', 'data')->name('iuran.dataTable');
            Route::get('detail/{iuran}', 'show')->name('iuran.detail');
            Route::delete('{iuran}', 'destroy')->name('iuran.destroy');
            Route::get('/cronjob_manually', 'runCronJob')->name('iuran.cronjob_manually');
        });

        //Pembayaran
        Route::controller(PembayaranController::class)->group(function(){
            Route::get('get_data', 'getData')->name('pembayaran.dataTable');
            Route::get('data_pembayaran', 'index')->name('pembayaran.index');
            Route::post('pembayaran', 'store')->name('pembayaran.store');
            Route::post('pembayaran/confirm', 'confirmPayment')->name('pembayaran.confirm');
        });
    });

     //Pemakaman
     Route::controller(PemakamanController::class)->group(function(){
        Route::get('makam/get_data', 'data')->name('makam.dataTable');
        Route::get('makam', 'index')->name('makam.index');
        Route::get('makam/create', 'create')->name('makam.create');
        Route::post('makam/create', 'store')->name('makam.store');
        Route::get('makam/edit/{id}', 'edit')->name('makam.edit');
        Route::put('makam/edit/{id}', 'update')->name('makam.update');
        Route::delete('makam/{id}', 'destroy')->name('makam.destroy');
    });

    // Laporan
    Route::get('laporan/iuran-bulanan', [LaporanController::class, 'iuran_bulanan'])->name('laporan.iuran_bulanan');
    Route::get('laporan/biaya-pemakaman', [LaporanController::class, 'biaya_pemakaman'])->name('laporan.biaya_pemakaman');
});
