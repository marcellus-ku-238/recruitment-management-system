<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\MockObject\ClassIsFinalException;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'namespace' => 'App\Http\Controllers\Api\V1'
], function() {
    
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('sign-in', 'AuthController@signIn')->name('signIn');
    Route::post('forget-password', 'AuthController@forgetPassword')->name('forgetPassword');
    Route::post('reset-password', 'AuthController@resetPassword')->name('resetPassword');
    
    
    Route::group([
        'middleware' => 'auth:sanctum'
    ], function ()
    {
        Route::post('me', 'AuthController@me')->name('me');
        Route::post('logout', 'AuthController@logout')->name('logout');

        Route::group([
            'middleware' => 'role:interviewer'
        ], function() {
            Route::post('interviewer-route', 'AuthController@me')->name('me');
            Route::apiResource('jobs', 'JobController');
        });

        Route::group([
            'middleware' => 'role:recruiter'
        ], function() {
            Route::post('recruiter-route', 'AuthController@me')->name('me');    
        });

    });

});