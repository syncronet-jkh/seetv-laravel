<?php

namespace Tests\Feature\API;

use App\Models\Channel;
use App\Models\Municipality;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Date;
use Tests\TestCase;

class BroadcastControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Municipality::disableSearchSyncing();
    }

    public function testAChannelMemberCanCreateABroadcast()
    {
        Date::setTestNow('2020-03-09 12:51:21');

        $user = User::factory()->create();

        /** @var Channel $channel */
        $channel = Channel::factory()->create();
        $member = $channel->members()->create([
            'user_id' => $user->getKey()
        ]);

        $this->actingAs($user)
            ->postJson("api/Channels/{$channel->id}/Broadcasts", [
                'channel_member_id' => $member->getKey(),
                'starts_at' => '2020-03-09 13:00:00',
                'ends_at' => '2020-03-09 13:10:00',
                'title' => 'Splonka F',
                'description' => 'F in the chat for Splonka'
            ])
            ->assertSuccessful();

        $this->assertDatabaseHas('broadcasts', [
            'channel_id' => $channel->getKey(),
            'channel_member_id' => $member->getKey(),
            'starts_at' => '2020-03-09 13:00:00',
            'ends_at' => '2020-03-09 13:10:00',
            'title' => 'Splonka F',
            'description' => 'F in the chat for Splonka'
        ]);
    }

    public function testCanCreateABroadcastWithoutSpecifyingChannelMemberId()
    {
        Date::setTestNow('2020-03-09 12:51:21');

        $user = User::factory()->create();

        /** @var Channel $channel */
        $channel = Channel::factory()->create();
        $member = $channel->members()->create([
            'user_id' => $user->getKey()
        ]);

        $this->actingAs($user)->postJson("api/Channels/{$channel->id}/Broadcasts", [
            'starts_at' => '2020-03-09 13:00:00',
            'ends_at' => '2020-03-09 13:10:00',
            'title' => 'SplonkaS',
            'description' => 'Splonka splonka'
        ])->assertSuccessful();

        $this->assertDatabaseHas('broadcasts', [
            'channel_id' => $channel->getKey(),
            'channel_member_id' => $member->getKey(),
            'starts_at' => '2020-03-09 13:00:00',
            'ends_at' => '2020-03-09 13:10:00',
            'title' => 'SplonkaS',
            'description' => 'Splonka splonka'
        ]);
    }

    public function testCannotCreateABroadcastWithoutMembership()
    {
        $user = User::factory()->create();

        /** @var Channel $channel */
        $channel = Channel::factory()->create();

        $this->postJson("api/Channels/{$channel->id}/Broadcasts")->assertUnauthorized();
        $this->actingAs($user)->postJson("api/Channels/{$channel->id}/Broadcasts")->assertForbidden();
    }

    public function testValidationFailsIfBroadcastsOverlap()
    {
        Date::setTestNow('2020-03-09 12:51:21');

        $user = User::factory()->create();

        /** @var Channel $channel */
        $channel = Channel::factory()->create();
        $member = $channel->members()->create([
            'user_id' => $user->getKey()
        ]);
        $channel->broadcasts()->create([
            'channel_member_id' => $member->getKey(),
            'starts_at' => '2020-03-09 13:00:00',
            'ends_at' => '2020-03-09 13:10:00',
            'title' => 'Malakas',
            'description' => 'yeet yo timeslot'
        ]);

        $this->actingAs($user)->postJson("api/Channels/{$channel->id}/Broadcasts", [
            'starts_at' => '2020-03-09 13:00:00',
            'ends_at' => '2020-03-09 13:10:00',
            'title' => 'SplonkaS',
            'description' => 'Splonka splonka'
        ])->assertJsonValidationErrors(['starts_at' => 'There is already another broadcast at the requested datetime interval.']);
    }
}
