<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function create()
    {
        return view('login'); // will create this file next
    }
    public function createuser()
    {
        return view('create'); // will create this file next
    }
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|unique:users,name',
            'password' => 'required|min:6',
        ]);

        // Create user
        $user = new User();
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->save();
         //redirect to intended page after registration
        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->intended(); // Redirect to intended page after registration
    }
    public function login(Request $request)
    {
        // Validate input
        $creadi=$request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);
        //make credentials
        $credentials = [
            'name' => $request->name,
            'password' => $request->password,
        ];
        // Attempt login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended();// Redirect to intended page after login
        }
        return back()->withErrors([
            'name' => 'The provided credentials do not match our records.',
        ])->onlyInput('name');
    }
    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        return redirect()->route('login'); 
    }
}
