@include('header')

<!-- Messages -->


@foreach($user as $user)
<img src="{{ asset('storage/images/'.$user->profile_image) }}" alt="Profile Image">

<h2>Welcome <span>{{ $user->first_name }}</span> to the Test Dashboard</h2>
@endforeach

<!-- Edit Profile -->
<h3><a href="/edit-profile">Edit Your Profile</a></h3>

<!-- Your Courses -->
<h3 style="margin-top:1rem;">Your Courses</h3>
@foreach ($course_names as $course_name)
        <div class="card">
            <h3>{{$course_name->course_name}}</h3>           
        </div>
@endforeach

<!-- Your Job Postings -->
<h3 style="margin-bottom:1rem;">Your Job Postings</h3>
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
<h3 style="margin-top:1rem;">Interested Job Postings</h3>
@foreach ($interested_postings as $interested_post)
        <div class="card">
            <h3>{{$interested_post->job_title}}</h3>
            <a href="/job_applied?id={{ $interested_post->posting_id }}" class="button">Apply to Job</a>
            <a href="/not-interested?id={{$interested_post->user_job_id}}" class="button">No Longer Interested</a>
        </div>
@endforeach

@include('footer')