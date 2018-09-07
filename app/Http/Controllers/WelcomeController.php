<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class WelcomeController extends Controller
{
	/**
	 * homepage
	 */
    public function index(Request $request)
    {
    	return view('welcome')
    		->with('leagues', Auth::user()->leagues);
    }
}
