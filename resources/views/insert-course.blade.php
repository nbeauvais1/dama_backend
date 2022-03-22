@include('header')

    <body>

        
        <h1>Insert a New Course</h1>
        

        <form action="/course_inserted" method="POST">
        @csrf
            <label for="course_code">Course Code</label>
            <input type="text" id="course_code" name="course_code"">

            <label for="course_name">Course Name</label>
            <input type="text" id="course_name" name="course_name">

            <label for="course_desc">Course Description</label>
            <input type="text" id="course_desc" name="course_desc">

            <label for="price">Price</label>
            <input type="text" id="price" name="price">

            <input type="submit" name="insert_course" value="Create Course">
        </form>
    </body>
@include('footer')