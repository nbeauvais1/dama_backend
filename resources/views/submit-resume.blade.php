@include('header');
<h1>Upload your resume for <span>{{$posting->job_title}}</span> at <span>{{$posting->company_name}}</span></h1>

<form action="/send_email?id={{ $posting->posting_id }}" method="POST" enctype="multipart/form-data">
        @csrf
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name">

            <label for="email">Email for Contact</label>
            <input type="text" id="email" name="email">

            <label for="resume">Upload Your Resume</label>
            <input type="file" id="resume" name="resume">

            <input type="submit" name="send_app" value="Submit Application">
</form>


@include('footer');
