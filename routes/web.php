<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/

   /* Auth::routes([
        'register' => false, // Registration Routes...
        'reset' => false, // Password Reset Routes...
        'verify' => false, // Email Verification Routes...
    ]);*/

Auth::routes();
    Route::get('/', function () {
        return redirect()->route('home');
    })->middleware('auth')->name('start');



    //open for all logged in user
    Route::middleware('auth')->group(function (){
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/home/profile', 'ProfileController@index')->name('home.profile');
        Route::get('/home/profile/change-password', 'ProfileController@changePassword')->name('home.profile.change-password');
        Route::post('/home/profile/update-password', 'ProfileController@updatePassword')->name('home.profile.update-password');

    });
    //open for all logged in user



    //administrative module
    Route::group(['as' => 'admin.','prefix' => 'admin','namespace' => 'Admin','middleware' => ['auth','administrator','restoreuser']] , function(){
        Route::get('user/historical','UserController@historicalUser')->name('user.historical');
    });


    Route::group(['as' => 'admin.','prefix' => 'admin','namespace' => 'Admin','middleware' => ['auth','administrator','createuser']] , function(){
        Route::post('user/save','UserController@saveUser')->name('user.save');
        Route::get('user/new','UserController@newUser')->name('user.new');
    });

    Route::group(['as' => 'admin.','prefix' => 'admin','namespace' => 'Admin','middleware' => ['auth','administrator','updateuser']] , function(){
        Route::post('user/update','UserController@updateUser')->name('user.update');
        Route::get('user/edit/{id}','UserController@editUser')->name('user.edit');
    });

    Route::group(['as' => 'admin.','prefix' => 'admin','namespace' => 'Admin','middleware' => ['auth','administrator','resetpassword']] , function(){
        Route::post('user/password/update','UserController@updatePassword')->name('user.password.update');
        Route::get('user/password/reset/{id}','UserController@resetPassword')->name('user.password.reset');
    });

    Route::group(['as' => 'admin.','prefix' => 'admin','namespace' => 'Admin','middleware' => ['auth']] , function(){
        Route::post('fabric-get-list','FabricController@getFabricList')->name('fabric-get-list');
        Route::post('buyer-season-get-list','BuyerSeasonController@getSeasonList')->name('buyer-season-get-list');
        Route::post('style-department-get-list','StyleDepartmentController@getStyleDepartmentList')->name('style-department-get-list');
    });

    Route::group(['as' => 'admin.','prefix' => 'admin','namespace' => 'Admin','middleware' => ['auth','administrator']] , function(){
        //dashboard
        //Route::get('home','AdminController@index')->name('home');

        Route::get('user/active','UserController@index')->name('user.active');
        Route::get('user/detail/{id}','UserController@detail')->name('user.detail');

        Route::delete('user/delete','UserController@softDelete')->name('user.delete');
        Route::delete('user/restore','UserController@restore')->name('user.restore');
        Route::delete('user/remove','UserController@fullDelete')->name('user.remove');
        Route::delete('user/access/block','UserController@blockAccess')->name('user.access.block');
        Route::delete('user/access/provide','UserController@provideAccess')->name('user.access.provide');

        //Route::delete('full-delete-user','UserController@fullDelete')->name('full-delete-user');
        //Route::get('user/master/{id}','UserController@master')->name('user.master');

        Route::delete('block-approval-access','UserController@blockApprovalAccess')->name('block-approval-access');
        Route::delete('user.provide-approval-access','UserController@provideApprovalAccess')->name('provide-approval-access');

        //user role management
        Route::post('user.apply-role', 'UserController@applyRole')->name('user.apply-role');

        //Route::get('user.apply-role/{role_id}/{user_id}', 'UserController@applyRole')->name('user.apply-role');
        //Route::get('user.delete-role/{role_id}/{user_id}', 'UserController@deleteRole')->name('user.delete-role');
        //user role management

        //role group
        Route::get('user/role','RoleController@index')->name('user.role');
        Route::post('user/role/save','RoleController@saveRole')->name('user.role.save');
        Route::post('user/role/edit','RoleController@updateRole')->name('user.role.edit');
        //role group

        //role task group
        Route::get('user/task','TaskController@index')->name('user.task');
        Route::post('user/task/save','TaskController@saveTask')->name('user.task.save');
        Route::post('user/task/edit','TaskController@updateTask')->name('user.task.edit');
        //role task group

        //location setup
        Route::get('location/setup', 'LocationController@index')->name('location.setup');
        Route::post('location/setup/save', 'LocationController@save')->name('location.setup.save');
        Route::post('location/setup/edit', 'LocationController@edit')->name('location.setup.edit');
        Route::delete('location/setup/delete', 'LocationController@delete')->name('location.setup.delete');
        Route::delete('location/setup/activate', 'LocationController@activate')->name('location.setup.activate');
        Route::delete('location/setup/de-activate', 'LocationController@deActivate')->name('location.setup.de-activate');
        //location setup

    });
    //administrative module

