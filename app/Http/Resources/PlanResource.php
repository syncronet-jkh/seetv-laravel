<?php

namespace App\Http\Resources;

use App\Models\Feature;
use App\Models\Price;
use Illuminate\Http\Resources\Json\JsonResource;
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
        $locale = $request->getLocale();

        return [
            'id' => $this->id,
            'title' => $this->title,
            'binding_period' => $this->binding_period,
            'prices' => $this->whenLoaded('prices', function () use ($locale) {
                return $this->prices->map(fn (Price $price) => [
                    'currency' => $price->currency,
                    'amount' => [
                        'raw' => $price->amount,
                        'formatted' => $price->toMoney()->formatTo($locale)
                    ]
                ]);
            }),
            'role' => $this->whenLoaded('role', fn () => $this->role->toLocaleName($locale)),
            'features' => $this->whenLoaded('features', function () use ($locale) {
                return $this->features->map(function (Feature $feature) use ($locale) {
                    return [
                        'permission' => $feature->permission->toLocaleName($locale),
                        'enabled' => $feature->enabled
                    ];
                });
            })
        ];
    }
}
