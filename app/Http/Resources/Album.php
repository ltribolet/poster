<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class Album extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     *
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(
            parent::toArray($request),
            ['pictures' => Picture::collection($this->whenLoaded('pictures'))]
        );
    }
}
