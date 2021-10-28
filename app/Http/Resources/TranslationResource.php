<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TranslationResource extends JsonResource
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
            'locale'       => $this->locale,
            'name'         => $this->name,
            'description'  => $this->description,
        ];
    }
}
