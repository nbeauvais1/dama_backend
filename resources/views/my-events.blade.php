@include('header')
<?php $user_id = session('session_user_id'); ?>
@if(!$user_id)
<p class="error">You must be logged in to access this page.</p>
<h2>My Events</h2>
@else
<h2>My Events</h2>
<h3>Upcoming events</h3>
<div>
	<?php  
		$user_id = session('session_user_id');
		$events = DB::select('SELECT *
		FROM user_event
		INNER JOIN user
		ON user_event.user_id = user.user_id
		INNER JOIN event
		ON user_event.event_id = event.event_id WHERE user.user_id = ? AND event.event_date > CURDATE();', [$user_id]);
		foreach ($events as $event)
    ?>
        @if(!$events)
        <p>You are not currently registered in any upcoming events.</p>
        @endif
        @foreach($events as $event)
         <div class="card">
                <h4><?php echo $event->event_title; ?></h4>
                <ul>
                    <li><?php echo $event->event_date ?></li>
                    <li><?php echo $event->event_city ?></li>
                    <li><?php echo $event->event_type ?></li>
                    <li>$<?php echo $event->event_price ?></li>
                </ul>
                <p><?php echo $event->event_description ?></p>
            </div>
        @endforeach
</div>
<h3>Previous Events</h3>
<div>
	<?php  
		$user_id = session('session_user_id');
		$events = DB::select('SELECT *
		FROM user_event
		INNER JOIN user
		ON user_event.user_id = user.user_id
		INNER JOIN event
		ON user_event.event_id = event.event_id WHERE user.user_id = ? AND event.event_date <= CURDATE();', [$user_id]);
    ?>  
        @if(!$events)
        <p>You have not registered in any previous events.</p>
        @endif
		@foreach($events as $event)
         <div class="card">
                <h4><?php echo $event->event_title; ?></h4>
                <ul>
                    <li><?php echo $event->event_date ?></li>
                    <li><?php echo $event->event_city ?></li>
                    <li><?php echo $event->event_type ?></li>
                    <li>$<?php echo $event->event_price ?></li>
                </ul>
                <p><?php echo $event->event_description ?></p>
            </div>
        @endforeach
</div>
@endif
@include('footer')