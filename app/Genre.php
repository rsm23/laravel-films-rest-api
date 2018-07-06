<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    
    /**
     * A genre could have many films.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function films() {
        return $this->belongsToMany(Film::class, 'film_genre', 'genre_id', 'film_id');
    }
}
