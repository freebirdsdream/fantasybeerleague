<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = ['id'];
    
    public function group()
    {
        return $this->belongsTo('\App\Group');
    }

    public function players()
    {
        return $this->group->players;
    }

    public function player()
    {
        return $this->players()->where('user_id', Auth::user()->id)->first();
    }

    public function tastingGroups()
    {
        return $this->hasMany('\App\TastingGroup');
    }
}
