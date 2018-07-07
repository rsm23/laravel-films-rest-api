<?php

namespace App\Http\Controllers;

use App\Film;
use App\Genre;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilmsController extends Controller {
    
    /**
     * Instantiate a new instance of the controller.
     *
     * FilmsController constructor.
     */
    public function __construct() {
        $this->middleware('auth:web')->except(['index', 'show']);
    }
    
    /**
     * Get all films.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function index() {
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', url('/api/films'), [
                'headers' => [
                        'Accept' => 'application/json',
                        'Content-type' => 'application/json',
                ],
        ]);
        $films = json_decode($res->getBody()->getContents())->data;
        return view('films.index', compact('films'));
    }
    
    /**
     * Show a specific film.
     *
     * @param $film
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function show($film) {
        $client = new Client();
        $res = NULL;
        try {
            $res = $client->request('GET', url('/api/films/' . $film), [
                    'headers' => [
                            'Accept' => 'application/json',
                            'Content-type' => 'application/json',
                    ],
            ]);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $e->getResponse()->getStatusCode();
        }
        if ($res) {
            $film = json_decode($res->getBody()->getContents())->data;
            $ratings = NULL;
            $average = '';
            if (sizeof($film->ratings) > 0) {
                $ratings = sizeof($film->ratings);
                $average = $film->ratings[0]->average_rating;
            }
            $comments = $film->comments;
            
            return view('films.show', compact([
                    'film' => 'film',
                    'ratings' => 'ratings',
                    'average' => 'average',
                    'comments' => 'comments',
            ]));
        }
        return abort(404);
    }
    
    /**
     * Display the create form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        if (Auth::user()->isAdmin == TRUE) {
            $genres = Genre::all();
            return view('films.create', compact('genres'));
        }
        return redirect('/films');
        
    }
    
    public function store(Request $request) {
        if (Auth::user()->isAdmin == TRUE) {
            $validatedData = $request->validate([
                    'name' => 'required|max:255',
                    'description' => 'required',
                    'release_date' => 'required|date',
                    'country' => 'required',
                    'price' => 'required|numeric',
                    'photo' => 'required|url',
                    'genre' => 'required|array|min:1',
            ]);
            if (Film::whereSlug(str_slug($request->name))->count() === 0) {
                $slug = str_slug($request->name);
            }
            else {
                $slug = str_slug($request->name) . rand(1, 1000);
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
            
            return redirect('/films/' . $film->slug);
        }
        return redirect('/films');
    }
}
