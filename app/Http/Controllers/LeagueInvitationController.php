<?php

namespace App\Http\Controllers;

use App\LeagueInvitation;
use App\League;
use App\User;
use Illuminate\Http\Request;
use Auth;
use App\Mail\LeagueInvitation as LeagueInvitationMail;
use Illuminate\Support\Facades\Mail;

class LeagueInvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'league_id' => 'required'
        ]);

        // check that user doesn't already exist
        $league = League::find($request->input('league_id'));
        if(
            $league->members()->pluck('email')->search($request->input('email')) !== false
        ) {
            return redirect(route('league.show', ['league' => $league]))
                ->with('message', 'User is already a part of this league')
                ->with('status', 'error');
        }

        // create
        $invitation = LeagueInvitation::create([
            'email' => $request->input('email'),
            'league_id' => $request->input('league_id')
        ]);

        // send email
        $league = League::find($request->input('league_id'));
        /*
         * @TODO enable this later
        Mail::to($request->input('email'))
            ->send(new LeagueInvitationMail($league, $invitation));
        */

        return redirect(route('league.show', ['league' => $league]))
            ->with('message', 'Invitation sent to ' . $request->input('email'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LeagueInvitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, LeagueInvitation $invitation)
    {
        $request->validate([
            'hash' => 'required',
            'email' => 'required'
        ]);

        if($invitation->league->hash == $request->input('hash') && $invitation->email == $request->input('email')) {
            // invitation is valid
            $invitation->league->members()->attach(Auth::user(), ['roles' => json_encode(['user'])]);
            $invitation->delete();
        } else {
            dd('not a valid invitation');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LeagueInvitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function edit(LeagueInvitation $invitation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LeagueInvitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeagueInvitation $invitation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LeagueInvitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeagueInvitation $invitation)
    {
        //
    }
}
