<?php

namespace App\Http\Resources;

use App\Initials;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;
use function substr;

/**
 * Class UserResource
 * @package App\Http\Resources
 * @mixin User
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            // 'id' => $this->id,
            'initials' => Str::contains($this->username, ' ')
                ? Initials::make($this->username)
                : substr($this->username, 0, 2),

            'username' => $this->username,
            'email' => $this->email,

            'channels' => $this->whenLoaded('channels', fn () => ChannelResource::collection($this->channels)),
            'publishers' => $this->whenLoaded('publishers', fn () => PublisherResource::collection($this->publishers)),

            'roles' => $this->whenLoaded('roles', fn () => $this->roles->map(fn (Role $role) => [
                'name' => $role->name,
                'local_name' => $role->toLocaleName()
            ])),

            'permissions' => $this->whenLoaded('permissions', fn () => $this->permissions->map(fn (Permission $permission) => [
                'name' => $permission->name,
                'local_name' => $permission->toLocaleName()
            ])),

            // Fields for frontend checks
            'is_publisher' => $this->when(
                $this->hasRole(Role::PUBLISHER),
                fn () => $this->publishers->isNotEmpty()
            ),
        ];
    }
}
