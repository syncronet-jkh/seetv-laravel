<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BroadcastStoreRequest;
use App\Http\Resources\BroadcastResource;
use App\Models\Broadcast;
use App\Models\Channel;
use Illuminate\Http\Request;

class BroadcastController extends Controller
{
    public function store(BroadcastStoreRequest $request)
    {
        /** @var Broadcast $broadcast */
        $broadcast = $request->channel()->broadcasts()->make($request->validated());
        $broadcast->setRelation('channel', $request->channel());
        $broadcast->channelMember()->associate($request->channelMember());
        $broadcast->saveOrFail();

        return new BroadcastResource($broadcast);
    }
}
