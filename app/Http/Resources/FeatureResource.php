<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FeatureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'image'        => $this->image_path,
            
            'updated_at'   => $this->updated_at->diffForHumans(),
            
            'translate'    => TranslationResource::collection($this->translations),
        ];
    }
}