<?php


namespace App\Http\Controllers\API\Auth;


use Illuminate\Support\Facades\Auth;

class UserController
{
    public function index()
    {
        return Auth::guard('api')->user()->load('roles', 'publishers', 'channels', 'channels.publisher');
    }
}
