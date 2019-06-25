<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'type' => $this->type->name,
            'added_by' => $this->added_by ? $this->addedBy->name : '',
            'images' => ImageResource::collection($this->images),
            'bookings' => BookingResource::collection($this->bookings)
        ];
    }
}