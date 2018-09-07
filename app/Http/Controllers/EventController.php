<?php

namespace App\Http\Controllers;

use App\Event;
use App\Group;
use Illuminate\Http\Request;

class EventController extends Controller
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
    public function create(Request $request)
    {
        return view('event.create')
            ->with('group', Group::find($request->input('group_id')));
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
            'address' => 'required',
            'starts_at' => 'required',
            'group_id' => 'required'
        ]);

        Event::create([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'started_at' => date('Y-m-d H:i:s', strtotime($request->input('starts_at'))),
            'group_id' => $request->input('group_id')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $tastingGroups = $event->tastingGroups->map(function($group) {
            $group->scores = $group->scores
                ->groupBy('beer_id')
                ->sortBy(function($row) {
                    return($row->sum('rating'));
                })->values();

            return $group;
        });

        return view('event.show')
            ->with('event', $event)
            ->with('tastingGroups', $tastingGroups)
            ->with('season', $event->group->season);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
