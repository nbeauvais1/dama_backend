@include('header')
<?php $event_id = $_GET['event_id']; 
$event_title = DB::table('event')
          ->where('event_id', '=', $event_id)
          ->value('event_title');
?>
<form action="/non-member-event-register?event_id={{$event_id}}" method="POST">
    @csrf
        <label for="event_id">Event</label>
        <input type="text" id="event_title" name="event_title" value="{{ $event_title }}" readonly>

        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name">

        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name">

        <label for="email">Email</label>
        <input type="text" id="email" name="email">

        <input type="submit" name="purchase_event" value="Purchase event">
</form>
@include('footer')