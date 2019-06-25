<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HotelResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'state' => $this->state,
            'country' => new CountryResource($this->country),
            'zip_code' => $this->zip_code,
            'phone' => $this->phone_number,
            'rooms' => RoomResource::collection($this->rooms)
        ];
    }
}
