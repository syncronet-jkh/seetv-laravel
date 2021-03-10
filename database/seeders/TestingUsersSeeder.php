<?php

namespace Database\Seeders;

use App\Models\Channel;
use App\Models\Municipality;
use App\Models\Plan;
use App\Models\Publisher;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;

class TestingUsersSeeder extends Seeder
{
    use WithFaker;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->setUpFaker();

        foreach (['jkh', 'jbn', 'eip', 'tbj', 'pds', 'stg'] as $username) {
            /** @var User $user */
            $user = User::factory()->create([
                'username' => $username,
                'email' => $username . '@syncronet.dk'
            ]);

            $user->assignRole(Role::ADMIN);

            Plan::with('role', 'features')->each(function (Plan $plan) use ($user) {
                $plan->assignRoleAndPermissionsTo($user);

                $municipality = Municipality::first();

                switch ($plan->role->name) {
                    case Role::PUBLISHER:
                        /** @var Publisher $publisher */
                        $publisher = $user->publishers()->create([
                            'user_id' => $user->getKey(),
                            'name' => $this->faker->company,
                            'plan_id' => $plan->getKey()
                        ]);

                        /** @var Channel $channel */
                        $channel = $publisher->channels()->create([
                            'name' => $this->faker->bs,
                            'municipality_id' => $municipality->getKey(),
                            'plan_id' => $plan->getKey(),
                            'user_id' => $user->getKey()
                        ]);

                        $channel->members()->create([
                            'user_id' => $user->getKey()
                        ]);
                        break;

                    default:
                        break;
                }
            });
        }
    }
}
