<?php

use App\Http\Hooks\GithubDeployment;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Hook Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web hook routes.
|
*/

Route::post('Deployments/Github/{branch}', GithubDeployment::class);
