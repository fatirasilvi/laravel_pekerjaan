<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Halaman Register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses Register
    public function register(Request $request)
{
    $request->validate([
        'name'     => 'required',
        'email'    => 'required|email|unique:users',
        'password' => 'required|min:8|confirmed',
    ]);

    $user = User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'role_id'  => 2,
    ]);

    Auth::login($user);

    return redirect()->route('dashboard'); // FIX
}


    // Halaman Login
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Pastikan user punya role
            if ($user->role) {
                $roleName = strtolower($user->role->name);

                if ($roleName === 'admin') {
                    return redirect()->intended('/admin/dashboard');
                } elseif ($roleName === 'user') {
                    return redirect()->intended('/user/dashboard');
                }
            }

            // Jika tidak punya role atau role tidak dikenali
            Auth::logout();
            return redirect()
                ->route('login')
                ->withErrors(['role' => 'Role tidak dikenali.']);
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
