<?php

namespace App\Policies;

use App\User;
use App\Station;
use Illuminate\Auth\Access\HandlesAuthorization;

class stationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the station.
     *
     * @param  \App\User  $user
     * @param  \App\Station  $station
     * @return mixed
     */
    public function view(User $user, Station $station)
    {
        //
    }

    /**
     * Determine whether the user can create stations.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the station.
     *
     * @param  \App\User  $user
     * @param  \App\Station  $station
     * @return mixed
     */
    public function update(User $user, Station $station)
    {
        //
    }

    /**
     * Determine whether the user can delete the station.
     *
     * @param  \App\User  $user
     * @param  \App\Station  $station
     * @return mixed
     */
    public function delete(User $user, Station $station)
    {
        //
    }
}
