<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use function response;
use function trans;

class LoginController
{
    public function store(LoginRequest $request)
    {

        $user = User::where(
            $request->identityColumn(),
            $request->input($request->identityColumn())
        )->firstOrFail();

        if (!Hash::check($request->input('password'), $user->password)) {
            throw ValidationException::withMessages([
                'password' => [trans('auth.failed')],
            ]);
        }

        // Auth::guard('api')->login($user);

        return response()->json([
            'token' => $user
                ->createToken('AuthToken')
                ->plainTextToken
        ]);
    }
}
