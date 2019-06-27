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
            'start_date' => $this->start_date,
            'end_date' => $this->end_date
        ];
    }
}
