<?php

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\Auth\UserController;
use App\Http\Controllers\API\BroadcastController;
use App\Http\Controllers\API\ChannelController;
use App\Http\Controllers\API\CSRFTokenController;
use App\Http\Controllers\API\MunicipalityController;
use App\Http\Controllers\API\PlanController;
use App\Http\Controllers\API\PlanPurchaseController;
use App\Http\Controllers\API\PublisherController;
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

Route::get('Plans', [PlanController::class, 'index']);
Route::get('Municipalities', [MunicipalityController::class, 'index']);
Route::get('Municipalities/{municipality}/Channels', [ChannelController::class, 'index']);

Route::post('Login', [LoginController::class, 'store']);
Route::post('Register', [RegisterController::class, 'store']);
Route::middleware('auth:api')->group(static function () {
    Route::get('User', [UserController::class, 'index']);

    Route::post('Plans/{plan}/Purchase', [PlanPurchaseController::class, 'store']);

    Route::post('Publishers', [PublisherController::class, 'store']);

    Route::post('Channels/{channel}/Broadcasts', [BroadcastController::class, 'store']);
});
