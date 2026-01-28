<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    public function dashboard()
    {
        $vendor = Auth::user();
        $totalMenuItems = MenuItem::where('vendor_id', $vendor->id)->count();
        
        // Get orders that contain vendor's items
        $vendorMenuItemIds = MenuItem::where('vendor_id', $vendor->id)->pluck('id')->toArray();
        $totalOrders = Order::whereRaw('JSON_EXTRACT(items, "$[*].menu_item_id") REGEXP ?', [implode('|', $vendorMenuItemIds)])->count();
        
        $recentOrders = Order::whereRaw('JSON_EXTRACT(items, "$[*].menu_item_id") REGEXP ?', [implode('|', $vendorMenuItemIds)])
            ->latest()
            ->take(5)
            ->get();

        return view('vendor.dashboard', compact('totalMenuItems', 'totalOrders', 'recentOrders'));
    }

    public function menu()
    {
        $menuItems = MenuItem::where('vendor_id', Auth::id())->with('category')->get();
        return view('vendor.menu', compact('menuItems'));
    }

    public function createMenuItem()
    {
        $categories = Category::all();
        return view('vendor.menu.create', compact('categories'));
    }

    public function storeMenuItem(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('menu-items', 'public');

        MenuItem::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $imagePath,
            'vendor_id' => Auth::id(),
            'is_active' => true,
        ]);

        return redirect()->route('vendor.menu')->with('success', 'Menu item created successfully!');
    }

    public function editMenuItem($id)
    {
        $menuItem = MenuItem::where('vendor_id', Auth::id())->findOrFail($id);
        $categories = Category::all();
        return view('vendor.menu.edit', compact('menuItem', 'categories'));
    }

    public function updateMenuItem(Request $request, $id)
    {
        $menuItem = MenuItem::where('vendor_id', Auth::id())->findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ];

        if ($request->hasFile('image')) {
            if ($menuItem->image) {
                Storage::disk('public')->delete($menuItem->image);
            }
            $data['image'] = $request->file('image')->store('menu-items', 'public');
        }

        $menuItem->update($data);

        return redirect()->route('vendor.menu')->with('success', 'Menu item updated successfully!');
    }

    public function deleteMenuItem($id)
    {
        $menuItem = MenuItem::where('vendor_id', Auth::id())->findOrFail($id);
        
        if ($menuItem->image) {
            Storage::disk('public')->delete($menuItem->image);
        }
        
        $menuItem->delete();

        return redirect()->route('vendor.menu')->with('success', 'Menu item deleted successfully!');
    }

    public function orders()
    {
        $vendorMenuItemIds = MenuItem::where('vendor_id', Auth::id())->pluck('id')->toArray();
        
        if (empty($vendorMenuItemIds)) {
            $orders = collect();
        } else {
            $orders = Order::whereRaw('JSON_EXTRACT(items, "$[*].menu_item_id") REGEXP ?', [implode('|', $vendorMenuItemIds)])
                ->latest()
                ->get()
                ->map(function($order) use ($vendorMenuItemIds) {
                    // Filter items to only show vendor's items
                    $vendorItems = collect($order->items)->filter(function($item) use ($vendorMenuItemIds) {
                        return in_array($item['menu_item_id'], $vendorMenuItemIds);
                    });
                    $order->vendor_items = $vendorItems;
                    return $order;
                });
        }

        return view('vendor.orders', compact('orders'));
    }

    public function profile()
    {
        $vendor = Auth::user();
        return view('vendor.profile', compact('vendor'));
    }

    public function updateProfile(Request $request)
    {
        $vendor = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'restaurant_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $vendor->id,
            'password' => 'nullable|string|min:8|confirmed',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'restaurant_name' => $request->restaurant_name,
            'email' => $request->email,
        ];

        if ($request->hasFile('banner_image')) {
            if ($vendor->banner_image) {
                Storage::disk('public')->delete($vendor->banner_image);
            }
            $data['banner_image'] = $request->file('banner_image')->store('banners', 'public');
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $vendor->update($data);

        return redirect()->route('vendor.profile')->with('success', 'Profile updated successfully!');
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,preparing,ready,delivered,cancelled'
        ]);

        $order = Order::findOrFail($id);
        $oldStatus = $order->status;
        $order->status = $request->status;
        $order->save();

        return response()->json(['success' => true, 'message' => 'Order status updated successfully']);
    }
}