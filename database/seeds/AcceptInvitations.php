<?php

use Illuminate\Database\Seeder;
use App\Invitation;
use App\User;

class AcceptInvitations extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Invitation::all()
    		->each(function($invitation) {
    			// invitation is valid
    			$user = User::where('email', $invitation->email)->first();
	            $invitation->league->members()->attach($user, ['roles' => json_encode(['user'])]);
	            $invitation->delete();
    		});
    }
}
