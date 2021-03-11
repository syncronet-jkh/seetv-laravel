<?php

use App\Http\Controllers\API\CSRFTokenController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
Route::get('/', [WelcomeController::class, 'show']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'show']);
    Route::resource('/terms', TermController::class);
});

require __DIR__.'/auth.php';
