@include('header')
<div class="admin">
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
        <div class="title"><h2>Insert a New Course</h2>
            <a href="/course-admin">Go Back</a>
        </div>
     
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
    <div class="title-2">
        <h2>Create New Course Type</h2>
    </div>
    <form action="new_course_type_insert" method="POST">
    @csrf

        <label for="type_name">Course Type Name</label>
        <input type="text" id="type_name" name="type_name">

        <label for="type_price">Course Type Price</label>
        <input type="text" id="type_price" name="type_price">
        
        <label for="type_price_member">Course Type Price - Member</label>
        <input type="text" id="type_price_member" name="type_price_member">
        
        <label for="type_price_corporate">Course Type Price - Corporate</label>
        <input type="text" id="type_price_corporate" name="type_price_corporate">

        <input type="submit" name="insert_course_type" value="Create New Course Type">

    </form>

    @else
    <p class="error">You must be an admin to use this page.</p>
    <h2>Insert a New Course</h2>
    @endif
</div>
@include('footer')