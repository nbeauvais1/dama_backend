<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Models\User;

class corporateMembershipController extends Controller
{    
    public function addCorporateMember(Request $request) {
        $user = User::where('email', '=', request('email'))->first();
        $email = request('email');
        $user_membership_id = $request->query('c_id');
        $membership_id = DB::table('user_membership')
                    ->where('user_membership_id', '=', $user_membership_id)
                    ->value('membership_id');
        $expiry_date_parent = DB::table('user_membership')
                    ->where('user_membership_id', '=', $user_membership_id)
                    ->value('expiry_date');
        $corporate_name_parent = DB::table('user_membership')
                    ->where('user_membership_id', '=', $user_membership_id)
                    ->value('corporate_name');
        $current_members_count = DB::table('corporate_membership')
                    ->join('user_membership', 'user_membership.user_membership_id', '=', 'corporate_membership.user_membership_id')
                    ->join('user', 'corporate_membership.user_id', '=', 'user.user_id')
                    ->select('corporate_membership.user_id')
                    ->where('corporate_membership.active_yn', '=', 'Y')
                    ->where('user_membership.user_membership_id', '=', $user_membership_id)
                    ->count();
        if($membership_id == '3'){
            $max_members = 5;
        }
        elseif($membership_id == '4'){
            $max_members = 10;
        }
        if($user){
            if($membership_id == '3' || $membership_id == '4'){
                if($current_members_count >= $max_members){
                    return back()->with('error', 'This account has reached the maximum number of members. Please remove a member or upgrade your account.');
                }
            }
            $check_user = DB::table('corporate_membership')->where('email', '=', request('email'))->where('active_yn', '=', 'Y')->where('user_membership_id', '=', "$user_membership_id")->first();
            if(!$check_user){
                DB::beginTransaction();
                $get_user_id = DB::table('user')
                    ->where('email', '=', $email)
                    ->value('user_id');
                
                $corporateMembershipData=array('user_membership_id'=>$user_membership_id,'user_id'=>$user->user_id, 'email'=>$email);
                $insert_corporate_member = DB::table('corporate_membership')->insertGetId($corporateMembershipData);
                $userMembershipData=array('user_id'=>$user->user_id,'membership_id'=>'6', 'corporate_membership_id'=>$insert_corporate_member, 'expiry_date'=>$expiry_date_parent, 'corporate_name'=>$corporate_name_parent);
                DB::table('user_membership')->insert($userMembershipData);
                DB::commit();
                return back()->with('message', 'Corporate member has been successfully added.');
            }
            else{
                return back()->with('error', 'This user is already an active member on the account.');
            }
        }
        else{
            return back()->with('error', "There is currently no account associated with the email provided. The feature to add users that do not currently have an account is still being implemented.");
        }
    }

    public function removeCorporateMember(Request $request) {
        $user_membership_id = $request->query('c_id');
        $user_id = $request->query('u_id');
        $parent_user_id = DB::table('user_membership')->where('user_membership_id', '=', $user_membership_id)->where('corporate_membership_id', '=' , NULL)->value('user_id');
        $session_user_id = session('session_user_id');
        if(($parent_user_id != $session_user_id) || (!$session_user_id)){
            return back()->with('message', "Only the account holder can make changes to a corporate account.");
        }
        $corporate_membership_id = DB::table('corporate_membership')->where('user_id', '=', $user_id)->where('user_membership_id', '=' , $user_membership_id)->value('corporate_membership_id');
        $current_date = date('Y-m-d H:i:s');

        
        DB::beginTransaction();
        DB::table('corporate_membership')->where('user_id', '=', $user_id)->where('user_membership_id', '=' , $user_membership_id)
        ->update([
            'active_yn' => 'N',
        ]);
        DB::table('user_membership')->where('corporate_membership_id', $corporate_membership_id)
        ->update([
            'expiry_date' => "$current_date",
        ]);
        DB::commit();
        
        return back()->with('message', "The user has been successfully removed from the account.");
    }
}