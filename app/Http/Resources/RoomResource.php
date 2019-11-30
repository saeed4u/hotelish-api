<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => new RoomTypeResource($this->type),
            'added_by' => $this->added_by ? $this->addedBy->name : '',
            'images' => ImageResource::collection($this->images)
        ];
    }
}
