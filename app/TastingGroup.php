<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TastingGroup extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function players()
    {
        return $this->belongsToMany('\App\User', 'tasting_group_user')->withPivot('glass');
    }

    public function scores()
    {
        return $this->hasMany('\App\Rating');
    }
}
