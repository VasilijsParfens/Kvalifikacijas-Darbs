<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // Rate limiting
        if (RateLimiter::tooManyAttempts('register:' . $request->ip(), 5)) {
            return response()->json(
                [
                    'error' => 'Too many attempts. Please try again later.',
                ],
                429,
            );
        }

        RateLimiter::hit('register:' . $request->ip(), 60);

        // Validate data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        \Log::info('User Created:', ['user' => $user]); // Log the created user

        auth()->login($user);

    }

    public function login(Request $request)
    {
        // Rate limiting
        $key = 'login:' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            return redirect()
                ->back()
                ->withErrors([
                    'error' => 'Too many login attempts. Please try again in 1 minute.',
                ]);
        }

        // Validate login data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Attempt to authenticate user
        if (Auth::attempt($request->only('email', 'password'))) {
            Log::info('User logged in successfully.', [
                'user_id' => Auth::id(),
                'email' => $request->email,
                'ip_address' => $request->ip(),
                'timestamp' => now(),
            ]);
            // Regenerate session to prevent session hijacking
            $request->session()->regenerate();

            // Clear rate limiting on successful login
            RateLimiter::clear($key);

            return redirect('/');
        }

        // Increment rate limit attempts
        RateLimiter::hit($key, 60);

        return redirect()
            ->back()
            ->withErrors([
                'error' => 'Invalid email or password.',
            ])
            ->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
