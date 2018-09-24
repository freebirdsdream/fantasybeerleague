<?php

namespace App\Http\Controllers;

use Auth;
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
        //$event->start();

        // determine status of event and handle appropriately 
        // check if user is attending event
        //    if not set, ask if attending or needs sub
        if(Auth::user()->attending($event) === null) {
            $attendanceCheck = true;
        }
        else {
            $attendanceCheck = false;
        }
        // check if user has beer
        //    if not, set beer
        if(Auth::user()->attending($event)) {
            if(Auth::user()->beer()->where('event_id', $event->id)->first()) {
                $beerCheck = false;
            }
            else {
                $beerCheck = true;
            }
        }
        // check if event has started
        //    if not, show message
        //    if is admin and not started, allow to manually start, will auto-start at right time
        // start
        //    assign groups
        //    set status as "pouring"
        // pour
        //    set status as "drinking"
        // drink
        //    page auto-shows score card to rate beers
        // admin can "end" event manually, auto-ends when all scores are in.
        // event ended
        //    show final scores
        //    allow admin to toggle beers showing/hidden (default hidden)

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
            ->with('season', $event->group->season)
            ->with('attendanceCheck', $attendanceCheck)
            ->with('beerCheck', $beerCheck);
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

    public function score(Event $event)
    {
        $tastingGroups = $event->tastingGroups
            ->filter(function($tastingGroup) {
                return $tastingGroup->players->pluck('id')->search(Auth::user()->id) === false;
            });

        return view('event.enterScores')
            ->with('event', $event)
            ->with('tastingGroups', $tastingGroups);
    }
}
