<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\League;
use App\User;
use App\LeagueInvitation;
use Auth;
use DB;

class LeagueUserController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, League $league)
    {
        $request->validate([
            'invitation' => 'required|integer',
            'email' => 'required'
        ]);

        $invitation = LeagueInvitation::where('email', $request->input('email'))
            ->where('id', $request->input('invitation'))
            ->first();

        // check that user doesn't already exist in league
        $league = $invitation->league;
        if(
            $league->members->pluck('id')->search(Auth::user()->id) !== false
        ) {
            return redirect(route('league.show', ['league' => $league]))
                ->with('message', 'You are already a part of this league')
                ->with('status', 'error');
        }

        if($invitation) {
            $league->members()->attach(Auth::user(), ['roles' => json_encode(['user'])]);
            return redirect(route('league.show', ['league' => $league]))
                ->with('message', 'You have joined ' . $league->name);
        }
        else {
            abort(401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, League $league, User $user)
    {
        $league->members()->detach($user, ['roles' => json_encode(['user'])]);

        return redirect(route('league.show', ['league' => $league]));
    }
}
