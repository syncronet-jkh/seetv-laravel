<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublisherStatus extends Model
{
    const ACTIVE = 'Active';
    const INACTIVE = 'Inactive';
    const SUSPENDED = 'Suspended';

    use HasFactory;

    protected $guarded = [];

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function infringements()
    {
        return $this->morphMany(Infringement::class, 'model');
    }
}
