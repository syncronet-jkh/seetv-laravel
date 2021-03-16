<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use function data_get;
use function is_numeric;
use function once;

/**
 * Class Plan
 * @package App\Models
 *
 * @method static static whereRole($role)
 * @mixin Builder
 */
class Plan extends Model
{
    const BINDING_PERIOD_1_MONTH = '1 month';

    use HasTranslations, HasFactory;

    public $translatable = ['title'];

    protected $guarded = [];

    public static function create(array $attributes): Plan
    {
        return static::query()->create($attributes);
    }

    public function scopeWhereRole($query, $role)
    {
        $this->scopeRole($query, $role);
    }

    public function scopeRole($query, $role)
    {
        $role = data_get($role, 'id', $role);
        $column = is_numeric($role) ? 'id' : 'name';

        $query->whereHas('role', fn ($q) => $q->where($column, $role));
    }

    public function getIsFreeAttribute(): bool
    {
        return once(fn () => $this->prices->isEmpty() || $this->prices->contains(fn ($price) => $price->amount === 0));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany|Feature
     */
    public function features()
    {
        return $this->morphMany(Feature::class, 'model');
    }

    public function prices()
    {
        return $this->HasMany(Price::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function assignRoleAndPermissionsTo(User $user): User
    {
        $user->assignRole($this->role);

        $user->givePermissionTo(
            $this->features()->enabled()->pluck('permission_id')
        );

        return $user;
    }

    public function allow(...$permissions): static
    {
        Permission::findMany($permissions)->each(
            fn (Permission $permission) => $this->features()->create([
                'permission_id' => $permission->getKey(),
                'enabled' => true
            ])
        );

        return $this;
    }

    public function deny(...$permissions): static
    {
        Permission::findMany($permissions)->each(
            fn (Permission $permission) => $this->features()->create([
                'permission_id' => $permission->getKey(),
                'enabled' => true
            ])
        );

        return $this;
    }
}
