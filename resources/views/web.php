<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/signin', function () {
    return view('signin');
});

Route::get('/signup', function () {
    return view('signup');
});

Route::get('/events', function () {
    return view('events');
});
Route::get('/event_list', function () {
    return view('event_list');
});
Route::get('/event-register', function () {
    return view('event-register');
});
Route::get('/my-events', function () {
    return view('my-events');
});

Route::get('/session-test', function () {
    return view('session-test');
});

Route::get('/', 'App\Http\Controllers\SessionTestController@index');

Route::post('/session-test', 'App\Http\Controllers\SessionTestController@store');
Route::get('/signed-out', 'App\Http\Controllers\LogoutController@logout');

Route::post('/signedin', 'App\Http\Controllers\membershipController@store');
Route::post('/login', 'App\Http\Controllers\membershipController@login');
// Route::post('/login', 'App\Http\Controllers\AuthController@postLogin');

Route::post('/events', 'App\Http\Controllers\EventController@store');

//Route::get('event-register/{key}', [EventRegisterController::class, 'urlFetch']);

// Insert a Course
Route::get('/insert-course','App\Http\Controllers\InsertCourseController@index');
Route::post('/course_inserted','App\Http\Controllers\InsertCourseController@insert');

// Course Sign Up
Route::get('/courses-list','App\Http\Controllers\CourseController@index');
Route::get('/course-form','App\Http\Controllers\CourseController@show');
Route::post('/courses','App\Http\Controllers\CourseController@insert');
Route::get('/ct-dashboard','App\Http\Controllers\CourseController@dashb');