<?php

namespace Database\Factories;

use App\Models\Broadcast;
use App\Models\Channel;
use App\Models\ChannelMember;
use Illuminate\Database\Eloquent\Factories\Factory;

class BroadcastFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Broadcast::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'channel_id' => Channel::factory(),
            'channel_member_id' => ChannelMember::factory(),
            'starts_at' => $this->faker->dateTime,
            'ends_at' => $this->faker->dateTime,
            'title' => $this->faker->bs,
            'description' => $this->faker->text,
        ];
    }
}
