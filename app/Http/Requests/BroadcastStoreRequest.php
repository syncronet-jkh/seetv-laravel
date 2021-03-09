<?php

namespace App\Http\Requests;

use App\Models\Broadcast;
use App\Models\Channel;
use App\Models\ChannelMember;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
use function tap;

class BroadcastStoreRequest extends FormRequest
{
    private ?Channel $channel = null;
    private ?ChannelMember $channelMember = null;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::forUser($this->user())->allows('create', [Broadcast::class, $this->channel()]);
    }

    public function channel(): Channel
    {
        if ($this->channel) {
            return $this->channel;
        }

        return tap(
            $this->route('channel') instanceof Channel ? $this->route('channel') : Channel::findOrFail($this->route('channel')),
            fn (Channel $channel) => $this->channel = $channel
        );
    }

    public function channelMember(): ChannelMember
    {
        if ($this->has('channel_member_id')) {
            return ChannelMember::findOrFail($this->input('channel_member_id'));
        }

        return $this->channel()->members()->where('user_id', $this->user()->getKey())->firstOrFail();
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            /** @var Validator $validator */
            if ($this->channel()->hasOverlappingBroadcasts(new Broadcast($this->validated()))) {
                $validator->errors()->add('starts_at', 'There is already another broadcast at the requested datetime interval.');
            }
        });
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'channel_member_id' => ['nullable', Rule::exists(ChannelMember::class, 'id')->where('channel_id', $this->channel()->getKey())],
            'starts_at' => ['required', 'date', 'before:ends_at', 'after:now'],
            'ends_at' => ['required', 'date', 'after:starts_at'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:255']
        ];
    }
}
