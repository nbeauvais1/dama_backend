<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Validator;
use Storage;
use App\Models\newMembership;

class EditProfileController extends Controller
{
    public function index() {
        if(session()->has('session_email')){
            // try{
                $user_id = session('session_user_id');
                $user = newMembership::where('user_id', $user_id)->get();
            
                return view('/edit-profile', [
                    'user' => $user,
                ]);
            // }
        }
    }
    public function editprofile(Request $request) {
        
        try{
            $request->validate([
                'fname' => 'required|string',
                'lname' => 'required|string',
                'email' => 'required|email',
                'secondary_email' => 'email',
                'profile-image' => 'image|mimes:jpeg,png,jpg|max:7000',
            ]);
            
            $user_id = session('session_user_id');
            $user = newMembership::where('user_id', $user_id)->get();
            $fname =request('fname');
            $lname =request('lname');
            $email =request('email');
            $secondary_email =request('secondary-email');
            $file = $request->file('profile-image')->getClientOriginalName();
            $filename = time() . $file;
            $request->file('profile-image')->storeAs('/images',$filename);

            newMembership::where('user_id', $user_id)
            ->update([
                'first_name' => $fname,
                'last_name' => $lname,
                'email' => $email,
                'secondary_email' => $secondary_email,
                'profile_image' => $filename,
            ]);
        }
        catch (\Exception $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
        catch (\Error $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }

        session::Flash('message', 'Profile updated!');
        return redirect('/ct-dashboard');
    }


}