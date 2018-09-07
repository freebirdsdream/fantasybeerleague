<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    protected $guarded = ['id'];

    public function brewery()
    {
        return $this->belongsTo('\App\Brewery');
    }

    public function player()
    {
        return $this->belongsToMany('\App\Player', 'player_beer');
    }

    public function score($events)
    {
        return $this->hasMany('\App\Rating')
            ->whereIn('event_id', $events)
            ->sum('rating');
    }
}
