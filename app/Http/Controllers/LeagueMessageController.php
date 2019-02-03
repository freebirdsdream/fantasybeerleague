<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\League;
use App\Mail\LeagueMessage;
use Illuminate\Support\Facades\Mail;
use Auth;
use App\User;

class LeagueMessageController extends Controller
{
    public function edit(Request $request, League $league)
    {
    	return view('league.message')
    		->with('league', $league);
    }

    public function update(Request $request, League $league)
    {
    	// check if we are including rules
    	if($request->input('rules')) {
    		$rules = $league->rules;
    	}
    	else {
    		$rules = false;
    	}

    	// get recipients
    	if($request->input('all_users')) {
    		$league->members->each(function($recipient) use($request, $league, $rules) {
				Mail::to($recipient->email)
					->bcc(Auth::user()->email)
					->send(new LeagueMessage($league, $request->input('subject'), $request->input('text'), Auth::user(), $rules));
    		});
    	}
    	else {
    		collect($request->input('recipients'))->each(function($recipient) use($request, $league, $rules) {
    			$recipient = User::find($recipient);
    			Mail::to($recipient->email)
    				->bcc(Auth::user()->email)
    				->send(new LeagueMessage($league, $request->input('subject'), $request->input('text'), Auth::user(), $rules));
    		});
    	}

    	return redirect(route('league.show', $league))
    		->with('message', 'Email sent!');
    }
}
