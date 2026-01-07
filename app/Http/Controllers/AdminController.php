<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        return view('admin.users');
    }

    public function orders()
    {
        return view('admin.orders');
    }

    public function menu()
    {
        $categories = \App\Models\Category::with('menuItems')->get();
        return view('admin.menu', compact('categories'));
    }

    public function createMenuItem()
    {
        $categories = \App\Models\Category::all();
        return view('admin.menu-create', compact('categories'));
    }

    public function storeMenuItem(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/menu'), $imageName);
            $data['image'] = 'images/menu/'.$imageName;
        }

        \App\Models\MenuItem::create($data);
        return redirect()->route('admin.menu')->with('success', 'Menu item created successfully!');
    }

    public function settings()
    {
        $settings = \App\Models\Setting::all()->pluck('value', 'key');
        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $checkboxes = ['payment_cod', 'payment_online', 'payment_upi', 'notifications_email', 'notifications_sms', 'notifications_push'];
        
        foreach ($request->except('_token') as $key => $value) {
            \App\Models\Setting::set($key, $value);
        }
        
        // Set unchecked checkboxes to 0
        foreach ($checkboxes as $checkbox) {
            if (!$request->has($checkbox)) {
                \App\Models\Setting::set($checkbox, '0');
            }
        }
        
        return redirect()->route('admin.settings')->with('success', 'Settings updated successfully!');
    }
}
