<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use function blank;

class Channel extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        parent::booted();

        static::creating(static function (Channel $channel) {
            if (blank($channel->stream_key)) {
                $channel->stream_key = (string)Uuid::uuid4();
            }
        });
    }

    public function owner()
    {
        return $this->user();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Plan
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Publisher
     */
    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo|Municipality
     */
    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|Broadcast
     */
    public function broadcasts()
    {
        return $this->hasMany(Broadcast::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|ChannelMember
     */
    public function members()
    {
        return $this->hasMany(ChannelMember::class);
    }

    public function addMember(User $user, ?ChannelReferralLink $channelReferralLink = null)
    {
        return ChannelMember::create([
            'channel_id' => $this->id,
            'user_id' => $user->id,
            'plan_id' => $this->plan_id,
            'channel_referral_link_id' => optional($channelReferralLink)->id
        ]);
    }

    public function hasMember(User $user): bool
    {
        return $this->members()->where('user_id', $user->getKey())->exists();
    }

    public function getIngestURLAttribute()
    {
        return "rtmp://rtmp.seetv.dk/show/{$this->stream_key}";
    }

    public function getStreamURLAttribute()
    {
        return "https://rtmp.seetv.dk/hls/{$this->stream_key}.m3u8";
    }

    public function hasOverlappingBroadcasts(Broadcast $broadcast): bool
    {
        return $this->broadcasts()
            ->where('starts_at', '>=', $broadcast->starts_at)
            ->where('ends_at', '<=', $broadcast->ends_at)
            ->exists();
    }
}
