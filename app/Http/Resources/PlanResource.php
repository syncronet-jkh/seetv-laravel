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
        $locale = $request->getLocale();

        return [
            'id' => $this->id,
            'title' => $this->title,
            'binding_period' => [
                'days' => Date::parse($this->binding_period)->diffInDays(today()),
                'raw' => $this->binding_period,
                'formatted' => __('plan.binding_period.'.$this->binding_period, [], $locale)
            ],
            'prices' => $this->whenLoaded('prices', function () use ($locale) {
                return $this->prices->map(fn (Price $price) => [
                    'currency' => $price->currency,
                    'amount' => [
                        'minor' => $price->toMoney()->getMinorAmount()->abs()->toInt(),
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
