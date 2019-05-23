<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $guarded = ['id'];

    public function style()
    {
        return $this->belongsToMany('App\Style');
    }
}
