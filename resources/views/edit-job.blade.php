@include('header')
    <h1>Edit your Posting</h1>
    <form action="/job_updated?id={{$post_id}}" method="POST">
       
        @csrf
            <label for="job_title">Job Title</label>
            <input type="text" id="job_title" name="job_title" value="{{$job_2_edit->job_title}}">

            <label for="company_name">Company Name</label>
            <input type="text" id="company_name" name="company_name" value="{{$job_2_edit->company_name}}">

            <label for="location">Location</label>
            <input type="text" id="location" name="location" value="{{$job_2_edit->location}}">

            <label for="job_desc">Job Description</label>
            <textarea name="job_desc" id="job_desc">{{$job_2_edit->job_desc}}</textarea>

            <input type="submit" name="update_job" value="Update Listing">
        </form>
@include('footer')