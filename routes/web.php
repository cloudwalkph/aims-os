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

Route::group(['prefix' => 'job-orders'], function() {
    Route::get('/{joNo}', 'JobOrdersController@index');
    Route::get('/{joNo}/discussions', 'JobOrdersController@discussions');
});

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

        Route::get('/details/{joNo}/event-details', 'Front\AE\JobOrderController@eventDetails');
        Route::post('/details/{joNo}/event-details/schedules', 'Front\AE\JobOrderController@createJOSchedule');
        Route::get('/details/{joNo}/project-attachments', 'Front\AE\JobOrderController@projectAttachments');
        Route::get('/details/{joNo}/project-status', 'Front\AE\JobOrderController@projectStatus');
        Route::get('/details/{joNo}/request-forms', 'Front\AE\JobOrderController@requestForms');
        Route::get('/details/{joNo}/discussions', 'Front\AE\JobOrderController@discussions');

        Route::get('/details/{joNo}/preview', 'Front\AE\JobOrderController@preview');
        Route::get('/details/{joNo}/manpower', 'Front\AE\JobOrderController@previewManpower');
        Route::get('/details/{joNo}/meal', 'Front\AE\JobOrderController@previewMeal');
        Route::get('/details/{joNo}/vehicle', 'Front\AE\JobOrderController@previewVehicle');
    });

});

Route::group(['prefix' => 'cmtuva'], function () {
    Route::get('/', 'Front\CMTUVA\CmtuvaController@index');
    Route::get('schedules', 'Front\CMTUVA\CmtuvaController@schedules');
    Route::get('venues', 'Front\CMTUVA\CmtuvaController@venues');
    Route::post('venues/import', 'Front\CMTUVA\CmtuvaController@importVenues');
    Route::get('plans', 'Front\CMTUVA\CmtuvaController@plans');
    Route::get('plans/{joNo}', 'Front\CMTUVA\CmtuvaController@planDetails');
    Route::get('plans/{joNo}/preview', 'Front\CMTUVA\CmtuvaController@preview');
});

Route::group(['prefix' => 'creatives'], function () {
    Route::get('/', 'Front\Creatives\CreativesController@index');
    Route::get('schedules', 'Front\Creatives\CreativesController@schedules');
    Route::get('ongoing-projects', 'Front\Creatives\CreativesController@ongoing');
    Route::post('ongoing-projects', 'Front\Creatives\CreativesController@assignProject');
    Route::get('work-in-progress', 'Front\Creatives\CreativesController@workInProgress');

    Route::get('work-in-progress/{joId}/preview', 'Front\Creatives\CreativesController@preview');

    Route::get('work-in-progress/{creativesId}/{joId}', 'Front\Creatives\CreativesController@workDetails');
    Route::post('work-in-progress/{creativesId}/{joId}', 'Front\Creatives\CreativesController@addTask');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'Front\Admin\AdminController@index');
    Route::get('/users', 'Front\Admin\AdminController@users');
    Route::get('/agencies', 'Front\Admin\AdminController@agencies');
    Route::get('/manpower-types', 'Front\Admin\AdminController@manpowerTypes');
    Route::get('/vehicle-types', 'Front\Admin\AdminController@vehicleTypes');
    Route::get('/job-orders', 'Front\Admin\AdminController@joborders');
    Route::get('/validate', 'Front\Validate\ValidateController@showJoLists');
    Route::get('/validations/{jid}', 'Front\Validate\ValidateController@validate_results');
});

Route::group(['prefix' => 'inventory'], function () {
    Route::get('/', 'Front\Inventory\InventoryController@index');
    Route::get('/print/delivery/{joID}', 'Front\Inventory\InventoryController@print_delivery');
    Route::get('/print/release/{joID}', 'Front\Inventory\InventoryController@print_release');
    Route::get('/print/product/{joID?}', 'Front\Inventory\InventoryController@print_product_list');
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
    Route::get('/manpower_pooling/view/{jobOrderId}', 'Front\HR\PoolingController@show');
    Route::get('/vehicle_request', 'Front\HR\VehicleController@index');
    Route::get('/finalDeployment/{joNumber}', 'Front\HR\PoolingController@previewFinalDeployment');
});

Route::group(['prefix' => 'setup'], function () {
    Route::get('/', 'Front\Setup\SetupController@index');
    Route::get('/manpower', 'Front\Setup\SetupController@manpowerList');
    Route::get('/pooling', 'Front\Setup\SetupController@getJoList');
    Route::get('/pooling/view/{joId}', 'Front\Setup\SetupController@viewJo');
    Route::get('/final/view/{joId}', 'Front\Setup\SetupController@finalJo');
    Route::get('/finalDeployment/{joNumber}', 'Front\Setup\SetupController@previewFinalDeployment');
});

