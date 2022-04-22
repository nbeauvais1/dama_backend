<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Member;
use App\Models\EmailList;


class EmailListController extends Controller
{
    public function index(){

        $member_emails = DB::table('email_list')
                        ->get();

        return view('email-list', ['emails' => $member_emails,]);        
    }

    public function delete(Request $request){
        $email = request('email');
        $check_email = DB::table('email_list')
                        ->where('email', '=', $email)
                        ->value('email');
        if ($check_email){
                $check_email = DB::table('email_list')
                        ->where('email', '=', $check_email)
                        ->delete();
                return back()->with('message', "You have been sucessfully removed from the email list.");
            }
            else {
                return back()->with('error', "An error occured: This email is not on the email list.");
            }
        }

    public function join(Request $request){

        $check_validation = request()->validate([
            'email' => 'required',
            ]);

        if ($check_validation) {
            try {
                $email = new EmailList();

                $email->email = request('email');

                $check_email = DB::table('email_list')
                        ->where('email', '=', $email->email)
                        ->value('email');
                if (!$check_email){
                    $email->save();
                    return back()->with('message', "You have been sucessfully added to the email list.");
                }
                else {
                    return back()->with('error', "This email is already on the email list.");
                }


            }
            catch (\Exception $e) {  
                return back()->with('error', "An error occured: " . $e->getMessage());
            }
            catch (\Error $e) {  
                return back()->with('error', "An error occured: " . $e->getMessage());
            }

        }     
    }
}
