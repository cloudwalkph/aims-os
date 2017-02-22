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

    // Job Orders
    Route::group(['prefix' => 'job-orders'], function() {
        Route::get('/', 'JobOrdersController@index');
        Route::get('/{jobOrderId}', 'JobOrdersController@show');
        Route::post('/', 'JobOrdersController@store');
        Route::put('/{jobOrderId}', 'JobOrdersController@update');
        Route::delete('/{jobOrderId}', 'JobOrdersController@delete');

        // job orders event details
        Route::get('/{jobOrderNo}/job-order-details', 'JODetails\JobOrdersEventDetailsController@getActive');
        Route::post('/{jobOrderNo}/job-order-details', 'JODetails\JobOrdersEventDetailsController@store');

        // job orders animation details
        Route::get('/{jobOrderNo}/job-order-animations', 'JODetails\JobOrdersAnimationDetailsController@getActive');
        Route::post('/{jobOrderNo}/job-order-animations', 'JODetails\JobOrdersAnimationDetailsController@store');

        // job orders departments involved
        Route::get('/{jobOrderNo}/job-order-departments', 'JODetails\JobOrdersDepartmentInvolvedController@getActive');
        Route::post('/{jobOrderNo}/job-order-departments', 'JODetails\JobOrdersDepartmentInvolvedController@store');

        // job orders manpower request
        Route::get('/{jobOrderNo}/job-order-manpowers', 'JODetails\JobOrdersManpowerRequestController@getActive');
        Route::post('/{jobOrderNo}/job-order-manpowers', 'JODetails\JobOrdersManpowerRequestController@store');

        // job orders meal request
        Route::get('/{jobOrderNo}/job-order-meals', 'JODetails\JobOrdersMealRequestController@getActive');
        Route::post('/{jobOrderNo}/job-order-meals', 'JODetails\JobOrdersMealRequestController@store');

        // job orders vehicle request
        Route::get('/{jobOrderNo}/job-order-vehicles', 'JODetails\JobOrdersVehicleRequestController@getActive');
        Route::post('/{jobOrderNo}/job-order-vehicles', 'JODetails\JobOrdersVehicleRequestController@storeByJoId');

    });

    // Project Types
    Route::group(['prefix' => 'project-types'], function() {
        Route::get('/', 'ProjectTypesController@index');
    });
});