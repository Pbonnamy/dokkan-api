<?php

namespace Database\Seeders;

use App\Models\Element;
use Illuminate\Database\Seeder;

class ElementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $elements = [
            [
                'id' => 1,
                'name' => 'AGL',
            ],
            [
                'id' => 2,
                'name' => 'TEQ'
            ],
            [
                'id' => 3,
                'name' => 'INT'
            ],
            [
                'id' => 4,
                'name' => 'STR'
            ],
            [
                'id' => 5,
                'name' => 'PHY'
            ]
        ];
        
        foreach ($elements as $element) {
            Element::updateOrCreate(['id' => $element['id']], $element);
        }
    }
}
