
@include('header')
<?php 
$user_id = session('session_user_id');
$admin_status = DB::table('user')
                ->where('user_id', '=', $user_id)
                ->value('admin_yn');
?>

<h2>View Events</h2>	

<?php

	$events = DB::table('event')->orderBy('event_date')->get();

	foreach ($events as $event)
	{
		if($event->deleted_yn == 'N') 
		{
?>		<div class="card">
			<h3><?php echo $event->event_title; ?></h3>
			<a href="./event-register?event_id=<?php echo $event->event_id ?>"  class="button">Register</a>
			@if($admin_status == 'Y')
			<a href="./edit-event?id=<?php echo $event->event_id ?>"  class="button">Edit</a>
			<a href="./delete-event?id=<?php echo $event->event_id ?>"  class="button">Delete</a>
			@endif
			<ul>
				<li><?php echo $event->event_date ?></li>
				<li><?php echo $event->event_city ?></li>
				<li><?php echo $event->event_type ?></li>
				<li>$<?php echo $event->event_price ?></li>
			</ul>
			<p>With <?php echo $event->event_speaker; ?> as your speaker!</p>
			<p><?php echo $event->event_description ?></p>
		</div>
<?php
		}
	}

?>	



@include('footer')


