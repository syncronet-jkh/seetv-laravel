<?php

namespace Tests\Feature\API;

use App\Models\Plan;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlanControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Whether the database should be seeded
     *
     * @var bool
     */
    protected bool $seed = true;

    public function test_it_lists_the_viewer_plans()
    {
        $plansCount = Plan::query()->whereHas('role', fn ($role) => $role->where('name', Role::VIEWER))->count();

        $this->getJson('/api/Plans?filter[role]='.Role::VIEWER)
            ->assertSuccessful()
            ->assertJsonCount($plansCount);
    }

    public function test_it_lists_the_publisher_plans()
    {
        $plansCount = Plan::query()->whereHas('role', fn ($role) => $role->where('name', 'Publisher'))->count();

        $this->getJson('/api/Plans?filter[role]='.Role::PUBLISHER)
            ->assertSuccessful()
            ->assertJsonCount($plansCount);
    }

    public function test_it_lists_the_distributor_plans()
    {
        $plansCount = Plan::query()->whereHas('role', fn ($role) => $role->where('name', Role::DISTRIBUTOR))->count();

        $this->getJson('/api/Plans?filter[role]='.Role::DISTRIBUTOR)
            ->assertSuccessful()
            ->assertJsonCount($plansCount);
    }
}
