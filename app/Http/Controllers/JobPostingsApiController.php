<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
use DB;
use Session;
use Storage;
use App\Models\JobPostings;
use App\Models\applications;

class JobPostingsApiController extends Controller
{
    public function index(){
        return view('/insert-job');
    }

    public function insert(Request $request) {

        $validator = Validator::make($request->all(), [
            'job_title' => 'required',
            'company_name' => 'required',
            'location' => 'required',
            'job_desc' => 'required',
        ]);
 
        if($validator->fails())
        {
            return response()->json([
                'validate_err' => $validator->messages(),
            ]);
        }
        else
        {
            $posting = new JobPostings();

            $posting->job_title = request('job_title');
            $posting->company_name = request('company_name');
            $posting->location = request('location');
            $posting->job_desc = request('job_desc');
            $posting->user_id = request('user_id');

            $posting->save();

            return response()->json([
                'message' => 'Your job posting has been uploaded successfully.', 
            ]);
        }    
    }

    public function delete(Request $request) {
        $posting_id = $request->query('id');

        JobPostings::where('posting_id', $posting_id)
                    ->update(array('job_filled_yn'=>"Y"));
        
        return response()->json([
                'message' => 'Congrats on filling your job!', 
            ]);
    }

    public function update(Request $request) {
        $posting_id = $request->query('id');
        return JobPostings::where('posting_id', $posting_id)->get();
    }

    public function InsertUpdate(Request $request) {
        $posting_id = $request->query('id');        

        $job_title = request('job_title');
        $company_name = request('company_name');
        $location = request('location');
        $job_desc = request('job_desc');        

        $validator = Validator::make($request->all(), [
            'job_title' => 'required',
            'company_name' => 'required',
            'location' => 'required',
            'job_desc' => 'required',
        ]);
 
        if($validator->fails())
        {
            return response()->json([
                'validate_err' => $validator->messages(),
            ]);
        }
        else
        {
            JobPostings::where('posting_id', $posting_id)
            ->update([
                'job_title' => $job_title,
                'company_name' => $company_name,
                'location' => $location,
                'job_desc' => $job_desc,
            ]);

            return response()->json([
                'message' => 'Job posting updated!!', 
            ]);
        }
    }

}