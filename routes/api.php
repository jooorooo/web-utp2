<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

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

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'pins', 'namespace' => 'Api',], function() {

    Route::get('/', ['uses' => 'PinController@index']);
    Route::get('user/{id}', ['uses' => 'PinController@user']);
    Route::get('view/{id}', ['uses' => 'PinController@view']);
    Route::post('create', ['uses' => 'PinController@create']);
});
