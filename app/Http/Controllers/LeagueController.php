<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\League;
use Hash;
use Auth;

class LeagueController extends Controller
{
    /**
     * Add Policy
     */
    public function __construct()
    {
        $this->authorizeResource(League::class, 'league');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('league.index')
            ->with('leagues', League::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('league.create');
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
            'name' => 'required',
            'location' => 'required',
            'description' => 'required',
            'user_id' => 'required|int'
        ]);

        $league = League::create([
            'name' => $request->input('name'),
            'location' => $request->input('location'),
            'description' => $request->input('description'),
            'hash' => Hash::make($request->input('name') . time() . rand(0,9999)),
            'created_by' => $request->input('user_id')
        ]);

        Auth::user()->assignRole(['admin', 'user'], $league);

        return redirect('/league');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(League $league)
    {    
        return view('league.show')
            ->with('league', $league);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(League $league)
    {
        return view('league.edit')
            ->with('league', $league);
    }

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
            'name' => 'required',
            'location' => 'required',
            'description' => 'required',
            'user_id' => 'required|int'
        ]);

        $league->update([
            'name' => $request->input('name'),
            'location' => $request->input('location'),
            'description' => $request->input('description'),
            'last_edited_by' => $request->input('user_id')
        ]);

        return redirect('/league/' . $league->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(League $league)
    {
        $league->delete();

        return redirect('/league')
            ->with('status', 'League "' . $league->name . '" deleted');
    }
}
