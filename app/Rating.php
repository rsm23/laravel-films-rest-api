<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model {
    
    protected $fillable = [
            'user_id',
            'film_id',
            'rating',
    ];
    
    /**
     * A rating belongs to a film.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function film() {
        return $this->belongsTo(Film::class);
    }
}
