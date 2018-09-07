<?php

namespace App\Http\Controllers;

use App\Brewery;
use App\Draft;
use App\Season;
use App\User;
use App\Group;
use Illuminate\Http\Request;
use App\Untappd;
use Auth;

class DraftController extends Controller
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
        return view('draft.create')
            ->with('season', Season::find($request->input('season_id')));
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
            'season_id' => 'required|int',
            'scheduled_start' => 'required',
            'scheduled_end' => 'required',
            'rounds' => 'required|integer',
        ]);

        $draft = Draft::create([
            'season_id' => $request->input('season_id'),
            'scheduled_start' => date('Y-m-d H:i:s', strtotime($request->input('scheduled_start'))),
            'scheduled_end' => date('Y-m-d H:i:s', strtotime($request->input('scheduled_end'))),
            'rounds' => $request->input('rounds')
        ]);

        // attach users
        Season::find($request->input('season_id'))
            ->groups
            ->each(function($group) use($request, $draft) {
                foreach($request->input('users-' . $group->id) as $order) {
                    $order = explode("-", $order);
                    $user = User::find($order[0]);
                    $order = $order[1];

                    $draft->users()->attach($user, ['order' => $order, 'group_id' => $group->id]);
                }
            });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Draft  $draft
     * @return \Illuminate\Http\Response
     */
    public function show(Draft $draft)
    {
        return view('draft.show')
            ->with('draft', $draft);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Draft  $draft
     * @return \Illuminate\Http\Response
     */
    public function edit(Draft $draft)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Draft  $draft
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Draft $draft)
    {
        if($request->has('start')) {
            $draft->started_at = date('Y-m-d H:i:s', time());
            $draft->season->groups->each(function($group) use($draft) {
                // make this draft-group?
                $draft->groups()->attach($group, ['user_id' => $draft->draftList()[$group->name]->first()->id, 'round' => 1]);
            });
            $draft->save();
        }
        else if($request->has('end')) {
            $draft->ended_at = date('Y-m-d H:i:s', time());
            $draft->save();
        }

        if($request->has('brewery')) {
            $untappd = new Untappd('brewery/info');
            $breweryInfo = $untappd->breweryInfo($request->input('brewery-id'));
            $brewery = Brewery::firstOrCreate(
                ['untappd_id' => $request->input('brewery-id')],
                [
                    'name' => $breweryInfo->brewery_name,
                    'city' => $breweryInfo->location->brewery_city,
                    'state' => ($breweryInfo->location->brewery_state) ? $breweryInfo->location->brewery_state : null,
                    'country' => $breweryInfo->country_name,
                    'untappd_url' => $breweryInfo->brewery_page_url,
                    'label' => ($breweryInfo->brewery_label) ? $breweryInfo->brewery_label : null,
                    'label_hd' => ($breweryInfo->brewery_label_hd) ? $breweryInfo->brewery_label_hd : null,
                ]);

            // check if brewery already selected in this user's draft group
            $exists = $draft->breweries
                ->filter(function($brewery) use($request) {
                    return $brewery->untappd_id == $request->input('brewery_id');
                })->count() > 0;
            if(!$exists) {
                // add user-brewery
                $draft->breweries()->attach($brewery, ['user_id' => Auth::user()->id, 'season_id' => $draft->season_id]);
                // incrememnt draft tracker
                $draft->users->each(function($user) use($draft) {
                    if($user->id == Auth::user()->id) {
                        $order = $user->pivot->order;
                        $group = $user->pivot->group_id;
                        $round = $user->pivot->round;

                        // get next user based on order
                        $user = $draft->users
                            ->filter(function($user) use($order) {
                                return $user->order == $order + 1;
                            })->first();
                        if(!$user) {
                            $order = 0;

                            $user = $draft->users
                                ->filter(function($user) use($order) {
                                    return $user->pivot->order == $order + 1;
                                })->first();
                            $round++;
                        }

                        $draft->groups()
                            ->updateExistingPivot($group, [
                                'user_id' => $user->id,
                                'round' => $round
                            ]);
                    }
                });
            }
            else {
                // throw exists error
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Draft  $draft
     * @return \Illuminate\Http\Response
     */
    public function destroy(Draft $draft)
    {
        //
    }
}
