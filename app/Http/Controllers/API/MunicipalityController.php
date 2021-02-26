<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\MunicipalityResource;
use App\Models\Municipality;
use Illuminate\Http\Request;
use function filled;
use function transform;

class MunicipalityController
{
    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:40'
        ]);

        return MunicipalityResource::collection(
            filled($request->input('search'))
                ? Municipality::search($request->input('search'))->query(fn ($query) => $query->with('region', 'postalCodes'))->get()
                : Municipality::with('region', 'postalCodes')->cacheFor(60)->get()
        );
    }
}
