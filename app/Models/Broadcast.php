<?php

namespace App\Models;

use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

/**
 * Class Broadcast
 * @package App\Models
 * @mixin Builder
 *
 * @method static static startingSoon()
 * @method static static startingAt($datetime)
 */
class Broadcast extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime'
    ];

    /**
     * Filter broadcasts that's currently scheduled to be on air
     *
     * @param Builder $query
     */
    public function scopeStartingSoon($query)
    {
        $this->scopeStartingAt($query, $this->freshTimestamp());
    }

    public function scopeStartingAt($query, $datetime)
    {
        $datetime = Date::make($datetime);

        $query->where('starts_at', '>=', $datetime->setSeconds(0)->toDateTimeString());
    }

    public function getDurationAttribute(): int
    {
        return $this->starts_at->diffInSeconds($this->ends_at);
    }

    public function channelMember()
    {
        return $this->belongsTo(ChannelMember::class);
    }

    public function channel()
    {
        return $this->hasOneThrough(Channel::class, ChannelMember::class);
    }
}
