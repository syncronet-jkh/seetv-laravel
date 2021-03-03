<?php

namespace App\Concerns;

use ReflectionClass;
use function in_array;
use function tap;

trait HasCachedConstants
{

    protected static array $constCache = [];

    public static function getConstants(): array
    {
        if (array_key_exists(static::class, static::$constCache)) {
            return static::$constCache[static::class];
        }

        $reflection = new ReflectionClass(static::class);

        return tap(
            array_filter($reflection->getConstants(), fn($const) => !in_array($const, [static::CREATED_AT, static::UPDATED_AT])),
            fn(array $constants) => static::$constCache[static::class] = $constants
        );
    }
}
