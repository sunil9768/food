<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\Category;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\WelcomeEmail;

class FrontendController extends Controller
{
    public function index()
    {
        $popularItems = MenuItem::where('is_active', true)
            ->with('category')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
            
        $categories = Category::where('is_active', true)
            ->withCount('menuItems')
            ->get();
            
        return view('welcome', compact('popularItems', 'categories'));
    }
    
    public function cart()
    {
        return view('frontend.cart');
    }
    
    public function menu()
    {
        $categories = Category::where('is_active', true)
            ->with(['menuItems' => function($query) {
                $query->where('is_active', true);
            }])
            ->get();
            
        return view('frontend.menu', compact('categories'));
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
                    'name' => $menuItem->name,
                    'price' => $menuItem->price,
                    'quantity' => $item['quantity']
                ];
            }
        }

        // Create order
        Order::create([
            'customer_name' => $customerName,
            'customer_email' => $customerEmail,
            'customer_phone' => $customerPhone,
            'customer_address' => $request->customer_address,
            'total_amount' => $total,
            'payment_method' => $request->payment_method,
            'items' => $orderItems,
            'notes' => $request->notes
        ]);

        // Send email only for new users
        if (!$isLoggedIn) {
            Mail::to($customerEmail)->send(new WelcomeEmail($customerName, $customerEmail, $password));
            $message = 'Order placed successfully! Check your email for login details.';
        } else {
            $message = 'Order placed successfully! You can track it in your dashboard.';
        }

        return redirect()->route('home')->with('success', $message);
    }
}