<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Validator,Redirect,Response;
Use App\Models\Event;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class EventApiController extends Controller
{
    public function insert(Request $request) {
        try{

            $validator = Validator::make($request->all(), [
                'event_title' => 'required',
                'event_type' => 'required',
                'event_price' => 'required',
                'event_date' => 'required',
                'event_city' => 'required',
                'event_description' => 'required',
            ]);
    
            if($validator->fails())
            {
                return response()->json([
                    'validate_err' => $validator->messages(),
                ]);
            }
            else
            {
                $event_title =request('event_title');
                $event_type =request('event_type');
                $event_price =request('event_price');
                $event_date =request('event_date');
                $event_city =request('event_city');
                $event_description =request('event_description');

                $data=array('event_title'=>$event_title,'event_type'=>$event_type,"event_price"=>$event_price,"event_date"=>$event_date,"event_description"=>$event_description, "event_city"=>$event_city);
                
                DB::table('event')->insert($data);
                
                return response()->json([
                    'message' => 'Your event has been created.', 
                ]);
            }
        }
        catch (\Exception $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
        catch (\Error $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
    }

    public function update(Request $request) {
        try{
        $user_id = request('user_id');
        $admin_status = DB::table('user')
                ->where('user_id', '=', $user_id)
                ->value('admin_yn');
        if($admin_status != 'Y'){
            return response()->json([
                'message' => 'You must be admin to access.', 
            ]);
        }
        $event_id = $request->query('id');
        return Event::where('event_id', $event_id)->first();
        }
        catch (\Exception $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
        catch (\Error $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
    }

    public function insertUpdate(Request $request) {
        try{
        $user_id = request('user_id');
        $admin_status = DB::table('user')
                ->where('user_id', '=', $user_id)
                ->value('admin_yn');
        if($admin_status != 'Y'){
            return response()->json([
                'message' => 'You must be admin to access.', 
            ]);
        }
        $event_id = $request->query('id');     

        $event_title =request('event_title');
        $event_type =request('event_type');
        $event_price =request('event_price');
        $event_date =request('event_date');
        $event_city =request('event_city');
        $event_description =request('event_description');      

        Event::where('event_id', $event_id)
        ->update([
            'event_title' => $event_title,
            'event_type' => $event_type,
            'event_price' => $event_price,
            'event_date' => $event_date,
            'event_city' => $event_city,
            'event_description' => $event_description,
        ]);
        return response()->json([
            'message' => 'Your event has been updated.', 
        ]);
        }
        catch (\Exception $e) {  
            return back()->with('error', "An error occurred: " . $e->getMessage());
        }
        catch (\Error $e) {  
            return back()->with('error', "An error occurred: " . $e->getMessage());
        }
    }

    public function delete(Request $request) {
        try{
        $user_id = request('user_id');
        $admin_status = DB::table('user')
                ->where('user_id', '=', $user_id)
                ->value('admin_yn');
        if($admin_status != 'Y'){
            return response()->json([
                'message' => 'You must be admin to access.', 
            ]);
        }
        $event_id = $request->query('id');     
      
        Event::where('event_id', $event_id)
        ->update([
            'deleted_yn' => 'Y',
        ]);
        return response()->json([
            'message' => 'Your event has been deleted.', 
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
