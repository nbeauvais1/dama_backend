@include('header');
<?php  
$user_id = session('session_user_id');
$admin_status = DB::table('user')
                ->where('user_id', '=', $user_id)
                ->value('admin_yn');
?>

@if($admin_status == 'Y')
<?php $converted_date = date("Y-m-d\TH:i:s", strtotime($edit_event->event_date)); ?>

    <h2>Update Event</h2>
    <form action="/event-updated?id={{$event_id}}" method="POST" class="event-form">
        @csrf

        <label for="event_title">Title</label>
        <input type="text" id="event_title" name="event_title" value="{{$edit_event->event_title}}">

        <label for="event_speaker">Event Speaker</label>
        <input type="text" id="event_speaker" name="event_speaker" value="{{$edit_event->event_speaker}}">

        <label for="event_type">Type</label>
        <select type="text" id="event_type" name="event_type">
            <option>Please Select a Type</option>
            
            <option value="online" <?php if($edit_event->event_type == "online"){echo "selected=\"true\"";}?>>Online</option>
            <option value="in-person" <?php if($edit_event->event_type == "in-person"){echo "selected=\"true\"";}?>>In-Person</option>
        </select>

        <label for="event_price">Price</label>
        <input type="number" step="0.01" id="event_price" name="event_price"  value="{{$edit_event->event_price}}">

        <label for="event_date">Date</label>
        <input type="datetime-local" id="event_date" name="event_date"  value="{{$converted_date}}">

        <label for="event_city">City</label>
        <input type="text" id="event_city" name="event_city"  value="{{$edit_event->event_city}}">

        <label for="event_description">Description</label>
        <textarea id="event_description" name="event_description">{{$edit_event->event_description}}
        </textarea>

        <input type="submit" value="Update Event" name="event-btn" class="event-btn">

    </form>

    @else
        <p class="error">You must be an admin to use this page.</p>
        <h2>Update Event</h2>
    @endif
@include('footer')