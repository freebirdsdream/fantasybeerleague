<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $guarded = ['id'];
    
    public function user()
    {
        return $this->belongsTo('\App\User');
    }

    public function name()
    {
        return $this->user->name;
    }

    public function group()
    {
        return $this->belongsTo('\App\Group');
    }

    public function beers()
    {
        return $this->belongsToMany('\App\Beer', 'player_beer');
    }

    public function tastingGroup()
    {
        return $this->user->event()->tastingGroups->filter(function($tastingGroup) {
            return $tastingGroup->players->where('user_id', $this->user->id)->count();
        })->first();
    }

    public function glass()
    {
        return $this->tastingGroup()
            ->players
            ->filter(function($player) {
                return $player->id == $this->id;
            })->first()->pivot->glass;
    }

    public function otherTastingGroups()
    {
        return Auth::user()->event()->tastingGroups->filter(function($tastingGroup) {
            return $tastingGroup->players->where('user_id', Auth::user()->id)->count() == 0;
        });
    }

    public function score() {
        return Rating::whereIn('beer_id', $this->beers->pluck('id'))->sum('rating');
    }

    public function rank() {
        $rank = Player::where('group_id', $this->group->id)
            ->get()
            ->map(function($player) {
                $player->score = $player->score();

                return $player;
            })->sortBy('score')
            ->values()
            ->where('id', $this->id)
            ->keys()
            ->first();

        return $rank + 1;
    }
}
