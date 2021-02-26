<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Feature
 * @package App\Models
 * @mixin Builder
 *
 * @method static static enabled()
 * @method static static disabled()
 */
class Feature extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeEnabled($query): void
    {
        $query->where('enabled', true);
    }

    public function scopeDisabled($query): void
    {
        $query->where('enabled', false);
    }

    public function model()
    {
        return $this->morphTo();
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
}
