<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PricingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'room_type' => new RoomTypeResource($this->roomType),
            'price' => number_format(($this->price / 100), 2),
            'currency' => '$',
            'added_by' => $this->added_by ? $this->addedBy->name : ''
        ];
    }
}
