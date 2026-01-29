<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Order;
use App\Models\User;
use App\Models\MenuItem;
use App\Models\Category;
use App\Models\Setting;
use App\Events\OrderStatusUpdated;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function dashboard()
    {
        $stats = [
            'total_orders' => Order::count(),
            'revenue' => Order::where('payment_status', 'paid')->sum('total_amount'),
            'customers' => User::whereHas('roles', function($q) {
                $q->where('name', '!=', 'admin');
            })->count(),
            'menu_items' => MenuItem::count()
        ];
        
        $recent_orders = Order::latest()->take(5)->get();
        $categories = Category::withCount('menuItems')->get();
        $recent_menu_items = MenuItem::with('category')->latest()->take(5)->get();
        
        return view('admin.dashboard', compact('stats', 'recent_orders', 'categories', 'recent_menu_items'));
    }

    public function users()
    {
        $users = User::with('roles')->latest()->get();
        return view('admin.users', compact('users'));
    }

    public function editUser($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::whereIn('name', ['admin', 'user'])->get();
        return view('admin.user-edit', compact('user', 'roles'));
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'role' => 'required|in:admin,user'
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
        
        $user->syncRoles([$request->role]);
        
        return redirect()->route('admin.users')->with('success', 'User updated successfully!');
    }

    public function orders()
    {
        $orders = Order::with('orderItems')->latest()->get();
        return view('admin.orders', compact('orders'));
    }

    public function menu()
    {
        $menuItems = MenuItem::with('category')->get();
        return view('admin.menu', compact('menuItems'));
    }

    public function createMenuItem()
    {
        $categories = Category::all();
        return view('admin.menu-create', compact('categories'));
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
            'is_active' => true,
        ]);

        return redirect()->route('admin.menu')->with('success', 'Menu item created successfully!');
    }

    public function editMenuItem($id)
    {
        $menuItem = MenuItem::findOrFail($id);
        $categories = Category::all();
        return view('admin.menu-edit', compact('menuItem', 'categories'));
    }

    public function updateMenuItem(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $menuItem = MenuItem::findOrFail($id);
        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/menu'), $imageName);
            $data['image'] = 'images/menu/'.$imageName;
        }
        
        $data['is_active'] = $request->has('is_active');
        $menuItem->update($data);
        
        return redirect()->route('admin.menu')->with('success', 'Menu item updated successfully!');
    }

    public function deleteMenuItem($id)
    {
        $menuItem = MenuItem::findOrFail($id);
        $menuItem->delete();
        return redirect()->route('admin.menu')->with('success', 'Menu item deleted successfully!');
    }

    public function settings()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        try {
            $checkboxes = ['payment_cod', 'payment_online', 'payment_upi', 'notifications_email', 'notifications_sms', 'notifications_push'];
            
            foreach ($request->except('_token') as $key => $value) {
                Setting::set($key, $value);
            }
            
            // Set unchecked checkboxes to 0
            foreach ($checkboxes as $checkbox) {
                if (!$request->has($checkbox)) {
                    Setting::set($checkbox, '0');
                }
            }
            
            return redirect()->route('admin.settings')->with('success', 'Settings updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.settings')->with('error', 'Failed to update settings. Please try again.');
        }
    }

    public function categories()
    {
        $categories = Category::all();
        return view('admin.categories', compact('categories'));
    }

    public function createCategory()
    {
        return view('admin.category-create');
    }

    public function storeCategory(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string'
            ]);

            Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description
            ]);

            return redirect()->route('admin.categories')->with('success', 'Category created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.categories')->with('error', 'Failed to create category.');
        }
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category-edit', compact('category'));
    }

    public function updateCategory(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string'
            ]);

            $category = Category::findOrFail($id);
            $category->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description,
                'is_active' => $request->has('is_active')
            ]);

            return redirect()->route('admin.categories')->with('success', 'Category updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.categories')->with('error', 'Failed to update category.');
        }
    }

    public function deleteCategory($id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            return redirect()->route('admin.categories')->with('success', 'Category deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('admin.categories')->with('error', 'Failed to delete category.');
        }
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,preparing,out_for_delivery,delivered,cancelled'
        ]);

        $order = Order::findOrFail($id);
        $oldStatus = $order->status;
        $order->status = $request->status;
        $order->save();

        // Dispatch event to send email to customer
        OrderStatusUpdated::dispatch($order, $oldStatus, $request->status);

        return response()->json(['success' => true, 'message' => 'Order status updated successfully']);
    }

    public function orderDetails($id)
    {
        $order = Order::with('orderItems.menuItem')->findOrFail($id);
        return view('admin.order-details', compact('order'));
    }

    public function invoice($id)
    {
        $order = Order::with('orderItems.menuItem')->findOrFail($id);
        return view('admin.invoice', compact('order'));
    }
}
