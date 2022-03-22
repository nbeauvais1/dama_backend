@include('header')
        
        @if(Session::has('msg'))
        <p class="message">{{ Session::get('msg') }}</p>
        @endif
        <h1>DAMA Edmonton - Member Management System</h1>
        <div>
            <a href="/signup">Sign Up For a Membership</a><br>
            <a href="/signin">Sign Into Membership</a><br>
            <a href="/event_list">Events</a><br>
            <a href="/events">Create An Event</a><br>
            <a href="/insert-course">Insert A Course</a><br>
            <a href="/courses-list">Courses</a><br>
            <a href="/ct-dashboard">Dashboard</a><br>
            
            <a href="/signed-out">Sign Out</a>
        </div>
@include('footer')        