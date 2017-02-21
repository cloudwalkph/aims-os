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

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'ae'], function () {
    Route::get('/', 'AE\AccountsExecutiveController@index');

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