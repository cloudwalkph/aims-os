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
        Route::get('/', 'UsersController@index');
        Route::get('/{departmentId}', 'UsersController@getByDepartment');
        Route::post('/', 'UsersController@store');
        Route::delete('/{userId}', 'UsersController@delete');
    });

    // Events API
    Route::group(['prefix' => 'events'], function() {
        Route::get('/all', 'EventsController@all');
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
    Route::group(['prefix' => 'creatives'], function() {
        Route::get('/', 'CreativesOngoingController@index');
        Route::get('/{joId}', 'CreativesOngoingController@show');
        Route::post('/', 'CreativesOngoingController@store');
        Route::put('/{joId}', 'CreativesOngoingController@update');
        Route::delete('/{joId}', 'CreativesOngoingController@delete');
    });

    // Job Orders
    Route::group(['prefix' => 'job-orders'], function() {
        Route::get('/all', 'JobOrdersController@all');
        Route::get('/department', 'JobOrdersController@getByDepartmentInvolvement');
        Route::get('/', 'JobOrdersController@index');
        Route::get('/{jobOrderId}', 'JobOrdersController@show');
        Route::post('/', 'JobOrdersController@store');
        Route::put('/{jobOrderId}', 'JobOrdersController@update');
        Route::delete('/{jobOrderId}', 'JobOrdersController@delete');

    });

    // manpower requests
    Route::group(['prefix' => 'job-order-manpowers'], function() {
        Route::get('/', 'ManpowerRequestsController@index');
        Route::post('/', 'ManpowerRequestsController@store');
        Route::delete('/{manpowerId}', 'ManpowerRequestsController@delete');
    });

    // meal requests
    Route::group(['prefix' => 'job-order-meals'], function() {
        Route::get('/', 'MealRequestsController@index');
        Route::post('/', 'MealRequestsController@store');
        Route::delete('/{mealId}', 'MealRequestsController@delete');
    });

    // vehicle requests
    Route::group(['prefix' => 'job-order-vehicles'], function() {
        Route::get('/', 'VehicleRequestsController@index');
        Route::post('/', 'VehicleRequestsController@store');
        Route::delete('/{vehicleId}', 'VehicleRequestsController@delete');
    });

    // department involvement
    Route::group(['prefix' => 'job-order-department-involvements'], function() {
        Route::get('/', 'DepartmentInvolvementController@index');
        Route::post('/', 'DepartmentInvolvementController@store');
        Route::delete('/{Id}', 'DepartmentInvolvementController@delete');
    });

    // animation details
    Route::group(['prefix' => 'job-order-animation-details'], function() {
        Route::get('/', 'AnimationDetailsController@index');
        Route::post('/', 'AnimationDetailsController@store');
        Route::delete('/{Id}', 'AnimationDetailsController@delete');
    });

    // Venues
    Route::group(['prefix' => 'venues'], function() {
        Route::get('/all', 'VenuesController@all');
        Route::get('/', 'VenuesController@index');
        Route::get('/{venueId}', 'VenuesController@show');
        Route::post('/', 'VenuesController@store');
        Route::put('/{venueId}', 'VenuesController@update');
        Route::delete('/{venueId}', 'VenuesController@delete');
    });

    // Project Types
    Route::group(['prefix' => 'project-types'], function() {
        Route::get('/', 'ProjectTypesController@index');
    });

    // Meal Types
    Route::group(['prefix' => 'meal-types'], function() {
        Route::get('/', 'MealTypesController@index');
    });

    // vehicle Types
    Route::group(['prefix' => 'vehicle-types'], function() {
        Route::get('/', 'VehicleTypesController@index');
    });

    // User roles
    Route::group(['prefix' => 'roles'], function() {
        Route::get('/', 'RolesController@index');
    });

    // departments
    Route::group(['prefix' => 'departments'], function() {
        Route::get('/', 'DepartmentsController@index');
    });

    // agency
    Route::group(['prefix' => 'agencies'], function() {
        Route::get('/', 'AgenciesController@index');
        Route::post('/', 'AgenciesController@store');
        Route::delete('/{agencyId}', 'AgenciesController@delete');
    });

    // manpower types
    Route::group(['prefix' => 'manpower-types'], function() {
        Route::get('/all', 'ManpowerTypesController@index');
        Route::get('/', 'ManpowerTypesController@index');
        Route::post('/', 'ManpowerTypesController@store');
        Route::delete('/{typeId}', 'ManpowerTypesController@delete');
    });

    Route::group(['prefix' => 'hr'], function() {
        Route::get('/manpower', 'ManpowerController@index');
        Route::post('/manpower', 'ManpowerController@store');
        Route::delete('/manpower/{manpowerId}', 'ManpowerController@delete');
        Route::post('/manpower/{manpowerId}', 'ManpowerController@update');
    });
});