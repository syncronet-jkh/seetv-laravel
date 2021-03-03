<?php

namespace App\Models;

use App\Concerns\HasCachedConstants;
use function __;
use function array_key_exists;

/**
 * Class Role
 * @package App\Models
 *
 * @method static static VIEWER()
 * @method static static STREAMER()
 * @method static static PUBLISHER()
 * @method static static ADMIN()
 */
class Role extends \Spatie\Permission\Models\Role
{
    use HasCachedConstants;

    const VIEWER = 'Viewer';
    const DISTRIBUTOR = 'Distributor';
    const PUBLISHER = 'Publisher';
    const ADMIN = 'Admin';

    public static function __callStatic($method, $parameters)
    {
        $constants = static::getConstants();

        if (array_key_exists($method, $constants)) {
            return static::findByName($constants[$method]);
        }

        return parent::__callStatic($method, $parameters);
    }

    public function getLocaleNameAttribute()
    {
        return $this->toLocaleName();
    }

    public function toLocaleName($locale = null)
    {
        return __("role.{$this->name}", [], $locale);
    }
}
