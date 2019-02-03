<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeagueInvitation extends Model
{
    protected $guarded = ['id'];

    public function league()
    {
    	return $this->belongsTo('\App\League', 'league_id', 'id');
    }
}
