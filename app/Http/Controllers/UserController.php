<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;

class UserController extends Controller
{
    
    public function create() {
        return view('users.register', ['pageTitle'=>'Register']);
    }

    public function store(RegisterRequest $request) {
        $user = User::create($request->validated());
        Auth::login($user);

        return redirect('/');
    }

    public function login() {
        return view('users.login', ['pageTitle'=>'Login']);
    }

    public function authenticate(LoginRequest $request) {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
