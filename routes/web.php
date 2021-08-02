<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/lazy-loading', function(){
    return view('lazyloading.loading_img');
});
Route::prefix('product')
->as('product.')
->group(function () {
    Route::get('search', 'App\Http\Controllers\ProductController@search')->name('search');
});
Route::get('/search/api/vehicle', 'App\Http\Controllers\ProductController@vehicleApi');
Route::get('/search/api/model', 'App\Http\Controllers\ProductController@modelApi');


