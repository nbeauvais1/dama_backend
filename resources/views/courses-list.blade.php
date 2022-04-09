@include('header')
<?php 
$user_id = session('session_user_id');
$admin_status = DB::table('user')
                ->where('user_id', '=', $user_id)
                ->value('admin_yn');
?>

        @if(Session::has('coursePurchasedMsg'))
        <p class="message">{{ Session::get('coursePurchasedMsg') }}</p>
        @endif
        <h1>View All Courses</h1>

        @foreach ($courses as $course)
            <div class="card">
                <h2>{{ $course->course_code }}: {{ $course->course_name }}</h2>
                <p>{{ $course->course_description }}</p>
                <p>Course Type: {{ $course->course_type_name }}</p>
                <p>Price: ${{ $course->course_price }}</p>    
            @if(Session()->has('session_email'))            
            @endif
                <a href="/course-form?id={{ $course->course_id }}" class="button">Purchase Course</a>
            @if($admin_status == 'Y')
			<a href="/update-course?id={{ $course->course_id }}"  class="button">Edit</a>
			<a href="/delete-course?id={{ $course->course_id }}"  class="button">Delete</a>
			@endif
            </div>
        @endforeach
    </body>
@include('footer')
