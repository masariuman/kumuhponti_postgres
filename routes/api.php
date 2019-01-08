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

Route::get('/cari-user/{id}', 'userController@CariUser');
Route::get('/semua-data/', 'dataController@SemuaData');
Route::get('/cari-data/{id}', 'dataController@CariData');
Route::get('/cari-daerah/{id}', 'daerahcontroller@caridaerah');
Route::get('/load-layer', 'frontweb@loadlayer');

Route::get('/cari-kumuh/{id}', 'JalingController@carikumuh');

Route::get('/cari-history/{id}', 'JalingController@carihistory');

Route::get('/cari-status/{id}', 'tampilanController@Caristatus');
