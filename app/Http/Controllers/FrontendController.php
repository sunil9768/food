<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\Category;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Setting;
use App\Events\OrderPlaced;
use App\Events\UserRegistered;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {
        $popularItems = MenuItem::where('is_active', true)
            ->with(['category', 'vendor'])
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
            
        $categories = Category::where('is_active', true)
            ->withCount('menuItems')
            ->get();
            
        // Get all restaurants/vendors with their menu items
        $restaurants = User::role('vendor')
            ->whereHas('menuItems', function($query) {
                $query->where('is_active', true);
            })
            ->withCount(['menuItems' => function($query) {
                $query->where('is_active', true);
            }])
            ->with(['menuItems' => function($query) {
                $query->where('is_active', true)->take(3);
            }])
            ->get();
            
        // Get settings for dynamic content
        $settings = [
            'site_name' => Setting::get('site_name', 'Desi Delights'),
            'site_tagline' => Setting::get('site_tagline', 'Multi-Vendor Food Delivery Platform'),
            'hero_title' => Setting::get('hero_title', '🏪 Grow Your Restaurant Business Online!'),
            'hero_subtitle' => Setting::get('hero_subtitle', 'Join Desi Delights platform and reach thousands of hungry customers. Register your restaurant for FREE and start earning more today!'),
            'partner_section_title' => Setting::get('partner_section_title', '🍴 Partner with Desi Delights'),
            'partner_section_subtitle' => Setting::get('partner_section_subtitle', 'Join thousands of restaurants growing their business with us'),
            'contact_phone' => Setting::get('contact_phone', '+91 98765 43210'),
            'contact_email' => Setting::get('contact_email', 'orders@desidelights.com'),
            'total_partners' => Setting::get('total_partners', '10+'),
            'opening_time' => Setting::get('opening_time', '11:00'),
            'closing_time' => Setting::get('closing_time', '23:00'),
            'free_delivery_above' => Setting::get('free_delivery_above', '299')
        ];
            
        return view('welcome', compact('popularItems', 'categories', 'restaurants', 'settings'));
    }
    
     public function partner()
    {
        return view('partner.index');
    }
    public function cart()
    {
        $settings = [
            'contact_phone' => Setting::get('contact_phone', '+91 98765 43210'),
            'contact_email' => Setting::get('contact_email', 'orders@desidelights.com'),
            'opening_time' => Setting::get('opening_time', '11:00'),
            'closing_time' => Setting::get('closing_time', '23:00'),
            'free_delivery_above' => Setting::get('free_delivery_above', '299')
        ];
        return view('frontend.cart', compact('settings'));
    }
    
    public function menu()
    {
        // Get all active menu items from all vendors
        $menuItems = MenuItem::where('is_active', true)
            ->with(['category', 'vendor'])
            ->orderBy('name')
            ->paginate(25);
            
        $settings = [
            'contact_phone' => Setting::get('contact_phone', '+91 98765 43210'),
            'contact_email' => Setting::get('contact_email', 'orders@desidelights.com'),
            'opening_time' => Setting::get('opening_time', '11:00'),
            'closing_time' => Setting::get('closing_time', '23:00'),
            'free_delivery_above' => Setting::get('free_delivery_above', '299')
        ];
            
        return view('frontend.menu', compact('menuItems', 'settings'));
    }

    public function vendorMenu($vendorId)
    {
        $vendor = User::role('vendor')
            ->with(['menuItems' => function($query) {
                $query->where('is_active', true)->with('category');
            }])
            ->findOrFail($vendorId);
            
        $settings = [
            'contact_phone' => Setting::get('contact_phone', '+91 98765 43210'),
            'contact_email' => Setting::get('contact_email', 'orders@desidelights.com'),
            'opening_time' => Setting::get('opening_time', '11:00'),
            'closing_time' => Setting::get('closing_time', '23:00'),
            'free_delivery_above' => Setting::get('free_delivery_above', '299')
        ];
            
        return view('frontend.vendor-menu', compact('vendor', 'settings'));
    }
    
    public function checkout(Request $request)
    {
        $cartData = $request->input('cart');
        
        // If cart is a JSON string, decode it
        if (is_string($cartData)) {
            $cartItems = json_decode($cartData, true);
        } else {
            $cartItems = $cartData;
        }
        
        if (empty($cartItems)) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty');
        }
        
        $isLoggedIn = Auth::check();
        
        return view('frontend.checkout', compact('cartItems', 'isLoggedIn'));
    }
    
    public function categoryItems($categorySlug)
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        
        $menuItems = MenuItem::where('is_active', true)
            ->where('category_id', $category->id)
            ->with(['vendor'])
            ->paginate(12);
            
        return view('frontend.category-items', compact('category', 'menuItems'));
    }

    public function placeOrder(Request $request)
    {
        $isLoggedIn = Auth::check();
        
        if ($isLoggedIn) {
            // For logged-in users
            $request->validate([
                'customer_phone' => 'required|string|max:15',
                'customer_address' => 'required|string',
                'payment_method' => 'required|in:cod,online,upi'
            ]);
            
            $user = Auth::user();
            $customerName = $user->name;
            $customerEmail = $user->email;
            $customerPhone = $request->customer_phone;
        } else {
            // For guest users
            $request->validate([
                'customer_name' => 'required|string|max:255',
                'customer_email' => 'required|email|unique:users,email',
                'customer_phone' => 'required|string|max:15',
                'customer_address' => 'required|string',
                'payment_method' => 'required|in:cod,online,upi'
            ]);
            
            // Generate random password and create account
            $password = Str::random(8);
            
            $user = User::create([
                'name' => $request->customer_name,
                'email' => $request->customer_email,
                'password' => Hash::make($password),
            ]);
            
            $user->assignRole('user');
            
            $customerName = $request->customer_name;
            $customerEmail = $request->customer_email;
            $customerPhone = $request->customer_phone;
        }

        // Get cart data
        $cartData = $request->input('cart', []);
        $cartItems = [];
        
        // Process cart data
        foreach ($cartData as $item) {
            if (is_string($item)) {
                $cartItems[] = json_decode($item, true);
            } else {
                $cartItems[] = $item;
            }
        }
        
        if (empty($cartItems)) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty');
        }
        
        // Calculate total
        $total = 0;
        $orderItems = [];
        
        foreach ($cartItems as $item) {
            $menuItem = MenuItem::find($item['id']);
            if ($menuItem) {
                $itemTotal = $menuItem->price * $item['quantity'];
                $total += $itemTotal;
                $orderItems[] = [
                    'menu_item_id' => $menuItem->id,
                    'name' => $menuItem->name,
                    'price' => $menuItem->price,
                    'quantity' => $item['quantity']
                ];
            }
        }

        // Create order
        $order = Order::create([
            'customer_name' => $customerName,
            'customer_email' => $customerEmail,
            'customer_phone' => $customerPhone,
            'customer_address' => $request->customer_address,
            'total_amount' => $total,
            'payment_method' => $request->payment_method,
            'notes' => $request->notes
        ]);

        // Create order items
        foreach ($orderItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_item_id' => $item['menu_item_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }

        // Dispatch events
        OrderPlaced::dispatch($order);
        
        if (!$isLoggedIn) {
            UserRegistered::dispatch($user, $password);
        }

        $message = !$isLoggedIn 
            ? 'Order placed successfully! Check your email for login details.'
            : 'Order placed successfully! You can track it in your dashboard.';

        return redirect()->route('home')->with('success', $message)->with('clearCart', true);
    }
}