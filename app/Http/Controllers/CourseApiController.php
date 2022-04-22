<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
use DB;
use Session;
use App\Models\Course;
use App\Models\NonMemberCourse;
use App\Models\userCourse;
use App\Models\Member;
use App\Models\JobPostings;
use App\Models\InterestedUser;
use App\Models\CourseType;

class CourseApiController extends Controller
{
    public function insertMember(Request $request) {

        try{
            $course_id = $request->query('id');
            $user_id = request('user_id');;
            
            $course = new userCourse();

            $course->user_id = $user_id;
            $course->course_id = $course_id;
            $course->save();
        
            return response()->json([
                'message' => 'Thank you for purchasing a course.', 
            ]);
            
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
            return Course::where('course_id', $course_id)->get();            
        }

        catch (\Exception $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
        catch (\Error $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }        
    }  
    
    public function insertNonMember(Request $request){
        
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ]);
 
        if($validator->fails())
        {
            return response()->json([
                'validate_err' => $validator->messages(),
            ]);
        }
        else
        {
            $course_id = $request->query('id');
            $course = new NonMemberCourse();

            $course->course_id = $course_id;
            $course->first_name = request('first_name');
            $course->last_name = request('last_name');
            $course->email = request('email');
            $course->save();

            session::Flash('message', 'Thank you for purchasing a course! Find more details in your email.');
            
            return response()->json([
                'message' => 'Thank you for purchasing a course.', 
            ]);
        }
    }
}


