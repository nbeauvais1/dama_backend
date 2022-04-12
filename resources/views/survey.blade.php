@include('header')

<h2>Course Feedback (Fully Confidential)</h2>
<h3>Webinar-Course Feedback Survey</h3>

<form action="/feedback-submit" method="post">
    @csrf
    <label for="hear">How did you hear about this webinar/course?</label>
    <div>
        <input type="radio" name="hear" id="radio1" value="Email">
        <label for="radio1">Email</label>
        <input type="radio" name="hear" id="radio2" value="LinkedIn">
        <label for="radio2">LinkedIn</label>
        <input type="radio" name="hear" id="radio3" value="DAMA/ICCP-Website">
        <label for="radio3">DAMA/ICCP Website</label>
        <input type="radio" name="hear" id="radio4" value="Other">
        <label for="radio4">Other</label>
    </div>

    <label for="ifother1">If Other please specify</label>
    <input type="text" name="ifother1" id="ifother1">


    <label for="prep">Speaker/Instructor Preparation</label>
    <select name="prep" id="prep">
        <option value="">Please Select An Option</option>
        <option value="Exceeded-Expectations">Exceeded Expectations</option>
        <option value="Met-Expectations">Met Expectations</option>
        <option value="Expectations-Not-Met">Did not meet expectations</option>
        <option value="Other">Other</option>
    </select>

    <label for="ifother2">If Other please specify</label>
    <input type="text" name="ifother2" id="ifother2">

    <label for="topics">What other topics/speakers would you like us to bring to you? (Optional)</label>
    <input type="text" name="topics" id="topics">

    <label for="cname">Name of Webinar/Course</label>
    <select name="cname" id="cname">
        @foreach ($courses as $course)
            <option value="{{ $course->course_name }}">{{ $course->course_name }}</option>
        @endforeach
    </select>
    <label for="cdate">Date of Webinar/Course</label>
    <input type="text" name="cdate" id="cdate">

    <label for="quality">Facility/Access/Quality</label>
    <select name="quality" id="quality">
    <option value="">Please Select An Option</option>
        <option value="Exceeded-Expectations">Exceeded Expectations</option>
        <option value="Met-Expectations">Met Expectations</option>
        <option value="Expectations-Not-Met">Did not meet expectations</option>
        <option value="Other">Other</option>
    </select>

    <label for="ifother3">If Other please specify</label>
    <input type="text" name="ifother3" id="ifother3">

    <label for="ccontent">Course Content</label>
    <select name="ccontent" id="ccontent">
    <option value="">Please Select An Option</option> 
        <option value="Exceeded-Expectations">Exceeded Expectations</option>
        <option value="Met-Expectations">Met Expectations</option>
        <option value="Expectations-Not-Met">Did not meet expectations</option>
        <option value="Other">Other</option>
    </select>

    <label for="ifother4">If Other please specify</label>
    <input type="text" name="ifother4" id="ifother4">

    <label for="fname">First Name (Optional)</label>
    <input type="text" name="fname" id="fname">

    <label for="lname">Last Name (Optional)</label>
    <input type="text" name="lname" id="lname">

    <label for="email">Email (Optional)</label>
    <input type="email" name="email" id="email">

    <input type="submit" value="Submit">
</form>



@include('footer') 