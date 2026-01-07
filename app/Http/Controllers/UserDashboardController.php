<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:user');
    }

    public function dashboard()
    {
        $user = Auth::user();
        $currentOrder = Order::where('customer_email', $user->email)
                            ->whereIn('status', ['pending', 'confirmed', 'preparing', 'out_for_delivery'])
                            ->latest()
                            ->first();
        
        $orderHistory = Order::where('customer_email', $user->email)
                            ->latest()
                            ->take(5)
                            ->get();
        
        return view('user.dashboard', compact('currentOrder', 'orderHistory'));
    }

    public function orders()
    {
        $orders = Order::where('customer_email', Auth::user()->email)
                      ->latest()
                      ->paginate(10);
        
        return view('user.orders', compact('orders'));
    }

    public function orderDetails($id)
    {
        $order = Order::where('customer_email', Auth::user()->email)
                     ->findOrFail($id);
        
        return view('user.order-details', compact('order'));
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'current_password' => 'nullable|string',
            'password' => 'nullable|string|min:8|confirmed'
        ]);

        $user = Auth::user();
        
        if ($request->current_password && !Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
    }
}