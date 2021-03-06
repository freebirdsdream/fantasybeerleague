<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use App\User;

class League extends Model
{
    use SoftDeletes;
    
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
    	return $this->hasMany('\App\LeagueInvitation');
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

    public function rules()
    {
        return $this->hasOne('\App\LeagueRule');
    }
}
