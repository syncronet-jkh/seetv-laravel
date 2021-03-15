<?php

namespace App\Http\Requests;

use App\Models\Channel;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class CurrentChannelStoreRequest extends FormRequest
{
    private ?Channel $channel = null;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::forUser($this->user())->allows('assignAsCurrent', $this->channel());
    }

    public function channel(): Channel
    {
        return $this->channel ??= Channel::findOrFail($this->input('channel_id'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'channel_id' => ['required', 'exists:channels,id']
        ];
    }
}
