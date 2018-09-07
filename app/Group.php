<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = ['id'];
    
    public function season() {
        return $this->belongsTo('\App\Season');
    }

    public function events()
    {
        return $this->hasMany('\App\Event');
    }

    public function members()
    {
        return $this->belongsToMany('\App\User', 'user_group')
            ->withPivot('leader');
    }

    public function rank($beer)
    {
        return $this->season->beer()
            ->map(function($beer) {
                $beer->score = $beer->score($this->events->pluck('id'));
                return $beer;
            })->sortBy('score')
            ->pluck('id')
            ->values()
            ->search($beer->id) + 1;
    }
}
