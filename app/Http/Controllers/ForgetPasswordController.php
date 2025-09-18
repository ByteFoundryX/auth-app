<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ForgetPasswordController extends Controller
{

    public function forgetPassword()
    {
        return view('auth.forget-password');
    }


       public function forgetPasswordPost(Request $request)
    {
        
        $request->validate([

            'email' => 'required|email|exists:users'
        ]);

       
        $email = DB::table('password_reset_tokens')->where('email' , $request->email)->first();
        if($email){
            return redirect()->back()->with('error' , 'ایمیل ارسال شده است از قبل');
        }

        $token = str()->random(64);
         DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
         ]);
        
    }


    public function resetPassword($token)
    {
       
 
        return view('auth.reset-password' , compact('token'));

    }


       public function resetPasswordPost(Request $request)
    {
       
 
             
        $request->validate([

            'token' => 'required',
            'password' => 'required|confirmed|min:5'

        ]);

        $updadepassword =  DB::table('password_reset_tokens')->where([
             'token' => $request->token,

        ])->first();
    
          if (!$updadepassword) {
            return redirect()->back()->with('error' , 'ایمیل ارسال شده است از قبل');
          }


          User::where('email' ,  $updadepassword->email)->update([
            'password' => Hash::make($request->password)
          ]);


           
        DB::table('password_reset_tokens')->where([
             'token' => $request->token,

        ])->delete();
            return redirect()->route('login');

    }
}
