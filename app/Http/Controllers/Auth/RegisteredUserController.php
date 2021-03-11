<?php

namespace App\Http\Controllers\Auth;

use App\Actions\CreateNewUser;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Actions\CreateNewUser $createNewUser
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, CreateNewUser $createNewUser)
    {
        $validated = $request->validate($createNewUser->rules());

        Auth::guard('web')->login(
            $user = $createNewUser->create($validated)
        );

        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);
    }
}
