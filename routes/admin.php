<?php

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
            Route::get('/login', 'App\Http\Controllers\Dashboard\AuthenticationController@loginView')->name('adminlogin')->middleware('guest:user');
            Route::post('/login', 'App\Http\Controllers\Dashboard\AuthenticationController@login')->middleware('guest:user');
        
            Route::group(['middleware' => 'auth:user'], function () {
                Route::get('/', 'App\Http\Controllers\Dashboard\HomeController@index');
                Route::get('/logout', 'App\Http\Controllers\Dashboard\AuthenticationController@logout');
        
                Route::group(['prefix' => 'users'],function(){
                    Route::get('/', 'App\Http\Controllers\Dashboard\UserController@index');
                    Route::get('/delete/{id}', 'App\Http\Controllers\Dashboard\UserController@delete');
                    Route::get('/create', 'App\Http\Controllers\Dashboard\UserController@create');
                    Route::post('/create', 'App\Http\Controllers\Dashboard\UserController@store');
                    Route::get('/edit/{id}', 'App\Http\Controllers\Dashboard\UserController@edit');
                    Route::post('/edit/{id}', 'App\Http\Controllers\Dashboard\UserController@update');
                    Route::get('/destroy/{id}', 'App\Http\Controllers\Dashboard\UserController@destroy');
                });
            
                Route::group(['prefix' => 'roles'],function(){
                    Route::get('/', 'App\Http\Controllers\Dashboard\RoleController@index');
                    Route::get('/delete/{id}', 'App\Http\Controllers\Dashboard\RoleController@delete');
                    Route::get('/create', 'App\Http\Controllers\Dashboard\RoleController@create');
                    Route::post('/create', 'App\Http\Controllers\Dashboard\RoleController@store');
                    Route::get('/edit/{id}', 'App\Http\Controllers\Dashboard\RoleController@edit');
                    Route::post('/edit/{id}', 'App\Http\Controllers\Dashboard\RoleController@update');
                    Route::get('/destroy/{id}', 'App\Http\Controllers\Dashboard\RoleController@destroy');
                });

                Route::group(['prefix' => 'settings'],function(){
                    Route::get('/edit', 'App\Http\Controllers\Dashboard\SettingController@edit');
                    Route::post('/edit', 'App\Http\Controllers\Dashboard\SettingController@update');
                });

                Route::get('/profile', 'App\Http\Controllers\Dashboard\ProfileController@edit');
                Route::post('/profile', 'App\Http\Controllers\Dashboard\ProfileController@update');
                Route::post('/update_image', 'App\Http\Controllers\Dashboard\ProfileController@update_image')->name('admin.upload.image');
            });
        });
});