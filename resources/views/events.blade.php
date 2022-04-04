@include('header')
<?php  
$user_id = session('session_user_id');
$admin_status = DB::table('user')
                ->where('user_id', '=', $user_id)
                ->value('admin_yn');
?>

@if($admin_status == 'Y')
<h2>Create an Event</h2>
<form action="/events" method="POST" class="event-form">
	@csrf

	<label for="event_title">Title</label>
	<input type="text" id="event_title" name="event_title">

	<label for="event_speaker">Event Speaker</label>
	<input type="text" id="event_speaker" name="event_speaker">

	<label for="event_type">Type</label>
	<select type="text" id="event_type" name="event_type">
		<option>Please Select a Type</option>
		<option value="online">Online</option>
		<option value="in-person">In-Person</option>
	</select>

	<label for="event_price">Price</label>
	<input type="number" step="0.01" id="event_price" name="event_price">

	<label for="event_date">Date</label>
	<input type="datetime-local" id="event_date" name="event_date">

	<label for="event_city">City</label>
	<input type="text" id="event_city" name="event_city">

	<label for="event_description">Description</label>
	<textarea id="event_description" name="event_description"></textarea>

	<input type="submit" value="Create Event" name="event-btn" class="login-btn">

</form>
	@else
        <p class="error">You must be an admin to use this page.</p>
        <h2>Create an Event</h2>
    @endif
@include('footer')


