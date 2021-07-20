<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
    Route::prefix('movies')->group(function () { 
        Route::post('get', 'App\Http\Controllers\MovieController@getAllMovies');        

        Route::middleware('api')->group(function () {
            Route::post('single', 'App\Http\Controllers\MovieController@getSingleMovie');
            Route::get('categories', 'App\Http\Controllers\MovieController@getMovieCategories');
        });
    });

    Route::prefix('auth')->group(function () {
        Route::post('register', 'App\Http\Controllers\AuthController@register');
        Route::post('login', 'App\Http\Controllers\AuthController@login')->name('login');
      
        Route::middleware('api')->group(function () {
            Route::post('logout', 'App\Http\Controllers\AuthController@logout');
            
        });
    });

});
