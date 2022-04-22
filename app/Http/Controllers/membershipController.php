<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Models\User;

class membershipController extends Controller
{    
    public function index()
    {
        return view('signup');
    }

    public function renew(Request $request) {
        $user_membership_id = $request->query('id');
        $user_id = session('session_user_id');
        $check_user_id = DB::table('user_membership')
                        ->where('user_membership_id', '=', $user_membership_id)
                        ->value('user_id');
        if($user_id != $check_user_id){
            return back()->with('error', "Only the account holder can renew an account.");
        }
        else {
            $current_expiry_date = DB::table('user_membership')
                        ->where('user_membership_id', '=', $user_membership_id)
                        ->value('expiry_date');
            $new_expiry_date = date('Y-m-d 23:59:59.999999', strtotime("+12 months", strtotime($current_expiry_date)));
            DB::table('user_membership')->where('user_membership_id', '=' , $user_membership_id)
            ->update([
                'expiry_date' => "$new_expiry_date",
            ]);
            return back()->with('message', "This membership has been successfully renewed.");

        }
    }

    public function addMembership(Request $request){
        if(request('type') == 'Corporate5' ||
            request('type') == 'Corporate10' ||
            request('type') == 'CorporateUnlimited')
            {
            $check_validation_corporate = request()->validate([
            'corporate_name' => 'required',]);
            }
        $membership_type =request('type');
        $user_id = session('session_user_id');
        $corporate_name = request('corporate_name');
        $current_date = date('Y-m-d H:i:s');
        $expiry_date = date('Y-m-d 23:59:59.999999', strtotime("+12 months", strtotime($current_date)));
        switch($membership_type){
                case ($membership_type == 'Individual'):
                    $membership_id = 1;
                    break;
                case ($membership_type == 'Student'):
                    $membership_id = 2;
                    break;
                case ($membership_type == 'Corporate5'):
                    $membership_id = 3;
                    break;
                case ($membership_type == 'Corporate10'):
                    $membership_id = 4;
                    break;
                case ($membership_type == 'CorporateUnlimited'):
                    $membership_id = 5;
                    break;
        }
        try{
            DB::beginTransaction();
                $userMembershipData=array('user_id'=>$user_id,'membership_id'=>$membership_id, 'expiry_date'=>$expiry_date, 'corporate_name' => $corporate_name);
                $insert_user_membership = DB::table('user_membership')->insert($userMembershipData);
            DB::commit();
            return back()->with('message', "You have sucessfully added a new membership.");

        }
        catch (\Exception $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
        catch (\Error $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
    }  

    public function store(Request $request) {
        $check_validation = request()->validate([
            'email' => 'required',
            'password' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'password' => 'required',
            'type' => 'required',
            'password' => 'required',
            ]);
        
        if($check_validation){

            if(request('type') == 'Corporate5' ||
            request('type') == 'Corporate10' ||
            request('type') == 'CorporateUnlimited')
            {
            $check_validation_corporate = request()->validate([
            'corporate_name' => 'required',]);
            }

            $fname =request('fname');
            $lname =request('lname');
            $email =request('email');
            $password =request('password');
            $hashedPassword = bcrypt($password);
            $membership_type =request('type');
            $corporate_name = request('corporate_name');
            $email_list = request('email_list');
            $current_date = date('Y-m-d H:i:s');
            $membershipData=array('password'=>$hashedPassword,'first_name'=>$fname,"last_name"=>$lname,"email"=>$email, "date_last_login"=>$current_date);
            $expiry_date = date('Y-m-d 23:59:59.999999', strtotime("+12 months", strtotime($current_date)));

            switch($membership_type){
                case ($membership_type == 'Individual'):
                    $membership_id = 1;
                    break;
                case ($membership_type == 'Student'):
                    $membership_id = 2;
                    break;
                case ($membership_type == 'Corporate5'):
                    $membership_id = 3;
                    break;
                case ($membership_type == 'Corporate10'):
                    $membership_id = 4;
                    break;
                case ($membership_type == 'CorporateUnlimited'):
                    $membership_id = 5;
                    break;
            }


            
        try{
            if($membership_id <= 2){
                DB::beginTransaction();
                $insert_user = DB::table('user')->insert($membershipData);
                $get_user_id = DB::table('user')
                        ->where('email', '=', $email)
                        ->value('user_id');
                $userMembershipData=array('user_id'=>$get_user_id,'membership_id'=>$membership_id, 'expiry_date'=>$expiry_date);
                $insert_user_membership = DB::table('user_membership')->insert($userMembershipData);
                DB::commit();
            }
            else{
                DB::beginTransaction();
                $insert_user = DB::table('user')->insert($membershipData);
                $get_user_id = DB::table('user')
                        ->where('email', '=', $email)
                        ->value('user_id');
                $userMembershipData=array('user_id'=>$get_user_id,'membership_id'=>$membership_id, 'expiry_date'=>$expiry_date, 'corporate_name' => $corporate_name);
                $insert_user_membership = DB::table('user_membership')->insert($userMembershipData);
                DB::commit();
            }
            if($email_list){
                $emailData=array('email'=>$email);
                $insert_email = DB::table('email_list')->insert($emailData);
            }
        }
        catch (\Exception $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
        catch (\Error $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }

        return back()->with('message', "Your account has been successfully registered. Please login to continue.");
        
        }
    }
}