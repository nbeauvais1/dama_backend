<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Feedback;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendFeedback;

class FeedbackController extends Controller
{ 
    public function index(){

        $courses =  DB::table('course')->where('deleted_yn', 'N')->get();
        return view('survey',['courses'=>$courses]);
        
    }
 
    public function store(Request $request) {
        try{
            $request->validate([
                'hear' => 'required',
                'prep' => 'required',
                'cname' => 'required',
                'cdate' => 'required',
                'quality' => 'required',
                'ccontent' => 'required',
            ]);
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
        $course_id = Course::select('course_id')
            ->where('course_name', $courseName)
            ->value('course_id');
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
        $feedbackData=array("hearAbout"=>$hearAbout,"prep"=>$prep,"topics"=>$topics,"course_name"=>$courseName,"course_id"=>$course_id,"course_date"=>$courseDate, "quality"=>$quality,"course_content"=>$courseContent, "fname"=>$fname, "lname"=>$lname, "email"=>$email);
        $insert_feedback = DB::table('feedback')->insert($feedbackData);

        $damaEmail = 'damaedmonton@gmail.com';
        $feedbackResults = array(
            'hearAbout' => $hearAbout,
            'prep' => $prep,
            'topics' => $topics,
            'course_name' => $courseName,
            'course_id' => $course_id,
            'course_date' => $courseDate,
            'quality' => $quality,
            'course_content' => $courseContent,
            'fname' => $fname,
            'lname' => $lname,
            'email' => $email,
        );
        Mail::to($damaEmail)->send(new SendFeedback($feedbackData));
        }
        catch (\Exception $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
        catch (\Error $e) {  
            return back()->with('error', "An error occured: " . $e->getMessage());
        }
        return redirect()->intended('/feedback-submitted');

    }

    public function submitted(){
        return view('/feedback-submitted');
    }
}   