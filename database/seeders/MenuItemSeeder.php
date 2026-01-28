<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuItem;
use App\Models\User;
use App\Models\Category;

class MenuItemSeeder extends Seeder
{
    public function run(): void
    {
        $vendor = User::where('email', 'vendor@gmail.com')->first();
        $soupCategory = Category::where('slug', 'soup')->first();
        $startersCategory = Category::where('slug', 'starters')->first();

        if ($vendor && $soupCategory) {
            $menuItems = [
                // Soup Items
                [
                    'name' => 'Tomato (On Your Way)',
                    'description' => 'Fresh tomato soup with herbs and spices',
                    'price' => 295.00,
                    'category_id' => $soupCategory->id,
                    'vendor_id' => $vendor->id,
                    'is_active' => true,
                ],
                [
                    'name' => 'Burnt Garlic Soup',
                    'description' => 'Aromatic burnt garlic soup with rich flavors',
                    'price' => 295.00,
                    'category_id' => $soupCategory->id,
                    'vendor_id' => $vendor->id,
                    'is_active' => true,
                ],
                [
                    'name' => 'Cream of Basil Soup',
                    'description' => 'Creamy basil soup with fresh herbs',
                    'price' => 295.00,
                    'category_id' => $soupCategory->id,
                    'vendor_id' => $vendor->id,
                    'is_active' => true,
                ],
                [
                    'name' => 'Broccoli Soup',
                    'description' => 'Healthy broccoli soup with cream',
                    'price' => 295.00,
                    'category_id' => $soupCategory->id,
                    'vendor_id' => $vendor->id,
                    'is_active' => true,
                ],
                [
                    'name' => 'Shorba Soup',
                    'description' => 'Traditional Indian shorba soup',
                    'price' => 350.00,
                    'category_id' => $soupCategory->id,
                    'vendor_id' => $vendor->id,
                    'is_active' => true,
                ],
                [
                    'name' => 'Cream Soup Vegetable',
                    'description' => 'Mixed vegetable cream soup',
                    'price' => 295.00,
                    'category_id' => $soupCategory->id,
                    'vendor_id' => $vendor->id,
                    'is_active' => true,
                ],
                [
                    'name' => 'Cream Soup Mushroom',
                    'description' => 'Rich mushroom cream soup',
                    'price' => 350.00,
                    'category_id' => $soupCategory->id,
                    'vendor_id' => $vendor->id,
                    'is_active' => true,
                ],
                [
                    'name' => 'Cream Soup Chicken',
                    'description' => 'Creamy chicken soup with herbs',
                    'price' => 350.00,
                    'category_id' => $soupCategory->id,
                    'vendor_id' => $vendor->id,
                    'is_active' => true,
                ],
                [
                    'name' => 'Hot & Sour Soup Vegetable',
                    'description' => 'Spicy and tangy vegetable soup',
                    'price' => 295.00,
                    'category_id' => $soupCategory->id,
                    'vendor_id' => $vendor->id,
                    'is_active' => true,
                ],
                [
                    'name' => 'Hot & Sour Soup Chicken',
                    'description' => 'Spicy and tangy chicken soup',
                    'price' => 350.00,
                    'category_id' => $soupCategory->id,
                    'vendor_id' => $vendor->id,
                    'is_active' => true,
                ],
                [
                    'name' => 'Sweet Corn Cream Soup Vegetable',
                    'description' => 'Sweet corn cream soup with vegetables',
                    'price' => 295.00,
                    'category_id' => $soupCategory->id,
                    'vendor_id' => $vendor->id,
                    'is_active' => true,
                ],
                [
                    'name' => 'Sweet Corn Cream Soup Chicken',
                    'description' => 'Sweet corn cream soup with chicken',
                    'price' => 350.00,
                    'category_id' => $soupCategory->id,
                    'vendor_id' => $vendor->id,
                    'is_active' => true,
                ],
                [
                    'name' => 'Manchow Soup Vegetable',
                    'description' => 'Spicy Manchow soup with vegetables',
                    'price' => 295.00,
                    'category_id' => $soupCategory->id,
                    'vendor_id' => $vendor->id,
                    'is_active' => true,
                ],
                [
                    'name' => 'Manchow Soup Chicken',
                    'description' => 'Spicy Manchow soup with chicken',
                    'price' => 350.00,
                    'category_id' => $soupCategory->id,
                    'vendor_id' => $vendor->id,
                    'is_active' => true,
                ],
                [
                    'name' => 'Clear Soup Vegetable',
                    'description' => 'Light and healthy vegetable clear soup',
                    'price' => 350.00,
                    'category_id' => $soupCategory->id,
                    'vendor_id' => $vendor->id,
                    'is_active' => true,
                ],
                [
                    'name' => 'Clear Soup Chicken',
                    'description' => 'Light and healthy chicken clear soup',
                    'price' => 350.00,
                    'category_id' => $soupCategory->id,
                    'vendor_id' => $vendor->id,
                    'is_active' => true,
                ],
            ];

            foreach ($menuItems as $item) {
                MenuItem::firstOrCreate(
                    ['name' => $item['name'], 'vendor_id' => $vendor->id],
                    $item
                );
            }
        }

        // Starters Items
        if ($vendor && $startersCategory) {
            $starterItems = [
                ['name' => 'Nachos with Salsa', 'description' => 'Crispy nachos served with fresh salsa', 'price' => 335.00],
                ['name' => 'Baked Cheese Loaded Nachos', 'description' => 'Nachos loaded with melted cheese', 'price' => 385.00],
                ['name' => 'Garlic Bread Pull Apart', 'description' => 'Soft pull apart garlic bread', 'price' => 350.00],
                ['name' => 'Chilli Cheese Garlic Bread', 'description' => 'Garlic bread with chilli and cheese', 'price' => 310.00],
                ['name' => 'Jalapeno Garlic Bread', 'description' => 'Spicy jalapeno garlic bread', 'price' => 350.00],
                ['name' => 'French Fries Salted', 'description' => 'Classic salted french fries', 'price' => 260.00],
                ['name' => 'Peri-Peri French Fries', 'description' => 'Spicy peri-peri seasoned fries', 'price' => 290.00],
                ['name' => 'Cheese Loaded French Fries', 'description' => 'Fries loaded with melted cheese', 'price' => 320.00],
                ['name' => 'Exotic Greens Boiled', 'description' => 'Fresh boiled exotic vegetables', 'price' => 270.00],
                ['name' => 'Exotic Greens Sauteed', 'description' => 'Sauteed exotic vegetables', 'price' => 280.00],
                ['name' => 'Exotic Greens Butter Tossed', 'description' => 'Butter tossed exotic vegetables', 'price' => 290.00],
                ['name' => 'Traditional Italian Bruschetta Tomato', 'description' => 'Classic tomato bruschetta', 'price' => 310.00],
                ['name' => 'Traditional Italian Bruschetta Chicken Tikka', 'description' => 'Bruschetta with chicken tikka', 'price' => 360.00],
                ['name' => 'Tempura Fried Onion Rings', 'description' => 'Crispy tempura battered onion rings', 'price' => 290.00],
                ['name' => 'Spring Roll Vegetable', 'description' => 'Crispy vegetable spring rolls', 'price' => 340.00],
                ['name' => 'Spring Roll Chicken', 'description' => 'Crispy chicken spring rolls', 'price' => 380.00],
                ['name' => 'Defused Creamy Cheese Bombs', 'description' => 'Creamy cheese filled bombs', 'price' => 380.00],
                ['name' => 'Cheese Cigar Roll', 'description' => 'Crispy cheese filled cigar rolls', 'price' => 380.00],
                ['name' => 'Crunchy Mushroom Duplex', 'description' => 'Double layered crunchy mushroom', 'price' => 380.00],
                ['name' => 'Arabic Hummus Pita Pocket Falafel', 'description' => 'Traditional falafel with hummus and pita', 'price' => 380.00],
                ['name' => 'Bar-Be-Que Chicken Wings', 'description' => 'Smoky barbecue chicken wings', 'price' => 470.00],
                ['name' => 'Chicken Garlic Nuggets', 'description' => 'Crispy garlic flavored chicken nuggets', 'price' => 470.00],
                ['name' => 'Five Spice Fish and Chips', 'description' => 'Fish and chips with five spice seasoning', 'price' => 490.00],
                ['name' => 'Fish Finger', 'description' => 'Crispy breaded fish fingers', 'price' => 490.00],
                ['name' => 'Prawns Pepper Fry', 'description' => 'Spicy pepper fried prawns', 'price' => 740.00],
                ['name' => 'Peri-Peri Grilled Chicken', 'description' => 'Grilled chicken with peri-peri sauce', 'price' => 490.00],
                ['name' => 'Chicken Popcorn', 'description' => 'Bite-sized crispy chicken popcorn', 'price' => 490.00],
                ['name' => 'Corn Cheese Shots', 'description' => 'Corn and cheese filled shots', 'price' => 380.00],
                ['name' => 'Vada Pav', 'description' => 'Mumbai style vada pav', 'price' => 310.00],
                ['name' => 'Peanut Masala', 'description' => 'Spicy masala peanuts', 'price' => 270.00],
                ['name' => 'Eggs on Your Way (3 Eggs)', 'description' => 'Three eggs prepared your way - omelette, masala, plain, cheese, bhurji, boiled, or scrambled', 'price' => 280.00],
                ['name' => 'Chakhna Platter', 'description' => 'Mixed appetizer platter', 'price' => 410.00],
            ];

            foreach ($starterItems as $item) {
                MenuItem::firstOrCreate(
                    ['name' => $item['name'], 'vendor_id' => $vendor->id],
                    [
                        'name' => $item['name'],
                        'description' => $item['description'],
                        'price' => $item['price'],
                        'category_id' => $startersCategory->id,
                        'vendor_id' => $vendor->id,
                        'is_active' => true,
                    ]
                );
            }
        }
    }
}