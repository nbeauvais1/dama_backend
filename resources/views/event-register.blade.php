@include('header')
<?php $event_id = $_GET['event_id'];  ?>
<form action="/non-member-event-register" method="POST">
    @csrf
        <label for="event_id">Event to be Purchased</label>
        <input type="text" id="event_id" name="event_id" value="{{ $event_id }}">

        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name">

        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name">

        <label for="email">Email</label>
        <input type="text" id="email" name="email">

        <input type="submit" name="purchase_event" value="Purchase event">
</form>
@include('footer')