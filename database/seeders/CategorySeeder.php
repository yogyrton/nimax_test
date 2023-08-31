<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::factory(5)
            ->create();

        Product::factory(5)->hasAttached($categories)->create();
    }
}
