<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.index', ['users' => $users]);
    }

    public function create()
    {
        return view('admin.create');
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
            'not_regex:/[0-9]/'
        ],
        'email' => 'required|string|email|max:255|unique:users',
        'role' => 'required|string',
        'password' => 'required|string|min:8',
    ], [
        'name.required' => 'Imię i nazwisko są wymagane.',
        'name.not_regex' => 'Imię i nazwisko nie mogą zawierać cyfr.',
        'email.required' => 'Adres e-mail jest wymagany.',
        'email.unique' => 'Ten adres e-mail jest już zajęty.',
        'password.required' => 'Hasło jest wymagane.',
        'password.min' => 'Hasło musi mieć co najmniej 8 znaków.',
    ]);

    \App\Models\User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'role' => $validated['role'],
        'password' => \Illuminate\Support\Facades\Hash::make($validated['password']),
    ]);

    return redirect('/admin/users')->with('success', 'Użytkownik został pomyślnie utworzony.');
}
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
{
    $user = \App\Models\User::findOrFail($id);

    $validated = $request->validate([
        'name' => [
            'required',
            'string',
            'max:255',
            'not_regex:/[0-9]/'
        ],
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'role' => 'required|string',
    ], [
        'name.required' => 'Imię i nazwisko są wymagane.',
        'name.not_regex' => 'Imię i nazwisko nie mogą zawierać cyfr.',
        'email.required' => 'Adres e-mail jest wymagany.',
        'email.unique' => 'Ten adres e-mail jest już zajęty.',
    ]);

    $user->update([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'role' => $validated['role'],
    ]);

    return redirect('/admin/users')->with('success', 'Dane użytkownika zostały zaktualizowane.');
}
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/admin/users');
    }
}