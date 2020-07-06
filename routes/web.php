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

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/register', function () {
        return view('Pages.Actions.Auth.register');
    })->name('register');

    Route::get('/login', function () {
        return view('Pages.Actions.Auth.login');
    })->name('login');

    Route::get('api/fetch/states', [
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
    ]);



