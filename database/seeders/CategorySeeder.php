<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Основные', 'image' => 'categories/main_dishes.jpg']);
        Category::create(['name' => 'Первые', 'image' => 'categories/soups.jpg']);
        Category::create(['name' => 'Салаты', 'image' => 'categories/salads.jpg']);
        Category::create(['name' => 'Десерты', 'image' => 'categories/desserts.jpg']);
        Category::create(['name' => 'Напитки', 'image' => 'categories/drinks.jpg']);
    }
}

