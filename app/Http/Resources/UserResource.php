<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $baseData = [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'token' => $this->token,
        ];
        if ($this->user_type === 'customer') {
            $baseData = array_merge($baseData,
                ['bookings' => BookingResource::collection($this->bookings)]);
        }
        return $baseData;
    }
}
