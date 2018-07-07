<?php

namespace App\Http\Controllers;

use App\Film;
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
