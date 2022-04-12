<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Event;
use Session;
use Illuminate\Support\Facades\View;

class EventRegisterController extends Controller
{
   public function store(Request $request) {
      try{
         $event_id = $request->query('event_id');
         $user_id = session('session_user_id');
         if(!$user_id){
            return redirect()->intended("/event-register-nonmember?event_id=$event_id");
         }
         $check_event = DB::table('user_event')
             ->where('user_id', '=', $user_id)
             ->where('event_id', '=', $event_id)
             ->get();
         if($check_event == '[]'){
            $data=array('user_id'=>$user_id,'event_id'=>$event_id);
            DB::table('user_event')->insert($data);
            return back()->with('message', "You have succesfully been registed to this event. Please check your email for further details.");
         }
         else {
               return back()->with('error', "You are already registered to this event.");
               }
         }
         catch (\Exception $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
        catch (\Error $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
      }
   public function insertNonMember(Request $request) {
      try{
         $event_id = $request->query('event_id');
         $email =request('email');
         $first_name =request('first_name');
         $last_name =request('last_name');
         $data=array('event_id'=>$event_id, 'first_name'=>$first_name,'last_name'=>$last_name,'email'=>$email);
         DB::table('nonmember_user_event')->insert($data);
         }
         catch (\Exception $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
         }
         catch (\Error $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
         }
         return redirect()->intended('/event_list')->with('message', "You have succesfully been registed to this event. Please check your email for further details.");
   }
        
}
