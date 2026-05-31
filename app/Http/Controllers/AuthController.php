<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
{
    dd('Trafiłeś do dobrej metody!');
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ], [
        'name.required' => 'Imię i nazwisko są wymagane.',
        'email.required' => 'Adres e-mail jest wymagany.',
        'email.unique' => 'Ten adres e-mail jest już zajęty.',
        'password.required' => 'Hasło jest wymagane.',
        'password.min' => 'Hasło musi mieć co najmniej 8 znaków.',
        'password.confirmed' => 'Hasła nie są identyczne.',
    ]);

    if (preg_match('/[0-9]/', $request->name)) {
        return back()->withErrors(['name' => 'Imię i nazwisko nie mogą zawierać cyfr.'])->withInput();
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        'role' => 'client',
    ]);

    auth()->login($user);

    return redirect('/');
}
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

    if (auth()->attempt($credentials)) {
        $request->session()->regenerate();

        if (auth()->user()->role === 'admin') {
            return redirect('/admin/dashboard');
        } elseif (auth()->user()->role === 'employee') {
            return redirect('/employee/dashboard');
        }

        return redirect('/');
    }

    return back()->withErrors([
        'email' => 'Błędny login lub hasło.',
    ])->onlyInput('email');
}
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}