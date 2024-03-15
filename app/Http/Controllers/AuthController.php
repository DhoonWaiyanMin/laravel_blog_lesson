<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function create(){
        return view("auth.register");
    }
    public function store(Request $request){
        $formData = request()->validate([
            'name' => 'required|max:255|min:3',
            'username' => ['required','min:3','max:255',Rule::unique('users','username')],
            'email' => ['required','email',Rule::unique('users','email')],
            'password' => ['required','min:8']
        ]);
        // $formData['password'] = bcrypt($formData['password']);
        // dd($formData);

        $user = User::create($formData);
        // session()->flash(
        //     'success' , "Welcome Dear ".$user->name
        // );
        auth()->login($user);
        return redirect('/')->with('success',"Welcome dear ".$user->name);
    }

    public function logout(){
        auth()->logout();
        return redirect('/')->with('success',"Logout successful");
    }

    public function login(){
        return view("auth.login");
    }

    public function postLogin(){
        $formData = request()->validate([
            'email' => ['required','email','max:255',Rule::exists('users','email')],
            'password' => ['required','min:8','max:255']
        ],[
            'email.required' => "E-mail is required",
            'password.required' => 'Password is required',
            'password.min' => "Password sholud be more than 8 characters"
        ]);
        // dd($formData);
        if(auth()->attempt($formData)){
            return redirect("/")->with("success","Welcome back");
        }else{
            return redirect()->back()->withErrors([
                "email" => "User credentials wrong"
            ]);
        }
    }
}
