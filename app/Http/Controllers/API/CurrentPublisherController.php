<?php

namespace App\Http\Controllers\API;

use App\Actions\AssignAsCurrentPublisher;
use App\Http\Requests\CurrentPublisherStoreRequest;
use Illuminate\Http\Request;

class CurrentPublisherController
{
    public function store(CurrentPublisherStoreRequest $request, AssignAsCurrentPublisher $currentPublisher)
    {
        $currentPublisher->assign(
            $request->user(),
            $request->publisher()
        );
    }
}
