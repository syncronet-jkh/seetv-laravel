<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PublisherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'user' => $this->whenLoaded('user', fn () => new UserResource($this->user)),
            'plan' => $this->whenLoaded('plan', fn () => new PlanResource($this->plan)),
            'addresses' => $this->whenLoaded('addresses'),
            'emails' => $this->whenLoaded('emails'),
            'phones' => $this->whenLoaded('phones'),
            'channels' => $this->whenLoaded('channels', fn () => ChannelResource::collection($this->channels)),
            'members' => $this->whenLoaded('members', fn () => ChannelMemberResource::collection($this->members)),
            'updated_at' => $this->updated_at->toDateTimeString()
        ];
    }
}
