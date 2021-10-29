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






Route::group([

    'middleware' => 'api',
    'prefix' => 'auth',
    'namespace' => 'Api',

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});



Route::group(['namespace' => 'Api', 'middleware' => 'guest:api',], function () {

    Route::get('branch', 'BranchController@index');

    Route::get('room/{id}', 'RoomController@show');

    Route::get('room', 'RoomController@index');

    Route::resource('reservation', 'ReservationController');
});
