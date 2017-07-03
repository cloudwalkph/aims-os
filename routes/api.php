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

// Auth
Route::group(['namespace' => 'API'], function() {
    Route::post('/auth', 'AuthenticationController@auth');
});

Route::group(['prefix' => 'v1', 'namespace' => 'API', 'middleware'  => 'api'], function() {
    // Validate
    Route::group(['prefix' => 'validate', 'namespace' => 'Validate'], function() {
        Route::get('job-orders', 'JobOrdersController@getJobOrders');
        Route::get('questions/{rateeId}/{jobOrderId}/{validateType}', 'QuestionsController@getQuestions');
        Route::get('ratees/{jobOrderId}/{validateType}', 'RateesController@getRatees');
    });

    // Schedules / Calendar
    Route::group(['prefix' => 'events', 'namespace' => 'Departments'], function() {
        Route::get('/all', 'SchedulesController@all');
        Route::get('/', 'SchedulesController@index');
        Route::post('/', 'SchedulesController@store');
        Route::put('/{eventId}', 'SchedulesController@update');
        Route::delete('/{eventId}', 'SchedulesController@delete');
    });

    // AE
    Route::group(['prefix' => 'clients', 'namespace' => 'AE'], function() {
        Route::get('/', 'ClientsController@index');
        Route::get('/{clientId}', 'ClientsController@show');
        Route::post('/', 'ClientsController@store');
        Route::put('/{clientId}', 'ClientsController@update');
        Route::delete('/{clientId}', 'ClientsController@delete');
    });

    // Inventory
    Route::group(['prefix' => 'inventory'], function() {
      Route::post('import', 'InventoryController@import');
        Route::resource('/', 'InventoryController');
        Route::resource('job', 'InventoryJobController');
        Route::resource('user', 'InventoryJobAssignedPersonController');
        Route::resource('delivery', 'InventoryDeliveriesController');
        Route::resource('release', 'InventoryReleasesController');
        Route::get('department', 'InventoryController@getByDepartmentInvolvement');
        Route::get('/{id}', 'InventoryController@show');
    });

    // Creatives
    Route::group(['prefix' => 'creatives', 'namespace' => 'Creatives'], function() {
        Route::get('/', 'CreativesOngoingController@index');
        Route::get('/{joId}', 'CreativesOngoingController@show');
        Route::post('/', 'CreativesOngoingController@store');
        Route::put('/{joId}', 'CreativesOngoingController@update');
        Route::delete('/{joId}', 'CreativesOngoingController@delete');
    });

    // Job Orders
    Route::group(['namespace' => 'JobOrders'], function() {
        // Job Orders
        Route::group(['prefix' => 'job-orders'], function() {
            Route::get('/', 'JobOrdersController@index');
            Route::get('/all', 'JobOrdersController@all');
            Route::get('/calendar', 'JobOrdersController@calendar');
            Route::get('/department', 'JobOrdersController@getByDepartmentInvolvement');
            Route::get('/department/{departmentId}', 'JobOrdersController@getByDepartmentId');
            Route::get('/{jobOrderId}', 'JobOrdersController@show');
            Route::post('/', 'JobOrdersController@store');
            Route::post('/add-ae', 'JobOrdersController@addAe');
            Route::put('/{jobOrderId}', 'JobOrdersController@update');
            Route::delete('/{jobOrderId}', 'JobOrdersController@delete');
            Route::post('/{joId}/mom', 'JobOrdersController@saveJobOrderMOM');
            Route::post('/{joId}/details', 'JobOrdersController@saveEventDetails');

            Route::get('/{joId}/discussions', 'JobOrderDiscussionsController@getDiscussions');
            Route::post('/{joId}/discussions', 'JobOrderDiscussionsController@createDiscussion');

        });

        // manpower requests
        Route::group(['prefix' => 'job-order-manpowers'], function() {
            Route::get('/{Id}', 'ManpowerRequestsController@index');
            Route::post('/', 'ManpowerRequestsController@store');
            Route::delete('/{manpowerId}', 'ManpowerRequestsController@delete');
        });

        // meal requests
        Route::group(['prefix' => 'job-order-meals'], function() {
            Route::get('/{Id}', 'MealRequestsController@index');
            Route::post('/', 'MealRequestsController@store');
            Route::delete('/{mealId}', 'MealRequestsController@delete');
        });

        // vehicle requests
        Route::group(['prefix' => 'job-order-vehicles'], function() {
            Route::get('/{Id}', 'VehicleRequestsController@index');
            Route::post('/', 'VehicleRequestsController@store');
            Route::delete('/{vehicleId}', 'VehicleRequestsController@delete');
        });

        // department involvement
        Route::group(['prefix' => 'job-order-department-involvements'], function() {
            Route::get('/{Id}', 'DepartmentInvolvementController@index');
            Route::post('/', 'DepartmentInvolvementController@store');
            Route::delete('/{Id}', 'DepartmentInvolvementController@delete');
        });

        // ae job order inventory
        Route::group(['prefix' => 'job-order-inventory'], function() {
            Route::get('/all', 'JobOrderProductController@all');
            Route::get('/{Id}', 'JobOrderProductController@index');
            Route::post('/', 'JobOrderProductController@store');
            Route::delete('/{Id}', 'JobOrderProductController@delete');
        });

        // project attachments
        Route::group(['prefix' => 'job-order-project-attachments'], function() {
            Route::get('/{Id}', 'ProjectAttachmentController@index');
            Route::get('/{Id}/download', 'ProjectAttachmentController@download');
            Route::post('/', 'ProjectAttachmentController@store');
            Route::delete('/{Id}', 'ProjectAttachmentController@delete');
        });

        // animation details
        Route::group(['prefix' => 'job-order-animation-details'], function() {
            Route::get('/{Id}', 'AnimationDetailsController@index');
            Route::post('/', 'AnimationDetailsController@store');
            Route::delete('/{Id}', 'AnimationDetailsController@delete');
        });
    });

    // Venues
    Route::group(['prefix' => 'venues', 'namespace' => 'CMTUVA'], function() {
        Route::get('/all', 'VenuesController@all');
        Route::get('/', 'VenuesController@index');
        Route::get('/{venueId}', 'VenuesController@show');
        Route::post('/', 'VenuesController@store');
        Route::put('/{venueId}', 'VenuesController@update');
        Route::delete('/{venueId}', 'VenuesController@delete');

        Route::get('plans/job-order/{jobOrderId}', 'VenuesController@getSelectedVenues');
        Route::post('plans/job-order/{jobOrderId}', 'VenuesController@createSelectedVenues');
    });

    // Admin
    Route::group(['namespace' => 'Admin'], function() {
        // Users
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', 'UsersController@index');
            Route::get('/{departmentId}', 'UsersController@getByDepartment');
            Route::post('/', 'UsersController@store');
            Route::put('/{userId}', 'UsersController@update');
            Route::delete('/{userId}', 'UsersController@delete');
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
            Route::get('/all', 'VehicleTypesController@all');
            Route::get('/', 'VehicleTypesController@index');
            Route::post('/', 'VehicleTypesController@store');
            Route::put('/{typeId}', 'VehicleTypesController@update');
            Route::delete('/{typeId}', 'VehicleTypesController@delete');
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
            Route::put('/{agencyId}', 'AgenciesController@update');
            Route::delete('/{agencyId}', 'AgenciesController@delete');
        });

        // manpower types
        Route::group(['prefix' => 'manpower-types'], function() {
            Route::get('/all', 'ManpowerTypesController@all');
            Route::get('/', 'ManpowerTypesController@index');
            Route::post('/', 'ManpowerTypesController@store');
            Route::put('/{typeId}', 'ManpowerTypesController@update');
            Route::delete('/{typeId}', 'ManpowerTypesController@delete');
        });
    });

    // HR
    Route::group(['prefix' => 'hr'], function() {
        Route::get('/manpower', 'ManpowerController@getManpower');
        Route::get('/manpower/{joNumber}', 'ManpowerController@index');
        Route::post('/manpower', 'ManpowerController@store');
        Route::delete('/manpower/{manpowerId}', 'ManpowerController@delete');
        Route::post('/manpower/{manpowerId}', 'ManpowerController@update');

        // pooling
        Route::get('/poolingManpower', 'PoolingManpowerController@index');
        Route::get('/job-order-manpower/{joNumber}', 'PoolingManpowerController@showJobOrderManpower');
        Route::post('/selected-manpower/{joNumber}','PoolingManpowerController@addSelectedManpower');
        Route::delete('/selected-manpower/{seletedId}/{joId}','PoolingManpowerController@deleteSelectedManpower');
        Route::get('/selected-manpower/{joNumber}','PoolingManpowerController@getSelectedManpower');
        Route::post('/manpower-schedule/{joNumber}','PoolingManpowerController@addManpowerSchedule');
        Route::get('/manpower-schedule/{joNumber}','PoolingManpowerController@getManpowerSchedule');
        Route::delete('/manpower-schedule/{id}','PoolingManpowerController@deteteManpowerSchedule');
        Route::get('/manpower-deployment/{JoNumber}','PoolingManpowerController@manpowerDeployment');
        Route::post('/set/event/{JoId}','PoolingManpowerController@setEventManpower');

        Route::post('/assign-buffef/{JoId}','PoolingManpowerController@assignBufferManpower');
    });

    Route::group(['prefix' => 'setup'], function() {
        Route::post('/manpower','SetupController@store');
        Route::post('/manpower/{manpowerId}','SetupController@store');
    });

    // Production
    Route::group(['prefix' => 'productions'], function() {
        Route::get('/', 'ProductionsController@index');
        Route::post('/{JoId}/details', 'ProductionsController@save_details');
        Route::post('/{JoId}/details/update', 'ProductionsController@update_details');
    });
});
