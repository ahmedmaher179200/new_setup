<?php


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
date_default_timezone_set('Africa/cairo');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

        Route::group(['prefix' => 'dashboard'], function(){
            Route::get('/login', 'App\Http\Controllers\dashboard\authentication@loginView')->name('adminlogin')->middleware('guest:admin');
            Route::post('/login', 'App\Http\Controllers\dashboard\authentication@login')->middleware('guest:admin');
        
            Route::group(['middleware' => 'auth:admin'], function () {
                Route::get('/', 'App\Http\Controllers\dashboard\home@index');
                Route::get('/logout', 'App\Http\Controllers\dashboard\authentication@logout');
        
                Route::group(['prefix' => 'admins'],function(){
                    Route::get('/', 'App\Http\Controllers\dashboard\admins@index');
                    Route::get('/delete/{id}', 'App\Http\Controllers\dashboard\admins@delete');
                    Route::get('/create', 'App\Http\Controllers\dashboard\admins@createView');
                    Route::post('/create', 'App\Http\Controllers\dashboard\admins@create');
                    Route::get('/edit/{id}', 'App\Http\Controllers\dashboard\admins@editView');
                    Route::post('/edit/{id}', 'App\Http\Controllers\dashboard\admins@edit');
                });
            
                Route::group(['prefix' => 'roles'],function(){
                    Route::get('/', 'App\Http\Controllers\dashboard\roles@index');
                    Route::get('/delete/{id}', 'App\Http\Controllers\dashboard\roles@delete');
                    Route::get('/create', 'App\Http\Controllers\dashboard\roles@createView');
                    Route::post('/create', 'App\Http\Controllers\dashboard\roles@create');
                    Route::get('/edit/{id}', 'App\Http\Controllers\dashboard\roles@editView');
                    Route::post('/edit/{id}', 'App\Http\Controllers\dashboard\roles@edit');
                });
        
            });
        });
});