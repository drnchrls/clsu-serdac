<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrivUser;
use Illuminate\Support\Facades\Auth;

class StaffLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:staff')->except('logout');
    }

    public function showLoginForm(){
        return view('management.staff-login', ['guard'=>'staff']);
    }

    // OVERWRITE DEFAULT USERNAME() = email TO priv_user_email
    public function username()
    {
        return 'staff_email';//or new email name if you changed
    }
    
    public function login(Request $request){
        $request -> validate([
            'staff_email' => 'required|email|exists:staffs',
            'staff_password' => 'required|min:8|max:30',
        ],[
            'staff_email.exists' => 'The email does not exists!'
        ]);

        // $creds = $request->only('email','password');

        if(Auth::guard('staff')->attempt(['staff_email' => $request->staff_email, 'password' => $request->staff_password])){
            if(Auth::guard('staff')->user()->staff_role == 'Admin'){
                return redirect()->route('admin.dashboard');
            }
            if(Auth::guard('staff')->user()->staff_role == 'Library Staff'){
                return redirect()->route('libr.dashboard');
            }
            if(Auth::guard('staff')->user()->staff_role == 'Service Staff'){
                return redirect()->route('serv.dashboard');
            }
            
        }
        else{
            return redirect()->route('staff.login')->with('fail', 'Incorrect Credentials!');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('staff.login');
    }
}