//settings drop down list
    Route::group(['as' => 'settings.','prefix' => 'settings','namespace' => 'Settings'] , function(){
        Route::post('factory/setup/drop-down-list', 'FactoryController@getDropDownList')->name('factory.setup.drop-down-list');
        Route::post('factory/department-setup/drop-down-list', 'DepartmentController@getDropDownList')->name('factory.department-setup.drop-down-list');
        Route::post('designation/drop-down-list', 'DesignationController@getDropDownList')->name('designation.drop-down-list');
        Route::post('employee/drop-down-list', 'CustomerController@getDropDownList')->name('employee.drop-down-list');

        Route::post('buyer/setup/drop-down-list', 'BuyerController@getDropDownList')->name('buyer.setup.drop-down-list');
        Route::post('buyer/style/drop-down-list', 'BuyerController@getDropDownList')->name('buyer.style.drop-down-list');

    });
// end settings drop down list

    Route::group(['as' => 'settings.','prefix' => 'settings','namespace' => 'Settings','middleware' => ['auth', 'settings']] , function(){
        Route::group(['middleware' => ['factory_department']] , function(){
            //factory setup
            Route::get('factory/setup', 'FactoryController@index')->name('factory.setup');
            Route::post('factory/setup/save', 'FactoryController@save')->name('factory.setup.save');
            Route::post('factory/setup/edit', 'FactoryController@edit')->name('factory.setup.edit');
            Route::delete('factory/setup/delete', 'FactoryController@delete')->name('factory.setup.delete');
            Route::delete('factory/setup/activate', 'FactoryController@activate')->name('factory.setup.activate');
            Route::delete('factory/setup/de-activate', 'FactoryController@deActivate')->name('factory.setup.de-activate');
            //factory setup

            //department setup
            Route::get('factory/department-setup', 'DepartmentController@index')->name('factory.department-setup');
            Route::post('factory/department-setup/save', 'DepartmentController@save')->name('factory.department-setup.save');
            Route::post('factory/department-setup/edit', 'DepartmentController@edit')->name('factory.department-setup.edit');
            Route::delete('factory/department-setup/delete', 'DepartmentController@delete')->name('factory.department-setup.delete');
            Route::delete('factory/department-setup/activate', 'DepartmentController@activate')->name('factory.department-setup.activate');
            Route::delete('factory/department-setup/de-activate', 'DepartmentController@deActivate')->name('factory.department-setup.de-activate');
            //department setup

            //buyer setup
            Route::get('buyer/setup', 'BuyerController@index')->name('buyer.setup');
            Route::post('buyer/setup/save', 'BuyerController@save')->name('buyer.setup.save');
            Route::post('buyer/setup/edit', 'BuyerController@edit')->name('buyer.setup.edit');
            Route::delete('buyer/setup/delete', 'BuyerController@delete')->name('buyer.setup.delete');
            Route::delete('buyer/setup/activate', 'BuyerController@activate')->name('buyer.setup.activate');
            Route::delete('buyer/setup/de-activate', 'BuyerController@deActivate')->name('buyer.setup.de-activate');
            //buyer setup

            //buyer style setup
            Route::get('buyer/style', 'BuyerStyleController@index')->name('buyer.style');
            Route::post('buyer/style/save', 'BuyerStyleController@save')->name('buyer.style.save');
            Route::post('buyer/style/edit', 'BuyerStyleController@edit')->name('buyer.style.edit');
            Route::delete('buyer/style/delete', 'BuyerStyleController@delete')->name('buyer.style.delete');
            Route::delete('buyer/style/activate', 'BuyerStyleController@activate')->name('buyer.style.activate');
            Route::delete('buyer/style/de-activate', 'BuyerStyleController@deActivate')->name('buyer.style.de-activate');
            //buyer style setup

            //unit setup
            Route::get('unit/setup', 'UnitController@index')->name('unit.setup');
            Route::post('unit/setup/save', 'UnitController@save')->name('unit.setup.save');
            Route::post('unit/setup/edit', 'UnitController@edit')->name('unit.setup.edit');
            Route::delete('unit/setup/delete', 'UnitController@delete')->name('unit.setup.delete');
            Route::delete('unit/setup/activate', 'UnitController@activate')->name('unit.setup.activate');
            Route::delete('unit/setup/de-activate', 'UnitController@deActivate')->name('unit.setup.de-activate');
            //unit setup
            //garments-type setup
            Route::get('garments-type/setup', 'GarmentsTypeController@index')->name('garments-type.setup');
            Route::post('garments-type/setup/save', 'GarmentsTypeController@save')->name('garments-type.setup.save');
            Route::post('garments-type/setup/edit', 'GarmentsTypeController@edit')->name('garments-type.setup.edit');
            Route::delete('garments-type/setup/delete', 'GarmentsTypeController@delete')->name('garments-type.setup.delete');
            Route::delete('garments-type/setup/activate', 'GarmentsTypeController@activate')->name('garments-type.setup.activate');
            Route::delete('garments-type/setup/de-activate', 'GarmentsTypeController@deActivate')->name('garments-type.setup.de-activate');
            //garments-type setup

            //stock-threshold setup
            Route::get('stock-threshold/setup', 'StockThresholdController@index')->name('stock-threshold.setup');
            Route::post('stock-threshold/setup/save', 'StockThresholdController@save')->name('stock-threshold.setup.save');
            Route::post('stock-threshold/setup/edit', 'StockThresholdController@edit')->name('stock-threshold.setup.edit');
            Route::delete('stock-threshold/setup/delete', 'StockThresholdController@delete')->name('stock-threshold.setup.delete');
            Route::delete('stock-threshold/setup/activate', 'StockThresholdController@activate')->name('stock-threshold.setup.activate');
            Route::delete('stock-threshold/setup/de-activate', 'StockThresholdController@deActivate')->name('stock-threshold.setup.de-activate');
            //stock-threshold setup

            //vendor setup
            Route::get('vendor/setup', 'VendorController@index')->name('vendor.setup');
            Route::post('vendor/setup/save', 'VendorController@save')->name('vendor.setup.save');
            Route::post('vendor/setup/edit', 'VendorController@edit')->name('vendor.setup.edit');
            Route::delete('vendor/setup/delete', 'VendorController@delete')->name('vendor.setup.delete');
            Route::delete('vendor/setup/activate', 'VendorController@activate')->name('vendor.setup.activate');
            Route::delete('vendor/setup/de-activate', 'VendorController@deActivate')->name('vendor.setup.de-activate');
            //vendor setup

        });

        Route::group(['middleware' => ['factory_it']] , function(){
            //factory it setup
            Route::get('factory/it-setup', 'FactoryItController@index')->name('factory.it-setup');
            Route::post('factory/it-setup/save', 'FactoryItController@save')->name('factory.it-setup.save');
            Route::post('factory/it-setup/edit', 'FactoryItController@edit')->name('factory.it-setup.edit');
            Route::delete('factory/it-setup/delete', 'FactoryItController@delete')->name('factory.it-setup.delete');
            Route::delete('factory/it-setup/activate', 'FactoryItController@activate')->name('factory.it-setup.activate');
            Route::delete('factory/it-setup/de-activate', 'FactoryItController@deActivate')->name('factory.it-setup.de-activate');
            //factory it setup
        });

        Route::group(['middleware' => ['designation']] , function(){
            //designation setup
            Route::get('designation', 'DesignationController@index')->name('designation');
            Route::post('designation/save', 'DesignationController@save')->name('designation.save');
            Route::post('designation/edit', 'DesignationController@edit')->name('designation.edit');
            Route::delete('designation/delete', 'DesignationController@delete')->name('designation.delete');
            Route::delete('designation/activate', 'DesignationController@activate')->name('designation.activate');
            Route::delete('designation/de-activate', 'DesignationController@deActivate')->name('designation.de-activate');
            //designation setup
        });

        Route::group(['middleware' => ['employee']] , function(){
            //employee setup
            Route::get('employee', 'CustomerController@index')->name('employee');
            Route::post('employee/save', 'CustomerController@save')->name('employee.save');
            Route::post('employee/edit', 'CustomerController@edit')->name('employee.edit');
            Route::delete('employee/delete', 'CustomerController@delete')->name('employee.delete');
            Route::delete('employee/activate', 'CustomerController@activate')->name('employee.activate');
            Route::delete('employee/de-activate', 'CustomerController@deActivate')->name('employee.de-activate');
            //employee setup
        });
    });

