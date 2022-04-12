<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\InterestedUser;

class interestedController extends Controller
{
    public function save(Request $request){
        try{
        $posting_id = $request->query('id');
        $user_id = session('session_user_id');

        $interested = new InterestedUser();

        $interested->posting_id = $posting_id;
        $interested->user_id = $user_id;

        $interested->save();
        }
        catch (\Exception $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
        catch (\Error $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
        session::Flash('message', 'The posting has been added to your dashboard.');
        return redirect('/view-jobs');
    }

    public function delete(Request $request){
        try{
        $posting_id = $request->query('id');

        InterestedUser::where('user_job_id', $posting_id)
                    ->update(array('interested_yn'=>"N"));
        }
        catch (\Exception $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
        catch (\Error $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }       
        session::Flash('message', 'The posting has been removed from interested list.');
        return redirect('/ct-dashboard');
    }

}

