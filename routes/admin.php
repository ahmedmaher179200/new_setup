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
            Route::get('/login', 'App\Http\Controllers\dashboard\authentication@loginView')->name('adminlogin')->middleware('guest:user');
            Route::post('/login', 'App\Http\Controllers\dashboard\authentication@login')->middleware('guest:user');
        
            Route::group(['middleware' => 'auth:user'], function () {
                Route::get('/', 'App\Http\Controllers\dashboard\home@index');
                Route::get('/logout', 'App\Http\Controllers\dashboard\authentication@logout');
        
                Route::group(['prefix' => 'users'],function(){
                    Route::get('/', 'App\Http\Controllers\dashboard\users@index');
                    Route::get('/delete/{id}', 'App\Http\Controllers\dashboard\users@delete');
                    Route::get('/create', 'App\Http\Controllers\dashboard\users@create');
                    Route::post('/create', 'App\Http\Controllers\dashboard\users@store');
                    Route::get('/edit/{id}', 'App\Http\Controllers\dashboard\users@edit');
                    Route::post('/edit/{id}', 'App\Http\Controllers\dashboard\users@update');
                    Route::get('/destroy/{id}', 'App\Http\Controllers\dashboard\users@destroy');
                });
            
                Route::group(['prefix' => 'roles'],function(){
                    Route::get('/', 'App\Http\Controllers\dashboard\roles@index');
                    Route::get('/delete/{id}', 'App\Http\Controllers\dashboard\roles@delete');
                    Route::get('/create', 'App\Http\Controllers\dashboard\roles@create');
                    Route::post('/create', 'App\Http\Controllers\dashboard\roles@store');
                    Route::get('/edit/{id}', 'App\Http\Controllers\dashboard\roles@edit');
                    Route::post('/edit/{id}', 'App\Http\Controllers\dashboard\roles@update');
                    Route::get('/destroy/{id}', 'App\Http\Controllers\dashboard\roles@destroy');
                });
            });
        });
});