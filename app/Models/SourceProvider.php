<?php

namespace App\Models;

use App\Concerns\HasCachedConstants;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class SourceProvider
 * @package App\Models
 * @mixin Builder
 *
 * @method static static Github()
 */
class SourceProvider extends Model
{
    const GITHUB = 'Github';

    use HasFactory, HasCachedConstants;

    protected $guarded = [];

    protected $casts = [
        'deployment_secret' => 'encrypted'
    ];

    public static function findByName(string $name)
    {
        return static::query()->where('name', $name)->firstOrFail();
    }

    public static function __callStatic($method, $parameters)
    {
        $constants = static::getConstants();

        if ($name = $constants[Str::upper($method)] ?? null) {
            return static::findByName($name);
        }

        return parent::__callStatic($method, $parameters);
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function deployments()
    {
        return $this->hasMany(Deployment::class);
    }
}
