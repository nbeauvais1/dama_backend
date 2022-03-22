@include('header');
<h1>CHECK OUT THESE EPIC PEOPLE WHO WANT TO WORK FOR YOU!</h1>

@foreach ($applications as $application)

<div class="card">
    <a href="indiv_app?name={{$application->resume}}">{{$application->resume}}</a>
</div>
@endforeach

@include('footer');