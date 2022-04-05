<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Course;
use App\Models\Event;
use App\Models\JobPostings;
use App\Models\Member;
use App\Models\MembershipType;

// Courses
Route::get('/all_courses', function () {
    return Course::where('deleted_yn', 'N')->get();
});

// Events
Route::get('/all_events', function () {
    return Event::where('deleted_yn', 'N')->get();
});

// Job Postings
Route::get('/all_jobs', function () {
    return JobPostings::where('job_filled_yn', 'N')->get();
});

// Users
Route::get('/all_members', function () {
    $now = DB::raw('NOW()');
    return Member::join('user_membership', 'user.user_id', '=', 'user_membership.user_id')
    ->where('expiry_date', '>', $now)
    ->get();
});

// Membership Types
Route::get('/all_membership_types', function () {
    return MembershipType::all();
});


// Login
Route::post('/signin', 'App\Http\Controllers\loginApiController@postLogin');