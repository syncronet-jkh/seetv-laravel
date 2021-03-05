<?php

use App\Http\Controllers\API\CSRFTokenController;
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

Route::get('/api/csrf-token', [CSRFTokenController::class, 'index']);
Route::view('/', 'welcome');
