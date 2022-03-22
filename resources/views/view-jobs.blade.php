@include('header');
<h1>Check out these nifty jobs we have available!</h1>
@if(Session::has('msg'))
    <p class="message">{{ Session::get('msg') }}</p>
@endif
    @foreach ($jobs as $job)
        <div class="card">
            <h2>{{ $job->job_title }}</h2>
            <p>{{ $job->company_name }}</p>
            <p>{{ $job->location }}</p>
            <p>{{ $job->job_desc }}</p>
            <a href="/job_applied?id={{ $job->posting_id }}" class="button">Apply to Job</a>
            @if(Session()->has('session_email'))
                <a href="/interested?id={{ $job->posting_id }}" class="button">Mark as Interested</a>
            @endif
        </div>
        @endforeach
@include('footer');