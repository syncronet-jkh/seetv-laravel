<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class UserController
{
    public function index()
    {
        return new UserResource(
            Auth::guard('api')->user()->load('roles', 'publishers', 'publishers.channels')
        );
    }
}
