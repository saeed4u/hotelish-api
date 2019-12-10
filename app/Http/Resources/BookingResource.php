<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'hotel' => new HotelResource($this->room->hotel),
            'room' => new  RoomResource($this->room),
            'pricing' => new PricingResource($this->pricing),
            'total_nights' => $this->total_nights,
            'total_price' => number_format($this->total_price / 100, 2),
            'currency' => $this->currency,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'customer_email' => $this->customer_email,
            'customer_name' => $this->customer_name,
        ];
    }
}
