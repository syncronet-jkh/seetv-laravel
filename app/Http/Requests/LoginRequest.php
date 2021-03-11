<?php

namespace App\Http\Requests;

use App\Models\User;
use Closure;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use function __;
use function ceil;
use function event;
use function trans;

class LoginRequest extends FormRequest
{
    private ?User $userBeingAuthenticated = null;

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

    public function userBeingAuthenticated()
    {
        if ($this->userBeingAuthenticated) {
            return $this->userBeingAuthenticated;
        }

        $this->userBeingAuthenticated = User::where(
            $this->identityColumn(),
            $this->input($this->identityColumn())
        )->firstOrFail();

        return $this->userBeingAuthenticated;
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @param Closure $isAuthenticated
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(Closure $isAuthenticated)
    {
        $this->ensureIsNotRateLimited();

        if (!$isAuthenticated($this)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return Str::lower($this->input('email')).'|'.$this->ip();
    }
}
