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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('login', 'AuthController@index')->name('login');
Route::post('proses_login', 'AuthController@proses_login')->name('proses_login');
Route::get('logout', 'AuthController@logout')->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/' , 'DashboardController@index')->name('dashboard');

    Route::prefix('order')->group(function() {

        Route::get('/', 'orderController@index')->name('order');
        Route::get('create', 'orderController@create')->name('order.create');
        Route::post('store', 'orderController@store')->name('order.store');
        Route::get('edit/{id}', 'orderController@edit')->name('order.edit');
        Route::post('update/{id}', 'orderController@update')->name('order.update');
        Route::get('delete/{id}', 'orderController@destroy')->name('order.delete');
        Route::get('datatables', 'orderController@datatables')->name('order.datatables');

        Route::post('addProduct', 'orderController@addProduct')->name('order.addproduct');
        Route::get('deleteDetail/{id}', 'orderController@destroyDetail')->name('order.deleteDetail');

    
    });

    Route::prefix('product')->group(function() {

        Route::get('/', 'ProductController@index')->name('product');
        Route::get('/getData/{id}', 'ProductController@getAll')->name('product.getAll');
        Route::get('create', 'ProductController@create')->name('product.create');
        Route::post('store', 'ProductController@store')->name('product.store');
        Route::get('edit/{id}', 'ProductController@edit')->name('product.edit');
        Route::post('update/{id}', 'ProductController@update')->name('product.update');
        Route::get('delete/{id}', 'ProductController@destroy')->name('product.destroy');

    });


});


