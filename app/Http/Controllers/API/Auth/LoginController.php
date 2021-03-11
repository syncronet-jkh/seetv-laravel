<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use function response;

class LoginController
{
    public function store(LoginRequest $request)
    {
        $request->authenticate(
            fn () => Hash::check($request->input('password'), $request->userBeingAuthenticated()->getAuthPassword())
        );

        return response()->json([
            'token' => $request
                ->userBeingAuthenticated()
                ->createToken('AuthToken')
                ->plainTextToken
        ]);
    }
}
