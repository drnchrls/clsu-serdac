<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\UserResetPasswordNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class UserForgotPasswordController extends Controller
{
    //


    public function showLinkRequestForm(){
        return view('auth.auth_forgot', ['guard'=>'web']);
    }
    public function sendResetLinkEmail()
    {
        $user = request()->email;
        request()->validate([
            'email' => 'required|email|exists:users',
        ],[],
        [
          'email' => 'email'
        ]);

        $token = Str::random(64);
        session([
          'email'=> request()->email,
          'token' => $token
        ]);

        DB::table('password_resets')->insert([
            'email' => request()->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
          ]);

      //   Mail::send('dashboard.priv.passwords.priv-email-response', ['token' => $token], function($message) use($request){
      //       $message->to($request->priv_user_email);
      //       $message->subject('Reset Password');
      //   });

        Notification::route('mail', $user)->notify(new UserResetPasswordNotification($token));
        
      // Notification::send($privuser, new PrivUserResetPasswordNotification($token));
      // $privuser->notify(new PrivUserResetPasswordNotification());

        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    
    public function showResetForm($token) { 
        return view('auth.passwords.reset', ['token' => $token]);
     }
     public function reset()
      {
          request()->validate([
              // 'email' => 'required|email|exists:users',
              'password' => 'required|string|min:8',
              'password-confirm' => 'required||string|min:8|same:password'
          ],[],
          [
            'password-confirm' => 'password confirmation',
          ]);
          

          $passwordUpdate = DB::table('password_resets')
                              ->where([
                                // 'email' => request()->email, 
                                'email'=> session('email'),
                                'token' => session('token')
                              ])
                              ->first();
  
          if(!$passwordUpdate){
              return back()->withInput()->with('error', 'Invalid token(User)!');
          }
  
          $user = User::where('email', session('email'))
                      ->update(['password' => Hash::make(request()->password)]);
          $login = User::where('email', session('email'))->first();
          DB::table('password_resets')->where(['email'=> session('email')])->delete();
  
          // return redirect('login')->with('updated', 'Your password has been changed!');
          Auth::login($login);
          return redirect('/profile')->with('updated', 'Your password has been changed!');
      }
}
