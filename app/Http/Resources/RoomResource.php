<?php

namespace App\Http\Resources;

use App\Models\Branch;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id'            => $this->id,
            'room_number'   => $this->room_number,

            'branch'        => new BranchResource( $this->branches),
            'type'          => new TypeResource($this->types),

            'features'      => FeatureResource::collection($this->features),
        ];
    }
}
