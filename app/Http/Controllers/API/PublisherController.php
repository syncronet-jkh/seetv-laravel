<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\PublisherStoreRequest;
use App\Http\Resources\PublisherResource;
use App\Models\ChannelMember;
use App\Models\Publisher;

class PublisherController
{
    public function store(PublisherStoreRequest $request)
    {
        /** @var Publisher $publisher */
        $publisher = $request->user()->publishers()->create([
            'user_id' => $request->user()->id,
            'name' => $request->input('name'),
            'plan_id' => $request->plan()->getKey()
        ]);

        $publisher->addresses()->saveMany(
            $request->addresses()
        );

        $publisher->emails()->saveMany(
            $request->emails()
        );

        $publisher->phones()->saveMany(
            $request->phones()
        );

        $channels = $publisher->channels()->saveMany(
            $request->channels()
        );

        foreach ($channels as $channel) {
            ChannelMember::query()->create([
                'channel_id' => $channel->id,
                'user_id' => $request->user()->id
            ]);
        }

        $publisher->load('addresses', 'emails', 'phones', 'channels');

        return new PublisherResource($publisher);
    }
}
