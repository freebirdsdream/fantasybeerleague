<?php

namespace App\Http\Controllers;

use App\Group;
use App\Season;
use App\User;
use Illuminate\Http\Request;

class GroupController extends Controller
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
            'season_id' => 'required',
            'name' => 'required'
        ]);

        Group::create([
            'name' => $request->input('name'),
            'season_id' => $request->input('season_id')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        return view('group.show')
            ->with('group', $group)
            ->with('season', $group->season)
            ->with('league', $group->season->league);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $season_id
     * @return \Illuminate\Http\Response
     */
    public function edit($season_id)
    {
        $season = Season::find($season_id);

        return view('group.edit')
            ->with('season', $season);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        foreach($request->input('members') as $member) {
            if($request->has('leaders') && in_array($member, $request->input('leaders'))) {
                $group->members()->attach($member, ['leader' => true]);
            }
            else {
                $group->members()->attach($member);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        //
    }
}