Route::group(['as' => 'receive.','prefix' => 'receive','namespace' => 'Receive','middleware' => ['auth','receive']] , function(){
    Route::get('new', 'InsertController@new')->name('new');
    Route::post('save', 'InsertController@save')->name('save');
    Route::post('master/update', 'MasterController@updateMaster')->name('master.update');
    Route::delete('master/delete', 'MasterController@deleteMaster')->name('master.delete');

    Route::group(['middleware' => ['image_access']] , function(){
        Route::get('image-upload', 'InsertController@imageUpload')->name('image-upload');
        Route::post('image-upload-search', 'InsertController@imageUploadSearch')->name('image-upload-search');
        Route::get('image-upload-form/{master_id}/{detail_id}', 'InsertController@imageUploadForm')->name('image-upload-form');
        Route::post('save-image-upload', 'InsertController@saveImageUpload')->name('save-image-upload');
        Route::delete('activate-image', 'InsertController@activateImage')->name('activate-image');
        Route::delete('de-activate-image', 'InsertController@deActivateImage')->name('de-activate-image');
        Route::delete('delete-image', 'InsertController@deleteImage')->name('delete-image');
    });

    Route::get('list/master/inserted', 'MasterController@listInserted')->name('list.master.inserted');
    Route::get('list/master/approved', 'MasterController@listInserted')->name('list.master.approved');
    Route::get('list/master/qc-started', 'MasterController@listInserted')->name('list.master.qc-started');
    Route::get('list/master/qc-finished', 'MasterController@listInserted')->name('list.master.qc-finished');

    Route::get('list/detail/inserted', 'DetailController@listInserted')->name('list.detail.inserted');
    Route::get('list/detail/qc-inserted', 'DetailController@listQCInserted')->name('list.detail.qc-inserted');
    Route::get('list/detail/qc-finished', 'DetailController@listQCFinished')->name('list.detail.qc-finished');

    Route::get('list/transfer/inserted', 'TransferController@transferInserted')->name('list.transfer.inserted');
    Route::delete('list/transfer/approve', 'TransferController@approveTransfer')->name('list.transfer.approve');
    Route::get('list/transfer/approved', 'TransferController@transferAccepted')->name('list.transfer.approved');

    Route::delete('list/detail/delete', 'DetailController@deleteDetail')->name('list.detail.delete');
    Route::delete('list/detail/approve-qc-single', 'DetailController@approveSingleQCInserted')->name('list.detail.approve-qc-single');
    Route::delete('list/detail/approve-all-qc-inserted', 'DetailController@approveAllQCInserted')->name('list.detail.approve-all-qc-inserted');
    Route::post('list/detail/insert-qc', 'DetailController@insertQC')->name('list.detail.insert-qc');

    Route::delete('approve', 'InsertController@approve')->name('approve');
    Route::delete('delete', 'InsertController@delete')->name('delete');

    Route::get('edit/{id}', 'InsertController@detail')->name('edit');
    Route::post('update', 'InsertController@update')->name('update');

    Route::get('detail/{id}', 'InsertController@detail')->name('detail');
    Route::post('detail/edit', 'InsertController@edit')->name('detail.edit');
    Route::post('detail/update', 'InsertController@detail')->name('detail.update');

    Route::get('search', 'InsertController@search')->name('search');
    Route::post('search-result', 'InsertController@searchResult')->name('search-result');
});

