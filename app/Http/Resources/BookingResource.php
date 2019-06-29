<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
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
            'room' => new  RoomResource($this->room),
            'user' => new UserResource($this->user),
            'pricing' => new PricingResource($this->pricing),
            'total_nights' => $this->total_nights,
            'total_price' => number_format($this->total_price / 100, 2),
            'currency' => '$',
            'start_date' => $this->start_date,
            'end_date' => $this->end_date
        ];
    }
}
