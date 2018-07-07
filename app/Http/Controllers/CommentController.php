<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Film;
use App\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct() {
        $this->middleware('auth:web');
    }
    
    public function store(Film $film, Request $request) {
    
        $validatedData = $request->validate([
                'comment' => 'required|max:255',
        ]);
        
        Comment::create([
                'user_id' => auth()->id(),
            'film_slug' => $film->slug,
                'body' => $request->comment
        ]);
        return back();
    }
}
