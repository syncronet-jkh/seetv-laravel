<?php

namespace App\Policies;

use App\Models\Broadcast;
use App\Models\Channel;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use function dd;

class BroadcastPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Broadcast  $broadcast
     * @return mixed
     */
    public function view(User $user, Broadcast $broadcast)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Channel $channel
     * @return mixed
     */
    public function create(User $user, Channel $channel)
    {
        if (!$channel->hasMember($user)) {
            return $this->deny('Must be a channel member to create a broadcast.');
        }

        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Broadcast  $broadcast
     * @return mixed
     */
    public function update(User $user, Broadcast $broadcast)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Broadcast  $broadcast
     * @return mixed
     */
    public function delete(User $user, Broadcast $broadcast)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Broadcast  $broadcast
     * @return mixed
     */
    public function restore(User $user, Broadcast $broadcast)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Broadcast  $broadcast
     * @return mixed
     */
    public function forceDelete(User $user, Broadcast $broadcast)
    {
        //
    }
}
