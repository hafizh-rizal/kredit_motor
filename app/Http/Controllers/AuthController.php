<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('login.index');
    }

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::guard('web')->attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('dashboard');
        } elseif ($user->role === 'marketing') {
            return redirect()->route('dashboard');
        } elseif ($user->role === 'ceo') {
            return redirect()->route('dashboard');
        } elseif ($user->role === 'kurir') {
            return redirect()->route('dashboard');
        }


        return redirect()->route('login.index');
    }

    return back()->with('error', 'Email atau password salah!');
}

public function logout(Request $request)
{
    Auth::guard('web')->logout();
    // $request->session()->invalidate();
    // $request->session()->regenerateToken(); 
    return redirect()->route('login.index'); 
}

    
}