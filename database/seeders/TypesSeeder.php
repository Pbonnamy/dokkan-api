<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'id' => 1,
                'name' => 'Super',
            ],
            [
                'id' => 2,
                'name' => 'Extreme'
            ]
        ];
        
        foreach ($types as $type) {
            Type::updateOrCreate(['id' => $type['id']], $type);
        }
    }
}
