<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Course;
use App\Models\CourseType;
use App\Models\CourseCourseTypes;

class InsertCourseController extends Controller
{

    public function index(){
        $course_types = CourseType::select('*')->get();
        return view('insert-course', ['course_types'=> $course_types,]);
    }

    public function insert(Request $request) {   
        try{

            $course = new Course();

            $course->course_code = request('course_code');
            $course->course_name = request('course_name');
            $course->course_description = request('course_desc');
            $course->course_type_id = request('course_type');

            $course->save();

        }
        catch (\Exception $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
        catch (\Error $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }


        return redirect('/course-admin');

    }

    public function insertType(Request $request) {
        try{

            $type = new CourseType();
                $type->course_type_name = request('type_name');
                $type->course_price = request('type_price');
                $type->course_price_member = request('type_price_member');
                $type->course_price_corporate = request('type_price_corporate');
                $type->save();
            session::Flash('message', 'Your new course type has been added.');   
            return redirect('/insert-course');

        }
        catch (\Exception $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
        catch (\Error $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
    }
}
