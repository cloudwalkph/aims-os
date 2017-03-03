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

Route::get('/profile', 'HomeController@profile');
Route::post('/change-password', 'HomeController@changePassword');

Route::group(['prefix' => 'ae'], function () {
    Route::get('/', 'Front\AE\AccountsExecutiveController@index');
    Route::get('schedules', 'Front\AE\AccountsExecutiveController@schedules');
    Route::get('clients', 'Front\AE\ClientsController@index');
    Route::get('/references', 'Front\AE\AccountsExecutiveController@references');
    Route::get('/references/{fileName}/download', 'Front\AE\ReferenceController@download');

    Route::group(['prefix' => 'jo'], function () {
        Route::get('/', 'Front\AE\JobOrderController@index');
        Route::get('/create', 'Front\AE\JobOrderController@create');
        Route::get('/details/{joNo}', 'Front\AE\JobOrderController@show');
        Route::get('/details/{joNo}/preview', 'Front\AE\JobOrderController@preview');
        Route::get('/details/{joNo}/manpower', 'Front\AE\JobOrderController@previewManpower');
        Route::get('/details/{joNo}/meal', 'Front\AE\JobOrderController@previewMeal');
        Route::get('/details/{joNo}/vehicle', 'Front\AE\JobOrderController@previewVehicle');
        Route::post('/{joId}/mom', 'Front\AE\JobOrderController@saveJobOrderMOM');
        Route::post('/{joId}/details', 'Front\AE\JobOrderController@saveEventDetails');
        Route::post('/{joId}/animation', 'Front\AE\JobOrderController@saveAnimationDetails');
        Route::post('/{joId}/project-attachments', 'Front\AE\JobOrderController@uploadProjectAttachments');
        Route::get('/{joId}/project-attachments/{attachmentId}/download', 'Front\AE\JobOrderController@downloadAttachment');

    });

});

Route::group(['prefix' => 'cmtuva'], function () {
    Route::get('/', 'Front\CMTUVA\CmtuvaController@index');
    Route::get('schedules', 'Front\CMTUVA\CmtuvaController@schedules');
    Route::get('venues', 'Front\CMTUVA\CmtuvaController@venues');
    Route::post('venues/import', 'Front\CMTUVA\CmtuvaController@importVenues');
    Route::get('plans', 'Front\CMTUVA\CmtuvaController@plans');
    Route::get('plans/{joNo}', 'Front\CMTUVA\CmtuvaController@planDetails');
});

Route::group(['prefix' => 'creatives'], function () {
    Route::get('/', 'Front\Creatives\CreativesController@index');
    Route::get('schedules', 'Front\Creatives\CreativesController@schedules');
    Route::get('ongoing-projects', 'Front\Creatives\CreativesController@ongoing');
    Route::get('work-in-progress', 'Front\Creatives\CreativesController@workInProgress');
    Route::get('work-in-progress/{creativesId}/{joId}', 'Front\Creatives\CreativesController@workDetails');

});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'Front\Admin\AdminController@index');
    Route::get('/users', 'Front\Admin\AdminController@users');
    Route::get('/agencies', 'Front\Admin\AdminController@agencies');
    Route::get('/manpower-types', 'Front\Admin\AdminController@manpowerTypes');
});

Route::group(['prefix' => 'inventory'], function () {
    Route::get('/', 'Front\Inventory\InventoryController@index');
});

Route::group(['prefix' => 'accounting'], function () {
    Route::get('/', 'Front\Accounting\AccountingController@index');
    Route::post('/check', 'Front\Accounting\AccountingController@check');
    Route::post('/cono', 'Front\Accounting\AccountingController@cono');
    Route::post('/transmittal', 'Front\Accounting\AccountingController@transmittal');
});

Route::group(['prefix' => 'hr'], function () {
    Route::get('/', 'Front\HR\HumanResourcesController@index');
    Route::get('/schedules', 'Front\HR\SchedulerController@index');
    Route::get('/manpower', 'Front\HR\ManpowerController@index');
    Route::get('/manpower_pooling', 'Front\HR\PoolingController@index');
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

Route::group(['prefix' => 'validate'], function () {
    Route::get('/', 'Front\Validate\ValidateController@index');
    Route::get('/create_project', 'Front\Validate\ValidateController@create_project');
    Route::get('/summary_result', 'Front\Validate\ValidateController@summary_result');
});
