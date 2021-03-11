<?php

namespace App\Http\Controllers\API\Auth;

use App\Actions\CreateNewUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class RegisterController
{
    public function store(Request $request, CreateNewUser $createNewUser)
    {
        $validated = $request->validate($createNewUser->rules());

        $user = $createNewUser->create($validated);

        event(new Registered($user));

        return response()->json([
            'token' => $user
                ->createToken('AuthToken')
                ->plainTextToken
        ]);
    }
}
