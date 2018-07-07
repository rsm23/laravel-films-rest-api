<?php

namespace App\Http\Controllers\Api;

use App\Film;
use App\Http\Controllers\Controller;
use App\Http\Resources\FilmsResource;
use Illuminate\Http\Request;

class FilmsController extends Controller {
    
    /**
     * Create a new instance of the controller
     *
     * FilmsController constructor.
     */
    public function __construct() {
        $this->middleware('auth:api')->except(['index', 'show']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index() {
        return FilmsResource::collection(Film::with('ratings')->get());
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \App\Http\Resources\FilmsResource
     */
    public function store(Request $request) {
        if ($request->user()->isAdmin) {
            $validatedData = $request->validate([
                    'name' => 'required|max:255',
                    'description' => 'required',
                    'release_date' => 'required|date',
                    'country' => 'required',
                    'price' => 'required|numeric',
                    'photo' => 'required|url',
                    'genre' => 'required|array|min:1',
            ]);
            if(Film::whereSlug(str_slug($request->name))->count() === 0){
                $slug = str_slug($request->name);
            }else{
                $slug = str_slug($request->name).rand(1,1000);
            }
            $film = Film::create([
                    'name' => $request->name,
                    'slug' => $slug,
                    'description' => $request->description,
                    'release_date' => $request->release_date,
                    'country' => $request->country,
                    'price' => $request->price,
                    'photo' => $request->photo,
            ]);
    
            $film->genres()->attach($request->genre);
            
            return new FilmsResource($film);
        }
        return response()->json(['error' => 'You can are not allowed to add films.'], 403);
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
        if ($request->user()->isAdmin) {
            $film->update($request->all());
            
            return new FilmsResource($film);
        }
        return response()->json(['error' => 'You can are not allowed to add films.'], 403);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Film $film
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Request $request, Film $film) {
        if ($request->user()->isAdmin) {
            $film->delete();
            return response()->json(NULL, 204);
        }
        return response()->json(['error' => 'You can are not allowed to add films.'], 403);
        
    }
}
