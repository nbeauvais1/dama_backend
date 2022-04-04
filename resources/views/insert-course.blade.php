@include('header')
<?php  
$user_id = session('session_user_id');
$admin_status = DB::table('user')
                ->where('user_id', '=', $user_id)
                ->value('admin_yn');
?>
     @if($admin_status == 'Y')
     <h2>Insert a New Course</h2>
    <form action="/course_inserted" method="POST">
    @csrf
        <label for="course_code">Course Code</label>
        <input type="text" id="course_code" name="course_code">

        <label for="course_name">Course Name</label>
        <input type="text" id="course_name" name="course_name">

        <label for="course_desc">Course Description</label>
        <input type="text" id="course_desc" name="course_desc">

        <label for="course_type">Course Type</label>
        <select name="course_type" id="course_type">
            <option value="self-study">Self-Study</option>
            <option value="instructor-led">Instructor-Led</option>
        </select>

        <label for="price">Price</label>
        <input type="text" id="price" name="price">

        <input type="submit" name="insert_course" value="Create Course">
    </form>
    @else
    <p class="error">You must be an admin to use this page.</p>
    <h2>Insert a New Course</h2>
    @endif
    </body>
@include('footer')