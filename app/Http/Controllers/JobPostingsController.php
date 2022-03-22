<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Storage;
use App\Models\JobPostings;
use App\Models\applications;

class JobPostingsController extends Controller
{
    public function index(){
        return view('/insert-job');
    }

    public function insert() {

        $posting = new JobPostings();

        $posting->job_title = request('job_title');
        $posting->company_name = request('company_name');
        $posting->location = request('location');
        $posting->job_desc = request('job_desc');
        $posting->user_id = session('session_user_id');

        $posting->save();

        session::Flash('coursePurchasedMsg', 'Your job listing has been uploaded successfully!');
        return redirect('/ct-dashboard');

    }

    public function delete(Request $request) {
        $posting_id = $request->query('id');

        JobPostings::where('posting_id', $posting_id)
                    ->update(array('job_filled_yn'=>"Y"));
                    
        session::Flash('msg', 'Congrats on filling your job!');
        return redirect('/ct-dashboard');
    }

    public function update(Request $request) {
        $posting_id = $request->query('id');
        $job_2_edit = JobPostings::where('posting_id', $posting_id)->first();

        return view('/edit-job', [
                                'job_2_edit'=>$job_2_edit,
                                'post_id'=>$posting_id,
                                ]);
    }

    public function InsertUpdate(Request $request) {
        $posting_id = $request->query('id');        

        $job_title = request('job_title');
        $company_name = request('company_name');
        $location = request('location');
        $job_desc = request('job_desc');        

        JobPostings::where('posting_id', $posting_id)
        ->update([
            'job_title' => $job_title,
            'company_name' => $company_name,
            'location' => $location,
            'job_desc' => $job_desc,
        ]);

        session::Flash('msg', 'Job posting updated!');
        return redirect('/ct-dashboard');
    }

    public function viewApps(Request $request) {
        $posting_id = $request->query('id');

        $applications = applications::where('posting_id', $posting_id)->get();

        return view('application', ['applications'=>$applications]);
    }

    public function viewIndiv(Request $request) {

        $app_name = $request->query('name');

        return Storage::download('app/public/resumes/'.$app_name);

    }

}