<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Session;


class SessionTestController extends Controller
{
    public function index() {
        if(session()->has('session_email')){
            session::Flash('testMsg', 'You are logged in and will get a discount.');
        }
        else{
            session::Flash('testMsg', 'You are not logged in and will pay full price.');
        }
        return view('welcome');
    }    

    public function store() {

        Session::flush();

        $email_post =request('email_post');
        $password_post =request('password_post');

        $getUserByEmail = DB::select('SELECT * FROM user WHERE email = ?' , [$email_post]);

        if ($getUserByEmail[0]->email == $email_post) {
            echo "<p>email matches</p>";
            if(password_verify($password_post, $getUserByEmail[0]->password)){
                echo "<p>password matches</p>";
                Session::put('session_email', $getUserByEmail[0]->email);
                Session::put('session_first_name', $getUserByEmail[0]->first_name);
                Session::put('session_last_name', $getUserByEmail[0]->last_name);
                Session::put('session_user_id', $getUserByEmail[0]->user_id);

                echo "<p>Session Started</p>";
                echo var_dump($data = Session::all());

            }
            else {
                echo "<p>password does not match</p>";
            }
        }

        else {
            echo "<p>email is not valid</p>";
        }
    }
}
