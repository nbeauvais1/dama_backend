<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Course;
use App\Models\Event;
use App\Models\JobPostings;
use App\Models\Member;
use App\Models\Membership;
use App\Models\MembershipType;

// Courses
Route::get('/all_courses', function () {
    return Course::where('deleted_yn', 'N')->get();
});  
  
Route::get('/all_courses_and_types', function () {
    return Course::leftJoin('course_types', 'course.course_type_id', '=', 'course_types.type_id')
    ->where('deleted_yn', 'N')
    ->get();
});

// Events
Route::get('/all_events', function () {
    return Event::where('deleted_yn', 'N')->get();
});
Route::post('/events', 'App\Http\Controllers\EventApiController@insert');

// Job Postings


Route::get('/all_jobs', function () {

$user_id = request('user_id');    
    return JobPostings::where('job_filled_yn', 'N')
                ->where('user_id', '!=', $user_id)
                ->get();
});
Route::post('/job_inserted','App\Http\Controllers\JobPostingsApiController@insert');
Route::get('/job_filled','App\Http\Controllers\JobPostingsApiController@delete');
Route::get('/update_job','App\Http\Controllers\JobPostingsApiController@update');
Route::post('/job_updated','App\Http\Controllers\JobPostingsApiController@insertUpdate');

// Apply to Job

Route::get('/apply_to','App\Http\Controllers\ViewJobsApiController@apply');

Route::post('/job_applied','App\Http\Controllers\ViewJobsApiController@mail');

// Users
Route::get('/all_members', function () {
    $now = DB::raw('NOW()');
    return Member::join('user_membership', 'user.user_id', '=', 'user_membership.user_id')
    ->where('expiry_date', '>', $now)
    ->get();
});

// User Membership
Route::get('/user_membership', function () {    
    $user_id = request('user_id');
    return Membership::select('*')
    ->join('user_membership', 'membership.membership_id', '=', 'user_membership.membership_id')
    ->where('user_id', $user_id)
    ->get();
});

// User Courses
Route::post('/purchase_course_member','App\Http\Controllers\CourseApiController@insertMember');
Route::post('/purchase_course_non_member','App\Http\Controllers\CourseApiController@insertNonMember');

Route::get('/user_courses', function () {    
    $user_id = request('user_id');
    return Course::select('*')
    ->join('user_course', 'course.course_id', '=', 'user_course.course_id')
    ->where('user_id', $user_id)
    ->get();
});

// User Events
Route::get('/user_events', function () {    
    $user_id = request('user_id');
    return Event::select('*')
    ->join('user_event', 'event.event_id', '=', 'user_event.event_id')
    ->where('user_id', $user_id)
    ->get();
});

Route::post('/purchase_event_member','App\Http\Controllers\EventRegisterApiController@store');
Route::post('/purchase_event_non_member','App\Http\Controllers\EventRegisterApiController@insertNonMember');

// Membership Types
Route::get('/all_membership_types', function () {
    return MembershipType::all();
});

// Login
Route::post('/signin', 'App\Http\Controllers\LoginApiController@postLogin');

// Forgot Password
Route::post('/send_forgot_password', 'App\Http\Controllers\ForgotPasswordApiController@submitForgetPasswordForm');
