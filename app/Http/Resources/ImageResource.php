<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request $request
     * @return array
     */
    public function toArray($request)
    {
        $port = $_SERVER['SERVER_PORT'] ? $_SERVER['SERVER_PORT'] : '8000';
        return [
            'id' => $this->id,
            'src' => sprintf("%s:%s%s", config('app.url'), $port, Storage::url($this->image))
        ];
    }
}
