<?php

namespace App\Http\Controllers;

use App\Invitation;
use App\Player;
use Illuminate\Http\Request;
use Auth;

class InvitationController extends Controller
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

        // send email

        // create
        Invitation::create([
            'email' => $request->input('email'),
            'league_id' => $request->input('league_id')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Invitation $invitation)
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
     * @param  \App\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function edit(Invitation $invitation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invitation $invitation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invitation $invitation)
    {
        //
    }
}
