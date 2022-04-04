<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;

class LogoutController extends Controller
{  
    public function logout() {
        Session::flush();
        Session::flash('message', 'You have been logged out.'); 
        return redirect('/');
    }
}
