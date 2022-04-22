<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Course;
use App\Models\NonMemberCourse;
use App\Models\userCourse;
use App\Models\Member;
use App\Models\JobPostings;
use App\Models\InterestedUser;
use App\Models\CourseType;

class CourseController extends Controller
{
    public function index(){

        $courses = Course::leftJoin('course_types', 'course.course_type_id', '=', 'course_types.type_id')
        ->where('deleted_yn', 'N')
        ->get();

        return view('courses-list',[
            'courses'=>$courses
        ]);
        
    }

    public function admin(){
        $courses = Course::leftJoin('course_types', 'course.course_type_id', '=', 'course_types.type_id')
        ->where('deleted_yn', 'N')
        ->get();

        return view('course-admin',[
            'courses'=>$courses
        ]);
        
    }

    public function insert(Request $request) {

        try{
            $course_id = $request->query('id');
            $user_id = session('session_user_id');
            if(!$user_id){
               return redirect()->intended("/course-form?id=$course_id");
            }
            $course = new userCourse();

            $course->user_id = $user_id;
            $course->course_id = $course_id;
            $course->save();
        
            session::Flash('message', 'Thank you for purchasing a course!');
            return redirect('/ct-dashboard');
            
        }
        catch (\Exception $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
        catch (\Error $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
    }


    public function show(Request $request){
        try{
            $course_id = $request->query('id');
            $courses = Course::where('course_id', $course_id)->get();
             return view('course-form', [
                 'courses'=>$courses,
                 'course_id'=>$course_id,
             ]);
        }

        catch (\Exception $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
        catch (\Error $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }        
    }  
    
    public function insertNonMember(Request $request){
        
            $course_id = $request->query('id');
            $course = new NonMemberCourse();

            $course->course_id = $course_id;
            $course->first_name = request('first_name');
            $course->last_name = request('last_name');
            $course->email = request('email');
            $course->save();

            session::Flash('message', 'Thank you for purchasing a course! Find more details in your email.');
            return redirect('/');            
        
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

            Course::where('course_id', $course_id)
            ->update([
                'course_name' => $course_name,
                'course_code' => $course_code,
                'course_description' => $course_desc,
            ]);
        }
        catch (\Exception $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
        catch (\Error $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }

        session::Flash('message', 'Course updated!');
        return redirect('/course-admin');
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


