<?php

namespace App\Policies\My;

use App\User;
use App\Models\Motel;
use Illuminate\Auth\Access\HandlesAuthorization;

class MotelPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any motels.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the motel.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Motel  $motel
     * @return mixed
     */
    public function view(User $user, Motel $motel)
    {
        return $user->id === $motel->user_id;
    }

    /**
     * Determine whether the user can create motels.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        
    }

    /**
     * Determine whether the user can update the motel.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Motel  $motel
     * @return mixed
     */
    public function update(User $user, Motel $motel)
    {
        return $user->id === $motel->user_id;
    }

    /**
     * Determine whether the user can delete the motel.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Motel  $motel
     * @return mixed
     */
    public function delete(User $user, Motel $motel)
    {
        return $user->id === $motel->user_id;
    }

    /**
     * Determine whether the user can restore the motel.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Motel  $motel
     * @return mixed
     */
    public function restore(User $user, Motel $motel)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the motel.
     *
     * @param  \App\User  $user
     * @param  \App\Models\Motel  $motel
     * @return mixed
     */
    public function forceDelete(User $user, Motel $motel)
    {
        //
    }
}
