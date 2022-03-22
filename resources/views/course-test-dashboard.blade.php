@include('header')

<!-- Messages -->
@if(Session::has('coursePurchasedMsg'))
<p class="message">{{ Session::get('coursePurchasedMsg') }}</p>
@endif
@if(Session::has('msg'))
<p class="message">{{ Session::get('msg') }}</p>
@endif

@foreach($user as $user)
<h1>Welcome <span>{{ $user->first_name }}</span> to the Test Dashboard</h1>
@endforeach

<!-- Your Courses -->
<h2 style="margin-top:1rem;">Your Courses</h2>
@foreach ($course_names as $course_name)
        <div class="card">
            <h3>{{$course_name->course_name}}</h3>           
        </div>
@endforeach

<!-- Your Job Postings -->
<h2 style="margin-bottom:1rem;">Your Job Postings</h2>
<a href="/insert-a-job" class="button">Create New Posting</a>
@foreach ($your_postings as $your_posting)
        <div class="card">
            <h3>{{$your_posting->job_title}}</h3>
            <a href="/job-filled?id={{$your_posting->posting_id}}">Mark Job as Filled</a>
            <a href="/edit-job?id={{$your_posting->posting_id}}">Edit Posting</a>
            <a href="/view_app?id={{$your_posting->posting_id}}">View Applications</a>
        </div>
@endforeach

<!-- Interested Job Postings -->
<h2 style="margin-top:1rem;">Interested Job Postings</h2>
@foreach ($interested_postings as $interested_post)
        <div class="card">
            <h3>{{$interested_post->job_title}}</h3>
            <a href="/job_applied?id={{ $interested_post->posting_id }}" class="button">Apply to Job</a>
            <a href="/not-interested?id={{$interested_post->user_job_id}}" class="button">No Longer Interested</a>
        </div>
@endforeach

@include('footer')