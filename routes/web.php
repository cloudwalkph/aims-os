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
    Route::get('/', 'Front\AE\AccountsExecutiveController@index');
    Route::get('schedules', 'Front\AE\AccountsExecutiveController@schedules');
    Route::get('clients', 'Front\AE\ClientsController@index');
    Route::get('/jo', 'Front\AE\JobOrderController@index');
    Route::get('/references', 'Front\AE\AccountsExecutiveController@references');
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