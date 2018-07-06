<?php

namespace App\Http\Controllers;

use App\Film;
use App\Http\Resources\FilmsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilmsController extends Controller {
    
    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index(Request $request) {
        if ($request->is('api/*')) {
            return FilmsResource::collection(Film::with('ratings')
                    ->paginate(1));
        }
        $films = Film::with(['ratings', 'genres'])->paginate(10);
        return view('films.index', compact('films'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \App\Http\Resources\FilmsResource
     */
    public function store(Request $request) {
        $film = Film::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'description' => $request->description,
                'release_date' => $request->release_date,
                'country' => $request->country,
                'price' => $request->price,
                'photo' => $request->photo,
                'genre' => $request->genre,
        ]);
        
        return new FilmsResource($film);
    }
    
    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Film $film
     *
     * @return \App\Http\Resources\FilmsResource
     */
    public function show(Request $request, Film $film) {
        if ($request->is('api/*')) {
            return new FilmsResource($film);
        }
        $film = $film->with(['ratings', 'genres'])->first();
        return view('films.show', compact('film'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param \App\Film $film
     *
     * @return \App\Http\Resources\FilmsResource
     */
    public function update(Request $request, Film $film) {
        $film->update($request->all());
        
        return new FilmsResource($film);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Film $film
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Film $film) {
        $film->delete();
        return response()->json(NULL, 204);
    }
}
