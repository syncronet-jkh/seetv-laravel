<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => ['required_without:email', 'string', 'exists:users,username', 'max:255'],
            'email' => ['required_without:username', 'string', 'email', 'exists:users,email', 'max:255'],
            'password' => ['required', 'string', 'max:255']
        ];
    }

    public function identityColumn(): string
    {
        return $this->has('email') ? 'email' : 'username';
    }

    public function credentials(): array
    {
        $identityColumn = $this->identityColumn();

        return [
            $identityColumn => $this->input($identityColumn),
            'password' => $this->input('password')
        ];
    }
}
