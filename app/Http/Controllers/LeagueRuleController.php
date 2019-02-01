<?php

namespace App\Http\Controllers;

use App\LeagueRule;
use Illuminate\Http\Request;
use App\League;
use Auth;

class LeagueRuleController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\LeagueRule  $leagueRule
     * @return \Illuminate\Http\Response
     */
    public function show(League $league)
    {
        return view('rules.show')
            ->with('rules', $league->rules);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\League  $league
     * @return \Illuminate\Http\Response
     */
    public function edit(League $league)
    {
        // create rules if they don't exist
        if(!$league->rules) {
            LeagueRule::create([
                'league_id' => $league->id,
                'edited_by' => Auth::user()->id
            ]);
            $league->load('rules');
        }

        return view('rules.edit')
            ->with('league', $league)
            ->with('rules', $league->rules);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LeagueRule  $leagueRule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, League $league)
    {
        $request->validate([
            'text' => 'required'
        ]);

        $league->rules->update([
            'text' => $request->input('text')
        ]);

        return redirect(route('league.show', $league));
    }
}
