<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Channel;
use App\Models\User;

class AssignAsCurrentChannel
{
    public function assign(User $user, Channel $channel): User
    {
        $user->currentChannel()->associate($channel);

        $user->saveOrFail();

        return $user;
    }
}
