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
        return $this->group->members;
    }

    public function player()
    {
        return $this->players()->where('user_id', Auth::user()->id)->first();
    }

    public function tastingGroups()
    {
        return $this->hasMany('\App\TastingGroup');
    }

    /**
     * Start a tasting event
     * This will begin the event by assigning players to tasting groups
     */
    public function start()
    {
        $firstTastingGroup = TastingGroup::create([
            'event_id' => $this->id,
            'name' => 'A'
        ]);

        $secondTastingGroup = TastingGroup::create([
            'event_id' => $this->id,
            'name' => 'B'
        ]);

        $this->players()
            ->shuffle()
            ->values()
            ->each(function($player, $index) use($firstTastingGroup, $secondTastingGroup) {
                $alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X','Y', 'Z'];

                if($index%2 == 0) {
                    $firstTastingGroup->players()->attach($player, ['glass' => $alphabet[$firstTastingGroup->players()->count()]]);
                }
                else {
                    $secondTastingGroup->players()->attach($player, ['glass' => $alphabet[$secondTastingGroup->players()->count()]]);
                }
            });
    }
}
