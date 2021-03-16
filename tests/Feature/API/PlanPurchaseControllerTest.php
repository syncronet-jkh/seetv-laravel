<?php

namespace Tests\Feature\API;

use App\Facades\PaymentGateway;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\PlanSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlanPurchaseControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testASuccessfulPaymentGrantsTheCurrentUserTheRoleAndPermissionsFromThePlan()
    {
        $this->seed([
            PermissionSeeder::class,
            PlanSeeder::class,
        ]);

        $plan = Plan::whereRole(Role::PUBLISHER)
            ->where('title->en', 'Pro')
            ->with('prices')
            ->firstOrFail();

        /** @var User $user */
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->postJson("api/Plans/{$plan->getKey()}/Purchase", [
                'gateway' => 'fake',
                'currency' => 'DKK',
                'authorize_id' => '1234-testing',
                'credit_card_id' => '1234-testing'
            ])
            ->assertSuccessful();

        PaymentGateway::driver('fake')->assertCaptured(
            fn (Payment $payment, string $authorizeId) => $authorizeId === '1234-testing'
        );

        $user->load('roles', 'permissions');

        $this->assertTrue($user->hasRole($plan->role));

        foreach ($plan->features as $feature) {
            $this->assertTrue(
                $user->hasPermissionTo($feature->permission)
            );

            $this->assertTrue(
                $user->can($feature->permission->name)
            );
        }

        $this->assertDatabaseHas('payments', [
            'price_id' => $plan->prices->first()->id,
            'plan_id' => $plan->id,
            'authorize_id' => '1234-testing',
            'credit_card_id' => '1234-testing',
            'amount' => 6250,
            'currency' => 'DKK'
        ]);
    }

    /** @test */
    public function test_can_purchase_a_free_viewer_plan()
    {
        $this->seed([
            PermissionSeeder::class,
            PlanSeeder::class,
        ]);

        $plan = Plan::whereRole(Role::VIEWER)
            ->where('title->en', 'Free')
            ->firstOrFail();

        /** @var User $user */
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->postJson("api/Plans/{$plan->getKey()}/Purchase")
            ->dump()
            ->assertSuccessful();

        $user->load('roles', 'permissions');

        $this->assertTrue($user->hasRole($plan->role));

        foreach ($plan->features as $feature) {
            $this->assertTrue(
                $user->hasPermissionTo($feature->permission)
            );

            $this->assertTrue(
                $user->can($feature->permission->name)
            );
        }

        $this->assertDatabaseHas('payments', [
            'plan_id' => $plan->id,
            'amount' => 0,
        ]);
    }
}
