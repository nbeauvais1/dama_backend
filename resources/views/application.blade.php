@include('header')
<h2>CHECK OUT THESE EPIC PEOPLE WHO WANT TO WORK FOR YOU!</h2>

@foreach ($applications as $application)

<div class="card">
    <a href="indiv_app?name={{$application->resume}}">{{$application->resume}}</a>
</div>
@endforeach

@include('footer')