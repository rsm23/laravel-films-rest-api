<?php

namespace App\Http\Controllers\Api;

use App\Film;
use App\Http\Controllers\Controller;
use App\Http\Resources\RatingResource;
use App\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller {
    
    public function store(Request $request, Film $film) {
        $rating = Rating::firstOrCreate(
                [
                        'user_id' => $request->user()->id,
                        'film_slug' => $film->slug,
                ],
                ['rating' => $request->rating]
        );
        
        return new RatingResource($rating);
    }
}
