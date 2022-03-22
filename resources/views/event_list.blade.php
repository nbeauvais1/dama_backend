
@include('header')

<main>
<div class="event_page">
	<h1>View Events</h1>	

	<?php

		$events = DB::table('event')->orderBy('event_date')->get();

		foreach ($events as $event)
		{
	?>		<div class="card">
				<h3><?php echo $event->event_title; ?></h3>
				<a href="./event-register?event_id=<?php echo $event->event_id ?>"  class="button">Register</a>
				<ul>
					<li><?php echo $event->event_date ?></li>
					<li><?php echo $event->event_city ?></li>
					<li><?php echo $event->event_type ?></li>
					<li>$<?php echo $event->event_price ?></li>
				</ul>
				<p><?php echo $event->event_description ?></p>
			</div>
	<?php
		}

	?>	

</div>
</main>

@include('footer')


