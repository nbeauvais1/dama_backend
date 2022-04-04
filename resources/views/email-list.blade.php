@include('header');
<?php  
$user_id = session('session_user_id');
$admin_status = DB::table('user')
                ->where('user_id', '=', $user_id)
                ->value('admin_yn');
?>

@if($admin_status == 'Y')
<h1>Email List</h1>

@foreach($emails as $email)

<p>{{ $email->email }}</p>

@endforeach

@else
        <p class="error">You must be an admin to use this page.</p>
        <h2>Email List</h2>
    @endif
@include('footer')