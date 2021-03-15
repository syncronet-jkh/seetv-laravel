<?php

namespace Tests\Feature\API;

use Tests\TestCase;
use App\Models\User;
use App\Models\Channel;
use App\Models\Publisher;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CurrentPublisherControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_can_assign_an_owned_publisher_as_current()
    {
        $user = User::factory()->create();
        $publisher = Publisher::factory()->create(['user_id' => $user->id]);

        $this
            ->actingAs($user)
            ->postJson("api/CurrentPublisher", ['publisher_id' => $publisher->id])
            ->assertSuccessful();

        $this->assertDatabaseHas('users', ['current_publisher_id' => $publisher->id]);
    }

    /** @test */
    public function test_can_assign_a_publisher_the_user_is_a_member_of()
    {
        $user = User::factory()->create();
        $publisher = Publisher::factory()->create();
        $publisher->addMember($user);

        $this
            ->actingAs($user)
            ->postJson("api/CurrentPublisher", ['publisher_id' => $publisher->id])
            ->assertSuccessful();

        $this->assertDatabaseHas('users', ['current_publisher_id' => $publisher->id]);
    }


    /** @test */
    public function test_cannot_assign_current_publisher_without_membership()
    {
        $user = User::factory()->create();
        $publisher = Publisher::factory()->create();

        $this
            ->actingAs($user)
            ->postJson("api/CurrentPublisher", ['publisher_id' => $publisher->id])
            ->assertForbidden();
    }
}
