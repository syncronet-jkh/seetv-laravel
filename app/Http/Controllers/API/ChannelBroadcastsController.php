<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BroadcastResource;
use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelBroadcastsController extends Controller
{
    public function planned(Channel $channel)
    {
        $data = $channel
            ->broadcasts()
            ->planned()
            ->oldest('starts_at')
            ->get()
            ->mapToGroups(fn ($broadcast) => [$broadcast->starts_at->toDateString() => $broadcast])
            ->map(fn ($broadcasts) => BroadcastResource::collection($broadcasts->sortBy('starts_at')));

        return [
            'data' => $data,
            'dates' => $data->keys()
        ];
    }

    public function historical(Channel $channel, Request $request)
    {
        $request->validate([
            'page' => 'nullable|integer',
            'per_page' => 'nullable|integer|max:50'
        ]);

        return BroadcastResource::collection(
            $channel->broadcasts()->historical()->latest('starts_at')->paginate($request->query('per_page', 15))
        );
    }
}
