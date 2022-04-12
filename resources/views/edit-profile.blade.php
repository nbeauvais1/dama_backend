@include('header')

<h2>Edit Your Profile</h2>
@foreach($user as $user)
<form action="/edited-profile" method="post" enctype="multipart/form-data">
@csrf
<label for="fname">First Name</label>
<input type="text" name="fname" id="fname" value="{{ $user->first_name }}">

<label for="lname">Last Name</label>
<input type="text" name="lname" id="lname" value="{{ $user->last_name }}">

<label for="email">Primary Email</label>
<input type="text" name="email" id="email" value="{{ $user->email }}">

<label for="secondary-email">Secondary Email</label>
<input type="text" name="secondary-email" id="secondary-email" value="{{ $user->secondary_email }}">

<label for="profile-image">Profile Image</label>
<input type="file" name="profile-image" id="profile-image" value="{{ $user->profile_image }}">

<input type="submit" value="Update Profile" name="submit" class="button">
</form>

<h3><a href="forget-password">Change Your Password</a></h3>
@endforeach

@include('footer')