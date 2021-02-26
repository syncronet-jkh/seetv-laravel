<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use function is_numeric;

/**
 * Class Plan
 * @package App\Models
 *
 * @mixin Builder
 */
class Plan extends Model
{
    use HasTranslations, HasFactory;

    public $translatable = ['title'];

    protected $guarded = [];

    public static function create(array $attributes): Plan
    {
        return static::query()->create($attributes);
    }

    public function scopeRole($query, $role)
    {
        $column = is_numeric($role) ? 'id' : 'name';

        $query->whereHas('role', fn ($q) => $q->where($column, $role));
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
        $user->assignRole($this->granted_role);

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
