<?php

namespace App\Http\Resources;

use App\Models\Feature;
use App\Models\Price;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Date;
use function __;
use function today;
use function trans;

class PlanResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'is_free' => $this->whenLoaded('prices', fn () => $this->is_free),
            'binding_period' => [
                'days' => Date::parse($this->binding_period)->diffInDays(today()),
                'raw' => $this->binding_period,
                'formatted' => __('plan.binding_period.' . $this->binding_period, [], $request->getLocale())
            ],
            'prices' => $this->whenLoaded('prices', fn () => PriceResource::collection($this->prices)),
            'role' => $this->whenLoaded('role', fn () => $this->role->toLocaleName($request->getLocale())),
            'features' => $this->whenLoaded('features', fn () => PlanFeatureResource::collection($this->features))
        ];
    }
}
