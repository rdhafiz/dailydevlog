<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        $packages = [
            [
                'name' => 'Tech',
                'slug' => 'tech',
                'description' => null,
                'parent_id' => null,
            ],
            [
                'name' => 'Music',
                'slug' => 'music',
                'description' => null,
                'parent_id' => null,
            ],
            [
                'name' => 'Food',
                'slug' => 'food',
                'description' => null,
                'parent_id' => null,
            ],
        ];
        Category::insert($packages);
    }
}
