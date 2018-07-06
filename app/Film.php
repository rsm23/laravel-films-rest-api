<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model {
    protected $primaryKey = 'slug';
    protected $keyType = 'string';
    
    /**
     * A Film has many ratings.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ratings() {
        return $this->hasMany(Rating::class, '');
    }
    
    /**
     * A films belongs to many genres.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function genres() {
        return $this->belongsToMany(Genre::class, 'film_genre', 'film_slug', 'genre_id');
    }
}
