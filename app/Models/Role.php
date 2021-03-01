<?php

namespace App\Models;

use ReflectionClass;
use function __;
use function array_key_exists;
use function tap;

/**
 * Class Role
 * @package App\Models
 *
 * @method static static VIEWER()
 * @method static static PUBLISHER()
 * @method static static DISTRIBUTOR()
 * @method static static ADMIN()
 */
class Role extends \Spatie\Permission\Models\Role
{
    protected static array $constCache = [];

    const VIEWER = 'Viewer';
    const STREAMER = 'Publisher';
    const DISTRIBUTOR = 'Distributor';
    const ADMIN = 'Admin';

    public static function __callStatic($method, $parameters)
    {
        $constants = static::getConstants();

        if (array_key_exists($method, $constants)) {
            return static::findByName($constants[$method]);
        }

        return parent::__callStatic($method, $parameters);
    }

    public static function getConstants(): array
    {
        if (array_key_exists(static::class, static::$constCache)) {
            return static::$constCache[static::class];
        }

        $reflection = new ReflectionClass(static::class);

        return tap(
            $reflection->getConstants(),
            fn (array $constants) => static::$constCache[static::class] = $constants
        );
    }

    public function toLocaleName($locale = null)
    {
        return __("role.{$this->name}", [], $locale);
    }
}
