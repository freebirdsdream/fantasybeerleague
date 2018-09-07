<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
	protected $guarded = ['id'];

	public function league()
	{
		return $this->belongsTo('\App\League');
	}

	public function groups()
	{
		return $this->hasMany('\App\Group');
	}

    public function beer()
    {
        return \App\Beer::all();
    }

    public function brewery()
    {
        return $this->hasMany('\App\Brewery');
    }

    public function draft()
    {
    	return $this->hasOne('\App\Draft');
    }
}
