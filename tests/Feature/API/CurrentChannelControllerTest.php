<?php

namespace Tests\Feature\API;

use Tests\TestCase;
use App\Models\User;
use App\Models\Channel;
use App\Models\Publisher;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CurrentChannelControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_a_channel_member_can_assign_it_as_current()
    {
        $publisher = Publisher::factory()->create();
        $user = User::factory()->create(['current_publisher_id' => $publisher->id]);
        $channel = Channel::factory()->create(['publisher_id' => $publisher->id]);
        $channel->addMember($user);

        $this->actingAs($user)->postJson("api/CurrentChannel", ['channel_id' => $channel->id])->assertSuccessful();

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'current_channel_id' => $channel->id
        ]);
    }

    /** @test */
    public function test_a_channel_owner_can_assign_it_as_current()
    {
        $publisher = Publisher::factory()->create();
        $user = User::factory()->create(['current_publisher_id' => $publisher->id]);
        $channel = Channel::factory()->create(['user_id' => $user->id, 'publisher_id' => $publisher->id]);

        $this->actingAs($user)->postJson("api/CurrentChannel", ['channel_id' => $channel->id])->assertSuccessful();

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'current_channel_id' => $channel->id
        ]);
    }

    /** @test */
    public function test_cannot_assign_current_channel_without_current_publisher()
    {
        $user = User::factory()->create(['current_publisher_id' => null]);

        $channel = Channel::factory()->create();

        $this->actingAs($user)->postJson('/api/CurrentChannel', ['channel_id' => $channel->id])->assertForbidden();
    }

    /** @test */
    public function test_cannot_assign_current_channel_if_it_is_not_within_the_current_publisher()
    {
        $user = User::factory()->create(['current_publisher_id' => Publisher::factory()->create()]);

        $channel = Channel::factory()->create();

        $this->actingAs($user)->postJson('/api/CurrentChannel', ['channel_id' => $channel->id])->assertForbidden();
    }
}
