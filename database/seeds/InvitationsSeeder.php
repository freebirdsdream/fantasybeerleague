<?php

use Illuminate\Database\Seeder;
use App\Invitation;
use App\User;

class InvitationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::all()
            ->reject(function($user) {
                return $user->email == 'landry.jacob@gmail.com';
            })->each(function($user) {
        		Invitation::create([
		            'email' => $user->email,
		            'league_id' => 1
		        ]);
        	});
    }
}
