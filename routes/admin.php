<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\AuthenticationController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\UserController;
use App\Models\Setting;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


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
// date_default_timezone_set(Setting::first()->time_zone);

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

        Route::group(['prefix' => 'dashboard'], function(){
            Route::get('/login', [AuthenticationController::class, 'loginView'])->name('adminlogin')->middleware('guest:user');
            Route::post('/login', [AuthenticationController::class, 'login'])->middleware('guest:user');

            Route::post('/summernote_upload_image', [Controller::class, 'summernote_upload_image'])->name('summernote_upload_image');
        
            Route::group(['middleware' => 'auth:user'], function () {
                Route::get('/', [HomeController::class, 'index']);
                Route::get('/logout', [AuthenticationController::class, 'logout']);
        
                Route::group(['prefix' => 'users'],function(){
                    Route::get('/', [UserController::class, 'index']);
                    Route::get('/create', [UserController::class, 'create']);
                    Route::post('/create', [UserController::class, 'store']);
                    Route::get('{id}/edit', [UserController::class, 'edit']);
                    Route::post('{id}/edit', [UserController::class, 'update']);
                    Route::get('{id}/destroy', [UserController::class, 'destroy']);
                    Route::get('{id}/activity-logs', [UserController::class, 'activity_logs']);
                });
            
                Route::group(['prefix' => 'roles'],function(){
                    Route::get('/', [RoleController::class, 'index']);
                    Route::get('/create', [RoleController::class, 'create']);
                    Route::post('/create', [RoleController::class, 'store']);
                    Route::get('{id}/edit', [RoleController::class, 'edit']);
                    Route::post('{id}/edit', [RoleController::class, 'update']);
                    Route::get('{id}/destroy', [RoleController::class, 'destroy']);
                });

                Route::group(['prefix' => 'categories'],function(){
                    Route::get('/', [CategoryController::class, 'index']);
                    Route::get('/create', [CategoryController::class, 'create']);
                    Route::post('/create', [CategoryController::class, 'store']);
                    Route::get('{id}/edit', [CategoryController::class, 'edit']);
                    Route::post('{id}/edit', [CategoryController::class, 'update']);
                    Route::get('{id}/destroy', [CategoryController::class, 'destroy']);
                });

                Route::group(['prefix' => 'settings'],function(){
                    Route::get('/edit', [SettingController::class, 'edit']);
                    Route::post('/edit', [SettingController::class, 'update']);
                });

                Route::get('/profile', [ProfileController::class, 'edit']);
                Route::post('/profile', [ProfileController::class, 'update']);
                Route::post('/update_image', [ProfileController::class, 'update_image'])->name('admin.upload.image');
            });
        });
});