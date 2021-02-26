<?php

namespace Database\Factories;

use App\Models\Channel;
use App\Models\Municipality;
use App\Models\Plan;
use App\Models\Publisher;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChannelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Channel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'plan_id' => null,
            'publisher_id' => Publisher::factory(),
            'user_id' => User::factory(),
            'municipality_id' => Municipality::factory(),
            'name' => $this->faker->bs
        ];
    }
}
