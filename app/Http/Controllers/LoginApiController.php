<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
Use App\Models\User;
Use App\Models\Member;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class LoginApiController extends Controller
{
    public function index()
    {
        return view('login');
    }  

    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
 
        if($validator->fails())
        {
            return response()->json([
                'validate_err' => $validator->messages(),
            ]);
        }
        else
        {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                
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

                return Member::where('email', $email)->get();
            }
            else 
            {
                return response()->json([
                    'validate_err' => 'Your email or password are incorrect.', 
                ]);     
            }
        }    
    }
}
