@include('header')

        @if(Session::has('coursePurchasedMsg'))
        <p class="message">{{ Session::get('coursePurchasedMsg') }}</p>
        @endif
        <h1>View All Courses</h1>

        @foreach ($courses as $course)
        <div class="card">
            <h2>{{ $course->course_code }}: {{ $course->course_name }}</h2>
            <p>{{ $course->course_description }}</p>
            <p>Price: ${{ $course->course_price }}</p>
            
        @if(Session()->has('session_email'))
        <p>Membership Price:</p>
        @endif
            <a href="/course-form?id={{ $course->course_id }}" class="button">Purchase Course</a>
        </div>
        @endforeach
    </body>
@include('footer')
