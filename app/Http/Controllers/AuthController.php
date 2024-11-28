<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
   // Menampilkan halaman login
   public function showLoginForm()
   {
       return view('auth.login');
   }

   // Menampilkan halaman registrasi
   public function showRegisterForm()
   {
       return view('auth.register');
   }

   // Menangani registrasi pengguna
   public function register(Request $request)
   {
       $validated = $request->validate([
           'name' => 'required|string|max:255',
           'email' => 'required|string|email|max:255|unique:users',
           'password' => 'required|string|min:8|confirmed',
       ]);

       $user = User::create([
           'name' => $validated['name'],
           'email' => $validated['email'],
           'password' => bcrypt($validated['password']),
           'role' => 'user', // Set default role jadi 'user'
       ]);

       Auth::login($user);

       return redirect('/dashboard');
   }

   // Menangani login pengguna
   public function login(Request $request)
   {
      $validated = $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    // Cek apakah login berhasil
    if (Auth::attempt($validated)) {
        $request->session()->regenerate();

        // Cek apakah user memiliki role 'admin'
        if (auth()->user()->role === 'admin') {
            return redirect('/admin-dashboard'); // Arahkan ke dashboard admin
        }

        // Cek jika role-nya 'user'
        return redirect('/user-dashboard'); // Arahkan ke halaman pengguna biasa
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
   }

   // Logout pengguna
   public function logout()
   {
       Auth::logout();
       return redirect('/');
   }
}
