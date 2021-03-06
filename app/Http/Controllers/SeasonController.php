<?php

namespace App\Http\Controllers;

use App\Beer;
use App\Season;
use App\League;
use App\BeerStyle;
use App\Survey;
use Illuminate\Http\Request;
use Auth;

class SeasonController extends Controller
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
        $styles = BeerStyle::all()->sortBy('style');
        return view('season.create')
            ->with('league', League::find($request->input('league_id')))
            ->with('styles', $styles);
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
            'league_id' => 'required'
        ]);

        $seasons = Season::where('league_id', $request->input('league_id'))
            ->orderBy('number', 'desc')
            ->get();
        if($seasons->count()) {
            $season = $seasons->first()->number + 1;
        }
        else {
            $season = 1;
        }

        $season = Season::create([
            'league_id' => $request->input('league_id'),
            'number' => $season
        ]);

        // create surveys
        $survey = Survey::create([
            'season_id' => $season->id,
            'days' => json_encode($request->input('days')),
            'times' => json_encode($request->input('times')),
            'start_date' => date('Y-m-d', strtotime($request->input('start_date'))),
            'end_date' => date('Y-m-d', strtotime($request->input('end_date'))),
            'created_by' => Auth::user()->id
        ]);

        // map and create styles
        foreach($request->input('styles') as $style) {
            if(BeerStyle::find($style)) {
                // attach
                $survey->style()->attach(BeerStyle::find($style));
            } else {
                // create and attach
                $style = BeerStyle::create(['style' => $style]);
                $survey->style()->attach($style->id);
            }
        }

        return redirect(route('league.show', ['league' => $request->input('league_id')]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function show(Season $season)
    {
        return view('season.show')
            ->with('season', $season)
            ->with('league', $season->league);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function edit(Season $season)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Season $season)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function destroy(Season $season)
    {
        //
    }
}
