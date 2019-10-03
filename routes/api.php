<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->prefix('v1')->group(function(){
    Route::resources([
        'events' => 'EventController',
        'users' => 'UserController'
    ]);
});

Route::post('v1/auth_client', 'OAuthClientController@show');

Route::middleware('auth:api')->post('v1/likeEvents', 'EventController@likeEvents');

Auth::routes();