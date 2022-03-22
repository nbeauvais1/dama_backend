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

class CourseController extends Controller
{
    public function index(){

        $courses = Course::all();
        return view('courses-list',['courses'=>$courses]);
        
    }


    public function show(Request $request){

        $course_query_id = $request->query('id');
        $courses = Course::where('course_id', $course_query_id)->get();  

        if(session()->has('session_email')){
            $course = new userCourse();

            $course->user_id = session('session_user_id');
            $course->course_id = $course_query_id;

            $course->save();
            session::Flash('coursePurchasedMsg', 'Thank you for purchasing a course. Find it in your courses!');
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

    public function insert() {

        $course = new userCourse();

        $course->user_id = session('session_user_id');
        $course->course_id = request('course_id');
        $course->first_name = request('first_name');
        $course->last_name = request('last_name');
        $course->email = request('email');

        $course->save();

        if(session()->has('session_email')){
            session::Flash('coursePurchasedMsg', 'Thank you for purchasing a course!');
            return redirect('/ct-dashboard');
        }
        else{
            session::Flash('coursePurchasedMsg', 'Thank you for purchasing a course. Check your email for more info!');
            return redirect('/courses-list');
        }

    }

    

}


