<?php

namespace Tests\Feature;

use App\Models\Broadcast;
use App\Models\Municipality;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Date;
use Tests\TestCase;

class BroadcastTest extends TestCase
{
    use RefreshDatabase;

    public function testScopeStartingSoon()
    {
        Municipality::disableSearchSyncing();
        Date::setTestNow('2020-03-08 13:13:24');

        $yesterday = Broadcast::factory()->create([
           'starts_at' => '2020-03-07 13:13:00',
           'ends_at' => '2020-03-07 13:43:00'
        ]);

        $past = Broadcast::factory()->create([
            'starts_at' => '2020-03-08 13:00:00',
            'ends_at' => '2020-03-08 13:10:00',
        ]);

        $aboutToAir = Broadcast::factory()->create([
            'starts_at' => '2020-03-08 13:13:24',
            'ends_at' => '2020-03-08 13:18:24',
        ]);

        $startingSoon = Broadcast::factory()->create([
            'starts_at' => '2020-03-08 13:13:20',
            'ends_at' => '2020-03-08 13:18:00'
        ]);

        $results = Broadcast::startingSoon()->get();

        $this->assertCount(2, $results);

        $this->assertTrue($results->contains($aboutToAir));
        $this->assertTrue($results->contains($startingSoon));
    }
}
