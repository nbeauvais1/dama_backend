<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Validator;
use App\Models\JobPostings;
use App\Models\applications;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

class ViewJobsController extends Controller
{
    public function index(){
    if(session()->has('session_email')){
        $user_id = session('session_user_id');

        $jobs = JobPostings::where('job_filled_yn', "N")
                ->where('user_id', '!=', $user_id)
                ->get();
        return view('view-jobs',['jobs'=>$jobs]);
    }
    else{
        session::Flash('msg', 'Please login to access the job board.');
        return redirect('/');
    }
    }

    public function apply(Request $request){
        if(session()->has('session_email')){
    
        $posting_id = $request->query('id');
        $posting = JobPostings::where('posting_id', $posting_id)->first();
        return view('submit-resume',['posting'=>$posting,]);
        }
        else{
            session::Flash('msg', 'Please login to apply to jobs.');
            return redirect('/');
        }
    }
    
    public function mail(Request $request){

    $posting_id = $request->query('id');    

    $employer_email = JobPostings::join('user', 'job_posting.user_id', '=', 'user.user_id')
    ->where('job_posting.posting_id', $posting_id)
    ->pluck('email');

    $job_title = JobPostings::where('posting_id', $posting_id)->value('job_title'); 

    $resume_path = $request -> file('resume')->getRealPath();
    $resume_name = $request -> file('resume')->getClientOriginalName();
    $resume_mime = $request -> file('resume')->getClientMimeType();

    $data = array(
        'job_title' => $job_title,
        'name'   => $request -> full_name,
        'email'  => $request -> email,
        'resume_path' => $resume_path,
        'resume_name' => $resume_name,
        'resume_mime' => $resume_mime
    );

    Mail::to($employer_email)->send(new SendMailable($data));
    
    session::Flash('msg', 'Your resume had been sent! Employers will reach out through email.');
    return redirect('view-jobs');
    }

    public function submit(Request $request){
        $posting_id = $request->query('id');        

    }
}
