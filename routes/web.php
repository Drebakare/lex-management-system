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

    Route::get('user/add-employee', [
        'uses' => 'Employee\EmployeeController@addEmployee',
        'as' => 'user.add-employee'
    ])->middleware('checkAuth');

    Route::post('user/submit-new-employee', [
        'uses' => 'Employee\EmployeeController@submitNewEmployee',
        'as' => 'user.submit-new-employee'
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



