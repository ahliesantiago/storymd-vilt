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

        return redirect('/')->with('success', 'You have successfully registered. Welcome!');
    }

    public function login(){
        return view('users.auth', [
            'type' => 'login'
        ]);
    }

    public function authenticate(Request $request){
        $credentials = filter_var($request->login_mode, FILTER_VALIDATE_EMAIL)
            ? ['email' => $request->login_mode, 'password' => $request->password]
            : ['username' => $request->login_mode, 'password' => $request->password];
        // $formFields = $request->validate([
        //     'login_mode' => [
        //         'required',
        //         'string',
        //         function($attribute, $value, $fail){
        //             $exists = User::where('email', $value)->orWhere('username', $value)->exists();
        //             if(!$exists){
        //                 $fail('The provided credentials do not match our records.');
        //             }
        //         }
        //     ],
        //     'password' => 'required',
        // ], [
        //     '.required' => 'Please enter your email or username',
        //     'password.required' => 'Please enter your password'
        // ]);

        if (in_array(null, $credentials, true)) {
            return back()->withErrors([
                'login_mode' => 'Please enter your credentials.'
            ]);
        }

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect('/')->with('success', 'You are now logged in!');
        }else{
            return back()->withErrors([
                'login_mode' => 'The provided credentials do not match our records.'
            ]);
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Successfully logged out. See you next time!');
    }

    public function show($username){
        $user = User::where('username', $username)->first();
        return view('users.profile', [
            'user' => $user
        ]);
    }
}
