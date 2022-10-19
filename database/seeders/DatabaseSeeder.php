<?php

namespace Database\Seeders;

use Database\Seeders\dokkan\ElementsSeeder;
use Database\Seeders\dokkan\RaritiesSeeder;
use Database\Seeders\dokkan\TypesSeeder;
use Illuminate\Database\Seeder;

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
            ElementsSeeder::class,
            TypesSeeder::class,
            RaritiesSeeder::class,
        ]);
    }
}
