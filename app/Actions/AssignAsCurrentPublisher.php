<?php

namespace App\Actions;

use App\Models\User;
use App\Models\Publisher;

class AssignAsCurrentPublisher
{
    public function assign(User $user, Publisher $publisher): User
    {
        $user->currentPublisher()->associate($publisher);

        $user->saveOrFail();

        return $user;
    }
}
