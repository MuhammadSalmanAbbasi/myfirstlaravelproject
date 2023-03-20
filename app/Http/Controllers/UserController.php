<?php

namespace App\Http\Controllers;

use App\Models\User;
use app\Models\listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //Show  Register/Create Form
    public function register() {
        return view('users.register');
    }

     // Create New User
     public function store(Request $request){
        $formFieleds = $request->validate([
            'name' => ['required','min:3'],
            'email' => ['required','email', Rule::unique('users','email')],
            'password' => 'required|confirmed|min:6'
        ]);

        // Hash Password
        $formFieleds['password'] = bcrypt($formFieleds['password']);

        // Create User
        $user = User::create($formFieleds);

        // Login User
        auth()->login($user);

        return redirect('/')->with('message','User Created and logged In');
      }

       // Logout User
    public function logout(Request $reqeust) {
        Auth()->logout();

        $reqeust->session()->invalidate();
        $reqeust->session()->regenerateToken();

        return redirect('/')->with('message','You have been Logged Out Successfully');
    }

    // Login User
    public function login() {
        return view('users.login');
    }

    // authenticate User
    public function authenticate(Request $request) {
        $formFieleds = $request->validate([
            'email' => ['required','email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFieleds)){
            $request->session()->regenerate();

            return redirect('/')->with('message','You are now logged In Successfully');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
}
