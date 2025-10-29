<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function home()
{
    return view('home');
}

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);


        if ($credentials['login'] === 'admin' && $credentials['password'] === 'bookworm') {
            $user = User::where('login', 'admin')->first();
            if (!$user) {

                $user = User::create([
                    'full_name' => 'Администратор',
                    'login' => 'admin',
                    'phone' => '+7(000)-000-00-00',
                    'email' => 'admin@bookworm.ru',
                    'password' => Hash::make('bookworm'),
                ]);
            }
            Auth::login($user);
            return redirect()->route('admin.index');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            if (Auth::user()->login === 'admin') {
                return redirect()->route('admin.index');
            }
            
            return redirect()->route('cards.index');
        }

        return back()->withErrors([
            'login' => 'Неверный логин или пароль.',
        ])->onlyInput('login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255|regex:/^[а-яА-ЯёЁ\s]+$/u',
            'login' => 'required|string|min:6|unique:users|regex:/^[а-яА-ЯёЁa-zA-Z0-9_]+$/u',
            'phone' => 'required|regex:/^\+7\(\d{3}\)-\d{3}-\d{2}-\d{2}$/',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'full_name.regex' => 'ФИО должно содержать только кириллические символы и пробелы.',
            'login.regex' => 'Логин должен содержать только кириллические символы, латиницу, цифры и подчеркивания.',
            'phone.regex' => 'Телефон должен быть в формате +7XXX-XXX-XX-XX.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'full_name' => $request->full_name,
            'login' => $request->login,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('cards.index')->with('success', 'Регистрация прошла успешно!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return to_route('home');
    }
}
