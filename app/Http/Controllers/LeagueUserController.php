<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\League;
use App\User;

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

        $invitation = Invitation::where('email', $request->input('email'))
            ->where('id', $request->input('invitation'))
            ->first();

        if($invitation) {
            $league->members()->attach(Auth::user(), ['roles' => json_encode(['user'])]);
            /*
            return redirect(route('league.show', ['league' => $league]))
                ->with('message', 'You have joined ' . $league->name);
            */  
        }
        else {
            //
        }

        dd('complete');
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
