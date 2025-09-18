<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}
