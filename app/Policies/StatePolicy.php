<?php

namespace App\Policies;

use App\User;
use App\State;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the state.
     *
     * @param  \App\User  $user
     * @param  \App\State  $state
     * @return mixed
     */
    public function view(User $user, State $state)
    {
        return TRUE;
    }

    /**
     * Determine whether the user can create states.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return FALSE;
    }

    /**
     * Determine whether the user can update the state.
     *
     * @param  \App\User  $user
     * @param  \App\State  $state
     * @return mixed
     */
    public function update(User $user, State $state)
    {
        return FALSE;
    }

    /**
     * Determine whether the user can delete the state.
     *
     * @param  \App\User  $user
     * @param  \App\State  $state
     * @return mixed
     */
    public function delete(User $user, State $state)
    {
        return FALSE;
    }
}
