<?php

namespace Database\Factories;

use App\Models\Channel;
use App\Models\ChannelMember;
use App\Models\ChannelReferralLink;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChannelMemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ChannelMember::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'channel_id' => Channel::factory(),
            'user_id' => User::factory(),
            'channel_referral_link_id' => null,
            'plan_id' => null
        ];
    }
}
