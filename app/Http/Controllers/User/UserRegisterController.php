<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\OTPMail;
use App\Models\OTP;
use App\Models\User;
use App\Notifications\OTPNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


class UserRegisterController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
    }

    public function showRegistrationForm(){
        return view('auth.register-first', ['guard'=>'web']);
    }

    public function showRegistrationFormSecond(){
        return view('auth.register-second', ['guard'=>'web']);
    }

    public function registerFirst(){

        $first = request()->validate([
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'age' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'max:255'],
            'occupation' => ['required', 'string', 'max:255'],
            'educational_level' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        session([
            'fname'=>request()->fname,
            'lname'=>request()->lname,
            'age'=>request()->age,
            'gender'=>request()->gender,
            'contact'=>request()->contact,
            'occupation'=>request()->occupation,
            'educational_level'=>request()->educational_level,
            'address'=>request()->address,

        ]);
        return view('auth.register-second');

    }
    public function registerSecond(Request $request){
        // $second = request()->validate([
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:8'],
        //     'password-confirm' => ['required', 'string', 'same:password'],
        // ]);
          
        $rules = [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'password-confirm' => ['required', 'string', 'same:password'],
        ];
        
        $customAttributes = [
            'email' => 'email address',
            'password' => 'password',
            'password-confirm' => 'password confirmation',
        ];
        
        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($customAttributes);
        
        if ($validator->fails()) {
            // Handle validation errors
            return view('auth.register-second')
                ->withErrors($validator);
                // ->withInput();
        }

        $otp = rand(100000, 999999);
        $token = Str::random(64);
        $otp_time = now();

        // WITH TABLE
        $get_otp = new OTP();
        $get_otp->email = request()->email;
        $get_otp->otp = $otp;
        $get_otp->token = $token;
        $get_otp->created_at = $otp_time;
        $get_otp->save();


        session([
            'email'=>request()->email,
            'password'=>request()->password,
            'otp'=>$otp,
            'token'=>$token,
            'otp-time' => $otp_time,
        ]);


        Notification::route('mail', request()->email)->notify(new OTPNotification($otp));

        

        return redirect()->route('otp.form', [session('token')]);
    }
    public function showOTPForm(){
        return view('auth.otp');
    }
    
    public function verifyOTP(){

        // request()->validate([
        //     'otp'=> 'required',
        // ]);

        // WITH TABLE
        $otp = OTP::where('token', session('token'))->where('otp', request()->otp)->first();

        if(!$otp){
            return redirect()->route('otp.form', [session('token')])->with('fail','You entered wrong OTP! Please check your email again.');
        }


        // WITHOUT TABLE
        // $otp = session('otp');

        // if($otp != request()->otp){
        //     return redirect()->route('otp.form')->with('fail','You entered wrong OTP! Please check your email again.');
        // }


        // $time = now();

        $user = User::create([
                'email'=> session('email'),
                'password'=> Hash::make(session('password')),
                'fname'=> session('fname'),
                'lname'=> session('lname'),
                'age'=> session('age'),
                'gender'=> session('gender'),
                'contact'=> session('contact'),
                'occupation'=> session('occupation'),
                'educational_level'=> session('educational_level'),
                'address'=> session('address'),
                'email_verified_at' => now(),
            ]);

        Auth::login($user);
        
        $delete_otp = OTP::where('email', session('email'))->get();
        foreach ($delete_otp as $otp) {
            $otp->delete();
        }
        // $delete_otp->delete();
        // session()->flush();
        session()->forget([
            'email',
            'password',
            'fname',
            'lname',
            'age',
            'gender',
            'contact',
            'occupation',
            'educational_level',
            'address',
        ]);
        return redirect('/profile')->with('registered', 'Account successfully created! Please login.');
    }

    public function resendOTP(){
        //
        $otp = rand(100000, 999999);
        $otp_time = now();

        // WITH TABLE
        $get_otp = OTP::where('token', session('token'))->first();
        $get_otp->email = session('email');
        $get_otp->otp = $otp;
        $get_otp->created_at = $otp_time;
        $get_otp->save();

        Notification::route('mail', session('email'))->notify(new OTPNotification($otp));

        // return redirect()->route('otp.form', [session('token')])->with('sent', 'New OTP code has been sent to your email! Please check it.');
        return response()->json(['sent' => 'New OTP code has been sent to your email! Please check it.']);
    }

}
