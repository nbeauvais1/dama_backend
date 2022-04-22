<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Validator,Redirect,Response;
use App\Models\JobPostings;
use App\Models\applications;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;

class ViewJobsApiController extends Controller
{   
    public function apply(Request $request){
    
        $posting_id = $request->query('id');
        return JobPostings::where('posting_id', $posting_id)->first();
        
    }
    
    public function mail(Request $request){;

    $validator = Validator::make($request->all(), [
        'resume' => 'required|mimes:doc,docx,pdf'
    ]);

    if($validator->fails())
    {
        return response()->json([
            'validate_err' => $validator->messages(),
        ]);
    }
    else
    {

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
    
    return response()->json([
        'message' => 'Your resume had been sent! Employers will reach out through email.', 
    ]);
    }
    }

    public function submit(Request $request){
        $posting_id = $request->query('id');        
    }
}
