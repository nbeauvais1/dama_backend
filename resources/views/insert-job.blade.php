@include('header')
    <h1>Create a job posting!</h1>
    <form action="/job_inserted" method="POST">
        @csrf
            <label for="job_title">Job Title</label>
            <input type="text" id="job_title" name="job_title"">

            <label for="company_name">Company Name</label>
            <input type="text" id="company_name" name="company_name">

            <label for="location">Location</label>
            <input type="text" id="location" name="location">

            <label for="job_desc">Job Description</label>
            <textarea name="job_desc" id="job_desc"></textarea>

            <input type="submit" name="post_job" value="Post Job Listing">
        </form>
@include('footer')