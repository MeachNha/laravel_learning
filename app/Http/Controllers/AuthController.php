<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class AuthController extends Controller
{
    //
    public function showform(){

        return view('login');
    } 
    
    public function showregister(){

        return view('register');
    } 

    public function store(Request $request){
        // Validate input

        $val=$request->validate([
            'name' => 'required|unique:users,name',
            'password' => 'required|min:6',
        ]);

        $user = new User(); 
        $user->name = $request->name;
        $user->password= $request->password;

        $user->save();

        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->intended(); // intended ng jea method dl vea dg tha yg jg tv route name ey vea dg mg 
    }



    public function login(Request $request)
        {

        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
             
             $request->session()->regenerate();
            return redirect()->intended();
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
