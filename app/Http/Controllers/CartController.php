<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add(Request $request)
    {
        $request->validate([
            'menu_item_id' => 'required|exists:menu_items,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = Cart::where('user_id', Auth::id())
                       ->where('menu_item_id', $request->menu_item_id)
                       ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'menu_item_id' => $request->menu_item_id,
                'quantity' => $request->quantity
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Item added to cart']);
    }

    public function view()
    {
        $cartItems = Cart::where('user_id', Auth::id())
                        ->with('menuItem')
                        ->get();
        
        return view('frontend.cart', compact('cartItems'));
    }

    public function update(Request $request, $id)
    {
        $cartItem = Cart::where('user_id', Auth::id())->findOrFail($id);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json(['success' => true]);
    }

    public function remove($id)
    {
        Cart::where('user_id', Auth::id())->findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    public function checkout()
    {
        $cartItems = Cart::where('user_id', Auth::id())->with('menuItem')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty');
        }

        return view('frontend.checkout', compact('cartItems'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:15',
            'customer_address' => 'required|string',
            'payment_method' => 'required|in:cod,online,upi'
        ]);

        $cartItems = Cart::where('user_id', Auth::id())->with('menuItem')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty');
        }

        $total = $cartItems->sum(function($item) {
            return $item->menuItem->price * $item->quantity;
        });

        $orderItems = $cartItems->map(function($item) {
            return [
                'name' => $item->menuItem->name,
                'price' => $item->menuItem->price,
                'quantity' => $item->quantity
            ];
        })->toArray();

        Order::create([
            'customer_name' => $request->customer_name,
            'customer_email' => Auth::user()->email,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'total_amount' => $total,
            'payment_method' => $request->payment_method,
            'items' => $orderItems,
            'notes' => $request->notes
        ]);

        // Clear cart
        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('home')->with('success', 'Order placed successfully!');
    }
}