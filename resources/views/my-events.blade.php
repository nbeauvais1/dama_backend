@include('header');

<p>Currently bugged! Couldn't get the SQL to use the session user_id, so I hardcoded mine in (10) to get it to work</p>

<h1>My Events</h1>
<?php  
/*$user_id_session= session('user_id_session');
$events = DB::select('SELECT *
FROM user_event
INNER JOIN user
ON user_event.user_id = user.user_id
INNER JOIN event
ON user_event.event_id = event.event_id WHERE user.user_id = $user_id_session AND event.event_date > CURDATE();');

var_dump($events);*/
?>

<h2>Upccoming events</h2>
<div>
	<?php  
		$user_id_session= session('user_id_session');
		$events = DB::select('SELECT *
		FROM user_event
		INNER JOIN user
		ON user_event.user_id = user.user_id
		INNER JOIN event
		ON user_event.event_id = event.event_id WHERE user.user_id = 10 AND event.event_date > CURDATE();');
		foreach ($events as $event)
        {
    ?>      <div>
                <h3><?php echo $event->event_title; ?></h3>
                <ul>
                    <li><?php echo $event->event_date ?></li>
                    <li><?php echo $event->event_city ?></li>
                    <li><?php echo $event->event_type ?></li>
                    <li>$<?php echo $event->event_price ?></li>
                </ul>
                <p><?php echo $event->event_description ?></p>
            </div>
        <?php } ?>
</div>
<h2>Previous Events</h2>
<div>
	<?php  
		$user_id_session= session('user_id_session');
		$events = DB::select('SELECT *
		FROM user_event
		INNER JOIN user
		ON user_event.user_id = user.user_id
		INNER JOIN event
		ON user_event.event_id = event.event_id WHERE user.user_id = 10 AND event.event_date <= CURDATE();');
		foreach ($events as $event)
        {
    ?>      <div>
                <h3><?php echo $event->event_title; ?></h3>
                <ul>
                    <li><?php echo $event->event_date ?></li>
                    <li><?php echo $event->event_city ?></li>
                    <li><?php echo $event->event_type ?></li>
                    <li>$<?php echo $event->event_price ?></li>
                </ul>
                <p><?php echo $event->event_description ?></p>
            </div>
        <?php } ?>
</div>