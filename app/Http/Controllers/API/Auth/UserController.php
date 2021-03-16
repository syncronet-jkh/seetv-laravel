<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class UserController
{
    public function index()
    {
        return new UserResource(
            Auth::guard('api')->user()->load(
                'roles',
                'currentPublisher',
                'currentPublisher.channels',
                'currentChannel',
                'publishers',
                'publishers.plan',
                'publishers.channels',
                'publishers.phones',
                'publishers.emails',
                'publishers.addresses',
            )
        );
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'email' => 'string|email|max:255|unique:users,email',
            'phone_number' => 'string|max:255'
        ]);

        $request->user()->update($validated);

        return $request->user();
    }
}
