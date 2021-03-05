<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use function app;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionSeeder::class,
            PlanSeeder::class,
            RegionsTableSeeder::class,
            MunicipalitiesTableSeeder::class,
            PostalCodesTableSeeder::class,
            SourceProviderSeeder::class
        ]);

        if (app()->environment('local')) {
            $this->call(TestingUsersSeeder::class);
        }
    }
}
