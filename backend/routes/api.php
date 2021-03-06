<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([

    'middleware' => 'api',
   

], function () {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

    Route::post('passwordResetLink', 'ResetPasswordController@sendEmail');
    Route::post('resetPassword', 'ChangePasswordController@process');

    Route::post('/client', [
        'uses' => 'ClientController@postClient'
    ]);
    Route::get('/clients', [
       'uses' => 'ClientController@getClients'
    ]);
    Route::put('/client/{id}', [
        'uses' => 'ClientController@putClient'
    ]);
    Route::delete('/client/{id}', [
        'uses' => 'ClientController@deleteClient'
    ]);
    
    Route::get('/clients/{id}', [
        'uses' => 'ClientController@getClient'
    ]);

});