<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserProfileController;

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
        Route::get('changeStatus', [UserController::class, 'changeStatus'])->name('changeStatusUser');
        Route::get('data', [UserController::class, 'data'])->name('userAccount.dataTable');
        Route::get('', [UserController::class, 'index'])->name('userAccount.index');
        Route::post('', [UserController::class, 'store'])->name('userAccount.store');
        Route::get('/{admin}', [UserController::class, 'show']);
        Route::post('/{admin}', [UserController::class, 'update']);
        Route::delete('/{admin}', [UserController::class, 'destroy']);
        Route::post('changePassword/{admin}', [UserController::class, 'changePassword']);
    });
});
