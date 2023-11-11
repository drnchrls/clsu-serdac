<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
    }


    // public function username()
    // {
    //     return 'email';//or new email name if you changed
    // }

    public function showLoginForm(){
        if(!session()->has('url.intended'))
        {
            session(['url.intended' => url()->previous()]);
        }
        // session(['link' => url()->previous()]);
        return view('auth.login', ['guard'=>'web']);
    }

    public function login(){
        request() -> validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ],[
            'email.exists' => 'The email does not exists!'
        ]);


        if(Auth::guard('web')->attempt(['email' => request()->email, 'password' => request()->password])){
            return redirect(session('url.intended'));
        }
        
        else{
            return redirect()->route('login')->with('fail', 'Incorrect Credentials!');
        }

    }




}
