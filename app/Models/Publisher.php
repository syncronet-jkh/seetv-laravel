<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publisher extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        parent::booted();

        static::saving(static function (Publisher $publisher) {
            $publisher->slug = Str::slug($publisher->name);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function emails()
    {
        return $this->hasMany(Email::class);
    }

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }

    public function channels()
    {
        return $this->hasMany(Channel::class);
    }

    public function members()
    {
        return $this
            ->belongsToMany(User::class, PublisherMembership::class)
            ->using(PublisherMembership::class);
    }

    public function addMember(User $user)
    {
        return PublisherMembership::create([
            'publisher_id' => $this->id,
            'user_id' => $user->id
        ]);
    }

    public function hasMember(User $user): bool
    {
        return $this->members()->where('user_id', $user->getKey())->exists();
    }

    public function hasChannel(Channel $channel): bool
    {
        return $this->channels()->whereKey($channel->getKey())->exists();
    }
}
