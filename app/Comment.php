<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
    
    protected $fillable = [
            'user_id',
            'film_slug',
            'body',
    ];
    
    /**
     * A comment belongs to a film.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function film() {
        return $this->belongsTo(Film::class, 'film_slug');
    }
    
    /**
     * A comment belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
