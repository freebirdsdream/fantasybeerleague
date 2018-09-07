<?php

namespace App\Console\Commands;

use App\Brewery;
use App\Player;
use Illuminate\Console\Command;

class fillData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:fill';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $events = \App\Event::orderBy('id', 'asc')->get();

        $events->each(function($event) {
            $this->info('Starting Week ' . $event->id . ':  ' . $event->name);

            $players = Player::where('group_id', 1)->get()
                ->each(function($player) use($event) {
                    $playerBeer = $this->ask('What beer did ' . $player->name() . ' bring?');
                    if($playerBeer) {
                        $breweryName = $this->ask('Who brewed it?');
                        $brewery = Brewery::where('name', $breweryName)->first();

                        $beer = \App\Beer::create([
                            'name' => $playerBeer,
                            'brewery_id' => $brewery->id,
                            'genre' => 'default'
                        ]);

                        // Map
                        \Illuminate\Support\Facades\DB::table('player_beer')
                            ->insert([
                                'player_id' => $player->id,
                                'beer_id' => $beer->id
                            ]);

                        $otherPlayers = Player::where('group_id', 1)->where('id', '<>', $player->id)->get()
                            ->each(function($competitor) use($beer, $event) {
                                $rating = $this->ask('How did ' . $competitor->name() . ' like it?');

                                \App\Rating::create([
                                    'beer_id' => $beer->id,
                                    'player_id' => $competitor->id,
                                    'event_id' => $event->id,
                                    'rating' => $rating
                                ]);
                            });
                    }
                });
            // Beer

            // Player

            // Rating

        });
    }
}
