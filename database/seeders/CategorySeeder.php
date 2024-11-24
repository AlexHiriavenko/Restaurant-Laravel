<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Основні страви', 'slug' => 'main-dishes', 'image' => 'imgs/categories/main_dishes.jpg']);
        Category::create(['name' => 'Перші страви', 'slug' => 'soups', 'image' => 'imgs/categories/soups.jpg']);
        Category::create(['name' => 'Салати', 'slug' => 'salads', 'image' => 'imgs/categories/salads.jpg']);
        Category::create(['name' => 'Десерти', 'slug' => 'desserts', 'image' => 'imgs/categories/desserts.jpg']);
        Category::create(['name' => 'Напої', 'slug' => 'drinks', 'image' => 'imgs/categories/drinks.jpg']);
    }
}
