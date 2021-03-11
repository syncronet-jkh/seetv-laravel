<?php

namespace App\Models;

use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;

/**
 * Class Broadcast
 * @package App\Models
 * @mixin Builder
 *
 * @method static static startingSoon()
 * @method static static startingAt($datetime)
 * @method static static planned()
 * @method static static historical()
 * 
 * @property Carbon $starts_at
 * @property Carbon $ends_at
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
        $datetime = Date::parse($datetime);

        $query->where(function ($query) use ($datetime) {
            $query
                ->where('starts_at', '>=', $datetime->setSeconds(0)->toDateTimeString())
                ->where('starts_at', '<=', $datetime->setSeconds(59)->toDateTimeString());
        });
    }

    public function scopePlanned($query)
    {
        $query->where('starts_at', '>=', now()->toDateTimeString());
    }

    public function scopeHistorical($query)
    {
        $query->where('starts_at', '<=', now()->toDateTimeString());
    }

    public function getDurationAttribute(): array
    {
        return [
            'hours' => $this->starts_at->diffInRealHours($this->ends_at),
            'minutes' => $this->starts_at->diffInRealMinutes($this->ends_at),
            'seconds' => $this->starts_at->diffInRealSeconds($this->ends_at)
        ];
    }

    public function channelMember()
    {
        return $this->belongsTo(ChannelMember::class);
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}
