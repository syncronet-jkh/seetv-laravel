<?php

namespace App\Http\Requests;

use App\Models\Publisher;
use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class CurrentPublisherStoreRequest extends FormRequest
{
    private ?Publisher $publisher = null;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::forUser($this->user())->allows('assignAsCurrent', $this->publisher());
    }

    public function publisher(): Publisher
    {
        return $this->publisher ??= Publisher::findOrFail($this->input('publisher_id'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'publisher_id' => ['required', 'exists:publishers,id']
        ];
    }
}
