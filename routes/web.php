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

Auth::routes();

Route::get('/home', 'CarsController@index');
Route::get('/home/data', 'CarsController@getData');
Route::post('home/addcar','CarsController@store');
Route::post('home/update','CarsController@update');
Route::post('home/delete','CarsController@destroy');
// Route::get('/home', 'HomeController@index')->name('home');
