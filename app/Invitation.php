<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $guarded = ['id'];

    public function league()
    {
    	return $this->belongsTo('\App\League');
    }
}
