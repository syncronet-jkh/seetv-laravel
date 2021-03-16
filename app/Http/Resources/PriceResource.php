<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PriceResource extends JsonResource
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
            'currency' => $this->currency,
            'amount' => [
                'minor' => $this->toMoney()->getMinorAmount()->abs()->toInt(),
                'formatted' => $this->toMoney()->formatTo($request->getLocale())
            ]
        ];
    }
}
