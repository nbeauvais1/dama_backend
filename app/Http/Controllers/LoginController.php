<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
Use App\Models\User;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }  

    public function postLogin(Request $request)
    {
        request()->validate([
        'email' => 'required',
        'password' => 'required',
        ]);
 
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            try{
            $email =request('email');
            $password =request('password');
            $getUserByEmail = User::where('email', '=', $email)->first();
            Session::put('session_email', $getUserByEmail->email);
            Session::put('session_first_name', $getUserByEmail->first_name);
            Session::put('session_last_name', $getUserByEmail->last_name);
            Session::put('session_user_id', $getUserByEmail->user_id);
            $current_date = date('Y-m-d H:i:s');
            User::where('email', '=', $email)->update([
            'date_last_login' => "$current_date",]);
            }
            catch (\Exception $e) {  
                return back()->with('error', "An error occured: " . $e->getMessage());
            }
            catch (\Error $e) {  
                return back()->with('error', "An error occured: " . $e->getMessage());
            }

            return redirect()->intended('/')->with('mesaage', 'You have successfully logged in.');
        }
        else {
            return redirect()->back()->with('error', 'Invalid username or password. Please try again.');
        }
    
    }
}
