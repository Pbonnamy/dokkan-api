<?php

namespace Database\Seeders\dokkanApi;

use App\Models\Dokkan\Rarity;
use Illuminate\Database\Seeder;

class RaritiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rarities = [
            [
                'id' => 1,
                'name' => 'N',
            ],
            [
                'id' => 2,
                'name' => 'R'
            ],
            [
                'id' => 3,
                'name' => 'SR'
            ],
            [
                'id' => 4,
                'name' => 'SSR'
            ],
            [
                'id' => 5,
                'name' => 'UR'
            ],
            [
                'id' => 6,
                'name' => 'LR'
            ]
        ];
        
        foreach ($rarities as $rarity) {
            Rarity::updateOrCreate(['id' => $rarity['id']], $rarity);
        }
    }
}
