<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

public function login(Request $request)
{
    $credentials = $request->validate([
        'username' => ['required', 'string'],
        'password' => ['required', 'string'],
    ]);

    $user = User::where('username', $request->username)->first();

    if ($user) {
        if (strlen($user->password) == 60 && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->intended('/');
        }

        if ($request->password === $user->password) {
            Auth::login($user);
            return redirect()->intended('/');
        }
    }

    return back()->withErrors([
        'username' => 'The provided credentials do not match our records.',
    ]);
}


    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:user',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password), 
            'role_id' => 2 
        ]);

        Auth::login($user);

        return redirect()->route('login')->with('success', 'Registration successful. You can now log in.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
