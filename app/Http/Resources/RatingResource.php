<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RatingResource extends JsonResource
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
                'user_id' => $this->user_id,
                'film_slug' => $this->film_slug,
                'rating' => $this->rating,
                'average_rating' => $this->film->ratings->avg('rating')
        ];
    }
}
