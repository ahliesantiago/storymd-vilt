<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Show registration form
    public function create(){
        return view('users.auth', [
            'type' => 'registration'
        ]);
    }

    public function store(Request $request){
        $formFields = $request->validate([
            'email' => 'required|email|unique:users,email',
            'username' => 'required|min:3|unique:users,username',
            'password' => ['required', 'min:6', 'confirmed'],
            'birthdate' => ['required', 'date',
                'before_or_equal: ' . now()->subYears(13)->format('Y-m-d')
            ],
        ], [
            'password.confirmed' => 'Passwords do not match',
            'birthdate.before_or_equal' => 'You must be at least 13 years old to register'
        ]);

        // password hashing
        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create([
            'username' => $formFields['username'],
            'email' => $formFields['email'],
            'password' => $formFields['password'],
            'is_admin' => 0,
            'birthdate' => $formFields['birthdate'],
        ]);

        Auth::login($user);
        // auth()->login($user);

        return redirect('/')->with('message', 'You have successfully registered. Welcome!');
    }

    public function login(){
        return view('users.auth', [
            'type' => 'login'
        ]);
    }
}
