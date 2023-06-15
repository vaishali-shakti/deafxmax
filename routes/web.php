<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\LoginController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\ConsultantController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\MembersController;

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
    return view('welcome');
});
Route::group(['prefix' => 'admin'], function(){
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('forgot-password', [HomeController::class, 'forgot_password'])->name('forgot_password');

    Route::post('login_submit', [LoginController::class, 'login_submit'])->name('login_submit');

    Route::group(['middleware' => ['auth']], function(){
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('profile-edit', [DashboardController::class, 'profile_edit'])->name('profile_edit');
        Route::post('profile-update/{id}', [DashboardController::class, 'profile_update'])->name('profile_update');
        Route::get('change-password', [DashboardController::class, 'change_password'])->name('change_password');
        Route::post('change-password-post', [DashboardController::class, 'change_password_post'])->name('change_password_post');
        Route::get('current_auth_password', [DashboardController::class, 'current_auth_password'])->name('current_auth_password');

        Route::resource('consultant',ConsultantController::class);
        Route::get('unique_user_email', [ConsultantController::class, 'unique_user_email'])->name('unique_user_email');
        Route::get('consultant_status_change', [ConsultantController::class,'consultant_status_change'])->name('consultant_status_change');

        Route::resource('setting',SettingController::class);
        Route::get('setting_unique_name',[SettingController::class,"setting_unique_name"])->name('setting_unique_name');
        Route::get('setting_unique_name_update',[SettingController::class,"setting_unique_name_update"])->name('setting_unique_name_update');

        Route::resource('members',MembersController::class);



    });
});
