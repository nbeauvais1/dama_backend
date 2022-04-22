@include('header')
<div class="admin">
<?php 
$user_id = session('session_user_id');
$admin_status = DB::table('user')
                ->where('user_id', '=', $user_id)
                ->value('admin_yn');
?>
        
        <div class="title">
            <h1>View All Courses</h1>
            <a href="/insert-course">Add a Course</a>
        </div>

        @if(Session::has('coursePurchasedMsg'))
            <p class="message">{{ Session::get('coursePurchasedMsg') }}</p>
        @endif

        <div class="all-courses">
        @foreach ($courses as $course)
            <div class="course">
                <h2>{{ $course->course_code }}: {{ $course->course_name }}</h2>
                    <div>
                        <a href="/update-course?id={{ $course->course_id }}" class="admin-button">Edit</a>
                        <a href="/delete-course?id={{ $course->course_id }}" class="admin-button">Delete</a>
                    </div>    
                </div>
        @endforeach
        <div class="add-new">
            <a href="/insert-course">&#43; Add New Course</a>
        </div>    
        </div>
</div>
@include('footer')
