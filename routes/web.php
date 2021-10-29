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
Route::get('/' , 'DashboardController@index')->name('dashboard');


Route::prefix('order')->group(function() {

    Route::get('/', 'orderController@index')->name('order');
    Route::get('create', 'orderController@create')->name('order.create');
    Route::post('store', 'orderController@store')->name('order.store');
    Route::get('edit/{id}', 'orderController@edit')->name('order.edit');
    Route::post('update/{id}', 'orderController@update')->name('order.update');
    Route::get('delete/{id}', 'orderController@destroy')->name('order.delete');
    Route::get('datatables', 'orderController@datatables')->name('order.datatables');

});
