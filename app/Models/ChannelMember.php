<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Spatie\Permission\Traits\HasRoles;

class ChannelMember extends Pivot
{
    use HasFactory, HasRoles;

    protected $table = 'channel_members';

    public $incrementing = true;

    protected $with = ['roles'];
}
