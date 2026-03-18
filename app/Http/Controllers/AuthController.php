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
        return view("auth.login");
    }
    public function register()
    {
        return view("auth.register");
    }



    public function doLogin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('name', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('blog')
                ->withSuccess('You have Successfully loggedin!!');
        }

        return redirect("login")->withError('Oppes! Invalid credentials');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function doRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:8',
        ]);

        $data = $request->all();
        $user = $this->create($data);

        Auth::login($user);

        return redirect("blog")->withSuccess('Great! You have Successfully loggedin');
    }
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }
    public function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
