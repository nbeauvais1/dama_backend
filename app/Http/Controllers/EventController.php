<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Validator,Redirect,Response;
Use App\Models\Event;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class EventController extends Controller
{
    public function index(){
        return view('/edit-event');
    }

    public function insert() {
        try{
        $event_title =request('event_title');
        $event_speaker =request('event_speaker');
        $event_type =request('event_type');
        $event_price =request('event_price');
        $event_date =request('event_date');
        $event_city =request('event_city');
        $event_description =request('event_description');

        $data=array('event_title'=>$event_title,'event_speaker'=>$event_speaker,'event_type'=>$event_type,"event_price"=>$event_price,"event_date"=>$event_date,"event_description"=>$event_description, "event_city"=>$event_city);
        
        DB::table('event')->insert($data);
        }
        catch (\Exception $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
        catch (\Error $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
        return redirect()->intended('/event_list');
    }

    public function update(Request $request) {
        try{
        $user_id = session('session_user_id');
        $admin_status = DB::table('user')
                ->where('user_id', '=', $user_id)
                ->value('admin_yn');
        if($admin_status != 'Y'){
            return redirect('/event_list')->with('message', "You must be an admin to use this feature.");
        }
        $event_id = $request->query('id');
        $edit_event = Event::where('event_id', $event_id)->first();
        }
        catch (\Exception $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
        catch (\Error $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
        return view('/edit-event', [
            'edit_event'=>$edit_event,
            'event_id'=>$event_id,
            ]);
    }

    public function insertUpdate(Request $request) {
        try{
        $user_id = session('session_user_id');
        $admin_status = DB::table('user')
                ->where('user_id', '=', $user_id)
                ->value('admin_yn');
        if($admin_status != 'Y'){
            return redirect('/event_list')->with('message', "You must be an admin to use this feature.");
        }
        $event_id = $request->query('id');     

        $event_title =request('event_title');
        $event_speaker =request('event_speaker');
        $event_type =request('event_type');
        $event_price =request('event_price');
        $event_date =request('event_date');
        $event_city =request('event_city');
        $event_description =request('event_description');      

        Event::where('event_id', $event_id)
        ->update([
            'event_title' => $event_title,
            'event_speaker' => $event_speaker,
            'event_type' => $event_type,
            'event_price' => $event_price,
            'event_date' => $event_date,
            'event_city' => $event_city,
            'event_description' => $event_description,
        ]);
        }
        catch (\Exception $e) {  
            return back()->with('error', "An error occurred: " . $e->getMessage());
        }
        catch (\Error $e) {  
            return back()->with('error', "An error occurred: " . $e->getMessage());
        }
        session::Flash('message', 'Event updated!');
        return redirect('/event_list');
    }

    public function delete(Request $request) {
        try{
        $user_id = session('session_user_id');
        $admin_status = DB::table('user')
                ->where('user_id', '=', $user_id)
                ->value('admin_yn');
        if($admin_status != 'Y'){
            return redirect('/event_list')->with('error', "You must be an admin to use this feature.");
        }
        $event_id = $request->query('id');     
      
        Event::where('event_id', $event_id)
        ->update([
            'deleted_yn' => 'Y',
        ]);
        }
        catch (\Exception $e) {  
            return back()->with('error', "An error occurred: " . $e->getMessage());
        }
        catch (\Error $e) {  
            return back()->with('error', "An error occurred: " . $e->getMessage());
        }
        session::Flash('message', 'Event deleted!');
        return redirect('/event_list');
    }
}
