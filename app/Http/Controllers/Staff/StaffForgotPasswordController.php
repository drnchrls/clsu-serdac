<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Notifications\StaffResetPasswordNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class StaffForgotPasswordController extends Controller
{

      public function showLinkRequestForm()
      {
         return view('management.staff-forgot', ['guard'=>'staff']);
      }


      /**
       * Write code on Method
       *
       * @return response()
       */
      public function sendResetLinkEmail()
      {
        //   $privuser = PrivUser::where('priv_user_email', $request->priv_user_email)->get();
          $staff = request()->staff_email;
          request()->validate([
              'staff_email' => 'required|email|exists:staffs',
          ],[],
          [
            'staff_email' => 'email'
          ]);
  
          $token = Str::random(64);

          session([
            'email'=> request()->staff_email,
            'token'=> $token,
          ]);

          DB::table('password_resets')->insert([
              'email' => request()->staff_email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);

        //   Mail::send('dashboard.priv.passwords.priv-email-response', ['token' => $token], function($message) use($request){
        //       $message->to($request->priv_user_email);
        //       $message->subject('Reset Password');
        //   });

          Notification::route('mail', $staff)->notify(new StaffResetPasswordNotification($token));
          
        // Notification::send($privuser, new PrivUserResetPasswordNotification($token));
        // $privuser->notify(new PrivUserResetPasswordNotification());

          return back()->with('message', 'We have e-mailed your password reset link!');
      }



      public function showResetForm($token) { 
         return view('management.passwords.reset', ['token' => $token]);
      }

      public function reset()
      {
          request()->validate([
              // 'staff_email' => 'required|email|exists:staffs',
              'staff_password' => 'required|string|min:8',
              'staff_password_confirm' => 'required|string|min:8|same:staff_password'
          ],[],
          [
            // 'staff_email' => 'email',
            'staff_password' => 'password',
            'staff_password_confirm' => 'password confirm',
          ]);
  
          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => session('email'), 
                                'token' => session('token')
                              ])
                              ->first();
  
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }
  
          $privuser = Staff::where('staff_email', session('email'))
                      ->update(['staff_password' => Hash::make(request()->staff_password)]);
 
          DB::table('password_resets')->where(['email'=> session('email')])->delete();
  
          return redirect('staff/login')->with('message', 'Your password has been changed!');
      }
}
