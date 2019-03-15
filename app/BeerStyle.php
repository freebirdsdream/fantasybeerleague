<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BeerStyle extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getBrewersAssociationAttribute($value)
    {
    	return collect(json_decode($value));
    }
}
