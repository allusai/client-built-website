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

Route::get('/', 'LoginController@login');
Route::get('/login', 'LoginController@login');
Route::post('/login', 'LoginController@doLogin');
Route::get('/signup', 'LoginController@signup');
Route::post('/signup', 'LoginController@store');

Route::get('/cameras/{id}', 'GeneralController@singleCameraView');
Route::get('/rangers/{id}', 'GeneralController@singleRangerView');
Route::get('/rangers', 'GeneralController@rangerList');
Route::get('/recharge', 'GeneralController@rechargeList')->name('rechargeList');
Route::post('/recharge/{id}', 'GeneralController@makeRechargeRequest');
Route::post('/deploy/{id}', 'GeneralController@deployCall');

Route::get('/dashboard', 'RangerController@myCameras')->name('dashboard');
Route::get('/selfAddCameras', 'RangerController@addNewCamerasForSelf');
Route::post('/selfAddCameras', 'RangerController@storeNewCameras');

Route::get('/headquarters', 'HeadquartersController@commandCentral')->name('headquarters');
Route::get('/addDevice', 'HeadquartersController@addDevice');
Route::post('/addDevice', 'HeadquartersController@storeDevice');
Route::get('/assignCamera', 'HeadquartersController@assignCamera');
Route::post('/assignCamera', 'HeadquartersController@store');
Route::get('/remove/{id}', 'HeadquartersController@removeCamera');
Route::delete('/remove/{id}', 'HeadquartersController@remove');

//Called from "/headquarters"
Route::post('/move/{id}', 'HeadquartersController@makeMoveRequest');
