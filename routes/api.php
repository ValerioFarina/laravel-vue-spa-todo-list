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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->prefix('item')->group(function() {
    Route::get('index', 'ItemController@index');
    Route::post('store', 'ItemController@store');
    Route::put('edit/{itemId}', 'ItemController@edit');
    Route::put('update/{itemId}', 'ItemController@update');
    Route::delete('destroy/{itemId}', 'ItemController@destroy');
});


