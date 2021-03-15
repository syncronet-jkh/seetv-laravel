<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Actions\AssignAsCurrentChannel;
use App\Http\Requests\CurrentChannelStoreRequest;

class CurrentChannelController
{
    public function store(CurrentChannelStoreRequest $request, AssignAsCurrentChannel $currentChannel)
    {
        $currentChannel->assign(
            $request->user(),
            $request->channel()
        );
    }
}
