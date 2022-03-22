<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Course;

class InsertCourseController extends Controller
{

    public function index(){
        return view('insert-course');        
    }

    public function insert() {

        $course = new Course();

        $course->course_code = request('course_code');
        $course->course_name = request('course_name');
        $course->course_description = request('course_desc');
        $course->course_price = request('price');

        $course->save();

        return redirect('/courses-list');

    }

}