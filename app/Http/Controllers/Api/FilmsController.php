<?php

namespace App\Http\Controllers\Api;

use App\Film;
use App\Http\Controllers\Controller;
use App\Http\Resources\FilmsResource;
use Illuminate\Http\Request;

class FilmsController extends Controller {
    
    public function __construct() {
        $this->middleware('auth:api')->except(['index', 'show']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index() {
        return FilmsResource::collection(Film::with('ratings')->paginate(25));
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
                'user_id' => $request->user()->id,
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
     * @param \App\Film $film
     *
     * @return \App\Http\Resources\FilmsResource
     */
    public function show(Film $film) {
        return new FilmsResource($film);
        
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
