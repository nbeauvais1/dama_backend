<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Course;
use App\Models\userCourse;
use App\Models\Member;
use App\Models\JobPostings;
use App\Models\InterestedUser;
use App\Models\CourseType;

class CourseController extends Controller
{
    public function index(){

        $courses = Course::join('course_types', 'course.course_type_id', '=', 'course_types.type_id')
                        ->where('deleted_yn', 'N')->get();
        return view('courses-list',['courses'=>$courses]);
        
    }


    public function show(Request $request){

        try{
        $course_query_id = $request->query('id');
        $courses = Course::where('course_id', $course_query_id)->get();  

        if(session()->has('session_email')){
            $course = new userCourse();

            $course->user_id = session('session_user_id');
            $course->course_id = $course_query_id;

            $course->save();
            session::Flash('message', 'Thank you for purchasing a course. Find it in your courses!');
            return redirect('ct-dashboard');
        }
        else
        {
             return view('course-form',[
                'courses'=>$courses,
                'course_id'=>$course_query_id,
            ]);
        };
        }
        catch (\Exception $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
        catch (\Error $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
        
    }

    public function insert() {

        try{
            $course = new userCourse();

            $course->user_id = session('session_user_id');
            $course->course_id = request('course_id');
            $course->first_name = request('first_name');
            $course->last_name = request('last_name');
            $course->email = request('email');

            $course->save();
        

            if(session()->has('session_email')){
                session::Flash('message', 'Thank you for purchasing a course!');
                return redirect('/ct-dashboard');
            }
            else{
                session::Flash('message', 'Thank you for purchasing a course. Check your email for more info!');
                return redirect('/courses-list');
            }
        }
        catch (\Exception $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
        catch (\Error $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
    }

    public function dashb() {
        try{
            if(session()->has('session_email')){
                $user_id = session('session_user_id'); //int
                $logged_user = Member::where('user_id', $user_id)->get();
                $yes = "'Y'";

                $course_name = Course::select('*')
                            ->join('user_course', 'course.course_id', '=', 'user_course.course_id')
                            ->where('user_id', $user_id)
                            ->get();
                            
                $interested = JobPostings::join('user_job', 'job_posting.posting_id', '=', 'user_job.posting_id')
                            ->where('user_job.user_id', $user_id)
                            ->where('interested_yn', $yes)
                            ->where('job_posting.posting_id', 'user_job.posting_id')
                            ->get();

                return view('/course-test-dashboard', [
                    'user'=>$logged_user,
                    'course_names'=>$course_name,
                    'interested_postings'=>$interested,
                ]);
            }
            else{
                session::Flash('error', 'Please login to access dashboard.');
                return redirect('/');
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
        $course_id = $request->query('id');
        $edit_course = Course::join('course_types', 'course.course_type_id', '=', 'course_types.type_id')
                    ->where('course_id', $course_id)
                    ->first();
        return view('/edit-course', [
            'edit_course'=>$edit_course,
            'course_id'=>$course_id,
            ]);
    }

    public function insertUpdate(Request $request) {
        try{
            $course_id = $request->query('id');     

            $course_name =request('course_name');
            $course_code =request('course_code');
            $course_desc =request('course_desc'); 
            $course_type =request('course_type');     

            Course::where('course_id', $course_id)
            ->update([
                'course_name' => $course_name,
                'course_code' => $course_code,
                'course_description' => $course_desc,
                'course_type' => $course_type,
            ]);
        }
        catch (\Exception $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
        catch (\Error $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }

        session::Flash('message', 'Course updated!');
        return redirect('/courses-list');
    }

    public function delete(Request $request) {
        try{
        $course_id = $request->query('id');     
      
        Course::where('course_id', $course_id)
        ->update([
            'deleted_yn' => 'Y',
        ]);
        }
        catch (\Exception $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
        catch (\Error $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }

        return back()->with('message', 'Course Deleted');
    }    

}


