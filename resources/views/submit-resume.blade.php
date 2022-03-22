@include('header');
<h1>Upload your resume for <span>{{$posting->job_title}}</span> at <span>{{$posting->company_name}}</span></h1>

<form action="/submit-app?id={{ $posting->posting_id }}" method="POST" enctype="multipart/form-data">
        @csrf
            <label for="resume">Upload Your Resume</label>
            <input type="file" id="resume" name="resume">

            <input type="submit" name="send_app" value="Submit Application">
</form>


@include('footer');
