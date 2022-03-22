<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Validator;
use App\Models\JobPostings;
use App\Models\applications;

class ViewJobsController extends Controller
{
    public function index(){
        $user_id = session('session_user_id');

        $jobs = JobPostings::where('job_filled_yn', "N")
                ->where('user_id', '!=', $user_id)
                ->get();
        return view('view-jobs',['jobs'=>$jobs]);
    }

    public function apply(Request $request){
        $posting_id = $request->query('id');
        $posting = JobPostings::where('posting_id', $posting_id)->first();
        return view('submit-resume',['posting'=>$posting,]);
    }
    
    public function submit(Request $request){
        $posting_id = $request->query('id');

        $request->validate([
            'resume' => 'required|mimes:pdf|max:2048'
        ]);

        $new_app = new applications();
        $file_name = time().'_'.$request->resume->getClientOriginalName();
        $filePath = $request->file('resume')->storeAs('resumes', $file_name, 'public');
        $new_app->resume = $file_name;
        $new_app->posting_id = $posting_id;
        $new_app-> save();

        session::Flash('msg', 'Thank you for submitting!');
        return redirect('view-jobs');
    }
}
