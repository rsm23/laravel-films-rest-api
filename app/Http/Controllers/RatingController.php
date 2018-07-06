<?php

namespace App\Http\Controllers;

use App\Film;
use App\Http\Resources\RatingResource;
use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller {
    
    public function store(Request $request, Film $film) {
        $rating = Rating::firstOrCreate(
                [
                        'user_id' => Auth::id(),
                        'film_id' => $film->id,
                ],
                ['rating' => $request->rating]
        );
        
        return new RatingResource($rating);
    }
}
