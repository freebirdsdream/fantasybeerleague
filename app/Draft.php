<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Draft extends Model
{
    protected $guarded = ['id'];

    public function season()
    {
    	return $this->belongsTo('\App\Season');
    }

    public function users()
    {
    	return $this->belongsToMany('\App\User', 'user_draft')->withPivot('order', 'group_id');
    }

    public function round($group)
    {
    	return $this->groups
			->filter(function($draftGroup) use($group) {
				return $draftGroup->name == $group;
			})->first()->pivot->round;
    }

    public function draftList()
    {
        return $this->users
        	->groupBy(function($member) {
        		return $member->pivot->group_id;
        	})->mapWithKeys(function($groupList, $groupId) {
        		return [Group::find($groupId)->name => $groupList->sortBy(function($member) {
                	return $member->pivot->order;
            	})];
        	});
    }

    public function groups()
    {
    	return $this->belongsToMany('\App\Group', 'draft_groups')->withPivot('user_id', 'round');
    }

    public function turn(User $user)
    {
    	return $this->groups
    		->filter(function($group) use($user) {
    			return $group->pivot->user_id == $user->id;
    		})->count() > 0;
    }

    public function breweries()
    {
    	return $this->belongsToMany('\App\Brewery', 'user_brewery')->withPivot('user_id', 'season_id');
    }

    public function brewery($userId, $seasonId, $round)
    {
    	$breweries = $this->breweries()
    		->where('user_id', $userId)
    		->where('season_id', $seasonId)
    		->orderBy('id', 'asc')
    		->get();

		if(isset($breweries[$round - 1])) {
			return $breweries[$round - 1];
		}
		else {
			return false;
		}
    }
}
