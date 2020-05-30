<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::post('products/list', 'ProductController@list')->name('products.list');
Route::delete('productsDestroySelected', 'ProductController@destroySelected')->name('products.destroySelected');
Route::resource('products', 'ProductController');