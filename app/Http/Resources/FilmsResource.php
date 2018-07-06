<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FilmsResource extends JsonResource
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
                'id' => $this->id,
                'name' => $this->name,
                'description' => $this->description,
                'release_date' => (string) $this->release_date,
                'country' => $this->country,
                'price' => $this->price,
                'created_at' => (string) $this->created_at,
                'updated_at' => (string) $this->updated_at,
                'genres' => $this->genres,
                'ratings' => RatingResource::collection($this->ratings),
                'photo' => $this->photo,
        ];
    }
}
