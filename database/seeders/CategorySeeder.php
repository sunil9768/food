<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\MenuItem;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Soup', 'slug' => 'soup', 'description' => 'Hot and fresh soups'],
            ['name' => 'Starters', 'slug' => 'starters', 'description' => 'Appetizers and snacks'],
            ['name' => 'Rice and Biryani', 'slug' => 'rice-and-biryani', 'description' => 'Aromatic rice dishes and biryanis'],
            ['name' => 'Noodles', 'slug' => 'noodles', 'description' => 'Asian style noodles'],
            ['name' => 'Indian Breads', 'slug' => 'indian-breads', 'description' => 'Fresh rotis, naans and parathas'],
            ['name' => 'Accompaniment', 'slug' => 'accompaniment', 'description' => 'Side dishes and accompaniments'],
            ['name' => 'Desserts', 'slug' => 'desserts', 'description' => 'Sweet treats and desserts'],
            ['name' => 'Main Course', 'slug' => 'main-course', 'description' => 'Traditional Indian main dishes'],
            ['name' => 'Sizzlers', 'slug' => 'sizzlers', 'description' => 'Hot sizzling platters'],
            ['name' => 'Indian Curry Veg', 'slug' => 'indian-curry-veg', 'description' => 'Vegetarian curries'],
            ['name' => 'Momos', 'slug' => 'momos', 'description' => 'Steamed and fried dumplings'],
            ['name' => 'Salads', 'slug' => 'salads', 'description' => 'Fresh and healthy salads'],
            ['name' => 'Tandoor and Grill Veg', 'slug' => 'tandoor-and-grill-veg', 'description' => 'Grilled and tandoor vegetables'],
            ['name' => 'Roll Sandwich and Wraps', 'slug' => 'roll-sandwich-and-wraps', 'description' => 'Rolls, sandwiches and wraps'],
            ['name' => 'Burgers', 'slug' => 'burgers', 'description' => 'Delicious burgers'],
            ['name' => 'Pasta', 'slug' => 'pasta', 'description' => 'Italian pasta dishes']
        ];

        foreach ($categories as $categoryData) {
            Category::firstOrCreate(
                ['slug' => $categoryData['slug']],
                $categoryData
            );
        }
    }
}
