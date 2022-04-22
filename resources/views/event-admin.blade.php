@include('header')
<div class="admin">
<?php 
$user_id = session('session_user_id');
$admin_status = DB::table('user')
                ->where('user_id', '=', $user_id)
                ->value('admin_yn');
?>
        
        <div class="title">
            <h1>View All Events</h1>
            <a href="/events">Add an Event</a>
        </div>


	<div class="all-courses">
	<?php

		$events = DB::table('event')->orderBy('event_date')->get();

		foreach ($events as $event)
		{
			if($event->deleted_yn == 'N') 
			{
	?>		
	<div class="course">
			<h2><?php echo $event->event_title; ?></h2>
			@if($admin_status == 'Y')
			<div>
				<a href="./edit-event?id=<?php echo $event->event_id ?>" class="admin-button">Edit</a>
				<a href="./delete-event?id=<?php echo $event->event_id ?>" class="admin-button">Delete</a>
			</div>	
			@endif
	</div><!-- End of Course -->
	<?php
		}
	}
	?>
	<div class="add-new">
		<a href="/events">&#43; Add New Event</a>
	</div>  
	</div> <!-- End of All Courses -->
</div> <!-- End of Admin -->
@include('footer')


