@include('header');
<main>
    <?php
        $event_id = $_GET['event_id'];
        $events = DB::select('SELECT * FROM event WHERE event_id = ?' , [$event_id]);

        

        foreach ($events as $event)
        {
    ?>      <div>
                <h3><?php echo $event->event_title; ?></h3>
                <ul>
                    <li><?php echo $event->event_date ?></li>
                    <li><?php echo $event->event_city ?></li>
                    <li><?php echo $event->event_type ?></li>
                    <li>$<?php echo $event->event_price ?>.00</li>
                </ul>
                <p><?php echo $event->event_description ?></p>
            </div>
    <?php
        }

    ?>
    <?php
        $event_id = $_GET['event_id'];
        $user_id = session('session_user_id');
        $data=array('user_id'=>$user_id,'event_id'=>$event_id);
        DB::table('user_event')->insert($data);
    ?>

    <br>
    <br>
    <h2>You have successfully registered to this event!</h2>
    
</main>
@include('footer');