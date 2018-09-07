<?php

namespace App\Policies;

use App\User;
use App\League;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeaguePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the league.
     *
     * @param  \App\User  $user
     * @param  \App\League  $league
     * @return mixed
     */
    public function view(User $user, League $league)
    {
        //
    }

    /**
     * Determine whether the user can create leagues.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the league.
     *
     * @param  \App\User  $user
     * @param  \App\League  $league
     * @return mixed
     */
    public function update(User $user, League $league)
    {
        // if the current logged in user is the owner we're ok
        if($league->owner($user)) {
            return true;
        }

        // otherwise check for editable roles
        $roles = $user->leagues
            ->filter(function($pivot) use($league) {
                return $pivot->id == $league->id;
            })->first()->pivot->roles;
        $roles = json_decode($roles);

        return in_array("admin", $roles);
    }

    /**
     * Determine whether the user can delete the league.
     *
     * @param  \App\User  $user
     * @param  \App\League  $league
     * @return mixed
     */
    public function delete(User $user, League $league)
    {
        //
    }
}
