<?php

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
    /*Route::get('update/titles', [
        'uses' => 'API\ApiController@Title',
        'as' => 'api.updateTitle'
    ]);

    Route::post('upload/designation', [
        'uses' => 'API\ApiController@uploadDesignation',
        'as' => 'api.uploadDesignation'
    ]);*/

    Route::get('/upload-title', function () {
        return view('welcome');
    });

    Route::get('/register', function () {
        return view('Pages.Actions.Auth.register');
    })->name('register');

    Route::get('/login', function () {
        return view('Pages.Actions.Auth.login');
    })->name('login');

    Route::post('user/register', [
        'uses' => 'Auth\AuthController@Register',
        'as' => 'user.register'
    ]);

    Route::post('user/login', [
        'uses' => 'Auth\AuthController@Login',
        'as' => 'user.login'
    ]);

    Route::get('/', [
        'uses' => 'Dashboard\DashboardController@Dashboard',
        'as' => 'user.dashboard'
    ])->middleware('checkAuth');

    Route::get('user/logout', [
        'uses' => 'Auth\AuthController@Logout',
        'as' => 'logout'
    ])->middleware('checkAuth');

    Route::get('user/dashboard/add-excel-employee', [
        'uses' => 'Dashboard\DashboardController@uploadEmployeeExcel',
        'as' => 'dashboard.upload-excel-employee'
    ])->middleware('checkAuth');

    Route::get('user/add-new-user', [
        'uses' => 'User\UserController@addUser',
        'as' => 'user.add-new-user'
    ])->middleware('checkAuth');

    Route::get('user/suspend-user/{token}', [
        'uses' => 'User\UserController@suspendUser',
        'as' => 'user.suspend-user'
    ])->middleware('checkAuth');

    Route::get('user/activate-user/{token}', [
        'uses' => 'User\UserController@activateUser',
        'as' => 'user.activate-user'
    ])->middleware('checkAuth');

    Route::post('user/edit-user-details/{token}', [
        'uses' => 'User\UserController@editUserDetails',
        'as' => 'user.edit-user-details'
    ])->middleware('checkAuth');

    Route::get('user/view-all-users', [
        'uses' => 'User\UserController@viewUser',
        'as' => 'user.view-users'
    ])->middleware('checkAuth');

    Route::get('user/add-new-excel-users', [
        'uses' => 'User\UserController@addExcelUsers',
        'as' => 'user.add-new-users'
    ])->middleware('checkAuth');

    Route::post('user/submit-new-user-form', [
        'uses' => 'User\UserController@submitUserForm',
        'as' => 'user.submit-new-user-form'
    ])->middleware('checkAuth');

    Route::post('user/upload-user-excel-file', [
        'uses' => 'User\UserController@uploadUserExcel',
        'as' => 'user.upload-user-excel-file'
    ])->middleware('checkAuth');

    Route::get('get-all-banks', [
        'uses' => 'Employee\EmployeeController@getBankCode',
        'as' => 'api.get-bank-code'
    ]);

    //Employee Details
    Route::get('user/add-employee', [
        'uses' => 'Employee\EmployeeController@addEmployee',
        'as' => 'user.add-employee'
    ])->middleware('checkAuth');

    Route::post('user/submit-new-employee', [
        'uses' => 'Employee\EmployeeController@submitNewEmployee',
        'as' => 'user.submit-new-employee'
    ])->middleware('checkAuth');

    Route::get('user/view-employees', [
        'uses' => 'Employee\EmployeeController@viewEmployees',
        'as' => 'user.view-employees'
    ])->middleware('checkAuth');

    Route::get('user/update-employee-details/{token}', [
        'uses' => 'Employee\EmployeeController@updateEmployeeDetails',
        'as' => 'user.update-employee-details'
    ])->middleware('checkAuth');

    Route::get('user/view-employee-details/{token}', [
        'uses' => 'Employee\EmployeeController@viewEmployeeDetails',
        'as' => 'user.view-employee-details'
    ])->middleware('checkAuth');

    Route::post('user/update-employee-data/{token}', [
        'uses' => 'Employee\EmployeeController@updateEmployeeDate',
        'as' => 'user.update-employee-data'
    ])->middleware('checkAuth');

    Route::post('user/update-employee-guarantor/{token}', [
        'uses' => 'Employee\EmployeeController@updateEmployeeGuarantor',
        'as' => 'user.update-employee-guarantor'
    ])->middleware('checkAuth');

    Route::post('user/add-employee-education/{token}', [
        'uses' => 'Employee\EmployeeController@addEmployeeEducation',
        'as' => 'user.add-employee-education'
    ])->middleware('checkAuth');

    Route::post('user/add-employee-work-details/{token}', [
        'uses' => 'Employee\EmployeeController@addEmployeeWorkDetails',
        'as' => 'user.add-employee-work-details'
    ])->middleware('checkAuth');

    Route::post('user/add-employee-employment-history/{token}', [
        'uses' => 'Employee\EmployeeController@addEmployeeEmploymentHistory',
        'as' => 'user.add-employee-employment-history'
    ])->middleware('checkAuth');

    // System Settings
    Route::get('user/store-settings', [
        'uses' => 'Settings\SettingController@addStore',
        'as' => 'user.add-store'
    ])->middleware('checkAuth');

    Route::post('user/submit-store-form', [
        'uses' => 'Settings\SettingController@submitStore',
        'as' => 'user.submit-store'
    ])->middleware('checkAuth');

    Route::post('user/edit-store-details/{token}', [
        'uses' => 'Settings\SettingController@editStoreDetails',
        'as' => 'user.edit-store-details'
    ])->middleware('checkAuth');

    Route::get('user/title-settings', [
        'uses' => 'Settings\SettingController@addTitle',
        'as' => 'user.add-title'
    ])->middleware('checkAuth');

    Route::post('user/submit-title-form', [
        'uses' => 'Settings\SettingController@submitTitle',
        'as' => 'user.submit-title'
    ])->middleware('checkAuth');

    Route::post('user/edit-title-details/{token}', [
        'uses' => 'Settings\SettingController@editTitleDetails',
        'as' => 'user.edit-title-details'
    ])->middleware('checkAuth');

    Route::get('user/state-settings', [
        'uses' => 'Settings\SettingController@addState',
        'as' => 'user.add-state'
    ])->middleware('checkAuth');

    Route::post('user/submit-state-form', [
        'uses' => 'Settings\SettingController@submitState',
        'as' => 'user.submit-state'
    ])->middleware('checkAuth');

    Route::post('user/edit-state-details/{token}', [
        'uses' => 'Settings\SettingController@editStateDetails',
        'as' => 'user.edit-state-details'
    ])->middleware('checkAuth');

    Route::get('user/lgs-settings', [
        'uses' => 'Settings\SettingController@addLgs',
        'as' => 'user.add-lgs'
    ])->middleware('checkAuth');

    Route::post('user/submit-lgs-form', [
        'uses' => 'Settings\SettingController@submitLgs',
        'as' => 'user.submit-lgs'
    ])->middleware('checkAuth');

    Route::post('user/edit-lgs-details/{token}', [
        'uses' => 'Settings\SettingController@editLgsDetails',
        'as' => 'user.edit-lgs-details'
    ])->middleware('checkAuth');

    Route::get('user/home_town-settings', [
        'uses' => 'Settings\SettingController@addHome',
        'as' => 'user.add-home-town'
    ])->middleware('checkAuth');

    Route::post('user/submit-home-town-form', [
        'uses' => 'Settings\SettingController@submitHome',
        'as' => 'user.submit-home-town'
    ])->middleware('checkAuth');

    Route::post('user/edit-home-town-details/{token}', [
        'uses' => 'Settings\SettingController@editHomeDetails',
        'as' => 'user.edit-home-town-details'
    ])->middleware('checkAuth');

    Route::get('user/role-settings', [
        'uses' => 'Settings\SettingController@addRole',
        'as' => 'user.add-role'
    ])->middleware('checkAuth');

    Route::post('user/submit-role-form', [
        'uses' => 'Settings\SettingController@submitRole',
        'as' => 'user.submit-role'
    ])->middleware('checkAuth');

    Route::post('user/edit-role-details/{token}', [
        'uses' => 'Settings\SettingController@editRoleDetails',
        'as' => 'user.edit-role-details'
    ])->middleware('checkAuth');

    Route::get('user/rating-settings', [
        'uses' => 'Settings\SettingController@addRating',
        'as' => 'user.add-rating'
    ])->middleware('checkAuth');

    Route::post('user/submit-rating-form', [
        'uses' => 'Settings\SettingController@submitRating',
        'as' => 'user.submit-rating'
    ])->middleware('checkAuth');

    Route::post('user/edit-rating-details/{token}', [
        'uses' => 'Settings\SettingController@editRatingDetails',
        'as' => 'user.edit-rating-details'
    ])->middleware('checkAuth');

    Route::get('user/bank-settings', [
        'uses' => 'Settings\SettingController@addBank',
        'as' => 'user.add-bank'
    ])->middleware('checkAuth');

    Route::get('user/deactivate-bank/{token}', [
        'uses' => 'Settings\SettingController@deactivateBank',
        'as' => 'user.deactivate-bank'
    ])->middleware('checkAuth');

    Route::get('user/activate-bank/{token}', [
        'uses' => 'Settings\SettingController@activateBank',
        'as' => 'user.activate-bank'
    ])->middleware('checkAuth');

    Route::get('user/designation-settings', [
        'uses' => 'Settings\SettingController@addDesignation',
        'as' => 'user.add-designation'
    ])->middleware('checkAuth');

    Route::post('user/submit-designation-form', [
        'uses' => 'Settings\SettingController@submitDesignation',
        'as' => 'user.submit-designation'
    ])->middleware('checkAuth');

    Route::post('user/edit-designation-details/{token}', [
        'uses' => 'Settings\SettingController@editDesignationDetails',
        'as' => 'user.edit-designation-details'
    ])->middleware('checkAuth');

    Route::get('user/image-settings', [
        'uses' => 'Settings\SettingController@addImage',
        'as' => 'user.add-image'
    ])->middleware('checkAuth');

    Route::post('user/submit-image-form', [
        'uses' => 'Settings\SettingController@submitImage',
        'as' => 'user.submit-image'
    ])->middleware('checkAuth');

    Route::post('user/edit-image-details/{token}', [
        'uses' => 'Settings\SettingController@editImageDetails',
        'as' => 'user.edit-image-details'
    ])->middleware('checkAuth');




    /*Route::get('api/fetch/states', [
       'uses' => 'API\ApiController@fetchStates',
       'as' => 'api.fetch-state'
    ]);

    Route::get('api/fetch/home-town', [
       'uses' => 'API\ApiController@fetchHomeTown',
       'as' => 'api.fetch-home-town'
    ]);

    Route::get('api/fetch/lgs', [
       'uses' => 'API\ApiController@fetchLgs',
       'as' => 'api.fetch-lgs'
    ]);*/



