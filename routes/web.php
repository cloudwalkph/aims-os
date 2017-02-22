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
    return redirect()->to('/login');
});

Auth::routes();

Route::get('/admin', function () {
    return view('admin.index');
});

Route::get('/profile', function () {
    return view('profile.index');
});

Route::get('/print', function () {
    return view('ae.jolist.details.print.index');
});

Route::group(['prefix' => 'ae'], function () {
    Route::get('/', 'Front\AE\AccountsExecutiveController@index');
    Route::get('schedules', 'Front\AE\AccountsExecutiveController@schedules');
    Route::get('clients', 'Front\AE\ClientsController@index');
    Route::get('/references', 'Front\AE\AccountsExecutiveController@references');

    Route::group(['prefix' => 'jo'], function () {
        Route::get('/', 'Front\AE\JobOrderController@index');
        Route::get('/create', 'Front\AE\JobOrderController@create');
        Route::get('/details/{joNo}', 'Front\AE\JobOrderController@show');
        Route::post('/{joId}/mom', 'Front\AE\JobOrderController@saveJobOrderMOM');
        Route::post('/{joId}/details', 'Front\AE\JobOrderController@saveEventDetails');
        Route::post('/{joId}/animation', 'Front\AE\JobOrderController@saveAnimationDetails');
    });

});

Route::group(['prefix' => 'cmtuva'], function () {
    Route::get('/', 'Front\CMTUVA\CmtuvaController@index');
});

Route::group(['prefix' => 'creatives'], function () {
    Route::get('/', 'Front\Creatives\CreativesController@index');

});

Route::group(['prefix' => 'inventory'], function () {
    Route::get('/', 'Front\Inventory\InventoryController@index');
});

Route::group(['prefix' => 'accounting'], function () {
    Route::get('/', 'Front\Accounting\AccountingController@index');
});

Route::group(['prefix' => 'hr'], function () {
    Route::get('/', 'Front\HR\HumanResourcesController@index');
});

Route::group(['prefix' => 'setup'], function () {
    Route::get('/', 'Front\Setup\SetupController@index');
});

Route::group(['prefix' => 'productions'], function () {
    Route::get('/', 'Front\Productions\ProductionsController@index');
});

Route::group(['prefix' => 'operations'], function () {
    Route::get('/', 'Front\Operations\OperationsController@index');
});