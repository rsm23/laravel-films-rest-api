<?php

namespace App\Http\Controllers;

class FilmsController extends Controller {
    
    public function index() {
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', url('/api/films'), [
                'headers' => [
                        'Accept' => 'application / json',
                        'Content - type' => 'application / json',
                ],
        ]);
        $films = json_decode($res->getBody()->getContents())->data;
        return view('films.index', compact('films'));
    }
    
    public function show($film) {
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', url('/api/films/' . $film), [
                'headers' => [
                        'Accept' => 'application / json',
                        'Content - type' => 'application / json',
                ],
        ]);
        $film = json_decode($res->getBody()->getContents())->data;
        $ratings = null;
        $average = '';
        if (sizeof($film->ratings) > 0) {
            $ratings = sizeof($film->ratings);
            $average = $film->ratings[0]->average_rating;
        }
        return view('films.show', compact([
                'film' => 'film',
                'ratings' => 'ratings',
                'average' => 'average',
        ]));
    }
}
