<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Untappd;

class UntappdController extends Controller
{
    public function brewery(Request $request, $term)
    {
    	$untappd = new Untappd('search/brewery');
    	return collect($untappd->brewery($term)->response->brewery->items)
    			->map(function($brewery) {
    				return ['brewery_id' => $brewery->brewery->brewery_id, 'brewery_name' => $brewery->brewery->brewery_name];
    			})->toJSON();
    }
}
