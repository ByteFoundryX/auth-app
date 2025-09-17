<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    
 
    public function register()
    {
        return view('auth.register');
    }


     
    public function registerPost( Request $request)
    {
         $request->validate([

            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|confirmed',

         ]);

         $user = User::create([
          
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

         ]);


         if(!$user)
         {
            return redirect()->back()->with('error' , 'دوباره تلاش کنید ');
         }


         return redirect()->route('register')->with('success' , 'موفقیا امیز بود ');
    }





     
    public function login()
    {
        return view('auth.login');
    }

 



        
    public function loginPost( Request $request)
    {
         $request->validate([

            'email' => 'required|email|exists:users',
            'password' => 'required|min:5',

         ]);

         $user = User::where('email' , $request->email)->first();
         if(!$user)
         {
            return redirect()->back()->with('error' , 'ایمیل شما صحیح نیست ');
         }


         if (!Hash::check($request->password, $user->password)) 
            {
        return redirect()->back()->with('error', 'پسورد صحیح نیست');
         }


    Auth::login($user);
    $request->session()->regenerate();
      return redirect()->route('home')->with('success' , 'موفقیا امیز بود ');





    }




    public function logout(Request $request)
    {
      Auth::logout();
      $request->session()->invalidate();
      $request->session()->regenerateToken();

      return redirect()->route('home');

    }





}
