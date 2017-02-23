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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1', 'namespace' => 'API'], function() {

    // users
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'UsersController@all');
        Route::post('/', 'UsersController@store');
        Route::post('/change-password', 'UsersController@changePassword');
    });

    // Events API
    Route::group(['prefix' => 'events'], function() {
        Route::get('/', 'EventsController@index');
        Route::post('/', 'EventsController@store');
        Route::put('/{eventId}', 'EventsController@update');
        Route::delete('/{eventId}', 'EventsController@delete');
    });

    // Clients
    Route::group(['prefix' => 'clients'], function() {
        Route::get('/', 'ClientsController@index');
        Route::get('/{clientId}', 'ClientsController@show');
        Route::post('/', 'ClientsController@store');
        Route::put('/{clientId}', 'ClientsController@update');
        Route::delete('/{clientId}', 'ClientsController@delete');
    });

    // Clients
    Route::group(['prefix' => 'creatives/ongoing'], function() {
        Route::get('/', 'CreativesOngoingController@index');
        Route::get('/{joId}', 'CreativesOngoingController@show');
        Route::post('/', 'CreativesOngoingController@store');
        Route::put('/{joId}', 'CreativesOngoingController@update');
        Route::delete('/{joId}', 'CreativesOngoingController@delete');
    });

    // Job Orders
    Route::group(['prefix' => 'job-orders'], function() {
        Route::get('/all', 'JobOrdersController@all');
        Route::get('/', 'JobOrdersController@index');
        Route::get('/{jobOrderId}', 'JobOrdersController@show');
        Route::post('/', 'JobOrdersController@store');
        Route::put('/{jobOrderId}', 'JobOrdersController@update');
        Route::delete('/{jobOrderId}', 'JobOrdersController@delete');

    });

    // Project Types
    Route::group(['prefix' => 'project-types'], function() {
        Route::get('/', 'ProjectTypesController@index');
    });
});