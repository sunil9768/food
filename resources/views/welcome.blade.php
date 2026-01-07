<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desi Delights - Authentic Indian Food Delivery</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'saffron': '#FF9933',
                        'curry': '#FF6B35',
                        'turmeric': '#FDB462'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-orange-50">
    <!-- Header -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-curry">🍛 Desi Delights</h1>
            <nav class="hidden md:flex space-x-6">
                <a href="#menu" class="text-gray-700 hover:text-curry">Menu</a>
                <a href="#testimonials" class="text-gray-700 hover:text-curry">Reviews</a>
                <a href="#contact" class="text-gray-700 hover:text-curry">Contact</a>
            </nav>
            <button class="bg-curry text-white px-6 py-2 rounded-full hover:bg-orange-600 transition">Order Now</button>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-saffron to-curry text-white py-20">
        <div class="container mx-auto px-4 flex flex-col lg:flex-row items-center">
            <div class="lg:w-1/2 mb-10 lg:mb-0">
                <h2 class="text-5xl font-bold mb-6">Fresh Roti & Sabji<br>Delivered Hot!</h2>
                <p class="text-xl mb-8">Experience authentic Indian flavors with our signature Aalu Sabji and freshly made rotis, delivered straight to your doorstep.</p>
                <button class="bg-white text-curry px-8 py-4 rounded-full text-lg font-semibold hover:bg-gray-100 transition shadow-lg">
                    Order Aalu Sabji Special - ₹149
                </button>
            </div>
            <div class="lg:w-1/2">
                <div class="bg-white rounded-2xl p-8 shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=500&h=400&fit=crop" 
                         alt="Delicious Aalu Sabji with Roti" 
                         class="w-full h-80 object-cover rounded-xl">
                    <div class="mt-4 text-center">
                        <h3 class="text-2xl font-bold text-gray-800">Aalu Sabji Special</h3>
                        <p class="text-gray-600">Spiced potatoes with fresh roti</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Dishes -->
    <section id="menu" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center text-gray-800 mb-12">Popular Dishes</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-orange-50 rounded-xl p-6 shadow-lg hover:shadow-xl transition">
                    <img src="https://images.unsplash.com/photo-1585937421612-70a008356fbe?w=300&h=200&fit=crop" 
                         alt="Dal Tadka" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Dal Tadka</h3>
                    <p class="text-gray-600 mb-4">Tempered lentils with aromatic spices</p>
                    <div class="flex justify-between items-center">
                        <span class="text-2xl font-bold text-curry">₹129</span>
                        <button class="bg-curry text-white px-4 py-2 rounded-full hover:bg-orange-600 transition">Add to Cart</button>
                    </div>
                </div>
                
                <div class="bg-orange-50 rounded-xl p-6 shadow-lg hover:shadow-xl transition">
                    <img src="https://images.unsplash.com/photo-1567188040759-fb8a883dc6d8?w=300&h=200&fit=crop" 
                         alt="Paneer Butter Masala" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Paneer Butter Masala</h3>
                    <p class="text-gray-600 mb-4">Creamy cottage cheese in rich tomato gravy</p>
                    <div class="flex justify-between items-center">
                        <span class="text-2xl font-bold text-curry">₹189</span>
                        <button class="bg-curry text-white px-4 py-2 rounded-full hover:bg-orange-600 transition">Add to Cart</button>
                    </div>
                </div>
                
                <div class="bg-orange-50 rounded-xl p-6 shadow-lg hover:shadow-xl transition">
                    <img src="https://images.unsplash.com/photo-1596797038530-2c107229654b?w=300&h=200&fit=crop" 
                         alt="Biryani" class="w-full h-48 object-cover rounded-lg mb-4">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Chicken Biryani</h3>
                    <p class="text-gray-600 mb-4">Fragrant basmati rice with tender chicken</p>
                    <div class="flex justify-between items-center">
                        <span class="text-2xl font-bold text-curry">₹249</span>
                        <button class="bg-curry text-white px-4 py-2 rounded-full hover:bg-orange-600 transition">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Customer Testimonials -->
    <section id="testimonials" class="py-16 bg-gradient-to-r from-orange-100 to-yellow-100">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center text-gray-800 mb-12">What Our Customers Say</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-curry rounded-full flex items-center justify-center text-white font-bold">P</div>
                        <div class="ml-4">
                            <h4 class="font-bold text-gray-800">Priya Sharma</h4>
                            <div class="text-yellow-500">★★★★★</div>
                        </div>
                    </div>
                    <p class="text-gray-600">"The aalu sabji reminds me of my mom's cooking! Fresh rotis and perfect spices. Will order again!"</p>
                </div>
                
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-curry rounded-full flex items-center justify-center text-white font-bold">R</div>
                        <div class="ml-4">
                            <h4 class="font-bold text-gray-800">Rahul Kumar</h4>
                            <div class="text-yellow-500">★★★★★</div>
                        </div>
                    </div>
                    <p class="text-gray-600">"Fast delivery and authentic taste. The dal tadka was exceptional. Highly recommended!"</p>
                </div>
                
                <div class="bg-white rounded-xl p-6 shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-curry rounded-full flex items-center justify-center text-white font-bold">A</div>
                        <div class="ml-4">
                            <h4 class="font-bold text-gray-800">Anita Patel</h4>
                            <div class="text-yellow-500">★★★★★</div>
                        </div>
                    </div>
                    <p class="text-gray-600">"Best Indian food delivery in the city! The paneer butter masala was creamy and delicious."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-curry text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-6">Hungry? Order Now!</h2>
            <p class="text-xl mb-8">Get your favorite Indian dishes delivered hot and fresh in 30 minutes</p>
            <button class="bg-white text-curry px-8 py-4 rounded-full text-lg font-semibold hover:bg-gray-100 transition shadow-lg">
                Start Your Order
            </button>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">🍛 Desi Delights</h3>
                    <p class="text-gray-400">Authentic Indian cuisine delivered fresh to your doorstep</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Contact Info</h4>
                    <p class="text-gray-400">📞 +91 98765 43210</p>
                    <p class="text-gray-400">📧 orders@desidelights.com</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Delivery Hours</h4>
                    <p class="text-gray-400">Mon-Sun: 11:00 AM - 11:00 PM</p>
                    <p class="text-gray-400">Free delivery on orders above ₹299</p>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 Desi Delights. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>