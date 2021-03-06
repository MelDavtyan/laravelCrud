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

use App\Category;
use App\Products;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('products','ProductsController');
Route::resource('category','CategoryController');

Route::get('/deleteImage/{products}/{image}','ProductsController@deleteImage')->name('deleteImage');
