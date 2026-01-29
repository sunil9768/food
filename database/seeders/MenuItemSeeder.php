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
        if (!$vendor) return;

        $menuData = [
            'soup' => [
                ['Tomato (On Your Way)', 'Fresh tomato soup with herbs and spices', 295],
                ['Burnt Garlic Soup', 'Aromatic burnt garlic soup with rich flavors', 295],
                ['Cream of Basil Soup', 'Creamy basil soup with fresh herbs', 295],
                ['Broccoli Soup', 'Healthy broccoli soup with cream', 295],
                ['Shorba Soup', 'Traditional Indian shorba soup', 350],
                ['Cream Soup Vegetable', 'Mixed vegetable cream soup', 295],
                ['Cream Soup Mushroom', 'Rich mushroom cream soup', 350],
                ['Cream Soup Chicken', 'Creamy chicken soup with herbs', 350],
                ['Hot & Sour Soup Vegetable', 'Spicy and tangy vegetable soup', 295],
                ['Hot & Sour Soup Chicken', 'Spicy and tangy chicken soup', 350],
                ['Sweet Corn Cream Soup Vegetable', 'Sweet corn cream soup with vegetables', 295],
                ['Sweet Corn Cream Soup Chicken', 'Sweet corn cream soup with chicken', 350],
                ['Manchow Soup Vegetable', 'Spicy Manchow soup with vegetables', 295],
                ['Manchow Soup Chicken', 'Spicy Manchow soup with chicken', 350],
                ['Clear Soup Vegetable', 'Light and healthy vegetable clear soup', 350],
                ['Clear Soup Chicken', 'Light and healthy chicken clear soup', 350],
            ],
            'starters' => [
                ['Nachos with Salsa', 'Crispy nachos served with fresh salsa', 335],
                ['Baked Cheese Loaded Nachos', 'Nachos loaded with melted cheese', 385],
                ['Garlic Bread Pull Apart', 'Soft pull apart garlic bread', 350],
                ['Chilli Cheese Garlic Bread', 'Garlic bread with chilli and cheese', 310],
                ['Jalapeno Garlic Bread', 'Spicy jalapeno garlic bread', 350],
                ['French Fries Salted', 'Classic salted french fries', 260],
                ['Peri-Peri French Fries', 'Spicy peri-peri seasoned fries', 290],
                ['Cheese Loaded French Fries', 'Fries loaded with melted cheese', 320],
                ['Khajuri Malai Kofta (Chef\'s Signature Dish)', 'Chef\'s special malai kofta with dates', 480],
                ['Paneer Makhani', 'Rich and creamy paneer in tomato gravy', 460],
                ['Paneer Lababdar (Spicy)', 'Spicy paneer curry with rich gravy', 460],
                ['Lahori Paneer Masala (Spicy)', 'Spicy Lahori style paneer masala', 460],
                ['Palak Paneer', 'Paneer cooked in spinach gravy', 470],
                ['Kadhai Paneer (Spicy)', 'Spicy paneer cooked in kadhai style', 450],
                ['Dal Tadka', 'Yellow lentils with tempering', 380],
                ['Dal Panchmail', 'Mixed five lentils curry', 380],
                ['Dal Makhani', 'Creamy black lentils with butter', 420],
                ['Rajma Rasila', 'Kidney beans in rich gravy', 460],
                ['Kaju Curry', 'Cashew nuts in creamy curry', 510],
                ['Corn Methi Palak', 'Corn with fenugreek and spinach', 430],
            ],
            'rice-and-biryani' => [
                ['Steamed Rice', 'Plain steamed basmati rice', 280],
                ['Jeera Rice', 'Cumin flavored basmati rice', 340],
                ['Subz Pulao', 'Vegetable pulao with aromatic spices', 350],
                ['Navratan Pulao', 'Nine gems pulao with mixed vegetables', 360],
                ['Peas Pulao', 'Green peas pulao', 360],
                ['Hyderabadi Subz Biryani', 'Authentic Hyderabadi vegetable biryani', 380],
                ['Murgh Hyderabadi Biryani', 'Traditional chicken Hyderabadi biryani', 480],
                ['Hyderabadi Gosht Biryani', 'Authentic mutton Hyderabadi biryani', 550],
                ['Fried Rice Vegetable', 'Wok-tossed vegetable fried rice', 330],
                ['Fried Rice Egg', 'Egg fried rice with scrambled eggs', 390],
                ['Fried Rice Chicken', 'Chicken fried rice with tender pieces', 450],
            ],
            'noodles' => [
                ['Hakka Noodles Veg', 'Vegetable hakka noodles', 450],
                ['Hakka Noodles Egg', 'Egg hakka noodles', 520],
                ['Hakka Noodles Chicken', 'Chicken hakka noodles', 550],
                ['Chilli Garlic Noodles Veg', 'Spicy vegetable chilli garlic noodles', 450],
                ['Chilli Garlic Noodles Chicken', 'Spicy chicken chilli garlic noodles', 550],
                ['Schezwan Noodles Veg', 'Spicy vegetable schezwan noodles', 450],
                ['Schezwan Noodles Chicken', 'Spicy chicken schezwan noodles', 550],
                ['Desi Chowmein Veg', 'Indian style vegetable chowmein', 410],
                ['Desi Chowmein Chicken', 'Indian style chicken chowmein', 490],
                ['Butter Chilli Garlic Noodles Veg', 'Buttery vegetable chilli garlic noodles', 450],
                ['Butter Chilli Garlic Noodles Chicken', 'Buttery chicken chilli garlic noodles', 550],
            ],
            'indian-breads' => [
                ['Tandoori Roti Plain', 'Plain tandoori roti', 60],
                ['Tandoori Roti Butter', 'Butter tandoori roti', 60],
                ['Tandoori Naan Plain', 'Plain tandoori naan', 100],
                ['Tandoori Naan Butter', 'Butter tandoori naan', 100],
                ['Chur Chur Naan', 'Crispy layered naan', 120],
                ['Garlic Naan', 'Naan with garlic and herbs', 120],
                ['Kulcha Aloo', 'Potato stuffed kulcha', 150],
                ['Kulcha Paneer', 'Paneer stuffed kulcha', 150],
            ],
            'accompaniment' => [
                ['Plain Curd', 'Fresh plain yogurt', 150],
                ['Vegetable Raita', 'Mixed vegetable raita', 180],
                ['Bundi Raita', 'Crispy bundi raita', 180],
                ['Fruit Raita', 'Mixed fruit raita', 190],
                ['Chaach', 'Traditional buttermilk', 150],
                ['Lassi Salted', 'Salted yogurt drink', 220],
                ['Lassi Sweet', 'Sweet yogurt drink', 220],
            ],
            'desserts' => [
                ['Ice Cream', 'Creamy vanilla ice cream', 155],
                ['Gulab Jamun', 'Traditional sweet gulab jamun', 155],
                ['Gulab Jamun with Ice Cream', 'Gulab jamun served with ice cream', 195],
                ['Gajar Halwa (Seasonal)', 'Traditional carrot halwa - seasonal special', 195],
                ['Sizzling Brownie', 'Hot chocolate brownie on sizzling plate', 195],
                ['Brownie with Ice Cream', 'Chocolate brownie served with ice cream', 225],
            ],
            'main-course' => [
                ['Prawn in Hot Basil Sauce', 'Fresh prawns cooked in spicy hot basil sauce', 810],
                ['Vegetable Thai Green Curry with Rice', 'Thai green curry with vegetables served with rice', 450],
                ['Chicken Thai Red Curry with Rice', 'Thai red curry with chicken served with rice', 510],
                ['Oriental Greens with Hot Garlic Sauce', 'Oriental vegetables in spicy hot garlic sauce', 390],
                ['Cottage Cheese and Greens with Hot Basil Sauce', 'Cottage cheese and vegetables in spicy hot basil sauce', 420],
            ],
            'sizzlers' => [
                ['Veg Oriental Sizzler', 'Chilli Paneer, Manchurian, Spring Roll, Rice/Noodles on sizzling plate', 650],
                ['Non-Veg Oriental Sizzler', 'Chilli Chicken, Chicken Manchurian, Chicken Spring Roll, Rice/Noodles on sizzling plate', 750],
                ['Tandoori Veg Kebab Platter', 'Paneer Tikka, Dahi Kebab, Soya Chaap, Veg Seekh Kebab, Tandoori Aloo', 650],
                ['Chef\'s Special Mezze Platter (Veg)', 'Pita Falafel, Leban\'s Burrito Bowl, Hummus, Baba Ganoush, Beetroot Hummus', 650],
            ],
            'indian-curry-veg' => [
                ['Paneer Rada Masala (Chef\'s Signature Dish)', 'Chef\'s special paneer rada masala', 450],
                ['Navratan Korma', 'Nine gems vegetable korma', 440],
                ['Paneer Badami Korma', 'Paneer in rich almond korma', 450],
                ['Chhole Amritsari', 'Amritsari style chickpea curry', 390],
                ['Soya Chaap Masala', 'Soya chaap in spicy masala', 430],
            ],
            'momos' => [
                ['Spinach Corn & Mushroom Momos', 'Steamed/Fried/Tandoori momos with spinach, corn and mushroom', 350],
                ['Veg Chinese Momos', 'Steamed/Fried/Tandoori vegetable Chinese momos', 350],
                ['Chicken Sumai Momos', 'Steamed/Fried/Tandoori chicken sumai momos', 410],
            ],
            'salads' => [
                ['Greek Salad', 'Traditional Greek salad with feta cheese', 340],
                ['Veg Caesar Salad', 'Classic vegetarian Caesar salad', 310],
                ['Chicken Caesar Salad', 'Classic chicken Caesar salad', 350],
                ['Green Salad', 'Fresh green salad', 200],
            ],
            'burgers' => [
                ['Potato Rostey Burger', 'Crispy potato rostey burger', 350],
                ['BBQ Chicken Burger', 'Barbecue chicken burger', 430],
                ['Chef\'s Special Chicken Burger', 'Chef\'s special chicken burger', 470],
            ],
            'pasta' => [
                ['Penne Alfredo Vegetable', 'Creamy penne alfredo with vegetables', 490],
                ['Penne Alfredo Chicken', 'Creamy penne alfredo with chicken', 560],
                ['Spaghetti Aglio Olio', 'Classic spaghetti aglio olio', 450],
                ['All-Time Favorite Lasagna', 'Classic layered lasagna', 530],
                ['Baked Mac & Cheese', 'Baked macaroni and cheese', 490],
            ],
        ];

        foreach ($menuData as $categorySlug => $items) {
            $category = Category::where('slug', $categorySlug)->first();
            if (!$category) continue;

            foreach ($items as [$name, $description, $price]) {
                MenuItem::firstOrCreate(
                    ['name' => $name, 'vendor_id' => $vendor->id],
                    [
                        'name' => $name,
                        'description' => $description,
                        'price' => $price,
                        'category_id' => $category->id,
                        'vendor_id' => $vendor->id,
                        'is_active' => true,
                    ]
                );
            }
        }
    }
}