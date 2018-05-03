<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reading;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReadingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the reading.
     *
     * @param  \App\User  $user
     * @param  \App\Reading  $reading
     * @return mixed
     */
    public function view(User $user, Reading $reading)
    {
        return TRUE;
    }

    /**
     * Determine whether the user can create readings.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return FALSE;
    }

    /**
     * Determine whether the user can update the reading.
     *
     * @param  \App\User  $user
     * @param  \App\Reading  $reading
     * @return mixed
     */
    public function update(User $user, Reading $reading)
    {
        return FALSE;
    }

    /**
     * Determine whether the user can delete the reading.
     *
     * @param  \App\User  $user
     * @param  \App\Reading  $reading
     * @return mixed
     */
    public function delete(User $user, Reading $reading)
    {
        return FALSE;
    }
}
