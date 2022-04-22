<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>DAMA Membership System</title>
    
    <link href="{{ asset('css/modern-reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <ul>
                @if(Session()->has('session_email'))
                <li><a href="/signup">Manage Membership</a></li>
                @else
                <li><a href="/signup">Sign Up For a Membership</a></li>
                @endif
                <li><a href="/add-corporate-member">Add Corporate Members</a></li>
                <li><a href="/event-admin">Manage Events</a></li>
                <li><a href="/event_list">All Events</a></li>
                <li><a href="/my-events">My Events</a></li>
                <li><a href="/course-admin">Manage Courses</a></li>
                <li><a href="/courses-list">All Courses</a></li>
                <li><a href="/view-jobs">Job Postings</a></li>
                <li><a href="/course-feedback">Course Feedback</a></li>
                <li><a href="/email-list">Email List</a></li>
                @if(Session()->has('session_email'))
                <li><a href="/signed-out" class="sign-in-out">Sign Out</a></li>
                @else
                <li><a href="/login" class="sign-in-out">Login</a></li>
                @endif
            </ul>    
        </nav>
    </header>
   
    <main>
    @if(Session::has('message') || Session::has('msg'))
        <p class="message">{{ Session::get('message') }}</p>
    @elseif(Session::has('error'))
        <p class="error">{{ Session::get('error') }}</p>
    @endif