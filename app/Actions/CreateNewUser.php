<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateNewUser
{
    public function rules(): array
    {
        return [
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|confirmed|min:8',
        ];
    }

    public function create(array $data)
    {
        $data['password'] = Hash::make($data['password']);

        return User::create($data);
    }
}
