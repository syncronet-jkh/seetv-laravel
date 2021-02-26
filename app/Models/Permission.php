<?php

namespace App\Models;

use Illuminate\Support\Collection;
use ReflectionClass;
use function __;
use function is_numeric;
use function trans;

class Permission extends \Spatie\Permission\Models\Permission
{
    const AD_FREE = 'Ad free';
    const TV_GUIDE = 'TV Guide';
    const VIEW_CONTENT = 'View content';
    const FIFTY_VIEWERS = '50 Viewers';
    const TWO_HUNDRED_VIEWERS = '200 Viewers';
    const MORE_THAN_TWO_HUNDRED_VIEWERS = '200+ Viewers';
    const FIVE_HOURS_PER_MONTH = '5 hours per. month';
    const THIRTY_HOURS_PER_MONTH = '30 hours per. month';
    const STREAM_ALL_THE_TIME = 'Stream all the time';
    const EMBED_ON_OWN_WEBSITE = 'Embed (on own website)';
    const OPEN_FOR_OBS = 'Open for OBS';

    public static function getConstants(): array
    {
        $reflection = new ReflectionClass(static::class);

        return $reflection->getConstants();
    }

    public static function resolve($permission): \Spatie\Permission\Contracts\Permission
    {
        if ($permission instanceof Permission) {
            return $permission;
        }

        return is_numeric($permission) ? Permission::findById($permission) : Permission::findByName($permission);
    }

    public static function findMany(...$permissions): Collection
    {
        return Collection::make($permissions)
            ->flatten()
            ->filter()
            ->map(fn ($permission) => static::resolve($permission));
    }

    public function toLocaleName($locale = null)
    {
        return __("permission.{$this->name}", [], $locale);
    }
}
