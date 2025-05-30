<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Makanan Pokok', 'type' => 'food'],
            ['name' => 'Minuman Segar', 'type' => 'drink'],
            ['name' => 'Camilan Enak', 'type' => 'snack'],
        ];

        foreach ($data as $item) {
            Category::create($item);
        }
    }
}