Route::group(['as' => 'issue.','prefix' => 'issue','namespace' => 'Issue','middleware' => ['auth','issue']] , function(){
    Route::get('stock/current', 'StockController@currentStock')->name('stock.current');
    Route::get('stock/current/print-view/{master_id}/{detail_id}', 'StockController@stockPrintView')->name('stock.current.print-view');
    Route::get('stock/in-active', 'StockController@inActiveStock')->name('stock.in-active');

    Route::delete('stock/current/activate', 'StockController@activateStock')->name('stock.current.activate');
    Route::delete('stock/current/de-activate', 'StockController@deActivateStock')->name('stock.current.de-activate');

    Route::post('detail/save', 'IssueController@saveIssue')->name('detail.save');
    Route::get('detail/issued', 'IssueController@issued')->name('detail.issued');
    Route::get('detail/transferred', 'IssueController@transferred')->name('detail.transferred');
    Route::delete('detail/delete', 'IssueController@deleteIssue')->name('detail.delete');

    Route::get('stock/old', 'StockController@oldStock')->name('stock.old');
});

Route::group(['as' => 'report.','prefix' => 'report','namespace' => 'Report','middleware' => ['auth','report']] , function(){
    Route::group(['as' => 'top-management.','prefix' => 'top-management', 'middleware' => ['top-management']] , function(){
        //top management
        Route::get('receive/form', 'ReceiveTMController@receiveForm')->name('receive.form');
        Route::post('receive/form/result', 'ReceiveTMController@receiveFormResult')->name('receive.form.result');

        Route::get('issue/form', 'IssueTMController@issueForm')->name('issue.form');
        Route::post('issue/form/result', 'IssueTMController@issueFormResult')->name('issue.form.result');

        Route::get('stock/form', 'StockTMController@stockForm')->name('stock.form');
        Route::post('stock/form/result', 'StockTMController@stockFormResult')->name('stock.form.result');
        //end top management
    });

    Route::group(['as' => 'management.','prefix' => 'management', 'middleware' => ['management']] , function(){
        //top management
        Route::get('receive/form', 'ReceiveMController@receiveForm')->name('receive.form');
        Route::post('receive/form/result', 'ReceiveMController@receiveFormResult')->name('receive.form.result');

        Route::get('issue/form', 'IssueMController@issueForm')->name('issue.form');
        Route::post('issue/form/result', 'IssueMController@issueFormResult')->name('issue.form.result');

        Route::get('stock/form', 'StockMController@stockForm')->name('stock.form');
        Route::post('stock/form/result', 'StockMController@stockFormResult')->name('stock.form.result');
        //end top management
    });

    Route::group(['as' => 'location.','prefix' => 'location', 'middleware' => ['location']] , function(){
        //top management
        Route::get('receive/form', 'ReceiveLController@receiveForm')->name('receive.form');
        Route::post('receive/form/result', 'ReceiveLController@receiveFormResult')->name('receive.form.result');

        Route::get('issue/form', 'IssueLController@issueForm')->name('issue.form');
        Route::post('issue/form/result', 'IssueLController@issueFormResult')->name('issue.form.result');

        Route::get('stock/form', 'StockLController@stockForm')->name('stock.form');
        Route::post('stock/form/result', 'StockLController@stockFormResult')->name('stock.form.result');
        //end top management
    });
});


