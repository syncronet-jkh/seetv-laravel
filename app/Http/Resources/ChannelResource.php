<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChannelResource extends JsonResource
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
            'name' => $this->name,
            'stream_url' => $this->stream_url,
            'ingest_url' => $this->ingest_url,
            'plan' => $this->whenLoaded('plan', fn () => new PlanResource($this->plan)),
            'user' => $this->whenLoaded('user', fn () => new UserResource($this->user)),
            'publisher' => $this->whenLoaded('publisher', fn () => new PublisherResource($this->publisher)),
            'municipality' => $this->whenLoaded('municipality', fn () => new MunicipalityResource($this->municipality)),
            'broadcasts' => $this->whenLoaded('broadcasts', fn () => BroadcastResource::collection($this->broadcasts))
        ];
    }
}
