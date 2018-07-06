<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    
    /**
     * A rating belongs to a film.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function film() {
        return $this->belongsTo(Film::class);
    }
}