Route::group(['prefix' => 'productions'], function () {
    Route::get('/', 'Front\Productions\ProductionsController@index');
    Route::get('/references', 'Front\Productions\ProductionsController@references');
    Route::get('/references/{fileName}/download', 'Front\AE\ReferenceController@download');

    Route::group(['prefix' => 'jo'], function () {
        Route::get('/', 'Front\Productions\ProductionsController@jos');
        Route::get('/details/{joNo}', 'Front\Productions\ProductionsController@show');
        Route::get('/costing/{joNo}/{productionType}', 'Front\Productions\ProductionsController@costing');

    });
});

Route::group(['prefix' => 'operations'], function () {
    Route::get('/', 'Front\Operations\OperationsController@index');
    Route::get('/schedules', 'Front\Operations\SchedulerController@index');
    Route::get('/project-monitors', 'Front\Operations\ProjectMonitorController@index');
    Route::get('/official-business', 'Front\Operations\OfficialBusinessController@index');
    Route::get('/references', 'Front\Operations\ReferenceController@index');
    Route::get('/references/{fileName}/download', 'Front\Operations\ReferenceController@download');

    Route::group(['prefix' => 'job-orders'], function () {
        Route::get('/', 'Front\Operations\JobOrderController@index');
        Route::get('/{joNo}', 'Front\Operations\JobOrderController@details');
        Route::get('/{joNo}/assign', 'Front\Operations\JobOrderController@assignView');
        Route::get('/{joNo}/discussions', 'Front\Operations\JobOrderController@discussions');
        Route::post('/{joNo}/assign', 'Front\Operations\JobOrderController@assign');

        Route::post('/{joId}/project-attachments', 'Front\Operations\JobOrderController@uploadProjectAttachments');
    });

    Route::get('/{departmentId}', 'Front\Operations\DepartmentsController@show');
    Route::get('/{departmentId}/{joNo}', 'Front\Operations\DepartmentsController@showDetails');
});

Route::group(['prefix' => 'activations'], function () {
    Route::get('/', 'Front\Activations\ActivationsController@index');
    Route::get('/schedules', 'Front\Activations\SchedulerController@index');
    Route::get('/references', 'Front\Activations\ReferenceController@index');
    Route::get('/references/{fileName}/download', 'Front\Activations\ReferenceController@download');

    Route::group(['prefix' => 'job-orders'], function () {
        Route::get('/', 'Front\Activations\JobOrderController@index');
        Route::get('/{joNo}', 'Front\Activations\JobOrderController@details');
        Route::get('/{joNo}/discussions', 'Front\Activations\JobOrderController@discussions');

        Route::post('/{joId}/project-attachments', 'Front\Operations\JobOrderController@uploadProjectAttachments');
    });

    Route::get('/{departmentId}', 'Front\Activations\DepartmentsController@show');
    Route::get('/{departmentId}/{joNo}', 'Front\Activations\DepartmentsController@showDetails');
});

Route::group(['prefix' => 'users'], function () {
    Route::get('/getusers', 'Front\User\UsersController@showUsers');
});

Route::group(['prefix' => 'validate'], function () {
    Route::get('/', 'Front\Validate\ValidateController@index');
    Route::get('/results/{id}', 'Front\Validate\ValidateController@validate_results');
    Route::get('/getData/{jNo}/{eventCategory}', 'Front\Validate\ValidateController@getEventScores');
    Route::get('/{uniq}', 'Front\Validate\EmailValidationController@index');
//    Route::get('/create_project', 'Front\Validate\ValidateController@create_project');
//    Route::get('/create_project/{id}', 'Front\Validate\ValidateController@create_project');
//    Route::get('/summary_result', 'Front\Validate\ValidateController@summary_result');
//    Route::get('/create_project/{id}/summary_view', 'Front\Validate\ValidateController@summary_view');
});

Route::group(['prefix' => 'questions'], function () {
    Route::get('/getquestions', 'Front\Validate\ValidateQuestionsController@showQuestions');
    Route::get('/getquestionswithresult', 'Front\Validate\ValidateQuestionsController@showResults');
    Route::post('/submitresults', 'Front\Validate\Questions@submitresult');
});

    Route::group(['prefix' => 'evaluate'], function () {
    Route::get('/', 'Front\Validate\Questions@index');
    Route::get('/{jno}', 'Front\Validate\Questions@choosecategory');
    Route::get('/{jno}/{eventCategory}', 'Front\Validate\Questions@chooseemployee');
    Route::get('/{jno}/{eventCategory}/{dptid}/{rateeId}', 'Front\Validate\Questions@showQuestions');
});
