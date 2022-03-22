<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Header Links</title>
    
    <link href="{{ asset('css/modern-reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Source+Sans+Pro&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/signup">Sign Up For a Membership</a></li>
                <li><a href="/event_list">All Events</a></li>
                <li><a href="/my-events">My Events</a></li>
                <li><a href="/events">Create An Event</a></li>
                <li><a href="/courses-list">Courses</a></li>
                <li><a href="/insert-course">Insert Course</a></li>
                <li><a href="/view-jobs">Job Postings</a></li>
                @if(Session()->has('session_email'))
                <li><a href="/signed-out" class="sign-in-out">Sign Out</a></li>
                @else
                <li><a href="/session-test" class="sign-in-out">Login</a></li>
                @endif
            </ul>    
        </nav>
    </header>
    <main>  