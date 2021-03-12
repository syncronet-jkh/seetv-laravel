<?php

namespace Tests\Feature\API;

use App\Models\Broadcast;
use App\Models\Channel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Date;
use Tests\TestCase;

class ChannelBroadcastsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testItListsTheMostRecentBroadcastsForTheChannel()
    {
        Date::setTestNow('2021-03-10 14:31:00');

        $channel = Channel::factory()->create();
        $jimmysShop = Broadcast::factory()->create([
            'channel_id' => $channel->id,
            'title' => 'jimmys shop',
            'starts_at' => '2021-03-10 14:35:00'
        ]);

        $wendysCakes = Broadcast::factory()->create([
            'channel_id' => $channel->id,
            'title' => 'wendys cakes',
            'starts_at' => '2021-03-10 14:30:30'
        ]);

        $this->getJson("/api/Channels/{$channel->id}/Broadcasts/Planned")
            ->assertSuccessful()
            ->assertJsonCount(1, 'data')
            ->assertSee('jimmys shop');
    }

    public function testItListsThePastBroadcastsForTheChannel()
    {
        Date::setTestNow('2021-03-10 14:31:00');

        $channel = Channel::factory()->create();
        $jimmysShop = Broadcast::factory()->create([
            'channel_id' => $channel->id,
            'title' => 'jimmys shop',
            'starts_at' => '2021-03-10 14:35:00'
        ]);

        $wendysCakes = Broadcast::factory()->create([
            'channel_id' => $channel->id,
            'title' => 'wendys cakes',
            'starts_at' => '2021-03-10 14:30:30'
        ]);

        $this->getJson("/api/Channels/{$channel->id}/Broadcasts/History")
            ->assertSuccessful()
            ->assertJsonCount(1, 'data')
            ->assertSee('wendys cakes');
    }
}
