<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
class FeedbackController extends Controller
{ 
 
    public function store() {
        $hearAbout =request('hear');
        $hearOther =request('ifother1');
            if ($hearOther) {
                $hearAbout = $hearOther;
            }
        $prep =request('prep');
        $prepOther =request('ifother2');
        if ($prepOther) {
            $prep = $prepOther;
        }
        $topics =request('topics');
        $courseName =request('cname');
        $courseDate =request('cdate');
        $quality =request('quality');
        $qualityOther =request('ifother3');
        if ($qualityOther) {
            $quality = $qualityOther;
        }
        $courseContent =request('ccontent');
        $courseOther =request('ifother4');
        if ($courseOther) {
            $courseContent = $courseOther;
        }
        $fname =request('fname');
        $lname =request('lname');
        $email =request('email');
        $feedbackData=array('hearAbout'=>$hearAbout,'prep'=>$prep,"topics"=>$topics,"course_name"=>$courseName,"course_date"=>$courseDate, "quality"=>$quality,"course_content"=>$courseContent, "fname"=>$fname, "lname"=>$lname, "email"=>$email);
        $insert_feedback = DB::table('feedback')->insert($feedbackData);
        return redirect()->intended('/feedback-submitted');

    }

    public function index(){
        return view('/survey');
    }

    public function submitted(){
        return view('/feedback-submitted');
    }
}   