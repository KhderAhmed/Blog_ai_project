<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function doLogin(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $loginValue = trim((string) $request->input('name'));
        $credentials = ['password' => $request->input('password')];

        if (filter_var($loginValue, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $loginValue;
        } else {
            $credentials['name'] = $loginValue;
        }

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/blog')
                ->withSuccess('You have successfully logged in!');
        }

        return redirect()->route('login')->withErrors([
            'name' => 'Oppes! Invalid credentials',
        ]);
    }

    public function doRegistration(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users,name'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
        ]);

        $user = $this->create($request->all());

        Auth::login($user);

        return redirect()->intended('/blog')->withSuccess('Great! You have successfully logged in');
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('login');
    }
}
