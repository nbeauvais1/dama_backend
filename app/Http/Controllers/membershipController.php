<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Models\newMembership;

class membershipController extends Controller
{    
    public function store() {
        $fname =request('fname');
        $lname =request('lname');
        $email =request('email');
        $password =request('password');
        $hashedPassword = bcrypt($password);
        $membership_type =request('type');
        $pfp =request('pfp');
        $date_last_login = date('Y-m-d H:i:s');
        $membershipData=array('password'=>$hashedPassword,'first_name'=>$fname,"last_name"=>$lname,"email"=>$email,"profile_image"=>$pfp, "date_last_login"=>$date_last_login,"membership_type"=>$membership_type);

        DB::table('user')->insert($membershipData);
    }

    function login(Request $request) {
        $email = request('email');
        $password = request('password');
        $login = newmembership::where(['email' => $email, 'password' => $password])->first();

        if (!empty($login)) {

               //Store Session
               $request->session()->put(['id' => $login->id]);
               return redirect('/');
        }   else {
               return back()->with('error', 'Email Or Password Wrong!');
            }   
    }
}