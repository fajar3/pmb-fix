<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            // Cek apakah user dibanned
            if (Auth::user()->status == 'banned') {
                Auth::logout();
                return back()->with('error', 'Akun Anda telah dibanned.');
            }

            // Redirect sesuai dengan role
            return redirect()->route(Auth::user()->role . '.dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'user'; // Default role "user"
        $user->status = 'active'; // Tambahkan status default
        $user->save();

        Auth::login($user);

        return redirect()->route('user.dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
