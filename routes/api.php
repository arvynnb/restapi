<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::delete('/v1/cars', 'CarsController@destroy');
// Route::resource('/v1/cars', 'CarsController');
Route::get('/cars', 'Api\CarsController@index');
Route::post('/cars','Api\CarsController@create');
Route::put('/cars/{id}','Api\CarsController@update');
Route::delete('/cars/{id}','Api\CarsController@delete');
