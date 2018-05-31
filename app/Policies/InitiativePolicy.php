<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Initiative;
use Illuminate\Auth\Access\HandlesAuthorization;

class InitiativePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the initiative.
     *
     * @param  \App\User  $user
     * @param  \App\Initiative  $initiative
     * @return mixed
     */
    public function view()
    {
        return TRUE;
    }

    /**
     * Determine whether the user can create initatives.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the initiative.
     *
     * @param  \App\User  $user
     * @param  \App\Initiative  $initiative
     * @return mixed
     */
    public function update(User $user, Initiative $initiative)
    {
        return $user->id == $initiative->user_id;
    }

    /**
     * Determine whether the user can delete the initiative.
     *
     * @param  \App\User  $user
     * @param  \App\Initiative  $initiative
     * @return mixed
     */
    public function delete(User $user, Initiative $initiative)
    {
        return $user->id == $initiative->user_id;
    }
}
