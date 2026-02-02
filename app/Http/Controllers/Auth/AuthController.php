<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::where('email', $request->email)->first();

        // Check if user exists and account status
        if (!$user) {
            return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
        }

        if (!$user->canLogin()) {
            $message = $user->isLocked() ? 'Account is temporarily locked.' : 'Account is suspended.';
            return back()->withErrors(['email' => $message])->withInput();
        }

        // Check password
        if (!Hash::check($request->password, $user->password)) {
            // Increment failed attempts
            $user->increment('failed_login_attempts');
            
            // Lock account after 5 failed attempts
            if ($user->failed_login_attempts >= 5) {
                $user->update(['locked_until' => now()->addMinutes(30)]);
                AuditLog::log('account_locked', $user, null, null, 'Account locked due to multiple failed login attempts');
            }

            return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
        }

        // Reset failed attempts on successful login
        $user->update([
            'failed_login_attempts' => 0,
            'locked_until' => null,
            'last_login_at' => now(),
            'last_login_ip' => $request->ip(),
        ]);

        Auth::login($user, $request->filled('remember'));
        
        AuditLog::log('user_login', $user);

        // Check for intended purchase redirect
        if (session()->has('intended_purchase')) {
            $vehicleId = session()->pull('intended_purchase');
            return redirect()->route('purchases.create', $vehicleId)
                ->with('success', 'Welcome back! Please complete your vehicle purchase.');
        }

        // Redirect based on role
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('dashboard');
    }

    public function register(Request $request)
    {
        // Debug logging
        \Log::info('Registration attempt', [
            'email' => $request->email,
            'name' => $request->name,
            'phone' => $request->phone,
            'preferred_language' => $request->preferred_language,
        ]);

        $validator = Validator::make($request->all(), [
            //  'name' => 'required|string|max:255',
            'name' => [
    'required',
    'string',
    'max:255',
    'regex:/^[A-Za-z\s]+$/'
],

            // 
            'email' => [
    'required',
    'email:rfc,dns',
    'max:255',
    'unique:users,email'
],

            // 'phone' => 'required|string|max:20|unique:users',
            'phone' => [
    'required',
    'regex:/^(?:\+251|0)9\d{8}$/',
    'unique:users,phone',
],

            // 'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
'password' => [
    'required',
    'confirmed',
    Password::min(8)
        ->mixedCase()
        ->numbers()
        ->symbols(),
],

            'preferred_language' => 'required|in:en,am',
        ], [
            // Custom error messages
            'name.required' => 'Please enter your full name.',
            'name.string' => 'Name must be a valid text.',
            'name.regex' => 'Name must contain letters only (no numbers or symbols).',
            'name.max' => 'Name cannot exceed 255 characters.',
            
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already registered.',
            
            'phone.required' => 'Please enter your phone number.',
            'phone.regex' => 'Please enter a valid Ethiopian phone number.',
            'phone.unique' => 'This phone number is already registered.',

            
            'password.required' => 'Please enter a password.',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.min' => 'Password must be at least 8 characters long.',
            
            'preferred_language.required' => 'Please select your preferred language.',
            'preferred_language.in' => 'Please select a valid language option.',
        ]);

        if ($validator->fails()) {
            \Log::warning('Registration validation failed', [
                'errors' => $validator->errors()->toArray(),
                'input' => $request->except(['password', 'password_confirmation'])
            ]);
            
            return back()
                ->withErrors($validator)
                ->withInput($request->except(['password', 'password_confirmation']))
                ->with('registration_error', 'Please correct the errors below and try again.');
        }

        try {
            $customerRole = Role::where('name', 'customer')->first();

            if (!$customerRole) {
                \Log::error('Customer role not found during registration');
                return back()
                    ->withInput($request->except(['password', 'password_confirmation']))
                    ->with('error', 'System error: Customer role not found. Please contact support.');
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role_id' => $customerRole->id,
                'preferred_language' => $request->preferred_language,
                'status' => 'active',
            ]);

            \Log::info('User registered successfully', [
                'user_id' => $user->id,
                'email' => $user->email,
                'name' => $user->name,
            ]);

            AuditLog::log('user_registered', $user);

            Auth::login($user);

            return redirect()->route('dashboard')->with('success', 'Registration successful! Welcome to our platform.');
            
        } catch (\Exception $e) {
            \Log::error('Registration error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->except(['password', 'password_confirmation'])
            ]);
            
            return back()
                ->withInput($request->except(['password', 'password_confirmation']))
                ->with('error', 'Registration failed due to a system error. Please try again or contact support.');
        }
    }

    public function logout(Request $request)
    {
        AuditLog::log('user_logout');
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}