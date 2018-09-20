<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\League;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function leagues()
    {
        return $this->belongsToMany('\App\League', 'user_league')
            ->withPivot('roles');
    }

    public function drafts()
    {
        return $this->belongsToMany('\App\Draft', 'user_draft')->withPivot('order');
    }

    public function breweries()
    {
        return $this->belongsToMany('\App\Brewery', 'user_brewery')->withPivot('season_id', 'draft_id');
    }

    public function groups()
    {
        return $this->belongsToMany('\App\Group', 'user_group');
    }

    public function admin(League $league)
    {
        if(!$this->roles) {
            return false;
        }
        else {
            $roles = collect(json_decode($this->roles));
            return $roles['admin']->search($league->id);
        }
    }

    public function event()
    {
        return $this->players->map(function($player) {
            return $player->group
                ->events()
                ->where('started_at', '<=', date('Y-m-d H:i:s'))
                ->where(function($query) {
                    $query->where('ended_at', '>=', date('Y-m-d H:i:s'))
                        ->orWhereNull('ended_at');
                })->first();
        })->first();
    }

    public function tastingGroup()
    {
        return $this->belongsToMany('\App\TastingGroup')->withPivot('glass');
    }

    public function assignRole($roles, $targetLeague)
    {
        $leagueRoles = $this->leagues
            ->filter(function($league) use($targetLeague) {
                return $league->id == $targetLeague->id;
            })->first();

        if(!$leagueRoles) {
            $leagueRoles = $roles;
            $this->leagues()->save($targetLeague, ['roles' => json_encode($leagueRoles)]);
        }
        else {
            $leagueRoles = json_decode($leagueRoles->pivot->roles);

            if(!in_array(strtolower($role), $leagueRoles)) {
                $leagueRoles = array_merge($leagueRoles, $roles);
                $this->leagues()->updateExistingPivot($targetLeague, ['roles' => json_encode($leagueRoles)]);
            }
        }
    }
}
