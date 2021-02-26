<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function owner()
    {
        return $this->user();
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function broadcasts()
    {
        return $this->hasMany(Broadcast::class);
    }

    public function members()
    {
        return $this->hasMany(ChannelMember::class);
    }
}
