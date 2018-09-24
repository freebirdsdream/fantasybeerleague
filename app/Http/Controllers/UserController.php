<?php

namespace App\Http\Controllers;

use App\User;
use App\Event;
use Auth;
use Illuminate\Http\Request;

class UserController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if($request->has('role-name') || $request->has('role-target')) {
            $request->validate([
                'role-name' => 'required',
                'role-target' => 'required'
            ]);

            $user->assignRole([$request->input('role-name')], League::find($target));
        }
    }

    public function attendance(Request $request, Event $event) 
    {
        $event->users()
            ->attach(Auth::user(), ['attending' => $request->input('attending')]);

        return redirect('/event/' . $event->id);
    }

    public function beer(Request $request, Event $event)
    {
        $brewery = Brewery::firstOrCreate(
            [
                'untappd_id' => $request->input('brwery_id')
            ],
            [
                'name' => $request->input('brweery_name')
            ]
        );
        
        $beer = Beer::firstOrCreate(
            [
                'untappd_id' => $request->input('beer_id')
            ],
            [
                'brewery_id' => $brewery->id,
                'name' => $request->input('beer_name'),
                'genre' => '',
                'sub_genre' => ''
            ]
        );

        Auth::user()
            ->beer()
            ->attach($beer, ['event_id', $event->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
