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

Route::group(['prefix' => 'ae'], function () {
    Route::get('/', 'AE\AccountsExecutiveController@index');
    Route::get('schedules', 'AE\AccountsExecutiveController@schedules');
    Route::get('clients', 'AE\ClientsController@index');
});

Route::group(['prefix' => 'cmtuva'], function () {
    Route::get('/', 'CMTUVA\CmtuvaController@index');
});

Route::group(['prefix' => 'creatives'], function () {
    Route::get('/', 'Creatives\CreativesController@index');

});

Route::group(['prefix' => 'inventory'], function () {
    Route::get('/', 'Inventory\InventoryController@index');
});

Route::group(['prefix' => 'accounting'], function () {
    Route::get('/', 'Accounting\AccountingController@index');
});

Route::group(['prefix' => 'hr'], function () {
    Route::get('/', 'HR\HumanResourcesController@index');
});

Route::group(['prefix' => 'setup'], function () {
    Route::get('/', 'Setup\SetupController@index');
});

Route::group(['prefix' => 'productions'], function () {
    Route::get('/', 'Productions\ProductionsController@index');
});

Route::group(['prefix' => 'operations'], function () {
    Route::get('/', 'Operations\OperationsController@index');
});