<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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


}
