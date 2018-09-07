<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\User;

class League extends Model
{
	protected $guarded = ['id'];
	
    public function currentSeason()
    {
        return $this->hasMany('\App\Season')
            ->orderBy('number', 'desc')
            ->limit(1);
    }

    public function seasons()
    {
    	return $this->hasMany('\App\Season')
    		->orderBy('number', 'asc');
    }

    public function invitations()
    {
    	return $this->hasMany('\App\Invitation');
    }

    public function owner(User $user)
    {
        return $user->id == $this->created_by;
    }

    public function members()
    {
    	return $this->belongsToMany('\App\User', 'user_league')
            ->withPivot('roles');
    }
}
