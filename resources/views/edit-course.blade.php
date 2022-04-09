@include('header');
<?php  
$user_id = session('session_user_id');
$admin_status = DB::table('user')
                ->where('user_id', '=', $user_id)
                ->value('admin_yn');
?>

@if($admin_status == 'Y')
<h2>Update Course</h2>
<form action="/course-updated?id={{$course_id}}" method="POST">
        @csrf
        <label for="course_code">Course Code</label>
        <input type="text" id="course_code" name="course_code" value="{{$edit_course->course_code}}">

        <label for="course_name">Course Name</label>
        <input type="text" id="course_name" name="course_name" value="{{$edit_course->course_name}}">

        <label for="course_desc">Course Description</label>
        <input type="text" id="course_desc" name="course_desc" value="{{$edit_course->course_description}}">

        <label for="course_type">Course Type</label>
        <select name="course_type" id="course_type">
            <option value="self-study">Self-Study</option>
            <option value="instructor-led">Instructor-Led</option>
        </select>
        
        <input type="submit" value="Update Course" name="course-btn" class="button">

        @else
        <p class="error">You must be an admin to use this page.</p>
        <h2>Update Course</h2>
    @endif
@include('footer')