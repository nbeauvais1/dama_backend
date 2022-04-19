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
    return Course::join('course_course_types', 'course.course_id', '=', 'course_course_types.course_id')
    ->join('course_types', 'course_types.type_id', '=', 'course_course_types.type_id')
    ->where('deleted_yn', 'N')->get();
});

Route::get('/purchase_course','App\Http\Controllers\CourseApiController@show');
Route::post('/courses_non_member','App\Http\Controllers\CourseApiController@insertNonMember');

// Events
Route::get('/all_events', function () {
    return Event::where('deleted_yn', 'N')->get();
});
Route::post('/events', 'App\Http\Controllers\EventApiController@insert');
// Event Register
Route::get('/event_member','App\Http\Controllers\EventRegisterApiController@store');
Route::get('/event_non_member','App\Http\Controllers\EventRegisterApiController@insertNonMember');

// Job Postings
Route::get('/all_jobs', function () {
    return JobPostings::where('job_filled_yn', 'N')->get();
});
Route::post('/job_inserted','App\Http\Controllers\JobPostingsApiController@insert');
Route::get('/job_filled','App\Http\Controllers\JobPostingsApiController@delete');
Route::get('/update_job','App\Http\Controllers\JobPostingsApiController@update');
Route::post('/job_updated','App\Http\Controllers\JobPostingsApiController@insertUpdate');

// Users
Route::get('/all_members', function () {
    $now = DB::raw('NOW()');
    return Member::join('user_membership', 'user.user_id', '=', 'user_membership.user_id')
    ->where('expiry_date', '>', $now)
    ->get();
});

Route::get('/user_membership', function () {    
    $user_id = request('user_id');
    return Membership::select('*')
    ->join('user_membership', 'membership.membership_id', '=', 'user_membership.membership_id')
    ->where('user_id', $user_id)
    ->get();
});

Route::get('/user_courses', function () {    
    $user_id = request('user_id');
    return Course::select('*')
    ->join('user_course', 'course.course_id', '=', 'user_course.course_id')
    ->where('user_id', $user_id)
    ->get();
});

Route::get('/user_events', function () {    
    $user_id = request('user_id');
    return Event::select('*')
    ->join('user_event', 'event.event_id', '=', 'user_event.event_id')
    ->where('user_id', $user_id)
    ->get();
});

// Membership Types
Route::get('/all_membership_types', function () {
    return MembershipType::all();
});

// Login
Route::post('/signin', 'App\Http\Controllers\LoginApiController@postLogin');