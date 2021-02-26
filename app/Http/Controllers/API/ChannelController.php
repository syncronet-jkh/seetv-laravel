<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\ChannelResource;
use App\Models\Channel;
use App\Models\Municipality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Spatie\QueryBuilder\QueryBuilder;

class ChannelController
{
    public function index(Municipality $municipality, Request $request)
    {
        $request->validate([
            'date' => ['nullable', 'date']
        ]);

        $date = Date::parse(
            $request->input('date', Date::today())
        )->toDateString();

        return ChannelResource::collection(
            $municipality
                ->channels()
                ->with([
                    'broadcasts' => fn ($query) => $query->whereDate('starts_at', $date)->latest('starts_at'),
                    'publisher'
                ])
                ->whereHas('broadcasts', fn ($query) => $query->whereDate('starts_at', $date))
                ->get()
        );
    }
}
