<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\PlanResource;
use App\Models\Plan;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PlanController
{
    public function index()
    {
        return PlanResource::collection(
            QueryBuilder::for(
                Plan::with('features', 'features.permission', 'role', 'prices')
            )->allowedFilters([
                AllowedFilter::scope('role')
            ])->get()
        );
    }
}
