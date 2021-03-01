<?php

namespace App\Http\Requests\API;

use App\Models\Address;
use App\Models\Channel;
use App\Models\Email;
use App\Models\Municipality;
use App\Models\Phone;
use App\Models\Plan;
use App\Models\Publisher;
use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use function array_map;
use function once;
use function tap;

class PublisherStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()
            && $this->user()->hasRole(Role::PUBLISHER);
    }

    public function plan(): Plan
    {
        return once(fn () => Plan::findOrFail($this->plan_id));
    }

    public function municipality(): Municipality
    {
        return once(fn () => Municipality::findOrFail($this->municipality_id));
    }

    public function addresses()
    {
        return array_map(function (array $address) {
            return tap(
                new Address($address),
                fn ($addr) => $addr->municipality()->associate($this->municipality())
            );
        }, $this->addresses);
    }

    public function emails()
    {
        return array_map(function (array $email) {
            return new Email($email);
        }, $this->emails);
    }

    public function phones()
    {
        return array_map(function (array $phone) {
            return new Phone($phone);
        }, $this->phones);
    }

    public function channels()
    {
        return array_map(function (array $channel) {
            return tap(
                new Channel($channel),
                function ($channel) {
                    $channel->municipality()->associate($this->municipality());
                    $channel->plan()->associate($this->plan());
                    $channel->user()->associate($this->user());
                }
            );
        }, $this->channels);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'plan_id' => ['required', Rule::exists(Plan::class, 'id')->where('role_id', Role::PUBLISHER()->getKey())],
            'municipality_id' => 'required|exists:municipalities,id',

            'addresses' => ['required', 'array'],
            'addresses.*.street_address' => ['required_with:addresses', 'string', 'max:255'],
            'emails' => ['required', 'array'],
            'emails.*.address' => ['required_with:emails', 'string', 'email'],
            'phones' => ['required', 'array'],
            'phones.*.number' => ['required_with:phones', 'string', 'max:255'],
            'channels' => ['required', 'array'],
            'channels.*.name' => ['required_with:channels', 'string', 'max:255']
        ];
    }
}
