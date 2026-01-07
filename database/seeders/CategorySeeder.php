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
            ['name' => 'Main Course', 'slug' => 'main-course', 'description' => 'Traditional Indian main dishes'],
            ['name' => 'Appetizers', 'slug' => 'appetizers', 'description' => 'Starters and snacks'],
            ['name' => 'Desserts', 'slug' => 'desserts', 'description' => 'Sweet treats'],
            ['name' => 'Beverages', 'slug' => 'beverages', 'description' => 'Drinks and refreshments']
        ];

        foreach ($categories as $categoryData) {
            $category = Category::create($categoryData);
            
            // Add sample menu items
            if ($category->slug === 'main-course') {
                MenuItem::create([
                    'name' => 'Aalu Sabji & Roti',
                    'description' => 'Spiced potatoes with fresh roti',
                    'price' => 149.00,
                    'category_id' => $category->id,
                    'image' => 'https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=300&h=200&fit=crop'
                ]);
                
                MenuItem::create([
                    'name' => 'Paneer Butter Masala',
                    'description' => 'Creamy cottage cheese in rich tomato gravy',
                    'price' => 189.00,
                    'category_id' => $category->id,
                    'image' => 'https://images.unsplash.com/photo-1567188040759-fb8a883dc6d8?w=300&h=200&fit=crop'
                ]);
                
                MenuItem::create([
                    'name' => 'Dal Tadka',
                    'description' => 'Tempered lentils with aromatic spices',
                    'price' => 129.00,
                    'category_id' => $category->id,
                    'image' => 'https://images.unsplash.com/photo-1585937421612-70a008356fbe?w=300&h=200&fit=crop'
                ]);
            }
        }
    }
}
