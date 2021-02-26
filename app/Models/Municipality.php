<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Municipality extends Model
{
    use HasFactory, Searchable, QueryCacheable;

    protected $guarded = [];

    /**
     * Invalidate the cache automatically
     * upon update in the database.
     *
     * @var bool
     */
    protected static $flushCacheOnUpdate = true;


    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function postalCodes()
    {
        return $this->hasMany(PostalCode::class);
    }

    public function channels()
    {
        return $this->hasMany(Channel::class);
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $this->loadMissing('region', 'postalCodes');

        return [
            'name' => $this->name,
            'region' => $this->region->name,
            'postalCodes' => $this->postalCodes->pluck('number')->implode(',')
        ];
    }
}
