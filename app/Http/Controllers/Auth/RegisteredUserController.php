<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

// Регистрация (ТЗ п.4.1, роль Пользователь)
class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Строгая серверная валидация (ТЗ п.4.2.2)
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'], // хешируется автоматически (Argon2id)
            'role' => 'user',
        ]);

        event(new Registered($user));
        Auth::login($user);
        $request->session()->regenerate(); // уникальный токен сессии (ТЗ п.4.4)

        return redirect()->route('home');
    }
}
