<?php

namespace App\Http\Resources;

use Carbon\CarbonInterval;
use Illuminate\Http\Resources\Json\JsonResource;

class BroadcastResource extends JsonResource
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
            'channel' => $this->whenLoaded('channel', fn () => new ChannelResource($this->channel)),
            'channel_member' => $this->whenLoaded('channelMember', fn () => new ChannelMemberResource($this->channelMember)),
            'starts_at' => $this->starts_at->toDateTimeString(),
            'ends_at' => $this->ends_at->toDateTimeString(),
            'duration' => $this->duration,
            'title' => $this->title,
            'description' => $this->description,

            // Backwards compatibility
            'stream_url' => $this->whenLoaded('channel', fn () => $this->channel->stream_url),
            'ingest_url' => $this->whenLoaded('channel', fn () => $this->channel->ingest_url)
        ];
    }
}
