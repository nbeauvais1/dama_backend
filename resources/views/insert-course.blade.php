@include('header')
<?php  
$user_id = session('session_user_id');
$admin_status = DB::table('user')
                ->where('user_id', '=', $user_id)
                ->value('admin_yn');
?>
@if(Session::has('msg'))
        <p class="message">{{ Session::get('msg') }}</p>
@endif
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
            @foreach ($course_types as $course_type)
            <option value="{{ $course_type->type_id }}">{{ $course_type->course_type_name }}</option>
            @endforeach
        </select>

        <input type="submit" name="insert_course" value="Create Course">
    </form>

    <h2>Create New Course Type</h2>
    <form action="new_course_type_insert" method="POST">
    @csrf

        <label for="type_name">Course Type Name</label>
        <input type="text" id="type_name" name="type_name">

        <label for="type_price">Course Type Price</label>
        <input type="text" id="type_price" name="type_price">
        
        <input type="submit" name="insert_course_type" value="Create New Course Type">

    </form>

    @else
    <p class="error">You must be an admin to use this page.</p>
    <h2>Insert a New Course</h2>
    @endif
    </body>
@include('footer')