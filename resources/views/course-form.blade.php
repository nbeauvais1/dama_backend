@include('header')

    <body>

            

        @foreach ($courses as $course)
        <h1>Purchase Course: {{ $course->course_name  }}</h1>
        @endforeach
        <!-- Session message -->
        
        <form action="/courses" method="POST">
        @csrf
            <label for="course_id">Course to be Purchased</label>
            <input type="text" id="course_id" name="course_id" value="{{ $course_id }}">

            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name">

            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name">

            <label for="email">Email</label>
            <input type="text" id="email" name="email">

            <input type="submit" name="purchase_course" value="Purchase Course">
        </form>
    </body>
</html>
