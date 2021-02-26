<?php

namespace Tests\Feature\API;

use App\Models\Municipality;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MunicipalityControllerTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_it_lists_all_the_municipalities()
    {
        $count = Municipality::query()->count();

        $this->getJson('/api/Municipalities')
            ->assertSuccessful()
            ->assertJsonCount($count);
    }
}
