<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $guarded = ['id'];

    public function beer()
    {
        return $this->belongsTo('\App\Beer');
    }

    public function tastingGroup()
    {
        return $this->belongsTo('\App\TastingGroup');
    }

    public function player()
    {
        return $this->belongsTo('\App\Player');
    }
}
