<?php

namespace Tests\Feature\API;

use App\Models\Municipality;
use App\Models\Plan;
use App\Models\Publisher;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PublisherControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Whether or not to seed the database before running this test
     *
     * @var bool
     */
    protected bool $seed = true;

    public function test_can_create_a_publisher()
    {
        $user = User::factory()->create();
        $publisherRole = Role::PUBLISHER();
        $user->assignRole($publisherRole);

        $plan = Plan::query()->firstWhere('role_id', $publisherRole->getKey());
        $municipality = Municipality::query()->firstOrFail();

        $this
            ->actingAs($user, 'api')
            ->postJson('api/Publishers', [
            'name' => 'testing',
            'plan_id' => $plan->getKey(),
            'municipality_id' => $municipality->getKey(),

            'addresses' => [
                [
                    'street_address' => 'Acme street 07'
                ]
            ],

            'emails' => [
                [
                    'address' => 'john@example.com'
                ]
            ],

            'phones' => [
                [
                    'number' => '+45 70707070'
                ]
            ],

            'channels' => [
                [
                    'name' => 'testings channel'
                ]
            ]
        ])->assertSuccessful();

        $this->assertDatabaseHas('publishers', [
            'name' => 'testing',
            'user_id' => $user->id,
            'plan_id' => $plan->getKey(),
            // 'municipality_id' => $municipality->getKey(),
        ]);

        $publisher = $user->publishers()->with('addresses', 'emails', 'phones', 'channels')->firstWhere('name', 'testing');

        $this->assertCount(1, $publisher->addresses);
        $this->assertTrue(
            $publisher->addresses->contains(fn ($a) => $a->street_address === 'Acme street 07' && $a->municipality->is($municipality))
        );

        $this->assertCount(1, $publisher->emails);
        $this->assertTrue(
            $publisher->emails->contains(fn ($e) => $e->address === 'john@example.com')
        );

        $this->assertCount(1, $publisher->phones);
        $this->assertTrue(
            $publisher->phones->contains(fn ($e) => $e->number === '+45 70707070')
        );

        $this->assertCount(1, $publisher->channels);
        $this->assertTrue(
            $publisher->channels->contains(fn ($c) => $c->name === 'testings channel' && $c->municipality->is($municipality))
        );
    }
}
