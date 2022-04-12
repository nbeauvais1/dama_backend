<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Storage;
use App\Models\Course;
use App\Models\userCourse;
use App\Models\Member;
use App\Models\JobPostings;
use App\Models\InterestedUser;

class DashBoardNController extends Controller
{
    public function dashb() {
        if(session()->has('session_email')){
            try{
            $user_id = session('session_user_id'); //int
            $logged_user = Member::where('user_id', $user_id)->get();

            $course_name = Course::select('*')
                        ->join('user_course', 'course.course_id', '=', 'user_course.course_id')
                        ->where('user_id', $user_id)
                        ->get();
            
            $your_postings = JobPostings::where('user_id', $user_id)
                        ->where('job_filled_yn', "N")
                        ->get();

            $interested = JobPostings::join('interested_jobs', 'job_posting.posting_id', '=', 'interested_jobs.posting_id')
                        ->where('interested_jobs.user_id', $user_id)
                        ->where('interested_yn', "Y")
                        ->get();
            }
            catch (\Exception $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
            }
            catch (\Error $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
            }
            return view('/course-test-dashboard', [
                'user'=>$logged_user,
                'course_names'=>$course_name,
                'your_postings'=>$your_postings,
                'interested_postings'=>$interested,
            ]);
        }
        else{
            session::Flash('error', 'Please login to access dashboard.');
            return redirect('/');
        }
    }
}
