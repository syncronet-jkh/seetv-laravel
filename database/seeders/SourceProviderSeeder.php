<?php

namespace Database\Seeders;

use App\Models\SourceProvider;
use Illuminate\Database\Seeder;

class SourceProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (SourceProvider::getConstants() as $name) {
            SourceProvider::query()->create(['name' => $name]);
        }
    }
}
