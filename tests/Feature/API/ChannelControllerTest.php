<?php

namespace Tests\Feature\API;

use App\Models\Channel;
use App\Models\ChannelMember;
use App\Models\Municipality;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Date;
use Tests\TestCase;

class ChannelControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_lists_the_channels_within_a_municipality_that_broadcasts_at_a_given_date()
    {
        Date::setTestNow('2021-02-26 14:47:10');

        $municipality = Municipality::withoutSyncingToSearch(
            fn () => Municipality::factory()->create()
        );

        /** @var Channel $expectedChannel */
        $expectedChannel = Channel::factory()->for($municipality)->create(['name' => 'expected channel']);
        $channelMember = ChannelMember::factory()->create(['channel_id' => $expectedChannel->getKey()]);

        $expectedBroadcast = $expectedChannel->broadcasts()->create([
            'channel_member_id' => $channelMember->getKey(),
            'starts_at' => Date::now()->addMinutes(10),
            'ends_at' => Date::now()->addMinutes(18),
            'title' => 'hello',
            'description' => 'hello darkness my old friend',
        ]);

        $unexpectedChannel = Channel::factory()->for($municipality)->create(['name' => 'unexpected channel']);

        $this->getJson("/api/Municipalities/{$municipality->getKey()}/Channels?date=2021-02-26")
            ->assertSuccessful()
            ->assertJsonCount(1)
            ->assertSee('expected channel')
            ->assertDontSee('unexpected channel');
    }
}
