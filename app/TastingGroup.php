<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TastingGroup extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function players()
    {
        return $this->belongsToMany('\App\Player', 'tasting_group_player')->withPivot('glass');
    }

    public function scores()
    {
        return $this->hasMany('\App\Rating');
    }
}
