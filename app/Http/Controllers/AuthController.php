<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function showLogin()
    {
        $recaptchaEnabled = Setting::get('recaptcha_enabled', '0') == '1';
        $recaptchaSiteKey = Setting::get('recaptcha_site_key', '');
        return view('auth.login', compact('recaptchaEnabled', 'recaptchaSiteKey'));
    }

    public function showRegister()
    {
        $recaptchaEnabled = Setting::get('recaptcha_enabled', '0') == '1';
        $recaptchaSiteKey = Setting::get('recaptcha_site_key', '');
        return view('auth.register', compact('recaptchaEnabled', 'recaptchaSiteKey'));
    }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        
        if (Setting::get('recaptcha_enabled', '0') == '1') {
            $rules['g-recaptcha-response'] = 'required';
        }
        
        $request->validate($rules);
        
        if (Setting::get('recaptcha_enabled', '0') == '1') {
            if (!$this->verifyRecaptcha($request->input('g-recaptcha-response'))) {
                return back()->withErrors(['recaptcha' => 'reCAPTCHA verification failed. Please try again.']);
            }
        }

        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $user = Auth::user();
            
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('vendor')) {
                return redirect()->route('vendor.dashboard');
            } else {
                return redirect()->route('user.dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
        
        if (Setting::get('recaptcha_enabled', '0') == '1') {
            $rules['g-recaptcha-response'] = 'required';
        }
        
        $request->validate($rules);
        
        if (Setting::get('recaptcha_enabled', '0') == '1') {
            if (!$this->verifyRecaptcha($request->input('g-recaptcha-response'))) {
                return back()->withErrors(['recaptcha' => 'reCAPTCHA verification failed. Please try again.']);
            }
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        $user->assignRole('user');
        
        Auth::login($user);
        
        return redirect()->route('user.dashboard')->with('success', 'Registration successful! Welcome to Desi Delights!');
    }

    public function showVendorRegister()
    {
        $recaptchaEnabled = Setting::get('recaptcha_enabled', '0') == '1';
        $recaptchaSiteKey = Setting::get('recaptcha_site_key', '');
        return view('auth.vendor-register', compact('recaptchaEnabled', 'recaptchaSiteKey'));
    }

    public function vendorRegister(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'restaurant_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
        
        if (Setting::get('recaptcha_enabled', '0') == '1') {
            $rules['g-recaptcha-response'] = 'required';
        }
        
        $request->validate($rules);
        
        if (Setting::get('recaptcha_enabled', '0') == '1') {
            if (!$this->verifyRecaptcha($request->input('g-recaptcha-response'))) {
                return back()->withErrors(['recaptcha' => 'reCAPTCHA verification failed. Please try again.']);
            }
        }

        $user = User::create([
            'name' => $request->name,
            'restaurant_name' => $request->restaurant_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        $user->assignRole('vendor');
        
        Auth::login($user);
        
        return redirect()->route('vendor.dashboard')->with('success', 'Vendor registration successful! Welcome to Desi Delights!');
    }
    
    private function verifyRecaptcha($token)
    {
        $secretKey = Setting::get('recaptcha_secret_key', '');
        $threshold = (float) Setting::get('recaptcha_threshold', '0.5');
        
        if (empty($secretKey)) {
            return false;
        }
        
       $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $secretKey,
            'response' => $token,
            'remoteip' => request()->ip()
        ]);
        
        $result = $response->json();
        
        return $result['success'] && $result['score'] >= $threshold;
    }
}